<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeBannerModel extends Model
{
    protected $table            = 'home_banners';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'badge', 'title', 'description', 'image',
        'button_text', 'button_url',
        'secondary_button_text', 'secondary_button_url',
        'sort_order', 'status',
    ];
    protected $useTimestamps = true;
    protected $validationRules = [
        'title'  => 'required|min_length[2]|max_length[255]',
        'status' => 'required|in_list[active,inactive]',
    ];

    public function getActiveBanners(): array
    {
        return $this->where('status', 'active')
            ->orderBy('sort_order', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();
    }

    public function adminList(array $filters = [], int $perPage = 20): array
    {
        $builder = $this->orderBy('sort_order', 'ASC')->orderBy('id', 'DESC');

        if (! empty($filters['status'])) {
            $builder->where('status', $filters['status']);
        }

        if (! empty($filters['search'])) {
            $builder->groupStart()
                ->like('title', $filters['search'])
                ->orLike('badge', $filters['search'])
                ->groupEnd();
        }

        return [
            'banners' => $builder->paginate($perPage),
            'pager'   => $this->pager,
        ];
    }
}
