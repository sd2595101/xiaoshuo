<?php

namespace App\Modules\Sites\Zhongheng;

use App\Modules\Crawler\Chapter\BuilderInterface;

class Chapter implements BuilderInterface
{
    public function url($id)
    {
        return config('sites.zhongheng.chapter.url')($id);
        return 'http://192.168.85.101/web/zhongheng-book-menu.html';
    }

    public function range()
    {
        return config('sites.zhongheng.chapter.range');
    }

    public function roules()
    {
        return config('sites.zhongheng.chapter.roules');
    }
}