<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'category_id', 'name', 'slug', 'short_description', 'description', 'main_image',
        'moq', 'moq_unit', 'applications', 'benefits', 'packaging_information',
        'availability_information', 'meta_title', 'meta_description', 'meta_keywords',
        'is_featured', 'status',
    ];
    protected $useTimestamps = true;
    protected $validationRules = [
        'name'        => 'required|min_length[2]|max_length[255]',
        'slug'        => 'required|alpha_dash|is_unique[products.slug,id,{id}]',
        'category_id' => 'required|integer',
    ];

    public function findBySlug(string $slug): ?array
    {
        return $this->select('products.*, product_categories.name as category_name, product_categories.slug as category_slug')
            ->join('product_categories', 'product_categories.id = products.category_id')
            ->where('products.slug', $slug)
            ->where('products.status', 'active')
            ->first();
    }

    public function getFeatured(int $limit = 8): array
    {
        return $this->select('products.*, product_categories.name as category_name, product_categories.slug as category_slug')
            ->join('product_categories', 'product_categories.id = products.category_id')
            ->where('products.status', 'active')
            ->where('products.is_featured', 1)
            ->orderBy('products.created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    public function getLatest(int $limit = 8): array
    {
        return $this->select('products.*, product_categories.name as category_name, product_categories.slug as category_slug')
            ->join('product_categories', 'product_categories.id = products.category_id')
            ->where('products.status', 'active')
            ->orderBy('products.created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    public function getRelated(int $categoryId, int $excludeId, int $limit = 4): array
    {
        return $this->select('products.*, product_categories.name as category_name')
            ->join('product_categories', 'product_categories.id = products.category_id')
            ->where('products.category_id', $categoryId)
            ->where('products.id !=', $excludeId)
            ->where('products.status', 'active')
            ->orderBy('RAND()')
            ->limit($limit)
            ->findAll();
    }

    public function frontendList(array $filters = [], int $perPage = 12): array
    {
        $builder = $this->select('products.*, product_categories.name as category_name, product_categories.slug as category_slug')
            ->join('product_categories', 'product_categories.id = products.category_id')
            ->where('products.status', 'active')
            ->where('product_categories.status', 'active');

        if (! empty($filters['category_id'])) {
            $builder->where('products.category_id', $filters['category_id']);
        }

        if (! empty($filters['category_slug'])) {
            $builder->where('product_categories.slug', $filters['category_slug']);
        }

        if (! empty($filters['search'])) {
            $search = $filters['search'];
            $subQuery = db_connect()->table('product_specifications')
                ->select('product_id')
                ->groupStart()
                ->like('specification_name', $search)
                ->orLike('specification_value', $search)
                ->groupEnd()
                ->getCompiledSelect();

            $builder->groupStart()
                ->like('products.name', $search)
                ->orLike('products.short_description', $search)
                ->orLike('product_categories.name', $search)
                ->orWhere("products.id IN ($subQuery)", null, false)
                ->groupEnd();
        }

        $builder->orderBy('products.created_at', 'DESC');

        return [
            'products' => $builder->paginate($perPage),
            'pager'    => $this->pager,
        ];
    }

    public function adminList(array $filters = [], int $perPage = 20): array
    {
        $builder = $this->select('products.*, product_categories.name as category_name')
            ->join('product_categories', 'product_categories.id = products.category_id', 'left')
            ->orderBy('products.created_at', 'DESC');

        if (! empty($filters['status'])) {
            $builder->where('products.status', $filters['status']);
        }

        if (! empty($filters['category_id'])) {
            $builder->where('products.category_id', $filters['category_id']);
        }

        if (! empty($filters['search'])) {
            $builder->groupStart()
                ->like('products.name', $filters['search'])
                ->orLike('products.slug', $filters['search'])
                ->groupEnd();
        }

        return [
            'products' => $builder->paginate($perPage),
            'pager'    => $this->pager,
        ];
    }

    public function countActive(): int
    {
        return $this->where('status', 'active')->countAllResults();
    }
}
