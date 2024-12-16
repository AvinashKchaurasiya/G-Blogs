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
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header" style="background-color: #332D2D; display: flex; justify-content:space-between;">
                    <h5 class="text-white"><?= esc($text) ?></h5>
                    <a href="<?= base_url('/admin/addCategory') ?>" class="btn btn-primary btn-sm m-0">Create Category</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable1" class="display table table-bordered">
                            <thead>
                                <tr>
                                    <th>#sn</th>
                                    <th>Category Name</th>
                                    <th>Category Description</th>
                                    <th>Parent Category</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($categoriesData)):?>
                                    <?php $sn = 1; foreach ($categoriesData as $category):?>
                                        <tr>
                                            <td><?= esc($sn++)?></td>
                                            <td><?= esc($category['name'])?></td>
                                            <td style="text-align: left;"><?= substr($category['category_description'], 0, 50)?>...</td>
                                            <td><?= esc($category['parent_category_id'])?></td>
                                            <td>
                                                <?php if ($category['status'] == 1):?>
                                                    <a href="<?php echo base_url('admin/changeCategoryStatus/'.esc($category['id']));?>" class="btn btn-sm btn-success">Active</a>    
                                                <?php else:?>
                                                    <a href="<?php echo base_url('admin/changeCategoryStatus/'.esc($category['id']));?>" class="btn btn-sm btn-danger">Inactive</a>
                                                <?php endif;?>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('admin/editCategory/'.esc($category['id']));?>" class="btn btn-sm btn-primary">Edit</a>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('admin/deleteCategory/'.esc($category['id']));?>" class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php else:?>
                                    <tr>
                                        <td colspan="9" class="text-center">No category found.</td>
                                    </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header" style="background-color: #332D2D; display: flex; justify-content:space-between;">
                    <h5 class="text-white">Parent Category List</h5>
                    <a href="<?= base_url('/admin/addParentCategory') ?>" class="btn btn-primary btn-sm m-0">Create Parent Category</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="display table table-bordered">
                            <thead>
                                <tr>
                                    <th>#sn</th>
                                    <th>Parent Category Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($parentCategoriesData)):?>
                                    <?php $sn = 1; foreach ($parentCategoriesData as $parentCategory):?>
                                        <tr>
                                            <td><?= esc($sn++)?></td>
                                            <td style="text-align: justify;"><?= esc($parentCategory['name'])?></td>
                                            <td>
                                                <a href="<?php echo base_url('admin/editParentCategory/'.esc($parentCategory['id']));?>" class="btn btn-sm btn-primary">Edit</a>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('admin/deleteParentCategory/'.esc($parentCategory['id']));?>" class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php else:?>
                                    <tr>
                                        <td colspan="9" class="text-center">No category found.</td>
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