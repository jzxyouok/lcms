<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Administer;

class AuthController extends Controller
{
    public function login()
    {
        return view('backend.auth.login');
    }

    public function signin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

    }
}