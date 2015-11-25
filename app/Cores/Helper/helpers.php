<?php

if (!function_exists('gratavarUrl')) {
    /**
     * Gravatar URL from Email address
     *
     * @param string $email Email address
     * @param string $size Size in pixels
     * @param string $default Default image [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $rating Max rating [ g | pg | r | x ]
     *
     * @return string
     */
    function gratavarUrl($email, $size = 60, $default = 'mm', $rating = 'g') {

        return 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . "?s={$size}&d={$default}&r={$rating}";
    }
}


/**
 * Backend menu active
 * @param $path
 * @param string $active
 * @return string
 */
function setActive($path, $active = 'active') {

    if (is_array($path)) {

        foreach ($path as $k => $v) {
            $path[$k] = $v;
        }
    } else {
        $path = $path;
    }

    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

/**
 * @return mixed
 */
function getLang() {

//    return LaravelLocalization::getCurrentLocale();
}

/**
 * @param null $url
 * @return mixed
 */
function langURL($url = null) {

    //return LaravelLocalization::getLocalizedURL(getLang(), $url);

    return getLang() . $url;
}

/**
 * @param $route
 * @return mixed
 */
function langRoute($route, $parameters = array()) {

    return URL::route(getLang() . "." . $route, $parameters);
}

/**
 * @param $route
 * @return mixed
 */
function langRedirectRoute($route) {

    return Redirect::route(getLang() . "." . $route);
}

function my_substr($text, $nr) {
    return strlen($text) > $nr ? (substr($text, 0, $nr - 3) . '...') : $text;
}
function aproximate_time($seconds, $date_added) {
    switch ($seconds) {
        case $seconds < 60:
            return $seconds . ' seconds ago';
            break;
        case $seconds >= 60 && $seconds < 120:
            return '1 minute ago';
            break;
        case $seconds >= 120 && $seconds < 3600:
            $min = floor($seconds / 60);
            return $min . ' minutes ago';
            break;
        case $seconds >= 3600 && $seconds < 86400:
            $min = floor($seconds / 3600);
            return ($min > 1) ? $min . ' hours ago' : $min . ' hour ago';
            break;
        case $seconds >= 86400 && $seconds < 259200:
            $min = floor($seconds / 86400);
            return $min . ' day(s) ago';
            break;
        case $seconds >= 259200:
            //return date('F d, Y h:i', strtotime($date_added));
            return date('F d, Y h:i a', strtotime($date_added));
            break;
    }
}

function parse_link($text) {
    $text = strtolower($text);
    $not_allowed = " /[]-{}\'\\|\"?><,.~`!@#$%^&*()_+=-";

    for ( $i = 0; $i < strlen($not_allowed); $i++ ) {
        $text = str_replace($not_allowed[$i], '_', $text);
    }

    return $text;
}

function array_to_json( $array ){
    if( !is_array( $array ) ){
        return false;
    }

    $associative = count( array_diff( array_keys($array), array_keys( array_keys( $array )) ));
    if( $associative ){

        $construct = array();
        foreach( $array as $key => $value ){

            // We first copy each key/value pair into a staging array,
            // formatting each key and value properly as we go.

            // Format the key:
            if( is_numeric($key) ){
                $key = "key_$key";
            }
            $key = "\"".addslashes($key)."\"";

            // Format the value:
            if( is_array( $value )){
                $value = array_to_json( $value );
            } else if( !is_numeric( $value ) || is_string( $value ) ){
                $value = "\"".addslashes($value)."\"";
            }

            // Add to staging array:
            $construct[] = "$key: $value";
        }

        // Then we collapse the staging array into the JSON form:
        $result = "{ " . implode( ", ", $construct ) . " }";

    } else { // If the array is a vector (not associative):

        $construct = array();
        foreach( $array as $value ){

            // Format the value:
            if( is_array( $value )){
                $value = array_to_json( $value );
            } else if( !is_numeric( $value ) || is_string( $value ) ){
                $value = "'".addslashes($value)."'";
            }

            // Add to staging array:
            $construct[] = $value;
        }

        // Then we collapse the staging array into the JSON form:
        $result = "[ " . implode( ", ", $construct ) . " ]";
    }

    return $result;
}

function populate_days($day = '') {
    for ( $i = 1; $i <= 31; $i++ ) {
        echo '<option' . ( $day == $i ? ' selected' : '' ) . ' value="' . $i . '">' . $i . '</option>';
    }
}

function populate_months($month = '') {
    $months = array('', 'January', 'February', 'March', 'April', 'May', 'June' , 'July', 'August', 'September', 'October', 'November', 'December');

    for ( $i = 1; $i <= 12; $i++ ) {
        echo '<option' . ( $month == $i ? ' selected' : '' ) . ' value="' . $i . '">' . $months[$i] . '</option>';
    }
}

function populate_years($year = '') {
    $start = date('Y') - 13;
    for ( $i = $start; $i >= 1950; $i-- ) {
        echo '<option' . ( $year == $i ? ' selected' : '' ) . ' value="' . $i . '">' . $i . '</option>';
    }
}