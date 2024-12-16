<?php

namespace App\Controllers;

use App\Models\BlogModel;
use App\Models\Category;
use App\Models\ParentCategoryModel;

// use App\Models\BlogModel;
class Admin extends BaseController
{
    public function index()
    {

        $blogModel = new BlogModel();

        $data['totalBlogs'] = $blogModel->countAll();
        $data['view'] = 'Backend/Dashboard';
        $data['title'] = 'Admin Blogs : Dashboard';

        return view('Backend/Layout/BaseLayout', $data);
    }

    public function Category()
    {
        $categoryModel = new Category();

        $parentCategoryModel = new ParentCategoryModel();
        // Fetch all category data
        $data['categoriesData'] = $categoryModel->findAll();
        $data['parentCategoriesData'] = $parentCategoryModel->findAll();

        // Define the dynamic breadcrumbs
        $data['breadcrumbs'] = [
            ['url' => base_url('admin/dashboard'), 'text' => 'Dashboard'],
            ['url' => base_url('admin/category'), 'text' => 'Categories'],
        ];

        // Pass data to the view
        $data['view'] = 'Backend/Pages/Category';
        $data['title'] = 'Admin Blogs : Category List';
        $data['text'] = 'Category List';

        return view('Backend/Layout/BaseLayout', $data);
    }

    public function addParentCategory($parentCategoryId = null){
        $parentCategoryModel = new ParentCategoryModel();
        $parentCategoryData = $parentCategoryModel->find($parentCategoryId);

        if($parentCategoryId){
            $data['parentCategoryData'] = $parentCategoryData;
            $data['breadcrumbs'] = [
                ['url' => base_url('admin/dashboard'), 'text' => 'Dashboard'],
                ['url' => base_url('admin/category'), 'text' => 'Categories'],
                ['url' => base_url('admin/editParentCategory/'. $parentCategoryId), 'text' => 'Edit Parent Category'],
            ];
            $data['title'] = 'Admin Blogs : Edit Parent Category';
            $data['text'] = 'Edit Parent Category';
            $data['formAction'] = site_url('/admin/updateParentCategory/'. $parentCategoryId);
        }else{
            // Define the dynamic breadcrumbs
            $data['breadcrumbs'] = [
                ['url' => base_url('admin/dashboard'), 'text' => 'Dashboard'],
                ['url' => base_url('admin/category'), 'text' => 'Categories'],
                ['url' => base_url('admin/addParentCategory'), 'text' => 'Add Parent Category'],
            ];
            $data['title'] = 'Admin Blogs : Add Parent Category';
            $data['text'] = 'Add Parent Category';
            $data['formAction'] = site_url('/admin/storeParentCategory/');
        }
        
        $data['view'] = 'Backend/Pages/addParentCategory';
        return view('Backend/Layout/BaseLayout', $data);
    }

    public function storeParentCategory($parentCategoryId = null){
        $parentCategoryModel = new ParentCategoryModel();

        $data = [
            'name' => $this->request->getPost('name'),
        ];
        if($parentCategoryId){
            $parentCategoryModel->update($parentCategoryId, $data);
            return redirect()->to('/admin/category')->with('success', 'Parent Category updated successfully!');
        }else{
            $parentCategoryModel->insert($data);
            return redirect()->to('/admin/category')->with('success', 'Parent Category saved successfully!');
        }
    }

    public function addCategory($categoryId = null)
    {
        // $categoryModel = new Category();
        $parentCategoryModel = new ParentCategoryModel();
        $categoryModel = New Category();

        // Fetch all parent category data
        $data['parentCategoriesData'] = $parentCategoryModel->findAll();
        if($categoryId){
            $data['categoryData'] = $categoryModel->find($categoryId);
            $data['breadcrumbs'] = [
                ['url' => base_url('admin/dashboard'), 'text' => 'Dashboard'],
                ['url' => base_url('admin/category'), 'text' => 'Categories'],
                ['url' => base_url('admin/editCategory/' . $categoryId), 'text' => 'Edit Category'],
            ];
            $data['title'] = 'Admin Blogs : Edit Blog';
            $data['text'] = 'Edit Blog';
            $data['formAction'] = site_url('/admin/updateCategory/' . $categoryId);
        }else{
            $data['breadcrumbs'] = [
                ['url' => base_url('admin/dashboard'), 'text' => 'Dashboard'],
                ['url' => base_url('admin/category'), 'text' => 'Categories'],
                ['url' => base_url('admin/addCategory'), 'text' => 'Add Category'],
            ];
    
            // Pass data to the view
            $data['title'] = 'Admin Blogs : Add Category';
            $data['text'] = 'Add Category';
            $data['formAction'] = site_url('/admin/storeCategory');
        }
        
        
        $data['view'] = 'Backend/Pages/addCategory';
        return view('Backend/Layout/BaseLayout', $data);
    }

