<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductSpecificationModel extends Model
{
    protected $table            = 'product_specifications';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['product_id', 'specification_name', 'specification_value', 'sort_order'];
    protected $useTimestamps    = true;

    public function getByProduct(int $productId): array
    {
        return $this->where('product_id', $productId)->orderBy('sort_order', 'ASC')->findAll();
    }

    public function saveForProduct(int $productId, array $specifications): void
    {
        $this->where('product_id', $productId)->delete();

        foreach ($specifications as $index => $spec) {
            if (empty(trim($spec['specification_name'] ?? '')) || empty(trim($spec['specification_value'] ?? ''))) {
                continue;
            }

            $this->insert([
                'product_id'          => $productId,
                'specification_name'  => trim($spec['specification_name']),
                'specification_value' => trim($spec['specification_value']),
                'sort_order'          => $index,
            ]);
        }
    }
}
