<div class="container mb-5">
    <div class="row">
        <div class="col-sm-10">
            <div class="card mb-5">
                <div class="card-header" style="display: flex; justify-content: center; align-items: center; ">
                    <?php if (!empty($blogData) && is_array($blogData)): ?>
                        <img src="<?= base_url($blogData['blog_image']);?>" class="img-responsive" alt="<?= $blogData['blog_title']?>" style="max-width: 50%;"/>
                    <?php endif;?>
                </div>
                <div class="card-body">
                    <h2 class="card-title"><?= esc(ucwords($blogData['blog_title']))?></h2>
                    <p class="card-text"><?= $blogData['blog_desc']?></p>
                    <p class="card-text">Author: <strong><?= esc(ucwords($blogData['blog_author']))?></strong></p>
                    <p class="card-text">Category: <strong><?= esc(ucwords($categoryData['category_name']))?></strong></p>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="row mb-5">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header px-3">Categories</div>
                        <ul class="list-group list-group-light list-group-small">
                            <?php foreach ($categoriesData as $categoriesData):?>
                                <li class="list-group-item px-3">
                                    <a href="/category/<?= esc($categoriesData->id)?>/<?= esc(ucwords($categoriesData->name))?>"><?= esc(ucwords($categoriesData->name))?></a></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header px-3">Latest Posts</div>
                            <ul class="list-group list-group-light list-group-small">
                                <?php foreach ($latestBlogs as $latestBlogs):?>
                                    <li class="list-group-item px-3"><a href="/<?= esc($latestBlogs['id'])?>/<?= esc($latestBlogs['blog_title'])?>"><?= esc(ucwords(substr($latestBlogs['blog_title'], 0, 18)))?>...</a></li>
                                <?php endforeach;?>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>