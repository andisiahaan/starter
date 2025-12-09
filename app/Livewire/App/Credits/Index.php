<?php

namespace App\Livewire\App\Credits;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $user = Auth::user();

        $products = Product::query()
            ->with('category')
            ->active()
            ->whereNotNull('credit_amount')
            ->orderBy('price')
            ->get();

        return view('livewire.app.credits.index', [
            'user' => $user,
            'products' => $products,
        ])
            ->layout('layouts.app')
            ->title(__('Credits'));
    }
}
