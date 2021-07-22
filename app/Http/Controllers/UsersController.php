<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users');
    }

    public function delete($id)
    {
        $delete = DB::table('users')->where('id', $id)->delete();
        return view('admin.users');
    }
}
