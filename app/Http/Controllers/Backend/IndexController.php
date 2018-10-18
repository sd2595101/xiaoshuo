<?php
namespace App\Http\Controllers\Xiaoshuo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Crawler\Book\Director;
use App\Modules\Sites\Zhongheng\Book;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
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
        $builder = new Book();
        $director = new Director($builder);
        $info = $director->build($bookid);
        
        //$isLogin = !Auth::guest();
        //dump($isLogin);

        return view('xiaoshuo.book', array('book' => $info));
    }
}
