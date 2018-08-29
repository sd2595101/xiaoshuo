<?php

namespace App\Modules\Crawler\Search;
use QL\QueryList;

class Director
{
	public $builder;

	public function __construct(BuilderInterface $builder)
	{
		$this->builder = $builder;
	}

	public function build($keyword)
	{
		return QueryList::get($this->builder->url($keyword))
			->range($this->builder->range())
			->rules($this->builder->roules())
			->query()
			->getData();
	}
}