    public function storeCategory($categoryId = null)
    {
        $categoryModel = new Category();

        $data = [
            'name' => $this->request->getPost('name'),
            'parent_category_id' => $this->request->getPost('parent_id'),
            'category_description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status'),
        ];

        if($categoryId){
            $updateCategory = $categoryModel->update($categoryId, $data);
            if($updateCategory){
                return redirect()->to('/admin/category/')->with('success', 'Category updated successfully!');
            }else{
                return redirect()->to('/admin/editBlog/' . $categoryId)->with('error', 'Failed to update category!');
            }
        }

        $categoryModel->insert($data);

        return redirect()->to('/admin/category')->with('success', 'Category saved successfully!');
    }

    public function changeCategoryStatus($categoryId){
        $categoryModel = new Category();

        $category = $categoryModel->find($categoryId);
        $category['status'] = ($category['status'] == 1)? 0 : 1;
        
        $changeStatus = $categoryModel->save($category);
        if($changeStatus){
            return redirect()->to('/admin/category')->with('success', 'Category status updated successfully!');
        }else{
            return redirect()->to('/admin/category')->with('error', 'Failed to update category status!');
        }
    }

    public function deleteCategory($categoryId){
        $categoryModel = new Category();
        $blogModel = New BlogModel();
        $totalData = count($blogModel->getAllBlogs($categoryId));
        $deleteRelatedBlogs = $blogModel->deleteRelatedBlogs($categoryId);
        $deleteStatus = $categoryModel->delete($categoryId);
        if($deleteStatus && $deleteRelatedBlogs){
            return redirect()->to('/admin/category')->with('success', 'Category and related ' . $totalData . ' blogs are deleted successfully!');
        } else{
            return redirect()->to('/admin/category')->with('error', 'Failed to delete category!');
        }
    }


    public function deleteParentCategory($parentCategory){
        $parentCategoryModel = new ParentCategoryModel();
        $categoryModel = new Category();
        $blogModel = new BlogModel();
        $categoryData = $categoryModel->getCategoryData($parentCategory);
        $count = 1;
        for($i = 0; $i < count($categoryData); $i++){
            $blogModel->deleteRelatedBlogs($categoryData[0]->id);
            $categoryModel->deleteCategory($parentCategory);
            $count++;
        }
        $deleteStatus = $parentCategoryModel->delete($parentCategory);
        if($deleteStatus){
            return redirect()->to('/admin/category')->with('success', 'Parent Category and related '.  $count .'blogs are deleted successfully!');
        } else{
            return redirect()->to('/admin/category')->with('error', 'Failed to delete parent category!');
        }
    }






    public function blog()
    {
        $blogModel = new BlogModel();

        // Fetch all blog data
        $data['blogsData'] = $blogModel->getActiveBlogsWithCategories();

        // Define the dynamic breadcrumbs
        $data['breadcrumbs'] = [
            ['url' => base_url('admin/dashboard'), 'text' => 'Dashboard'],
            ['url' => base_url('admin/blogs'), 'text' => 'Blogs'],
        ];

        // Pass data to the view
        $data['view'] = 'Backend/Pages/Blogs';
        $data['title'] = 'Admin Blogs : Blog List';
        $data['text'] = 'Blog List';

        return view('Backend/Layout/BaseLayout', $data);
    }

    public function addBlog($blogId = null)
    {
        // Load necessary models
        $categoryModel = new Category();
        $blogModel = new BlogModel();

        // Fetch all categories
        $data['categories'] = $categoryModel->findAll();

        if ($blogId) {
            $data['blog'] = $blogModel->find($blogId);
            if (!$data['blog']) {
                return redirect()->to('/admin/blogs')->with('error', 'Blog not found!');
            }
            $data['breadcrumbs'] = [
                ['url' => base_url('admin/dashboard'), 'text' => 'Dashboard'],
                ['url' => base_url('admin/blogs'), 'text' => 'Blogs'],
                ['url' => base_url('admin/editBlog/' . $blogId), 'text' => 'Edit Blog'],
            ];
            $data['title'] = 'Admin Blogs : Edit Blog';
            $data['text'] = 'Edit Blog';
            $data['formAction'] = site_url('/admin/updateBlog/' . $blogId);
        } else {
            $data['breadcrumbs'] = [
                ['url' => base_url('admin/dashboard'), 'text' => 'Dashboard'],
                ['url' => base_url('admin/blogs'), 'text' => 'Blogs'],
                ['url' => base_url('admin/addBlog'), 'text' => 'Add Blog'],
            ];
            $data['title'] = 'Admin Blogs : Add Blog';
            $data['text'] = 'Add Blog';
            $data['formAction'] = site_url('/admin/storeBlog');
        }

        $data['view'] = 'Backend/Pages/AddBlog';
        return view('Backend/Layout/BaseLayout', $data);
    }


    public function storeBlog($blogId = null){
        helper(['form']);
        $validation = \Config\Services::validation();

        $categoryModel = new Category();
        $categories = $categoryModel->findAll();
        // Gather form data
        $data = [
            'blog_title'    => $this->request->getPost('title'),
            'blog_category' => $this->request->getPost('category'),
            'blog_author'   => $this->request->getPost('author'),
            'publish_status' => $this->request->getPost('status'),
            'blog_status'   => $this->request->getPost('active_status'),
            'blog_desc'     => $this->request->getPost('description'),
        ];

        $newImagePath = null;
        if ($this->request->getFile('image')->isValid()) {
            $image = $this->request->getFile('image');

            // Generate a random name for the image
            $newImageName = $image->getRandomName();

            // Define the target directory
            $uploadPath = FCPATH . 'Admin/Assets/Images/blog_image/';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $image->move($uploadPath, $newImageName);

            $newImagePath = 'Admin/Assets/Images/blog_image/' . $newImageName;

            if ($blogId) {
                $blogModel = new BlogModel();
                $existingBlog = $blogModel->find($blogId);
                if ($existingBlog && !empty($existingBlog['blog_image'])) {
                    $oldImagePath = FCPATH . $existingBlog['blog_image'];
                    if (is_file($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }
        }
        if ($newImagePath) {
            $data['blog_image'] = $newImagePath;
        }

        $blogModel = new BlogModel();
        if ($blogId) {
            $existingBlog = $blogModel->find($blogId);
            if (!$existingBlog) {
                return redirect()->to('/admin/blogs')->with('error', 'Blog not found!');
            }

            $data['id'] = $blogId;
            if ($blogModel->save($data)) {
                return redirect()->to('/admin/blogs')->with('success', 'Blog updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Something went wrong while updating!')->withInput();
            }
        } else {
            if ($blogModel->save($data)) {
                return redirect()->to('/admin/blogs')->with('success', 'Blog added successfully!');
            } else {
                return redirect()->back()->with('error', 'Something went wrong while adding the blog!')->withInput();
            }
        }
    }

    public function changeStatus($blogId)
    {
        $blogModel = new BlogModel();
        $blogData = $blogModel->find($blogId);

        // Toggle the blog status
        $newStatus = ($blogData['blog_status'] == 1) ? 0 : 1;

        // Update the blog status in the database
        $updated = $blogModel->update($blogId, ['blog_status' => $newStatus]);

        // Check if the update was successful
        if ($updated) {
            return redirect()->to('/admin/blogs')->with('success', 'Status changed successfully!');
        } else {
            return redirect()->to('/admin/blogs')->with('error', 'Failed to update the status.');
        }
    }

    public function deleteBlog($blogId)
    {
        $blogModel = new BlogModel();
        $blogData = $blogModel->find($blogId);

        // Delete the blog image from the directory
        if (!empty($blogData['blog_image'])) {
            $imagePath = FCPATH . $blogData['blog_image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete the blog from the database
        $deleted = $blogModel->delete($blogId);

        // Check if the deletion was successful
        if ($deleted) {
            return redirect()->to('/admin/blogs')->with('success', 'Blog deleted successfully!');
        } else {
            return redirect()->to('/admin/blogs')->with('error', 'Failed to delete the blog.');
        }
    }
}
