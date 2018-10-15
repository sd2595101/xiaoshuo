<?php

namespace App\Modules\Crawler\Content;
use QL\QueryList;
use Illuminate\Support\Facades\Cache;

class Director
{
	public $builder;

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
	
	private function rebuild($bookid, $chapterid, $site = null)
	{
        $url = $this->builder->url($bookid, $chapterid);
        //dump($url);
        $ql = QueryList::getInstance()->get($url);
	    $result = $ql
        	    ->rules($this->builder->roules())
        	    ->query()
        	    ->getData();
        
        $info = $result[0] ?? $result;
        $info['original_url'] = $url;
        return $info;
	}
}