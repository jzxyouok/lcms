<?php
namespace App\Http\Controllers;

use App\Models\User;

class InstallController extends Controller
{
    public function install()
    {
        User::create([
            'username' => 'ruolin',
            'email' => 'guangxiao.wang@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        return 'success';
    }
}