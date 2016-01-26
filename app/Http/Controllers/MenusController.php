<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Support\Tree;

class MenusController extends Controller
{
    public function index(Request $request)
    {
        $menus = Menu::all()->keyBy('id')->toArray();

        foreach ($menus as &$menu) {
            $menu['str_manage'] = sprintf('<a href="%s?parentid=%s&menuid=%s">添加子菜单</a> | ', '#','#', '#').
                                sprintf('<a href="%s">修改</a> |', route('menus.edit', ['menus' => $menu['id']])).
                                sprintf('<a href="javascript:confirmurl(\'%s\',\'确认删除？\')">删除</a>', route('menus.destroy', ['menus' => $menu['id']]));
             ;

        }

        $str  = "<tr>
                    <td align='center'><input name='listorders[\$id]' type='text' size='3' value='\$listorder' class='input-text-c'></td>
                    <td align='center'>\$id</td>
                    <td >\$spacer\$name</td>
                    <td align='center'>\$str_manage</td>
                </tr>";

        $content = with(new Tree($menus))->getTree(0, $str);

        return view('menus.index', ['content' => $content]);
    }

    public function create(Request $request)
    {
        $menus = Menu::all()->keyBy('id')->toArray();
        $opt  = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $select = with(new Tree($menus))->getTree(0, $opt);

        return view('menus.create', ['select' => $select]);
    }

    public function store(Request $request)
    {
        $info = $request->only('info');
        Menu::create($info['info']);

        return view('message', ['msg' => '操作成功', 'redirect' => route('menus.index')]);
    }


    public function edit($menuId)
    {
        $menus = Menu::all()->keyBy('id')->toArray();
        $parentId = $menus[$menuId]['parentid'];

        $menus = array_map(function($menu) use ($parentId) {
            $menu['selected'] = $menu['id'] == $parentId ? 'selected' : '';
            return $menu;
        }, $menus);

        $opt  = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $select = with(new Tree($menus))->getTree(0, $opt);

        return view('menus.edit', ['menu' => $menus[$menuId], 'select' => $select]);
    }

    public function update(Request $request, $menuId)
    {
        $info = $request->only('info');
        $menu = Menu::find($menuId);

        $menu->update($info['info']);

        return view('message', ['msg' => '操作成功', 'redirect' => route('menus.index')]);
    }
}