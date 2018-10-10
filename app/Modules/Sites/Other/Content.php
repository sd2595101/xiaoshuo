<?php
namespace App\Modules\Sites\Other;

use Illuminate\Support\Facades\Cache;
use App\Modules\Crawler\Content\BuilderInterface;
use QL\QueryList;
use App\Modules\Crawler\Book\Director as BookDirector;
use App\Modules\Crawler\Content\Director as ContentDirector;
use App\Modules\Utility\StringUtility;
use App\Modules\Utility\AI;

class Content implements BuilderInterface
{

    public function url($bookid, $chapterid)
    {
        $book = BookDirector::getCache($bookid);
        $chapter = ContentDirector::getCache($bookid, $chapterid);
        $title = trim($book[ 'title' ]);
        $chapter['title'] = StringUtility::standardizationChapterTitle($chapter['title']);
        // search by book name for sodu.cc
        $queryurl = 'http://www.sodu.cc/result.html?searchstr=' . \urlencode($title);
        $q = Cache::get($queryurl, function() use ($queryurl, $title) {
                sleep(1);
                $q = QueryList::getInstance()
                    ->get($queryurl)
                    ->range('body')
                    ->rules([
                        'links' => ['.main-html a', ['text' => 'text', 'href' => 'href'], ''],
                    ])
                    ->query()
                    ->getData(function($e) use ($title) {
                        foreach ($e[ 'links' ] as $link) {
                            if (trim($link[ 'text' ]) == $title) {
                                return $link[ 'href' ];
                            }
                        }
                        return false;
                    }
                );
                Cache::forever($queryurl, $q);
                return $q;
            }
        );
        // get the book url
        $url = $q[ 0 ] ?? null;
        if (!$url) {
            dump($queryurl);
            dump($q);
            throw new \Exception('error : search book url from sodu.');
        }
        // find the book chapter-list url
        $q2 = Cache::get($url, function() use ($url){
            if (Cache::has($url)) {
                return Cache::get($url);
            }
            sleep(1);
            $q2 = QueryList::getInstance()
                ->get($url)
                ->range('body')
                ->rules([
                    'links' => ['.main-html a.tl', ['text' => 'text', 'href' => 'href'], ''],
                ])
                ->query()
                ->getData();
            Cache::forever($url, $q2);
            return $q2;
        });
        
        $sites = ['27', '21'];
        $contentUrl = false;
        $menuurl = null;
        for ($site = 0; $site < 10; $site ++) {
            //dump($menuurl);
            $menuurl = $q2[ 0 ][ 'links' ][ $site ][ 'href' ] ?? false;
            
            //Cache::forget($menuurl);
            try {
                $q3 = Cache::get($menuurl, function() use ($menuurl) {
                    sleep(1);
                    $q3 = QueryList::getInstance()
                    ->get($menuurl)
                    ->rules([
                        'chapterlist' => ['td>a', ['href' => 'href','text' => 'text']],
                    ])
                    ->range('table')
                    ->query()
                    ->getData(function($e) {
                        $e['chapterlist'] = array_map(function($one){
                            $parts = explode('chapterurl=', $one['href'] ?? '');
                            $one['href'] = array_pop($parts);
                            return $one;
                        }, $e['chapterlist'] ?? []);
                        return $e;
                    });
                    Cache::forever($menuurl, $q3);
                    return $q3;
                });
            } catch (\Exception $ex) {
                echo $ex;
                dump($menuurl);
                continue;
            }
            
            $chapterlist = $q3[3]['chapterlist'];
            foreach ($chapterlist as $chapterlink) {
                if (StringUtility::standardizationChapterTitle($chapterlink['text']) == $chapter['title']) {
                    $contentUrl = $chapterlink['href'];
                    break;
                }
            }
            if ($contentUrl !== false) {
                break;
            }
            
            // if un maching the chapter name
            // go to the first chapter page and find chapter list
            $anyContentUrl = $q3[3]['chapterlist'][0]['href'] ?? '';
            
            if (!$anyContentUrl) {
                break;
            }
            //dump($anyContentUrl);
            try {
                $contentHtml = QueryList::getInstance()->get($anyContentUrl)->getHtml();
                sleep(1);
                $clurl = AI::findChapterListUrl($contentHtml, $anyContentUrl);
                //dump($clurl);exit;
                $clHtml = QueryList::getInstance()->get($clurl)->getHtml();
                $contentUrl = AI::findContentUrl($clHtml, $chapter['title'], $clurl);
                //dump($contentUrl);
                if ($contentUrl) {
                    return $contentUrl;
                }
                
            } catch (\Exception $ex) {
                //dump($ex);
                break;
            }
        }
        if (!$contentUrl) {
            throw new \Exception('error : search content url from sodu.');
        }
        dump($contentUrl);
        //$contentUrl = 'http://192.168.56.101/test.html';
        //dump($contentUrl);
        return $contentUrl;
    }

    public function range()
    {
        return false;
    }

    public function roules()
    {
        return config('sites.76wx.content.roules');
    }
}
