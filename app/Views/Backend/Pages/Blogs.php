<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="card page_title">
                <div class="card-body">
                    <div class="admin-title d-flex justify-content-between px-2">
                        <div class="d-flex admin-title-box">
                            <h2 class="mb-0"><?= esc($text) ?></h2>
                            <div class="breadcrumbs">
                                <ol class="breadcrumb bg-white ms-3 mb-0">
                                    <?php if (!empty($breadcrumbs)): ?>
                                        <?php foreach ($breadcrumbs as $breadcrumb): ?>
                                            <li class="breadcrumb-item">
                                                <a href="<?= esc($breadcrumb['url']) ?>"><?= esc($breadcrumb['text']) ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header" style="background-color: #332D2D; display: flex; justify-content:space-between;">
                    <h5 class="text-white">Blogs List</h5>
                    <a href="<?= base_url('/admin/addBlog') ?>" class="btn btn-primary btn-sm m-0">Write Blog</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="display table table-bordered">
                            <thead>
                                <tr>
                                    <th>#sn</th>
                                    <th>Blog Title</th>
                                    <th>Blog Image</th>
                                    <th>Blog Description</th>
                                    <th>Blog Category</th>
                                    <th>Blog Author</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($blogsData)):?>
                                    <?php $sn = 1; foreach ($blogsData as $blog):?>
                                        <tr>
                                            <td><?= esc($sn++)?></td>
                                            <td><?= esc($blog['blog_title'])?></td>
                                            <td>
                                                <img src="<?php echo base_url($blog['blog_image']);?>" alt="Blog Image" width="100" height="100" style="border-radius: 50%;">
                                            </td>
                                            <td>
                                                <?= esc(substr($blog['blog_desc'], 0, 20))?>...
                                            </td>
                                            <td><?= esc($blog['category_name'])?></td>
                                            <td><?= esc($blog['blog_author'])?></td>
                                            <td>
                                                <?php if ($blog['blog_status'] == 1):?>
                                                    <a href="<?php echo base_url('admin/changeStatus/'.esc($blog['id']));?>" class="btn btn-sm btn-success">Active</a>    
                                                <?php else:?>
                                                    <a href="<?php echo base_url('admin/changeStatus/'.esc($blog['id']));?>" class="btn btn-sm btn-danger">Inactive</a>
                                                <?php endif;?>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('admin/editBlog/'.esc($blog['id']));?>" class="btn btn-sm btn-primary">Edit</a>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('admin/deleteBlog/'.esc($blog['id']));?>" class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php else:?>
                                    <tr>
                                        <td colspan="9" class="text-center">No blog found.</td>
                                    </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>