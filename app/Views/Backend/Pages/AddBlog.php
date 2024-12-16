<style>
    /* Container for the image preview circle */
    .image-upload-container {
        position: relative;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid #ccc;
        background-color: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    /* Style for the upload input (hidden) */
    .image-upload-input {
        display: none;

    }

    .image-upload-label {
        font-size: 30px;
        color: #aaa;
        cursor: pointer;
        position: absolute;
        top: auto;
        right: auto;
        transition: opacity 0.3s;
    }

    .image-preview {
        max-width: 100%;
        max-height: 100%;
        cursor: pointer;
        object-fit: cover;
    }

    .image-upload-container:hover .image-upload-label {
        opacity: 1;
    }

    .image-preview:not([src=""])~.image-upload-label {
        display: none;
    }
</style>

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
                    <a href="<?= base_url('admin/blogs') ?>" class="btn btn-primary btn-sm m-0">Back</a>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <form action="<?= $formAction; ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>

                            <div class="row">
                                <!-- Title -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="<?= old('title', isset($blog) ? esc($blog['blog_title']) : '') ?>" required>
                                        <?php if (isset($errors['title'])): ?>
                                            <div class="text-danger"><?= esc($errors['title']) ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Category -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Category</label>
                                        <select class="form-select" id="category" name="category" required>
                                            <option value="">Select Category</option>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?= esc($category['id']) ?>" <?= old('category', isset($blog) ? $blog['blog_category'] : '') == $category['id'] ? 'selected' : '' ?>>
                                                    <?= esc($category['name']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (isset($errors['category'])): ?>
                                            <div class="text-danger"><?= esc($errors['category']) ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Author -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="author" class="form-label">Author</label>
                                        <input type="text" class="form-control" id="author" name="author" value="<?= old('author', isset($blog) ? esc($blog['blog_author']) : '') ?>" required>
                                        <?php if (isset($errors['author'])): ?>
                                            <div class="text-danger"><?= esc($errors['author']) ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Active Status -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="active_status" class="form-label">Active Status</label>
                                        <select class="form-select" id="active_status" name="active_status" required>
                                            <option value="" hidden>Select Status</option>
                                            <option value="1" <?= old('active_status', isset($blog) ? $blog['blog_status'] : '') == '1' ? 'selected' : '' ?>>Active</option>
                                            <option value="0" <?= old('active_status', isset($blog) ? $blog['blog_status'] : '') == '0' ? 'selected' : '' ?>>Inactive</option>
                                        </select>
                                        <?php if (isset($errors['active_status'])): ?>
                                            <div class="text-danger"><?= esc($errors['active_status']) ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Image Upload -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <div class="image-upload-container">
                                            <input type="file" class="image-upload-input" id="image" name="image" accept="image/*" onchange="previewImage()" />
                                            <label for="image" class="image-upload-label">
                                                <i class="fas fa-upload text-primary"></i> 
                                            </label>
                                            <img id="imagePreview" src="<?= isset($blog) && $blog['blog_image'] ? base_url(esc($blog['blog_image'])) : '' ?>" alt="Image Preview" class="image-preview" style="display:<?= isset($blog) && $blog['blog_image'] ? 'block' : 'none' ?>"/>
                                        </div>
                                        <?php if (isset($errors['image'])): ?>
                                            <div class="text-danger"><?= esc($errors['image']) ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <divb class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="5" required><?= old('description', isset($blog) ? esc($blog['blog_desc']) : '') ?></textarea>
                                        <?php if (isset($errors['description'])): ?>
                                            <div class="text-danger"><?= esc($errors['description']) ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </divb>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <input type="submit" name="saveBlog" value="<?= isset($blog) ? 'Update Blog' : 'Save Blog' ?>" class="btn btn-primary" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImage() {
            const file = document.getElementById("image").files[0];
            const reader = new FileReader();
            const preview = document.getElementById("imagePreview");

            if (file) {
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }
    </script>