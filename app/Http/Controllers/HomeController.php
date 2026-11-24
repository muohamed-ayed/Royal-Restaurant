<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::orderBy('name')->get();
        $meals = Meal::with('category')
            ->when($request->filled('category'), fn ($query) => $query->where('category_id', $request->integer('category')))
            ->latest()
            ->get();
        $cartCount = array_sum($request->session()->get('cart', []));

        return view('home', compact('meals', 'categories', 'cartCount'));
    }
}
