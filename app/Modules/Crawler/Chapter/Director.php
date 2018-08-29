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
		$ql = QueryList::get($this->builder->url($bookid));
		
		$tomenames = $ql->find('.booklist')->attrs('tomename');
		
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