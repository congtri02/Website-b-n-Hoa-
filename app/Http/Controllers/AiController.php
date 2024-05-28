<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use GuzzleHttp\Client;


class AiController extends Controller
{
    public function index()
    {
        return view('ai.index', [
            'title' => 'Tìm kiếm và xác định loài hoa'
        ]);
    }

    public function sendAi(Request $request)
    {
        $file = $request->file('file');
        $client = new Client();
        $response = $client->post('http://127.0.0.1:8000/predict', [
            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => fopen($file->getPathname(), 'r'),
                    'filename' => $file->getClientOriginalName()
                ]
            ]
        ]);
        $data = json_decode($response->getBody()->getContents(), true);


        return response()->json(['predicted_class' => $data['predicted_class']]);
    }

    public function search(Request $request)
    {
        $predictedClass = $request->input('predicted_class');

        $products = Product::where('name', 'like', '%' . $predictedClass . '%')->get();
        return response()->json(['products' => $products]);
    }
}

