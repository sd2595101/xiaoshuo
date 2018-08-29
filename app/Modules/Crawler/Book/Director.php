<?php

namespace App\Modules\Crawler\Book;
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
		return QueryList::get($this->builder->url($bookid))
			->range($this->builder->range())
			->rules($this->builder->roules())
			->query()
			->getData();
	}
}