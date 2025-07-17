<?php

namespace App\Helpers;

class StringHelper
{
    /**
     * Safely limit a string to a specified length
     * 
     * @param string|null $string
     * @param int $limit
     * @param string $end
     * @return string
     */
    public static function safeLimit($string, $limit = 100, $end = '...')
    {
        if (empty($string)) {
            return '';
        }
        
        $string = (string) $string;
        
        // Use iconv if available, otherwise fallback to substr
        if (function_exists('iconv') && extension_loaded('iconv')) {
            $limited = iconv_substr($string, 0, $limit, 'UTF-8');
        } else {
            $limited = substr($string, 0, $limit);
        }
        
        if (strlen($string) <= $limit) {
            return $string;
        }
        
        return rtrim($limited) . $end;
    }
    
    /**
     * Get first character of a string safely
     * 
     * @param string|null $string
     * @return string
     */
    public static function firstChar($string)
    {
        if (empty($string)) {
            return '';
        }
        
        $string = (string) $string;
        
        // Use iconv if available, otherwise fallback to substr
        if (function_exists('iconv') && extension_loaded('iconv')) {
            return iconv_substr($string, 0, 1, 'UTF-8');
        }
        
        return substr($string, 0, 1);
    }
} 