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
                        <div class="mb-3">
                            <label for="name" class="form-label">Parent Category Name</label>
                            <input type="text" class="form-control" id="name" value="<?= old('name', isset($parentCategoryData) ? esc($parentCategoryData['name']) : '') ?>" name="name" required>
                        </div>
                        <div class="mb-5">
                            <input type="submit" class="btn btn-primary" name="save" value="Save Category"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>