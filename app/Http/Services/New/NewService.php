<?php

namespace App\Http\Services\New;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewService
{
    public function insert($request)
    {
        try {
            // Tạo slug từ tiêu đề
            $slug = Str::slug($request->input('Blog_title'));

            // Thêm tin tức vào cơ sở dữ liệu
            News::create([
                'Blog_title' => $request->input('Blog_title'),
                'description' => $request->input('description'),
                'thumb' => $request->input('thumb'),
                'content' => $request->input('content'),
                'author' => $request->input('author'),
                'active' => $request->input('active'),
                'slug' => $slug, // Gán giá trị cho trường 'slug'
            ]);

            Session::flash('success', 'Thêm tin tức thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm tin tức lỗi');
            Log::info($err->getMessage());
            return false;
        }

        return true;
    }
    public function get()
    {
        return News::orderByDesc('id')->paginate(15);
    }
    public function update($request, $new)
    {
        try {
            $new->fill($request->input());
            $new->save();
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function destroy($request)
    {
        $news = News::where('id', $request->input('id'))->first();
        if ($news) { // Sử dụng $news thay vì $slider
            $path = str_replace('storage', 'public', $news->thumb);
            Storage::delete($path);
            $news->delete();
            return true;
        }

        return false;
    }
    public function show()
    {
        return News::where('active', 1)->get();
    }
    public function getNewsByIdAndSlug($id,$slug)
    {
        return News::where('id', $id)
            ->where('slug', $slug)
            ->where('active', 1)
            ->firstOrFail();
    }
}

