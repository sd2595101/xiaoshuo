<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 笔趣阁
    |--------------------------------------------------------------------------
    */
    'bequge' => [
        'top' => 'https://www.biquge.info/',
        'host' => 'www.biquge.info',
        'hotlist' => [
            'elem' => '#hotcontent .item dl dt a',
            'attr' => 'href',
        ],
        'otherlist' => [
            'elem' => '.novelslist .content .top dl dt a, .novelslist .content ul li a, #newscontent ul li span.s2 a',
            'attr' => 'href',
        ],
        'category' => [

        ],
        'page' => [
            'list' => [
                'link-elem' => '.box_con dl dd a',
                'link-attr' => 'href',
            ]
        ],
    ],
    'zhongheng' => [
        'top'       => 'http://www.zongheng.com/',
        'book_top'  => 'http://book.zongheng.com/book/{bookid}.html',
        'book_menu' => 'http://book.zongheng.com/showchapter/{bookid}.html',
        
        'category'  => [
            ['http://www.zongheng.com/mianfei/'                                 ,'免费小说' ],
            ['http://www.zongheng.com/category/1.html'                          ,'奇幻·玄幻'],
            ['http://www.zongheng.com/category/3.html'                          ,'武侠·仙侠'],
            ['http://www.zongheng.com/category/6.html'                          ,'历史·军事'],
            ['http://www.zongheng.com/category/9.html'                          ,'都市·娱乐'],
            ['http://www.zongheng.com/category/21.html'                         ,'竞技·同人'],
            ['http://www.zongheng.com/category/15.html'                         ,'科幻·游戏'],
            ['http://www.zongheng.com/category/18.html'                         ,'悬疑·灵异'],
        ],
        'rank' => [
            'top' => ['http://book.zongheng.com/rank.html']
        ],
        'store' => [
            ['http://book.zongheng.com/store/c0/c0/b0/u12/p1/v9/s9/t0/ALL.html', '全部作品'],
            ['http://book.zongheng.com/store/c1/c0/b0/u12/p1/v9/s9/t0/ALL.html', '奇幻玄幻'],
            ['http://book.zongheng.com/store/c3/c0/b0/u12/p1/v9/s9/t0/ALL.html', '武侠仙侠'],
            ['http://book.zongheng.com/store/c6/c0/b0/u12/p1/v9/s9/t0/ALL.html', '历史军事'],
            ['http://book.zongheng.com/store/c9/c0/b0/u12/p1/v9/s9/t0/ALL.html', '都市娱乐'],
            ['http://book.zongheng.com/store/c15/c0/b0/u12/p1/v9/s9/t0/ALL.html', '科幻游戏'],
            ['http://book.zongheng.com/store/c18/c0/b0/u12/p1/v9/s9/t0/ALL.html', '悬疑灵异'],
            ['http://book.zongheng.com/store/c21/c0/b0/u12/p1/v9/s9/t0/ALL.html', '竞技同人'],
            ['http://book.zongheng.com/store/c24/c0/b0/u12/p1/v9/s9/t0/ALL.html', '评论文集'],
            ['http://book.zongheng.com/store/c40/c0/b0/u12/p1/v9/s9/t0/ALL.html', '二次元'],
        ],
        'query'     => [
            'url' => 'http://search.zongheng.com/search/book',
            'key' => 'keyword',
            'list' => [
                'range'  => '.search-tab .search-result-list',
                'roules' => [
                    'image'   => ['.imgbox img', 'src'],
                    'title'   => ['.tit', 'text'],
                    'book'    => ['.tit a', 'href'],
                    'bookid'  => ['.tit a', 'href', '', function($href){
                        $pregPattern = "/http:\/\/book.zongheng.com\/book\/(\d+)\.html/";
                        if (preg_match($pregPattern, $href, $matches)) {
                            return $matches[1];
                        }
                    }],
                    'ulink'   => ['.bookinfo a:first', 'href'],
                    'uname'   => ['.bookinfo a:first', 'text'],
                    'clink'   => ['.bookinfo a:last', 'href'],
                    'cname'   => ['.bookinfo a:last', 'text'],
                    'keyword' => ['.key-word', 'text', '', function($k){return explode(' ', str_replace('关键词：', '', $k));}],
                    'desc'    => ['.se-result-infos>p', 'text', '', function($v){return str_replace("\n", '', $v);}],
                ],
            ],
        ],
        'book' => [
            'url' => function($id){return 'http://book.zongheng.com/book/'.$id.'.html';},
            //'range'  => '.box',
            'roules' => [
                'image'         => ['.book_cover img', 'src'],
                'image-title'   => ['.book_cover img', 'title'],
                'serial'        => ['.book_cover .serial', '', '', function($item){
                    //dump($item);
                }],
                //<a href="http://book.zongheng.com/showchapter/672340.html" title="剑来最新章节">剑来</a>
                'title'         => ['.status h1 a', 'text'],
                'book'          => ['.status h1 a', 'href'],
                'bookid'        => ['.status h1 a', 'href', '', function($href){
                                        $pregPattern = "/http:\/\/book.zongheng.com\/showchapter\/(\d+)\.html/";
                                        if (preg_match($pregPattern, $href, $matches)) {
                                            return $matches[1];
                                        }
                                    }],
                'ulink'   => ['.booksub a:first', 'href'],
                'uname'   => ['.booksub a:first', 'text'],
                'clink'   => ['.booksub a:last', 'href'],
                'cname'   => ['.booksub a:last', 'text'],
                'length'  => ['.booksub span', 'text'],
                'keyword' => ['.status .keyword a', 'text'],
                'keyword-link' => ['.status .keyword a', 'href'],
                'vote_info' => ['.vote_info p*', 'text', '', function($item){
                    $list = explode("\n", $item);
                    $list = array_map('trim', $list);
                    $list = array_diff($list, array(''));
                    return array_map(function($one){
                        list($name, $value) = explode('：', $one);
                        return array(
                            'name'  => $name,
                            'value' => $value,
                        );
                    }, $list);
                }],
                
                'desc'    => ['.info_con', 'text', '', function($v){return str_replace("\n", '', $v);}],
            ],
        ],
        // 'chapter' => [
        //     'url' => function($id){return 'http://book.zongheng.com/showchapter/'.$id.'.html';},
        //     'range' => '.booklist table td',
        //     'roules' => [
        //         //'tomename' => ['.booklist', 'tomename'],
        //         'chapterid' => ['<tr>td', 'chapterid'],
        //         'chaptername' => ['a', 'text'],
        //     ]
        // ],
        'chapter' => [
            'url' => function($id){return 'http://book.zongheng.com/showchapter/'.$id.'.html';},
            'range' => '.booklist td',
            'roules' => [
                'chaptername' => ['a', 'text'],
            ]
        ],
   ]
];
