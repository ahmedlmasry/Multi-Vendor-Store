<?php

namespace App\View\Components;

use App\Facades\Cart;
use App\Repositories\Cart\CartRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartMenu extends Component
{
    public $items;
    public $total;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(CartRepository $cart)
    {
        $this->items = $cart->get();
        $this->total = $cart->total();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
//        dd($total = $this->total);
        return view('components.cart-menu');
    }
}
