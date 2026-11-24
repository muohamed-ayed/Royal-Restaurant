<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            'categoriesCount' => Category::count(),
            'mealsCount' => Meal::count(),
            'adminsCount' => User::where('role', 'admin')->count(),
        ]);
    }
}
