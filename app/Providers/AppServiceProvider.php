<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Request $request): void
    {
        //
        Paginator::useBootstrapFive();

        if ($request->method() == "GET") {

            $categories = Category::withCount('products')
                ->withoutGlobalscope('owner')->get();

            $products = Product::active()
                //             ->when($request->input('categories', []) ?? false, function ($query,array $value) {
                //     return $query->whereIn(DB::table('categories')->select('name'),  $value);
                // })
                ->get();

            View::share([
                'categories' => $categories,
                "products" => $products,
                'status_options' => Product::statusOpations(),
            ]);
        }
    }
}
