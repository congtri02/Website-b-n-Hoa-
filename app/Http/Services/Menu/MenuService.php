<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use function Laravel\Prompts\select;

class MenuService{

	public function getParent()
	{
		return Menu::where('parent_id', 0)->get();
		// return Menu::
		// where($parent_id = 0, function ($query) use ($parent_id){
		// 	$query->where('parent_id',$parent_id);
		// })
 	// 	->get()
	}

    public function show()
    {
        return Menu::select('name','id','created_at')->where('parent_id',0)->orderbyDesc('id')->get();
    }

	public function getAll()
	{
		return Menu::orderbyDesc('id')->paginate(20); //sắp xếp theo lơn nhất orderbyDesc
	}


	public function create($request)
	{

	try{
		Menu::create([
			'name' => (string) $request->input('name'),
			'parent_id' => (int) $request->input('parent_id'),
			'description' => (string) $request->input('description'),
			'content' => (string) $request->input('content'),
			'active' => (string) $request->input('active')




		]);
		Session::flash('success','tạo Danh Mục thành công');
	}catch(\Exception $err){
			Session::flash('error',$err->getMessage());
			return flash;
		}
		return true;
	}

	public function destroy($request)
	{
		$id = (int)$request->input('id');
		$menu = Menu::where('id', $id)->first();
		if ($menu) {
			return Menu::where('id',$id)->orWhere('parent_id', $id)->delete();
		}
		return false;
	}
	public function update($request,$menu):bool
	{
		if ($request->input('parent_id') != $menu->id) {
            $menu->parent_id = (int)$request->input('parent_id');
        }
		// $menu->fill($request->input());
		// $menu->save();
		$menu->name = (string)$request->input('name');
		$menu->description = (string)$request->input('description');
		$menu->content = (string)$request->input('content');
		$menu->active = (string)$request->input('active');
		$menu->save();

		session::flash('success', 'cập nhật thành công');
		return true;
	}
    public function getId($id)
    {
        return Menu::where('id', $id)->where('active', 1)->firstOrFail();
    }
    public function getProduct($menu, $request)
    {
        //dd($request->input('price'));
        $query = $menu->products()
            ->select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1);
//        dd($request->input('price'));
        if ($request->input('price')) {
            $query->orderBy('price', $request->input('price'));
        }

        return $query
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

    }

}

