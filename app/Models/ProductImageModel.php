<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductImageModel extends Model
{
    protected $table            = 'product_images';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['product_id', 'image', 'sort_order'];
    protected $useTimestamps    = true;

    public function getByProduct(int $productId): array
    {
        return $this->where('product_id', $productId)->orderBy('sort_order', 'ASC')->findAll();
    }

    public function deleteImage(int $id): ?array
    {
        $image = $this->find($id);

        if ($image) {
            $this->delete($id);
        }

        return $image;
    }
}
