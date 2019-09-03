<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('app')) {
    /**
     *  Get the available library instance
     *
     *  @param     string    $make
     *  @param     array     $params
     *  @return    mixed
     */
    function app($make = null, $params = array())
    {
        $ci = &get_instance();
        if (is_null($make)) {
            return $ci;
        }
        //  Special cases 'user_agent' and 'unit_test' are loaded with diferent names
        if ($make !== 'user_agent') {
            $lib = ($make == 'unit_test')
                ? 'unit'
                : $make;
        } else {
            $lib = 'agent';
        }
        //  Library not loaded
        if (!isset($ci->$lib)) {
            //  Special case 'cache' is a driver
            if ($make == 'cache') {
                $ci->load->driver($make, $params);
            }
            //  The type of what is being loaded, i.e. a model or a library
            $loader = (ends_with($make, '_model'))
                ? 'model'
                : 'library';
            $ci->load->$loader($make, $params);
        }
        //  Special name for 'unit_test' is 'unit'
        if ($make == 'unit_test') {
            return $ci->unit;
        }
        //  Special name for 'user_agent' is 'agent'
        elseif ($make == 'user_agent') {
            return $ci->agent;
        }
        return $ci->$make;
    }
}

if (!function_exists('ci')) {
    /**
     *  Same as app() but with null parameter
     *
     *  @param     NULL
     *  @return    object
     */
    function ci()
    {
        return app();
    }
}

if (!function_exists('site_name')) {
    /**
     *  Get site_name from config.php
     *
     *  @param     NULL
     *  @return    object
     */
    function site_name()
    {
        return config_item('site_name');
    }
}

if (!function_exists('camel_case')) {
    /**
     *  Convert a string to camel case
     *
     *  @param     string    $str
     *  @return    string
     */
    function camel_case($str)
    {
        static $camel_cache = array();
        if (isset($camel_cache[$str])) {
            return $camel_cache[$str];
        }
        return $camel_cache[$str] = lcfirst(studly_case($str));
    }
}

if (!function_exists('ends_with')) {
    /**
     *  Determine if a given string ends with a given substring
     *
     *  @param     string          $haystack
     *  @param     string|array    $needles
     *  @return    boolean
     */
    function ends_with($haystack, $needles)
    {
        foreach ((array)$needles as $needle) {
            if (substr($haystack, -strlen($needle)) === (string)$needle) {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('put_underscore')) {
    /**
     *  Determine if a given string ends with a given substring
     *
     *  @param     string      $str
     *  @return    string
     */
    function put_underscore($str, $lower = true)
    {
        if (!$lower) {
            return str_replace(' ', '_', $str);
        }
        return strtolower(str_replace(' ', '_', $str));
    }
}

if (!function_exists('cut_underscore')) {
    /**
     *  Determine if a given string ends with a given substring
     *
     *  @param     string      $str
     *  @return    string
     */
    function cut_underscore($str, $uc = true)
    {
        if (!$uc) {
            return str_replace('_', '', $str);
        }
        return ucwords(str_replace(' ', '_', $str));
    }
}

if (!function_exists('first_index_arr')) {
    /**
     *  Return first index of array
     *
     *  @param     array      $arr
     *  @return    string
     */
    function first_index_arr($arr)
    {
        foreach ($arr as $k => $v) return $k;
    }
}

if (!function_exists('relative_date1')) {
    /**
     *  Escape HTML entities in a string
     *
     *  @param     string    $time
     */
    function relative_date1($time)
    {
        $today = strtotime(date('M j, Y'));
        $reldays = ($time - $today) / 86400;
        if ($reldays >= 0 && $reldays < 1) {
            return 'Today';
        } else if ($reldays >= 1 && $reldays < 2) {
            return 'Tomorrow';
        } else if ($reldays >= -1 && $reldays < 0) {
            return 'Yesterday';
        }
        if (abs($reldays) < 7) {
            if ($reldays > 0) {
                $reldays = floor($reldays);
                return 'In ' . $reldays . ' day' . ($reldays != 1 ? 's' : '');
            } else {
                $reldays = abs(floor($reldays));
                return $reldays . ' day' . ($reldays != 1 ? 's' : '') . ' ago';
            }
        }
        if (abs($reldays) < 182) {
            return date('l, j F', $time ? $time : time());
        } else {
            return date('l, j F Y', $time ? $time : time());
        }
    }
}


if (!function_exists('relative_date')) {
    /**
     *  Escape HTML entities in a string
     *
     *  @param     string    $time
     */
    function relative_date($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime('@'.$datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}

if (!function_exists('e')) {
    /**
     *  Escape HTML entities in a string
     *
     *  @param     string    $value
     *  @return    string
     */
    function e($value)
    {
        return htmlentities($value, ENT_QUOTES, 'UTF-8', false);
    }
}

if (!function_exists('assets')) {
    /**
     *  Get assets URL for project
     *
     *  @param     string    $type
     *  @param     string    $file
     *  @return    string
     */
    function assets($type = null, $file = null)
    {
        // Make sure the path on config file end with '/'
        $assets_path = ends_with(config_item('assets_path'), '/')
            ? config_item('assets_path')
            : config_item('assets_path') . '/';
        if (is_null($type)) {
            // return the URL of original assets_path
            return base_url() . $assets_path;
        }
        // $file variable is fullfil
        if (!is_null($file)) {
            // $file variable is not empty string
            if ($type != '') {
                $path = ends_with(config_item($type . '_path'), '/')
                    ? config_item($type . '_path')
                    : config_item($type . '_path') . '/';
            }
            // $file is empty string
            else {
                $path = $assets_path;
            }
        }
        // return the URL of type_path
        return base_url() . $path . $file;
    }
}

if (!function_exists('css')) {
    /**
     *  Get the url of given css path
     *
     *  @param     string    $file
     *  @return    string
     */
    function css($file)
    {
        return assets('css', $file);
    }
}

if (!function_exists('js')) {
    /**
     *  Get the url of given js path
     *
     *  @param     string    $file
     *  @return    string
     */
    function js($file)
    {
        return assets('js', $file);
    }
}

if (!function_exists('images')) {
    /**
     *  Get the url of given images path
     *
     *  @param     string    $file
     *  @return    string
     */
    function images($file)
    {
        return assets('images', $file);
    }
}

if (!function_exists('fonts')) {
    /**
     *  Get the url of given fonts path
     *
     *  @param     string    $file
     *  @return    string
     */
    function fonts($file)
    {
        return assets('fonts', $file);
    }
}

if (!function_exists('images_base64')) {
    function images_base64($file)
    {
        $path = images($file);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
}

if (!function_exists('random_color')) {
    function random_color()
    {
        $r = '';
        for ($i = 0; $i <= 2; $i++) {
            $r .= str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
        }
        return '#' . $r;
    }
}

if (!function_exists('url_encode')) {
    /**
     *  Encode plain text with php base64_encode()
     *  Used for url token
     *
     *  @param     string    $text
     *  @return    string
     */
    function url_encode($text)
    {
        return rtrim(strtr(base64_encode($text), '+/', '-_'), '=');
    }
}

if (!function_exists('url_decode')) {
    /**
     *  Decode coded text with php base64_decode
     *  Used for url token
     *
     *  @param     string    $text
     *  @return    string
     */
    function url_decode($text)
    {
        return base64_decode(str_pad(strtr($text, '-_', '+/'), strlen($text) % 4, '=', STR_PAD_RIGHT));
    }
}