<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use DB;
use Session;

class SliderController extends Controller
{
    protected $slider;

    public function __construct(SliderService $slider)
    {
        $this->slider = $slider;
    }
    public function create()
    {
        return view('admin.slider.add', [
            'title' => 'Thêm SLider mới'
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'thumb' => 'required',
            'url'   => 'required'
        ]);

        $this->slider->insert($request);

        return redirect()->back();
    }
    public function index()
    {
        return view('admin.slider.list', [
            'title' => 'Danh Sách Slider Mới Nhất',
            'sliders' => $this->slider->get()
        ]);
    }
    public function show($id,Slider $slider)
    {
        $dataSlider = $slider->where("id",$id)->first();
        // echo "<pre>"; print_r($dataSlider);exit;
        return view('admin.slider.edit', [
            'title' => 'Chỉnh Sửa Slider',
            'slider' => $dataSlider
        ]);

    }

    public function update(Request $request, Slider $slider)
    {
//         /dd($_REQUEST);
        $this->validate($request, [
            'name' => 'required',
            'thumb' => 'required',
            'url'   => 'required'
        ]);
        $result = $slider->where(
        [
            "id" => $request->id_slider
        ])->update(
            [
                'name' => $request->name,
                'thumb'=> $request->thumb,
                'url'=> $request->url,
                'active'=> $request->active
            ]
        );

        if ($result) {
            Session::flash('success', 'Cập nhật Slider thành công');
            return redirect('/admin/sliders/list');
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->slider->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công Slider'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }
}



