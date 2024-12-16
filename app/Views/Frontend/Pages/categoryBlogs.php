<div class="container mb-5">
    <div class="row">
        <div class="col-sm-10">
            <?php if (!empty($blogsData) && is_array($blogsData)): ?>
                <?php foreach ($blogsData as $blogData): ?>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-sm-4" style="display: flex; justify-content: center; align-items: center; ">
                                <img src="<?php echo base_url($blogData['blog_image']); ?>" alt="Blog Image" class="img-fluid" style="max-width: 70%; height: auto;">
                            </div>

                            <div class="col-sm-8">
                                <div class="card-body">
                                    <h2 class="card-title"><?= esc(ucwords($blogData['blog_title'])) ?></h2>
                                    <p class="card-text"><?= substr($blogData['blog_desc'], 0, 20) ?>...</p>
                                    <p class="card-text">Author: <strong><?= esc(ucwords($blogData['blog_author'])) ?></strong></p>
                                    <p class="card-text">Category: <strong><?= esc(ucwords($blogData['category_name'])) ?></strong></p>
                                    <a href="/<?= esc($blogData['id']) ?>/<?= esc($blogData['blog_title']) ?>" class="btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="color: red;">No blogs found</p>
            <?php endif; ?>
        </div>
        <div class="col-sm-2">
            <div class="row mb-5">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header px-3">Categories</div>
                        <ul class="list-group list-group-light list-group-small">
                            <?php foreach ($categoriesData as $categoriesData): ?>
                                <li class="list-group-item px-3">
                                    <a href="/category/<?= esc($categoriesData->id) ?>/<?= esc(ucwords($categoriesData->name)) ?>"><?= esc(ucwords($categoriesData->name)) ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header px-3">Latest Posts</div>
                        <ul class="list-group list-group-light list-group-small">
                            <?php foreach ($latestBlogs as $latestBlogs): ?>
                                <li class="list-group-item px-3"><a href="/<?= esc($latestBlogs['id']) ?>/<?= esc($latestBlogs['blog_title']) ?>"><?= esc(ucwords(substr($latestBlogs['blog_title'], 0, 18))) ?>...</a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>