<?php
    namespace App\Models;

    use CodeIgniter\Model;
    class BlogModel extends Model
    {
        protected $table      = 'blogs'; 
        protected $primaryKey = 'id';  
        
        // The columns we can insert or update
        protected $allowedFields = ['blog_title', 'blog_category', 'blog_desc', 'blog_author', 'blog_image', 'blog_status'];

        // Timestamp columns
        protected $useTimestamps = true; 
        protected $createdField  = 'create_at';
        protected $updatedField  = 'modified_at';

        // Enable automatic handling of timestamps
        protected $dateFormat    = 'datetime';  


        public function getActiveBlogsWithCategories(){
            return $this->select('blogs.id, blogs.blog_title, blogs.blog_author, blogs.blog_image, blogs.blog_desc, categories.name as category_name, blogs.blog_status')->join('categories', 'categories.id = blogs.blog_category')->findAll(); 
        }

        public function getActiveBlogs($perPage = null, $page = null) {
            return $this->select('blogs.id, blogs.blog_title, blogs.blog_author, blogs.blog_image, blogs.blog_desc, categories.name as category_name')
            ->join('categories', 'categories.id = blogs.blog_category')
            ->where('blogs.blog_status', 1)
            ->orderBy('blogs.id', 'DESC')
            ->paginate($perPage, 'default', $page); 
        }

        public function getLatestBlogs(){
            return $this->select('blogs.id, blogs.blog_title, blogs.blog_author, blogs.blog_image, blogs.blog_desc, categories.name as category_name')
                ->join('categories', 'categories.id = blogs.blog_category')
                ->where('blogs.blog_status', 1)
                ->orderBy('blogs.id', 'DESC')
                ->findAll();
        }

        public function getCategory($categoryId) {
            return $this->select('categories.name as category_name')
                ->join('categories', 'categories.id = blogs.blog_category')
                ->where('categories.id', $categoryId)
                ->first();
        }        

        public function getBlogsData($categoryId){
            return $this->select('blogs.id, blogs.blog_title, blogs.blog_author, blogs.blog_image, blogs.blog_desc, categories.name as category_name')
                ->join('categories', 'categories.id = blogs.blog_category')
                ->where('blogs.blog_status', 1)
                ->where('blogs.blog_category', $categoryId)
                ->orderBy('blogs.id', 'DESC')
                ->findAll();
        }


        public function getAllBlogs($categoryId){
            return $this->select('blogs.id as id')->where('blogs.blog_category', $categoryId)->findAll();
        }

        public function deleteRelatedBlogs($categoryId){
            $blogs = $this->db->table('blogs')
            ->select('id, blog_image')
            ->where('blog_category', $categoryId)
            ->get()
            ->getResultArray();
            foreach ($blogs as $blog) {
                if (!empty($blog['blog_image']) && file_exists(FCPATH . $blog['blog_image'])) {
                    unlink(FCPATH . $blog['blog_image']); 
                }
            }
            $builder = $this->db->table('blogs');
            $builder->where('blog_category', $categoryId);
            
            return $builder->delete();
        }
    }    
?>