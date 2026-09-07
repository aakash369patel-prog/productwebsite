<?php

namespace App\Controllers\Admin;

use App\Models\ProductCategoryModel;
use App\Models\ProductEnquiryModel;
use App\Models\ProductModel;

class Dashboard extends AdminBaseController
{
    public function index()
    {
        $categoryModel = model(ProductCategoryModel::class);
        $productModel  = model(ProductModel::class);
        $enquiryModel  = model(ProductEnquiryModel::class);

        $data = [
            'pageTitle'       => 'Dashboard',
            'totalCategories' => $categoryModel->countAllResults(),
            'totalProducts'   => $productModel->countAllResults(),
            'newEnquiries'    => $enquiryModel->countNew(),
            'totalEnquiries'  => $enquiryModel->countAllResults(),
            'recentEnquiries' => $enquiryModel->getRecent(5),
            'latestProducts'  => $productModel->select('products.*, product_categories.name as category_name')
                ->join('product_categories', 'product_categories.id = products.category_id', 'left')
                ->orderBy('products.created_at', 'DESC')
                ->limit(5)
                ->findAll(),
        ];

        return $this->render('admin/dashboard/index', $data);
    }
}
