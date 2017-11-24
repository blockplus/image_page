<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utils {
    /* =========================================================================
     * @param string $algo The algorithm (md5, sha1, whirlpool, etc)
     * @param string $data The data to encode
     * @param string $salt The salt (This should be the same throughout the system probably)
     * @return string The hashed/salted data
      ======================================================================== */

    public static function hash($algo, $data, $salt) {
        $context = hash_init($algo, HASH_HMAC, $salt);
        hash_update($context, $data);
        return hash_final($context);
    }

    /* =========================================================================
      Clear the old cache (usage optional)
      ======================================================================= */

    public static function no_cache() {
        $ci = & get_instance();
        $ci->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $ci->output->set_header("Pragma: no-cache");
    }

    ///////////////////////////////////////////////

    public static function getCurlPost($url, $data)
    {
        // $data = array(
        //         'patient_id'      => '1',
        //         'department_name' => 'a',
        //         'patient_type'    => 'b'
        // );
        $data_string = json_encode($data);
        //$url = 'http://localhost/patient-portal/api/patient/visit';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data
        // Send the request
        $result = curl_exec($curl);
        // Free up the resources $curl is using
        curl_close($curl);

        return $result;
    }

    public static function get_sim2score($sim) {
        $max_match = 60;
        $total_match = min($max_match, $sim);
        return round($total_match * 100.0 / $max_match, 2);
    }   
}
?>