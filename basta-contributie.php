<?php
/*
Plugin Name: Basta Contributie
Plugin URI: https://github.com/usbpaul/basta-contributie
Description: Toont voor een ingelogd lid zijn contributie-status
Version: 1.0.0
Author: Paul Bakker
Author URI: https://github.com/usbpaul
License: GPL2

Copyright 2023  Paul Bakker

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once ("includes/class-vgb-contributie-template-loader.php");
require ("includes/UserPayments.php");

define( 'BASTA_CONTRIBUTIE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

function vgbct_contributie_detail( $attrs ) {
    $template_loader = new Basta_Contributie_Template_Loader();
    $userPayments = new Basta\UserPayments();
    $data = array(
        'user_firstname' => wp_get_current_user()->get("user_firstname"),
        'betaald_tot' => $userPayments->getBetaaldTotVoorUserId(get_current_user_id())
    );

    $template_loader->set_template_data($data)->get_template_part("vgbct-detail");
}

add_shortcode( 'vgb-contributie-detail', 'vgbct_contributie_detail' );

add_action( 'init', 'vgbct_register_script' );
function vgbct_register_script() {
	wp_register_script( 'vgbct_script', plugins_url('/js/vgbct-script.js', __FILE__), array(), '1.0.0' );
	wp_register_style( 'vgbct_style', plugins_url( '/css/vgbct-style.css', __FILE__ ), false, '1.0.0', 'all' );
}
add_action( 'wp_enqueue_scripts', 'vgbct_enqueue_style' );
function vgbct_enqueue_style() {
	wp_enqueue_script('vgbct_script');
	wp_enqueue_style( 'vgbct_style' );
}
