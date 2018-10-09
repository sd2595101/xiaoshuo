<?php

namespace App\Http\Controllers\Xiaoshuo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Crawler\Chapter\Director as ChapterDirector;
use App\Modules\Sites\Zhongheng\Chapter;
use App\Modules\Crawler\Book\Director as BookDirector;
use App\Modules\Sites\Zhongheng\Book;

use App\Modules\Crawler\Content\Director as ContentDirector;
use App\Modules\Sites\Zhongheng\Content as ZhonghengContent;

use App\Modules\Sites\Other\Content as OtherContent;


class ContentController extends Controller
{

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index($bookid,$chapterid)
    {
        $content = new ZhonghengContent();
        $director = new ContentDirector($content);
        $contentData = $director->build($bookid, $chapterid);
        
        if ($contentData['isvip']) {
            try {
                $content = new OtherContent();
                $director = new ContentDirector($content);
                $contentData2 = $director->build($bookid, $chapterid, 'other2');
                $newContent = $contentData2['content'] ?? ['更新失败,请稍后再试'];
                $contentData['content'] = $newContent;
            } catch (\Exception $ex) {
                $contentData['content'] = ['TODO', $ex->getMessage()];
            }
        }
        
        $bookBuilder = new Book();
        $bookDirector = new BookDirector($bookBuilder);
        $bookInfo = $bookDirector->build($bookid);
        
        return view('xiaoshuo.content', array(
            'info' => $contentData,
            'book' => $bookInfo[0] ?? $bookInfo,
        ));

        
        
    }
}
