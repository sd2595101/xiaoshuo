<?php

namespace App\Modules\Crawler\Chapter;
use QL\QueryList;

class Director
{
	public $builder;

	public function __construct(BuilderInterface $builder)
	{
		$this->builder = $builder;
	}

	public function build($bookid)
	{
	    $result = QueryList::get($this->builder->url($bookid))
        	    ->range($this->builder->range())
        	    ->rules($this->builder->roules())
        	    ->query()
        	    ->getData(function($data){
        	        return $data;
        	    });
	    //
	    //dump($result);exit;
        return $result;
	}
	
	public function _____________build_delete($bookid)
	{
	    $ql = QueryList::get($this->builder->url($bookid));
	    
	    $tomenames = $ql->find('.chapter-list')->attrs('tomename');
	    
	    $result = [];
	    
	    foreach ($tomenames as $tname) {
	        
	        if ($tname == '作品相关') {
	            continue;
	        }
	        
	        $data = $ql->range('.booklist[tomename="'.$tname.'"] td')
	        ->rules([
	            'chapterid'   => ['', 'chapterid'],
	            'chaptername'   => ['a', 'text'],
	            'chaptername-t' => ['a', 'text', '', function($i) use ($tname){
	            return $tname . ' ' . $i;
	            }],
	            'chapterlink'   => ['a', 'href'],
	            ])
	            ->query()
	            ->getData()
	            ;
	            
	            $result[] = [
	                'tomename' => $tname,
	                'data' => $data,
	            ];
	    }
	    return $result;
	}
}