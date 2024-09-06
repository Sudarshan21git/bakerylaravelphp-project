<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cake;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\MasterChef;
class IndexController extends Controller
{
    
    public function index()
    {
        $cakes = Cake::with('category')->orderBy('name')->get();
        $categories = Category::orderBy('title')->get();
        $chefs = MasterChef::all();

        return view('frontend.index', compact('cakes', 'categories','chefs'));
        
       
    }

}
