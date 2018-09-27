<?php
namespace App\Modules\Utility;


class StringUtility
{
    public static function trim($value)
    {
        return trim($value, "\\\" \t\r\n");
    }
    
    
    
    public static function divideChapterList($value)
    {
        return $value;
    }
    public static function getZhonghengChapterIdByUrl($href)
    {
        $pregPattern = "/http:\/\/book.zongheng.com\/chapter\/(\d+)\/(\d+)\.html/";
        $matches = null;
        if (preg_match($pregPattern, $href, $matches)) {
            return $matches[2];
        }
        return $href;
    }
    
    public static function getZhonghengBookIdByChapterUrl($href)
    {
        $pregPattern = "/http:\/\/book.zongheng.com\/chapter\/(\d+)\/(\d+)\.html/";
        $matches = null;
        if (preg_match($pregPattern, $href, $matches)) {
            return $matches[1];
        }
        return $href;
    }
}