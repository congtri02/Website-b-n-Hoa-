<?php


namespace App\Helpers;

use Illuminate\Support\Str;


class Helper
{
    public static function menu($menus, $parent_id = 0, $char = '')
    {
        $html = '';

        foreach ($menus as $key => $menu) {
           // echo "<pre>"; print_r($menu->name);exit();

            if ($menu->parent_id == $parent_id){
                $html .= '
            <tr>
                    <tr>
                        <td>' . $menu->id . '</td>
                        <td>' . $char . $menu->name . '</td>
                        <td>' . self::active($menu->active) . '</td>
                        <td>' . $menu->updated_at . '</td>
                        <td>
                            <a class="btn btn-primary btn-sm"
                             href="'.route('menus.edit', [ 'menu' => $menu->id]).'">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm"
                            onclick="removeRow(' . $menu->id . ', \''.route('menus.destroy').'\')">
                        <i class="fas fa-trash"></i>
                    </a>
                        </td>
                    </tr>
                ';
//"\'.route('menus.destroy').\'"
                unset($menus[$key]);

                $html .= self::menu($menus, $menu->id, $char . '|--');
             }
        }

        return $html;
    }
    public static function active($active = 0): string
    {
        return $active == 0 ? '<span class="btn btn-danger btn-xs">NO</span>'
            : '<span class="btn btn-success btn-xs">YES</span>';
    }
    public static function level($level = 0): string
    {
        return $level == 0 ? '<span class="btn btn-danger btn-xs">Admin</span>'
            : '<span class="btn btn-success btn-xs">Client</span>';
    }
    public static function menus($menus, $parent_id = 0): string
    {
        $html = '';
        foreach ($menus as $key => $menu){
            if ($menu->parent_id == $parent_id){
                $html .= '
                    <li>
                        <a href="'  . route('menu.shop',[$menu->id, Str::slug($menu->name, '-')]) .'">
                         ' . $menu->name . '
                        </a>';
                if (self::isChild($menus, $menu->id)) {
                    $html .= '<ul class="sub-menu">';
                    $html .= self::menus($menus, $menu->id);
                    $html .= '</ul>';
                }
                $html .= '</li>';

                unset($menus[$key]);



            }
        }
         return $html;
    }

    public static function isChild($menus, $id) : bool
    {
        foreach ($menus as $menu) {
            if ($menu->parent_id == $id) {
                return true;
            }
        }

        return false;
    }
    public static function price($price = 0, $priceSale = 0)
    {
        if ($priceSale != 0) return number_format($priceSale);
        if ($price != 0)  return number_format($price);
        return '<a href="/lien-he.html">Liên Hệ</a>';
    }
}
