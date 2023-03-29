<?php
/**
 * Basta Contributie Overzicht
 *
 * @package   Basta_Contributie
 * @author    Paul Bakker
 * @link      http://example.com/basta-contributie
 * @copyright 2023 Paul Bakker
 * @license   GPL-2.0+
 */

if ( ! class_exists( 'Gamajo_Template_Loader' ) ) {
    require plugin_dir_path( __FILE__ ) . 'class-gamajo-template-loader.php';
}

/**
 * Template loader for Basta Contributie.
 *
 * Only need to specify class properties here.
 *
 * @package Basta_Contributie
 * @author  Paul Bakker
 */
class Basta_Contributie_Template_Loader extends Gamajo_Template_Loader {
    /**
     * Prefix for filter names.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $filter_prefix = 'basta_contributie';

    /**
     * Directory name where custom templates for this plugin should be found in the theme.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $theme_template_directory = 'basta-contributie';

    /**
     * Reference to the root directory path of this plugin.
     *
     * Can either be a defined constant, or a relative reference from where the subclass lives.
     *
     * In this case, `MEAL_PLANNER_PLUGIN_DIR` would be defined in the root plugin file as:
     *
     * ~~~
     * define( 'MEAL_PLANNER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
     * ~~~
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $plugin_directory = BASTA_CONTRIBUTIE_PLUGIN_DIR;

    /**
     * Directory name where templates are found in this plugin.
     *
     * Can either be a defined constant, or a relative reference from where the subclass lives.
     *
     * e.g. 'templates' or 'includes/templates', etc.
     *
     * @since 1.1.0
     *
     * @var string
     */
    protected $plugin_template_directory = 'templates';
}