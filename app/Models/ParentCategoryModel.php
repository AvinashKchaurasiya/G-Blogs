<?php

namespace App\Models;

use CodeIgniter\Model;

class ParentCategoryModel extends Model
{
    protected $table      = 'parent_categories';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'created_at', 'updated_at'];

    // Optional: If you want to set timestamps
    protected $useTimestamps = true;

    // Optional: If you want to use a different date format
    protected $dateFormat = 'datetime';

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getParentCategory() {
        return $this->db->table('parent_categories')->get()->getResult();
    }

    public function getCategoryByParentId($parentId, $limit = 10, $offset = 0) {
        return $this->db->table('categories')
        ->select('categories.id as id, categories.name as categoryName, categories.category_description as categoryDescription')
        ->join('parent_categories', 'categories.parent_category_id = parent_categories.id')
        ->where('categories.status', 1)
        ->where('categories.is_deleted', 0)
        ->where('parent_categories.id', $parentId)
        ->orderBy('categories.id', 'ASC')
        ->limit($limit, $offset)
        ->get()
        ->getResult();
    }    
}
