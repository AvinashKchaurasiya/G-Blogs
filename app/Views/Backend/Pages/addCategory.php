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
                    <h5 class="text-white"><?= esc($text) ?></h5>
                    <a href="<?= base_url('/admin/category') ?>" class="btn btn-primary btn-sm m-0">Back</a>
                </div>
                <div class="card-body">
                    <form action="<?= $formAction; ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= old('name', isset($categoryData) ? esc($categoryData['name']) : '') ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="parent_id" class="form-label">Parent Category</label>
                                    <select class="form-select" id="parent_id" name="parent_id" required>
                                        <option value="">Select Parent Category</option>
                                        <?php foreach ($parentCategoriesData as $parentCategoriesData):?>
                                            <option value="<?= esc($parentCategoriesData['id'])?>" <?= old('category', isset($categoryData) ? $categoryData['parent_category_id'] : '') == $parentCategoriesData['id'] ? 'selected' : '' ?>><?= esc($parentCategoriesData['name'])?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3">
                                        <?= old('description', isset($categoryData) ? esc($categoryData['category_description']) : '') ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="1" <?= old('active_status', isset($categoryData) ? $categoryData['status'] : '') == '1' ? 'selected' : '' ?>>Active</option>
                                        <option value="0"  <?= old('active_status', isset($categoryData) ? $categoryData['status'] : '') == '0' ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <input type="submit" class="btn btn-primary" value="<?= isset($categoryData) ? 'Update Category' : 'Save Category' ?>"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>