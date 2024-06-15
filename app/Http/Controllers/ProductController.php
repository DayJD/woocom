<?php

namespace App\Http\Controllers;

use App\Services\WooCommerceService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $wooCommerceService;

    public function __construct(WooCommerceService $wooCommerceService)
    {
        $this->wooCommerceService = $wooCommerceService;
    }

    public function list(Request $request)
    {
        $data['products'] = $this->wooCommerceService->getProducts($request->page ?? 1, 10);

        
        return view('shop_manager.product.list', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Product';

        return view('shop_manager.product.add', $data);
    }
}
