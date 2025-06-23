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
        dd($itemCount, $userCount);
        return view('pages.dashboard', compact('itemCount', 'userCount'));
    }

}
