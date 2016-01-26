<?php
function crumbs($menuId)
{
    $crumbs = '';
    $menu = app('menu')->where('id', '=', $menuId)->first();

    if (!empty($menu['parentid'])) {
        $crumbs = crumbs($menu['parentid']);
    }

    return $crumbs.$menu['name']." > ";
}