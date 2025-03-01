<?php
if (!function_exists('add_query_param')) {
    function add_query_param($url, $key, $value) {
        $url_parts = parse_url($url);
        
        if (isset($url_parts['query'])) {
            parse_str($url_parts['query'], $params);
        } else {
            $params = array();
        }
        
        $params[$key] = $value;
        
        $url_parts['query'] = http_build_query($params);
        
        return build_url($url_parts);
    }
}

if (!function_exists('build_url')) {
    function build_url($url_parts) {
        $scheme   = isset($url_parts['scheme']) ? $url_parts['scheme'] . '://' : '';
        $host     = isset($url_parts['host']) ? $url_parts['host'] : '';
        $port     = isset($url_parts['port']) ? ':' . $url_parts['port'] : '';
        $user     = isset($url_parts['user']) ? $url_parts['user'] : '';
        $pass     = isset($url_parts['pass']) ? ':' . $url_parts['pass']  : '';
        $pass     = ($user || $pass) ? "$pass@" : '';
        $path     = isset($url_parts['path']) ? $url_parts['path'] : '';
        $query    = isset($url_parts['query']) ? '?' . $url_parts['query'] : '';
        $fragment = isset($url_parts['fragment']) ? '#' . $url_parts['fragment'] : '';
        
        return "$scheme$user$pass$host$port$path$query$fragment";
    }
}