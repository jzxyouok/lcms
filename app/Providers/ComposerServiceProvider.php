<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Menu;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('*', function($view) {

            $menuId = request()->get('menuid');
            $routeName = app('router')->currentRouteName();

            if (empty($menuId)) {
                $menuId = app('menu')
                        ->select('id')
                        ->where('route', '=', $routeName)
                        ->first()['id'];
            }

            $params = [
                'submenus' => [],
                'route_name' => $routeName,
                'menuid' => $menuId,
            ];

            if (!empty($menuId)) {
                $menus = Menu::all();

                $submenus = [];

                foreach ($menus as $menu) {
                    if ($menu['parentid'] == $menuId) {
                        $submenus[] = $menu;
                    }

                    if ($menu['id'] == $menuId) {
                        $p = $menu;
                    }
                }

                array_unshift($submenus, $p);

                $params['submenus'] = $submenus;
            }

            $view->with($params);
        });
    }

    public function register()
    {

    }
}
