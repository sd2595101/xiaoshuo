<?php
namespace App\Modules\Utility;

use QL\QueryList;
use phpQuery;
use App\Modules\Utility\StringUtility;

class AI
{
    const INTERNAL_ENCODING = 'UTF-8';
    
    public static function getChapterListNeedle()
    {
        return [
            '返回目录',
            '章节列表',
            '章节目录',
            '查看目录',
            '目录',
        ];
    }
    
    /**
     * 
     * @param type $url
     * @param type $return PHP_URL_SCHEME, PHP_URL_HOST, PHP_URL_PORT, PHP_URL_USER, PHP_URL_PASS, PHP_URL_PATH, PHP_URL_QUERY or PHP_URL_FRAGMENT
     */
    public static function parseUrl($url, $return = PHP_URL_HOST)
    {
        if (is_null($return)) {
            return parse_url($url);
        }
        return parse_url($url, $return);
    }
    
    public static function getUrlBase($url)
    {
        $proto = self::parseUrl($url, PHP_URL_SCHEME);
        $host = self::parseUrl($url, PHP_URL_HOST);
        return $proto . '://'.$host.'/';
    }
    
    public static function findChapterListUrl($html, $url)
    {
        $base = self::getUrlBase($url);
        $links = self::findAllSiteLinks($html);
        $needles = self::getChapterListNeedle();
        foreach ($needles as $needle) {
            $position = array_search($needle, $links);
            if ($position !== false) {
                $parses = self::parseUrl($position, null);
                if (isset($parses['scheme'])) {
                    return $position;
                }
                return $base . $position;
            }
        }
        return false;
    }
    public static function findContentUrl($chapterListHtml, $chapterTitle, $url)
    {
        $base = self::getUrlBase($url);
        $allLinks = self::findAllSiteLinks($chapterListHtml);
        foreach ($allLinks as $href => $title) {
            if (StringUtility::standardizationChapterTitle($title) == $chapterTitle) {
                $parses = self::parseUrl($href, null);
                if (isset($parses['scheme'])) {
                    return $href;
                } else if (substr($href, 0, 1) == '/') {
                    return $base . $href;
                }
                return $url . $href;
            }
        }
        return false;
    }
    public static function findAllSiteLinks($html)
    {
        
        $pqObj = phpQuery::newDocumentHTML($html);
        $charset = self::getCharset($html);
        if ($charset != self::INTERNAL_ENCODING) {
            // if need iconv
        }
        $links = [];
        $doc = phpQuery::newDocumentHTML($html);
        $doc->find('a')->each(function($a) use (&$links){
            $text = StringUtility::trim($a->textContent);
            $href = $a->getAttribute('href');
            if (strpos(strtolower($href), 'javascript') !== false) {
                return;
            }
            
            if ($text == '') {
                return;
            }
            if (isset($links[$text]) && $links[$text] != $href ) {
                //throw new \LogicException('Duplicate link text on ' . $text);
            }
            //$links[$text] = $href;
            $links[$href] = $text;
        });
        return $links;
    }
    
    public static function getCharset($html)
    {
        return strtoupper(phpQuery::newDocumentHTML($html)->charset ?? self::INTERNAL_ENCODING);
    }
}