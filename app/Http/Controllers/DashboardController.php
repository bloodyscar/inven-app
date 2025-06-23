<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;

class DashboardController extends Controller
{

    public function index()
    {
        $itemCount = Item::count();
        $userCount = User::count();
        return view('dashboard', compact('itemCount', 'userCount'));
    }

}
