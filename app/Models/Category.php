<?php
    namespace App\Models;

    use CodeIgniter\Model;
    class Category extends Model{
        protected $table      = 'categories';
        protected $primaryKey = 'id';

        protected $allowedFields = ['name', 'status', 'category_description', 'parent_category_id', 'is_deleted'];

        protected $useTimestamps = true; 
        protected $createdField  = 'create_at';
        protected $updatedField  = 'modified_at';

        // Enable automatic handling of timestamps
        protected $dateFormat    = 'datetime'; 


        public function getCategoryData($parentId){
            return $this->db->table('categories')
            ->select('id')
            ->where('parent_category_id', $parentId)
            ->where('status', 1)
            ->where('is_deleted', 0)
            ->orderBy('id', 'ASC')
            ->get()
            ->getResult();
        }

        public function deleteCategory($parentId){
            return $this->db->table('categories')->where('parent_category_id', $parentId)->delete();
        }
    }

?>