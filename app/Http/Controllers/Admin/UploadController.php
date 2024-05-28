<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Services\UploadService as UploadService;

class UploadController extends Controller
{
    protected $upload;

    public function __construct(UploadService $upload)
    {
        $this->upload = $upload;
    }

    public  function store(Request $request)
    {
        $url = $this->upload->store($request);

        //dd($url);
//      dd($request->file());
        if($url !==  false)
        {
            return response()->json([
               'error'=> false,
                'url'=>$url,
            ]);
        }else{
            return response()->json(['error'=> true]);
        }
    }


}
