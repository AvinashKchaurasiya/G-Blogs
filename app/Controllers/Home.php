<?php

namespace App\Controllers;

use App\Models\BlogModel;
use App\Models\Category;
use App\Models\ParentCategoryModel;

class Home extends BaseController
{
    public function index() {

        $blogModel = new BlogModel();
        $parentCategory = new ParentCategoryModel();
        $parentCategoryDataOnly = $parentCategory->findAll();

        
        $perPage = 10;
        // Get the current page, default is 1
        $page = $this->request->getVar('page') ?? 1;
        
        $data['parentCategoryDataOnly'] = $parentCategoryDataOnly;
        $data['blogsData'] = $blogModel->getActiveBlogs($perPage, $page);
        $data['latestBlogs'] = $blogModel->getLatestBlogs();
        $data['categoryData'] = $parentCategory->getParentCategory();
        $data['pager'] = $blogModel->pager;

        $data['view'] = 'Frontend/index';  
        $data['title'] = 'Blogs : Home Page';
        
        return view('Frontend/baseLayout/masterApp', $data);
    }
    public function showDetails($blogId, $name){
        $blogModel = new BlogModel();
        $parentCategory = new ParentCategoryModel();
        $parentCategoryDataOnly = $parentCategory->findAll();
        // $category = new Category();

        $blogData = $blogModel->find($blogId);

        if (empty($blogData)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Page not found');
        }

        $data['parentCategoryDataOnly'] = $parentCategoryDataOnly;
        $data['blogData'] = $blogData;
        $data['categoryData'] = $blogModel->getCategory($blogData['blog_category']);

        $data['latestBlogs'] = $blogModel->getLatestBlogs();
        $data['categoriesData'] = $parentCategory->getParentCategory();

        $data['view'] = 'Frontend/Pages/blogDetails';  
        $data['title'] = 'Blogs : '. ucwords($name);
        
        return view('Frontend/baseLayout/masterApp', $data);
    }

    public function showCategories($parentCategoryId) {
        $blogModel = new BlogModel();
        $parentCategory = new ParentCategoryModel();
    
        // Get parent category data
        $parentCategoryData = $parentCategory->find($parentCategoryId);

        $parentCategoryDataOnly = $parentCategory->findAll();
    
        if (empty($parentCategoryData)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Page not found');
        }
    
        // Get the current page from query parameters, default to 1 if not set
        $currentPage = $this->request->getVar('page') ?: 1;
        $perPage = 10;  
        $offset = ($currentPage - 1) * $perPage;  // Calculate the offset for pagination
    
        // Fetch categories with pagination
        $categoryData = $parentCategory->getCategoryByParentId($parentCategoryId, $perPage, $offset);
        $totalCategories = count($categoryData);
        // Initialize pagination library
        $pager = \Config\Services::pager();
    
        // Pass data to the view
        $data['parentCategoryDataOnly'] = $parentCategoryDataOnly;
        $data['parentCategory'] = $parentCategoryData;
        $data['categoryData'] = $categoryData;
        $data['latestBlogs'] = $blogModel->getLatestBlogs();
        $data['categoriesData'] = $parentCategory->getParentCategory();
    
        // Pagination details
        $data['pager'] = $pager;
        $data['currentPage'] = $currentPage;
        $data['totalCategories'] = $totalCategories;
        $data['perPage'] = $perPage;
    
        $data['view'] = 'Frontend/Pages/categoryDetails';
        $data['title'] = 'Blogs : ' . ucwords($parentCategoryData['name']) . ' Category Details';
    
        return view('Frontend/baseLayout/masterApp', $data);
    }
    

    public function getCategoryBlogs($categoryId, $categoryName){
        $blogModel = new BlogModel();
        $parentCategory = new ParentCategoryModel();
        $parentCategoryDataOnly = $parentCategory->findAll();

        $data['parentCategoryDataOnly'] = $parentCategoryDataOnly;
        $data['blogsData'] = $blogModel->getBlogsData($categoryId);
        $data['latestBlogs'] = $blogModel->getLatestBlogs();
        $data['categoriesData'] = $parentCategory->getParentCategory();

        $data['view'] = 'Frontend/Pages/categoryBlogs';  
        $data['title'] = 'Blogs : '. ucwords($categoryName).'  Category Blogs';
        
        return view('Frontend/baseLayout/masterApp', $data);
    }

    public function blogs(){
        $blogModel = new BlogModel();
        $parentCategory = new ParentCategoryModel();
        $parentCategoryDataOnly = $parentCategory->findAll();

        
        $perPage = 10;
        // Get the current page, default is 1
        $page = $this->request->getVar('page') ?? 1;
        
        $data['parentCategoryDataOnly'] = $parentCategoryDataOnly;
        $data['blogsData'] = $blogModel->getActiveBlogs($perPage, $page);
        $data['latestBlogs'] = $blogModel->getLatestBlogs();
        $data['categoryData'] = $parentCategory->getParentCategory();
        $data['pager'] = $blogModel->pager;

        $data['view'] = 'Frontend/index';  
        $data['title'] = 'Blogs : Blogs Page';
        
        return view('Frontend/baseLayout/masterApp', $data);
    }



    // login
    public function login(){

        $parentCategory = new ParentCategoryModel();
        $parentCategoryDataOnly = $parentCategory->findAll();

        $data = [];
        $data['parentCategoryDataOnly'] = $parentCategoryDataOnly;
        $data['view'] = 'Frontend/Auth/login';  
        $data['title'] = 'Blogs : User Login';
        
        return view('Frontend/baseLayout/masterApp', $data);
    }
}
