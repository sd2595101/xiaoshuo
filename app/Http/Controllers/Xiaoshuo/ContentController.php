<?php

namespace App\Http\Controllers\Xiaoshuo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Crawler\Chapter\Director as ChapterDirector;
use App\Modules\Sites\Zhongheng\Chapter;
use App\Modules\Crawler\Book\Director as BookDirector;
use App\Modules\Sites\Zhongheng\Book;

use App\Modules\Crawler\Content\Director as ContentDirector;
use App\Modules\Sites\Zhongheng\Content;


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
        $content = new Content();
        $director = new ContentDirector($content);
        $contentData = $director->build($bookid, $chapterid);
        //dump($contentData);exit;
        $bookBuilder = new Book();
        $bookDirector = new BookDirector($bookBuilder);
        $bookInfo = $bookDirector->build($bookid);
        //dump($bookInfo);exit;
        return view('xiaoshuo.content', array(
            'info' => $contentData,
            'book' => $bookInfo[0] ?? [],
        ));

        
        
    }
}
