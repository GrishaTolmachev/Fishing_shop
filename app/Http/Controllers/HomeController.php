<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 *
 * @middleware('auth')
 */
class HomeController extends Controller
{
    /**
     * Создание нового экземпляра контроллера.
     */
    public function __construct()
    {
        // Вызов промежуточного программного обеспечения для аутентификации пользователя
        $this->middleware('auth');
    }

    /**
     * Показ корзины.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function basket()
    {
        // Вернуть вид корзины
        return view('basket');
    }
}