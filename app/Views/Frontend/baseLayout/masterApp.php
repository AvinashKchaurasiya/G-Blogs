<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo isset($title) ? $title : 'Blogs Hain'; ?>
    </title>
    <link rel="icon" href="<?= base_url('Admin/Assets/Images/logo.png') ?>" type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="<?php echo base_url('Assets/CSS/Main.css'); ?>" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary mb-5">
        <div class="container-fluid">
            <a class="navbar-brand me-2" href="<?= base_url('/')?>" style="font-size: 20px; font-weight: bold;">
                Blogs
            </a>
            <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarButtonsExample">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0"> <!-- Use ms-auto to push items to the right -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/')?>">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a data-mdb-dropdown-init class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" aria-expanded="false" >
                            Categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if(!empty($parentCategoryDataOnly) && isset($parentCategoryDataOnly)):?>
                                <?php foreach ($parentCategoryDataOnly as $parentCategoryDataOnly):?>
                                    <li>
                                        <a class="dropdown-item" href="/category/<?= esc($parentCategoryDataOnly['id'])?>/<?= esc(ucwords($parentCategoryDataOnly['name']))?>">
                                            <?= (ucwords($parentCategoryDataOnly['name'])) ?>
                                        </a>
                                    </li>
                                <?php endforeach;?>
                            <?php endif;?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/blogs') ?>">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="<?= base_url('/login')?>">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="content">
        <?= $this->include($view); ?>
    </div>

    <footer>
        <!-- Your footer content -->
    </footer>

    <!-- MDB JS -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.umd.min.js"></script>
    <script src="<?php echo base_url('Assets/JS/Main.js') ?>"></script>
</body>

</html>