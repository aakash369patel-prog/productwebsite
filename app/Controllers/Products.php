<?php

namespace App\Controllers;

use App\Models\ProductCategoryModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use App\Models\ProductSpecificationModel;

class Products extends BaseController
{
    public function index(?string $categorySlug = null)
    {
        $categoryModel = model(ProductCategoryModel::class);
        $productModel  = model(ProductModel::class);

        $search   = $this->request->getGet('search');
        $category = null;
        $filters  = ['search' => $search];

        if ($categorySlug) {
            $category = $categoryModel->findBySlug($categorySlug);

            if (! $category) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            $filters['category_slug'] = $categorySlug;
        }

        $result = $productModel->frontendList($filters, 12);

        $data = [
            'pageTitle'       => $category ? $category['name'] . ' Products' : 'Our Products',
            'metaDescription' => $category['meta_description'] ?? 'Browse our complete range of B2B export quality products.',
            'metaKeywords'    => $category['meta_keywords'] ?? 'products, catalogue, B2B',
            'categories'      => $categoryModel->getWithProductCount('active'),
            'category'        => $category,
            'products'        => $result['products'],
            'pager'           => $result['pager'],
            'search'          => $search,
        ];

        return view('frontend/layout/header', $data)
            . view('frontend/products/index', $data)
            . view('frontend/layout/footer', $data);
    }

    public function detail(string $slug)
    {
        $productModel = model(ProductModel::class);
        $specModel    = model(ProductSpecificationModel::class);
        $imageModel   = model(ProductImageModel::class);

        $product = $productModel->findBySlug($slug);

        if (! $product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'pageTitle'       => $product['meta_title'] ?: $product['name'] . ' - ' . site_name(),
            'metaDescription' => $product['meta_description'] ?: truncate_text($product['short_description'], 160),
            'metaKeywords'    => $product['meta_keywords'] ?? '',
            'product'         => $product,
            'specifications'  => $specModel->getByProduct($product['id']),
            'gallery'         => $imageModel->getByProduct($product['id']),
            'relatedProducts' => $productModel->getRelated($product['category_id'], $product['id'], 4),
        ];

        return view('frontend/layout/header', $data)
            . view('frontend/products/detail', $data)
            . view('frontend/layout/footer', $data);
    }
}
