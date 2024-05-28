<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Services\New\NewService;

class NewController extends Controller
{
	protected $newService;

    public function __construct(NewService $newService)
    {
        $this->newService = $newService;
    }
    public function create()
    {
    	return view('admin.new.add', [
            'title' => 'Thêm tin tức mới',
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'Blog_title' => 'required',
            'thumb' => 'required',
            'description'   => 'required'
        ]);
        $this->newService->insert($request);

        return redirect()->back();
    }
     public function index()
    {
        return view('admin.new.list', [
            'title' => 'Danh Sách Tin tức Mới Nhất',
            'news' => $this->newService->get()
        ]);
    }
     public function show($id,News $new)
    {
         $news = $new->where("id", $id)->first();
    // echo "<pre>"; print_r($dataSlider);exit;
    return view('admin.new.edit', [
        'title' => 'Chỉnh Sửa tin tức', // Xóa 'news' đi
        'news' => $news
    ]);

    }
    public function update(Request $request, $id)
{
    $this->validate($request, [
        'Blog_title' => 'required',
        'thumb' => 'required',
        'description'   => 'required'
    ]);

    $new = News::findOrFail($id);

    $result = $this->newService->update($request, $new);

    if ($result) {
        return redirect()->route('news.list')->with('success', 'Cập nhật tin tức thành công');
    }

    return redirect()->back()->with('error', 'Cập nhật tin tức thất bại');
}

     public function destroy(Request $request)
    {
        $result = $this->newService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công tin tức'
            ]);
        }

        return response()->json(['error' => true]);
    }

}
