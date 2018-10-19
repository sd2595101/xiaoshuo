<?php
namespace App\Modules\Utility;


class NovelUtility
{
    
    
    
    public static function convertZHChaptersVolumeMerge($list)
    {
        $res = [];
        
        foreach ($list as $vg => $v) {
            $clist = $v['chapter-list'] ?? [];
            foreach ($clist as $c) {
                $c['vg'] = $vg;
                $c['volume'] = $v['volume'];
                $res[] = $c;
            }
        }
        
        $chapters = [];
        
        foreach ($res as $key => $val) {
            
            $prevKey = $key - 1;
            $nextKey = $key + 1;
            $val['prev'] = $res[$prevKey]['chapterid'] ?? '';
            $val['next'] = $res[$nextKey]['chapterid'] ?? '';
            $chapters[$val['chapterid']] = $val;
        }
        
        return $chapters;
    }
    
}