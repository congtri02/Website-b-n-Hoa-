<?php

namespace App\Http\Controllers;

use App\Http\Services\New\NewService;
use Illuminate\Http\Request;

class NewShopController extends Controller
{
    protected $newService;

    public function __construct(NewService $newService)
    {
        $this->newService = $newService;
    }
    public function index(Request $request, $id = '', $slug = '')
    {

        $new = $this->newService->show();
        $news = $this->newService->getNewsByIdAndSlug($id, $slug);
//        dd($news);
        return view('new.content',[
            'new' => $new,
            'news'=> $news
        ]);
    }
}
