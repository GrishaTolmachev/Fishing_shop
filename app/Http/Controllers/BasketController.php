<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;



/**
 * Class BasketController
 * @package App\Http\Controllers
 */
class BasketController extends Controller
{

    /**
     * Отображение корзины товаров
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function basket() {
        $orderId = session(key:'orderId');
     
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }
        return view('basket', compact('order'));
    }

    /**
     * Подтверждение заказа
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function basketConfirm(Request $request){
        $orderId = session(key:'orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }
        $order = Order::find($orderId);
        $success = $order->saveOrder($request->name, $request->phone);

       
        return redirect()->route('index');
    }

    /**
     * Добавление товара в корзину
     * @param $product_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function basketAdd($product_id) 
    {
        $orderId = session(key:'orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        if ($order->products->contains($product_id)) {
            $pivotRow = $order->products()->where('product_id', $product_id)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($product_id);
        }

        if (Auth::check()) {
            $order->user_id = Auth::id();
            $order->save();
        }
        return redirect()->route('index');
    }

    /**
     * Добавление товара в корзину из страницы корзины
     * @param $product_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function basketAddBasket($product_id) 
    {
        $orderId = session(key:'orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        if ($order->products->contains($product_id)) {
            $pivotRow = $order->products()->where('product_id', $product_id)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($product_id);
        }
        return redirect()->route('basket');
    }

    /**
     * Удаление товара из корзины
     * @param $product_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function basketRemove($product_id)
    {
        $orderId = session(key:'orderId');
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        $order = Order::find($orderId);

        if ($order->products->contains($product_id)) {
            $pivotRow = $order->products()->where('product_id', $product_id)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($product_id);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }

       

        return redirect()->route('basket');
    }
}