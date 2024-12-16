<div class="container">
    <div class="row">
        <div class="col-sm-10">
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="card-title">
                        <?php if (!empty($parentCategory) && is_array($parentCategory)): ?>
                            <?=$parentCategory['name']?>
                        <?php endif ?>
                    </h3>
                </div>
                <div class="card-body">
                    <ol class="list-group list-group-flush" style="list-style-type: decimal;">
                        <?php if(!empty($categoryData)):?>
                            <?php foreach ($categoryData as $categoryData):?>
                                <li class="list-group-item">
                                    <h4>
                                        <a href="/categoryBlogs/<?= $categoryData->id; ?>/<?= $categoryData->categoryName;?>">
                                            <?= $categoryData->categoryName;?>
                                        </a>
                                    </h4>
                                    <p style="text-align: justify;"><?= $categoryData->categoryDescription;?></p>
                                </li>
                            <?php endforeach;?>
                        <?php else:?>
                            <p style="color: red; text-align: center;">There is No child categories found in "<?=$parentCategory['name']?>".</p>
                        <?php endif;?>
                    </ol>
                </div>
                <div class="card-footer">
                    <div class="pagination">
                        <?= $pager->links() ?>
                    </div>
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
                                    <a href="/category/<?= esc($categoriesData->id)?>/<?= esc(ucwords($categoriesData->name))?>"><?= esc(ucwords($categoriesData->name))?></a>
                                </li>
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