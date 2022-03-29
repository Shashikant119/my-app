<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function getMenu()
    {
        $menu = new \App\Models\Menu;
        $menuList = $menu->tree();
        return view('multiplemenu.index')->with('menulist', $menuList);
    }
}
