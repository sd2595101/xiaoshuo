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

	public function build($bookid, $chapterid)
	{
	    $key = __CLASS__.'::'.__FUNCTION__ .'::bookid::'.$bookid . '::chapterid::'.$chapterid;
	    
	    if (!Cache::has($key)) {
	        Cache::forever($key, $this->rebuild($bookid, $chapterid));
	    }
	    
	    return Cache::get($key);
	}
	
	private function rebuild($bookid, $chapterid)
	{
	    $result = QueryList::get($this->builder->url($bookid, $chapterid))
        	    ->rules($this->builder->roules())
        	    ->query()
        	    ->getData(function($data){
        	        return $data;
        	    });
        $info = $result[0] ?? false;
        $isVip = $info['isvip'] ?? false;
        if ($isVip) {
            $info = $this->buildByOtherSite($info);
        }
        return $info;
	}
	
	private function buildByOtherSite($info)
	{
	    return $info;
	}
}