<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductEnquiryModel extends Model
{
    protected $table            = 'product_enquiries';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'product_id', 'name', 'company_name', 'email', 'phone',
        'country', 'quantity', 'unit', 'message', 'status',
    ];
    protected $useTimestamps = true;
    protected $validationRules = [
        'name'    => 'required|min_length[2]|max_length[150]',
        'email'   => 'required|valid_email',
        'phone'   => 'required|min_length[6]|max_length[30]',
        'message' => 'required|min_length[10]',
    ];

    public function countByStatus(string $status): int
    {
        return $this->where('status', $status)->countAllResults();
    }

    public function countNew(): int
    {
        return $this->countByStatus('new');
    }

    public function adminList(array $filters = [], int $perPage = 20): array
    {
        $builder = $this->select('product_enquiries.*, products.name as product_name')
            ->join('products', 'products.id = product_enquiries.product_id', 'left')
            ->orderBy('product_enquiries.created_at', 'DESC');

        if (! empty($filters['status'])) {
            $builder->where('product_enquiries.status', $filters['status']);
        }

        if (! empty($filters['product_id'])) {
            $builder->where('product_enquiries.product_id', $filters['product_id']);
        }

        if (! empty($filters['date_from'])) {
            $builder->where('DATE(product_enquiries.created_at) >=', $filters['date_from']);
        }

        if (! empty($filters['date_to'])) {
            $builder->where('DATE(product_enquiries.created_at) <=', $filters['date_to']);
        }

        if (! empty($filters['search'])) {
            $builder->groupStart()
                ->like('product_enquiries.name', $filters['search'])
                ->orLike('product_enquiries.email', $filters['search'])
                ->orLike('product_enquiries.company_name', $filters['search'])
                ->orLike('product_enquiries.phone', $filters['search'])
                ->groupEnd();
        }

        return [
            'enquiries' => $builder->paginate($perPage),
            'pager'     => $this->pager,
        ];
    }

    public function getWithProduct(int $id): ?array
    {
        return $this->select('product_enquiries.*, products.name as product_name, products.slug as product_slug')
            ->join('products', 'products.id = product_enquiries.product_id', 'left')
            ->where('product_enquiries.id', $id)
            ->first();
    }

    public function getRecent(int $limit = 5): array
    {
        return $this->select('product_enquiries.*, products.name as product_name')
            ->join('products', 'products.id = product_enquiries.product_id', 'left')
            ->orderBy('product_enquiries.created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }
}
