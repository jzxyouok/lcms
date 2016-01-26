<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected static $unguarded = true;

    public static function menus($parentid = 0)
    {
        $menus = [
            ['id' => 1, 'name' => 'dashbaord', 'parentid' => 0, 'route' => 'ds'],
            ['id' => 2, 'name' => 'members', 'parentid' => 0, 'route' => 'ds'],
            ['id' => 5, 'name' => 'system', 'parentid' => 0, 'route' => 'ds'],
            ['id' => 3, 'name' => 'person', 'parentid' => 1, 'route' => 'ds'],
            ['id' => 4, 'name' => 'person.info', 'parentid' => 3, 'route' => 'ds'],
            ['id' => 6, 'name' => 'menu', 'parentid' => 5, 'route' => 'ds'],
            ['id' => 7, 'name' => 'menu.index', 'parentid' => 6, 'route' => 'menus'],
            ['id' => 8, 'name' => 'menu.create', 'parentid' => 6, 'route' => '/menus/create'],

        ];

        $results = [];

        foreach ($menus as $menu) {
            if ($menu['parentid'] == $parentid) {
                $results[] = $menu;
            }
        }

        return $results;
    }
}