<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductCategoryModel extends Model
{
    protected $table            = 'product_categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'name', 'slug', 'short_description', 'description', 'image',
        'meta_title', 'meta_description', 'meta_keywords', 'sort_order', 'status',
    ];
    protected $useTimestamps = true;
    protected $validationRules = [
        'name' => 'required|min_length[2]|max_length[200]',
        'slug' => 'required|alpha_dash|is_unique[product_categories.slug,id,{id}]',
    ];

    public function getActiveCategories(int $limit = 0): array
    {
        $builder = $this->where('status', 'active')->orderBy('sort_order', 'ASC');

        if ($limit > 0) {
            $builder->limit($limit);
        }

        return $builder->findAll();
    }

    public function getWithProductCount(?string $status = 'active'): array
    {
        $db = db_connect();
        $builder = $db->table($this->table . ' c')
            ->select('c.*, COUNT(p.id) as product_count')
            ->join('products p', 'p.category_id = c.id AND p.status = "active"', 'left')
            ->groupBy('c.id')
            ->orderBy('c.sort_order', 'ASC');

        if ($status !== null) {
            $builder->where('c.status', $status);
        }

        return $builder->get()->getResultArray();
    }

    public function findBySlug(string $slug): ?array
    {
        return $this->where('slug', $slug)->where('status', 'active')->first();
    }

    public function adminList(array $filters = [], int $perPage = 20): array
    {
        $builder = $this->orderBy('sort_order', 'ASC');

        if (! empty($filters['status'])) {
            $builder->where('status', $filters['status']);
        }

        if (! empty($filters['search'])) {
            $builder->groupStart()
                ->like('name', $filters['search'])
                ->orLike('slug', $filters['search'])
                ->groupEnd();
        }

        return [
            'categories' => $builder->paginate($perPage),
            'pager'      => $this->pager,
        ];
    }
}
