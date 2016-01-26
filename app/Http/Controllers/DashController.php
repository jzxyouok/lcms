<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;

class DashController extends Controller
{

    public function construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $menus = app('menu')
               ->where('parentid', '=', 0)
               ->get();

        $leftMainUrl = url('/dash/left_main?menuid=');

        $params = [
            'menus' => $menus,
            'left_main_url' => $leftMainUrl,
            'crumb_url' => route('dash.crumbs'),
        ];

        return view('dash.index', $params);
    }

    public function leftMain(Request $request)
    {
        $menuId = $request->get('menuid');

        $menus = Menu::all()->toArray();

        $leftMenus = [];
        foreach ($menus as $menu) {
            if ($menu['parentid'] == $menuId) {
                $leftMenus[$menu['id']] = $menu;
            }

            if (isset($leftMenus[$menu['parentid']])) {
                $leftMenus[$menu['parentid']]['child'][] = $menu;
            }
        }

        return view('dash.left_main', ['left_menus' => $leftMenus]);
    }

    public function crumbs(Request $request)
    {
        $menuId = $request->get('menuid');

        return crumbs($menuId);
     }
}