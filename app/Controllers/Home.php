<?php

namespace App\Controllers;

use App\Models\HomeBannerModel;
use App\Models\ProductCategoryModel;
use App\Models\ProductModel;

class Home extends BaseController
{
    public function index()
    {
        $categoryModel = model(ProductCategoryModel::class);
        $productModel  = model(ProductModel::class);
        $bannerModel   = model(HomeBannerModel::class);
    
        $data = [
            'pageTitle'       => site_name() . ' - Premium B2B Export Products',
            'metaDescription' => 'Leading manufacturer and exporter of organic herbal powders, essential oils, cold pressed oils and tea ingredients. Bulk supply with export quality standards.',
            'metaKeywords'    => 'B2B exporter, herbal powder, essential oils, bulk supplier, manufacturer',
            'banners'         => $bannerModel->getActiveBanners(),
            'categories'      => $categoryModel->getWithProductCount('active'),
            'featuredProducts'=> $productModel->getFeatured(8),
            'latestProducts'  => $productModel->getLatest(8),
        ];

        return view('frontend/layout/header', $data)
            . view('frontend/home', $data)
            . view('frontend/layout/footer', $data);
    }

    public function about()
    {
        $data = [
            'pageTitle'       => 'About Us - ' . site_name(),
            'metaDescription' => 'Learn about our company, mission and commitment to quality manufacturing and global export of natural products.',
            'metaKeywords'    => 'about us, manufacturer, exporter, natural products',
        ];

        return view('frontend/layout/header', $data)
            . view('frontend/about', $data)
            . view('frontend/layout/footer', $data);
    }

    public function contact()
    {
        $productModel = model(ProductModel::class);

        $data = [
            'pageTitle'       => 'Contact Us - ' . site_name(),
            'metaDescription' => 'Contact us for product enquiries, bulk orders and export partnerships.',
            'metaKeywords'    => 'contact, enquiry, bulk order',
            'products'        => $productModel->where('status', 'active')->orderBy('name', 'ASC')->findAll(),
        ];

        return view('frontend/layout/header', $data)
            . view('frontend/contact', $data)
            . view('frontend/layout/footer', $data);
    }
}
