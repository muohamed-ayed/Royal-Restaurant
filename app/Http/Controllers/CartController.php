<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $cart = $request->session()->get('cart', []);
        $meals = Meal::with('category')->whereIn('id', array_keys($cart))->get()->keyBy('id');
        $items = collect($cart)->map(function ($quantity, $id) use ($meals) {
            $meal = $meals->get($id);
            return $meal ? ['meal' => $meal, 'quantity' => (int) $quantity] : null;
        })->filter();

        $total = $items->sum(fn ($item) => $item['meal']->price * $item['quantity']);

        return view('cart.index', compact('items', 'total'));
    }

    public function store(Request $request, Meal $meal): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);
        $cart[$meal->id] = min(99, ($cart[$meal->id] ?? 0) + 1);
        $request->session()->put('cart', $cart);

        return back()->with('success', $meal->name.' added to your cart.');
    }

    public function update(Request $request, Meal $meal): RedirectResponse
    {
        $validated = $request->validate(['quantity' => ['required', 'integer', 'min:1', 'max:99']]);
        $cart = $request->session()->get('cart', []);
        if (isset($cart[$meal->id])) {
            $cart[$meal->id] = (int) $validated['quantity'];
            $request->session()->put('cart', $cart);
        }

        return back()->with('success', 'Cart updated.');
    }

    public function destroy(Request $request, Meal $meal): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$meal->id]);
        $request->session()->put('cart', $cart);

        return back()->with('success', 'Meal removed from your cart.');
    }

    public function clear(Request $request): RedirectResponse
    {
        $request->session()->forget('cart');
        return back()->with('success', 'Your cart has been cleared.');
    }
}
