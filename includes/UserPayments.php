<?php
namespace Basta;
require_once plugin_dir_path( __FILE__ ) . 'Constants.php';

class UserPayments {

    function getBetaaldTotVoorUserId($number) {
        $file_name = FINDATA_JSON;
        $fh = fopen($file_name, 'r');
        $jsondata = fread($fh, filesize($file_name));
        fclose($fh);
        $obj = json_decode($jsondata, true, 5, JSON_THROW_ON_ERROR);
        $datalist = $obj["contributies"];
        $bijgewerkt_op = $obj["bijgewerktOp"];
        foreach ($datalist as $userdata) {

            if ($userdata["id"] === $number) {
                return $this->get_betaling_string($userdata, $bijgewerkt_op);
            }

        }
        return BETALING_ONBEKEND;
    }

    function get_betaling_string($userdata, $bijgewerkt_op) {
        $betaald_totenmet = $userdata["btm"];
        $opmerkingen = $userdata["opm"];
        $kwartaal_en_jaar = explode('_', $betaald_totenmet);
        if (!preg_match('/Q[1234]_\d{4}/', $betaald_totenmet)) {
            $returnvalue = 'Het is niet gelukt om contributiegegevens voor je te vinden.';
        } else {
            $kwartaal = $this->vertaal_kwartaal($kwartaal_en_jaar[0]);
            $jaar = $kwartaal_en_jaar[1];
            $returnvalue = sprintf(
                'Je hebt betaald tot en met %s van %s.',
                $kwartaal, $jaar
            );
        }
        if (sizeof($opmerkingen) > 0) {
            foreach ($opmerkingen as $opmerking) {
                $returnvalue = sprintf(
                    '%s<br/>%s',
                    $returnvalue, $opmerking
                );
            }
        }
        $returnvalue = sprintf(
            '%s<br/>Dit overzicht is bijgewerkt op: %s',
            $returnvalue, $bijgewerkt_op
        );
        return $returnvalue;
    }

    function vertaal_kwartaal($kwartaalcode) {
        switch ($kwartaalcode) {
            case "Q1":
                $vertaling = "het eerste kwartaal";
                break;
            case "Q2":
                $vertaling = "het tweede kwartaal";
                break;
            case "Q3":
                $vertaling = "het derde kwartaal";
                break;
            case "Q4":
                $vertaling = "het vierde kwartaal";
                break;
            default:
                $vertaling = "onbekend kwartaal";
        }
        return $vertaling;
    }
}