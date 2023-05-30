<?php

namespace App\Http\Middleware;

use App\Models\Category;
use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class CategoriesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next){$categories = Category::orderBy('id')->get();
        View::share('categories', $categories);
    
            return $next($request);
        }
}
