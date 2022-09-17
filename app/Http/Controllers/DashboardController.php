<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = new User();
        $user->password = \Hash::make('Www24733$');
        $user->email = 'fuzik.vlad@gmail.com';
        $user->name = 'Tex';
        $user->save();

        return view('dashboard.index');

    }
}
