<?php

namespace App\Controllers\Admin;

// use App\Models\ProductCategoryModel;
use App\Models\ProductEnquiryModel;
use App\Models\ProductModel;

class Dashboard extends AdminBaseController
{
    public function index()
    {
        // $categoryModel = model(ProductCategoryModel::class);
        $productModel = model(ProductModel::class);
        $enquiryModel  = model(ProductEnquiryModel::class);

        $data = [
            'pageTitle'       => 'Dashboard',
            // 'totalCategories' => $categoryModel->countAllResults(),
            'totalProducts'   => $productModel->countAllResults(),
            'newEnquiries'    => $enquiryModel->countNew(),
            'totalEnquiries'  => $enquiryModel->countAllResults(),
            'recentEnquiries' => $enquiryModel->getRecent(5),
            'latestProducts' => $productModel->orderBy('created_at', 'DESC')->limit(5)->findAll(),
        ];

        return $this->render('admin/dashboard/index', $data);
    }
}
