<?php

namespace App\Controllers;

use App\Models\ProductCategoryModel;
use App\Models\ProductModel;

class Sitemap extends BaseController
{
    public function index()
    {
        $categoryModel = model(ProductCategoryModel::class);
        $productModel  = model(ProductModel::class);

        $categories = $categoryModel->where('status', 'active')->findAll();
        $products   = $productModel->where('status', 'active')->findAll();

        return $this->response
            ->setContentType('application/xml')
            ->setBody(view('frontend/sitemap', [
                'categories' => $categories,
                'products'   => $products,
            ]));
    }
}
