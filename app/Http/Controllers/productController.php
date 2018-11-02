<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class productController extends Controller
{
    public function showAll()
    {
        return Product::All();
    }
}
