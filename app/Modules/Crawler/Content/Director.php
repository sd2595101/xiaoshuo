<?php

namespace App\Modules\Crawler\Content;
use QL\QueryList;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client as GHttpClient;
use GuzzleHttp\RequestOptions as GROption;
use phpQuery;


class Director
{
	public $builder;
	private static $ghttpclient = null;

	public function __construct(BuilderInterface $builder)
	{
		$this->builder = $builder;
	}
    
    public static function getCacheKey($bookid, $chapterid, $site = null)
    {
        return __CLASS__.'::'. 'build' .'::bookid::'.$bookid . '::chapterid::'.$chapterid . '::site::'.$site;
    }
    
    public static function getCache($bookid, $chapterid, $site = null)
    {
        $key = self::getCacheKey($bookid, $chapterid, $site);
        
        return Cache::get($key);
    }
    
    public static function clearCache($bookid, $chapterid, $site)
    {
        $key = self::getCacheKey($bookid, $chapterid, $site);
        Cache::forget($key);
    }
    

	public function build($bookid, $chapterid, $site = null)
	{
	    $key = __CLASS__.'::'.__FUNCTION__ .'::bookid::'.$bookid . '::chapterid::'.$chapterid . '::site::'.$site;
	    
	    if (!Cache::has($key)) {
	        Cache::forever($key, $this->rebuild($bookid, $chapterid, $site));
	    }
	    
	    $result = Cache::get($key);
        if (!isset($result['content'])) {
            Cache::forget($key);
        }
        return $result;
	}
    public static function getGHttpClient()
    {
        if (is_null(self::$ghttpclient)) {
            self::$ghttpclient = new GHttpClient();
        }
        return self::$ghttpclient;
    }
	private function rebuild($bookid, $chapterid, $site = null)
	{
        $url = $this->builder->url($bookid, $chapterid);
        //
        //$ql = QueryList::getInstance()->get($url);
        //dump($ql);
        
        $client = self::getGHttpClient();
        $realRequestOption = [
            GROption::ALLOW_REDIRECTS => false
        ];
        if (!Cache::has($url)) {
	        $response = $client->request('GET', $url, $realRequestOption);
	        $html = $response->getBody()->getContents();
	        
	        
	        Cache::set($url, $html, 12 * 60);
        } 
        $html = Cache::get($url);
        
        $doc = phpQuery::newDocumentHTML($html);
        
        if (strtoupper($doc->charset) != 'UTF-8') {
            $html = mb_convert_encoding($html, 'UTF-8', $doc->charset);
            $html = str_replace('charset='.$doc->charset,'charset=utf-8',$html);
        }
        
        $ql = QueryList::html($html);
	    $result = $ql
        	    ->rules($this->builder->roules())
        	    ->query()
        	    ->getData();
        
        $info = $result[0] ?? $result;
        $info['original_url'] = $url;
        return $info;
	}
}