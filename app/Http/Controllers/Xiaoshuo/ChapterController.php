<?php

namespace App\Http\Controllers\Xiaoshuo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Crawler\Chapter\Director;
use App\Modules\Sites\Zhongheng\Chapter;
use App\Modules\Crawler\Book\Director as BookDirector;
use App\Modules\Sites\Zhongheng\Book;


class ChapterController extends Controller
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
    public function index($bookid)
    {
        $chapter = new Chapter();
        $director = new Director($chapter);
        $list = $director->build($bookid);
        
        $bookBuilder = new Book();
        $bookDirector = new BookDirector($bookBuilder);
        $info = $bookDirector->build($bookid);
        return view('xiaoshuo.chapter', array(
            'list' => $list,
            'book' => $info,
        ));
    }
}
