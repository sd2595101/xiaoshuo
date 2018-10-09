<?php
namespace App\Modules\Crawler\Chapter;

use QL\QueryList;
use Illuminate\Support\Facades\Cache;

class Director
{

    public $builder;

    public function __construct(BuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    public function build($bookid)
    {
        $key = __CLASS__ . '::' . __FUNCTION__ . '::bookid::' . $bookid;
        //Cache::forget($key);
        if (!Cache::has($key)) {
            Cache::forever($key, $this->rebuild($bookid));
        }

        return Cache::get($key);
    }

    private function rebuild($bookid)
    {
        $result = QueryList::get($this->builder->url($bookid))
            ->rules($this->builder->roules())
            ->range($this->builder->range())
            ->query()
            ->getData(function($data) {
            return $data;
        });
        //
        return $result;
    }
}
