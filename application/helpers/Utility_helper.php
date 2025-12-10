<?php

// ********************* DEBUGGING FUNCTIONS START *********************************************

if (!function_exists('pr')) {
    function pr($array = '', $stop_execution = 1)
    {
        echo '<pre>';
        print_r($array);
        if ($stop_execution) {
            die();
        }
    }
}

if ( ! function_exists('vd')){
    function vd($array_or_string = '',$stop_execution = 1)
    {
        echo '<pre>';
        var_dump($array_or_string);
        echo "<br>";
        if ($stop_execution) {
            die();
        }
    }
}

if ( ! function_exists('enable_error')){
    function enable_error() {
        error_reporting(1);
        ini_set('display_errors', true);
    }
}

if ( ! function_exists('query')){
    function query($stop_execution = 1)
    {
        $CI = & get_instance();
        echo '<pre>';
        print_r($CI->db->last_query());
        if($stop_execution){
            die();
        }
    }
}

// ********************* DEBUGGING FUNCTIONS END *********************************************

// ********************* UTILITY HELPER FUNCTIONS START *********************************************

if ( ! function_exists('format_date')){
    function format_date($datestring, $format = 'd-m-Y') {
        return date($format, strtotime($datestring));
    }
}

if(!function_exists('check_array')){
    function check_array($array = array())
    {
        if (is_array($array) && array_filter($array) && count($array) > 0) {
            return true;
        } else {
            return false;
        }
    }
}

if(!function_exists('getCharCount')){
    function getCharCount($text)
    {
        $clean = trim($text);
        $clean = strip_tags($text);
        $clean = html_entity_decode($clean, ENT_QUOTES, 'UTF-8');
        return mb_strlen($clean, 'UTF-8');
    }
}

// ********************* UTILITY HELPER FUNCTIONS END *********************************************

?>