<?php

use App\Data\ProductData;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/category/{id}', function ($id) {
    return view('category-page-mobile', ['id' => $id]);
});

Route::get('/advanced-search', function () {
    return view('advanced_search');
});

Route::get('/voucher/{id}', function ($id) {
    $products = array_merge(
        ProductData::getFeaturedProducts(),
        ProductData::getFlashSaleProducts(),
        ProductData::getDrinksProducts(),
        ProductData::getFoodProducts(),
        ProductData::getTravelProducts(),
        ProductData::getEntertainmentProducts()
    );

    $product = collect($products)->firstWhere('id', $id);

    if (!$product) {
        abort(404);
    }

    return view('voucher', compact('product'));
});

Route::get('/kfc-country', function () {
    return view('kfc');
});
