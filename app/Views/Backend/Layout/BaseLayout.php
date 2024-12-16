<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title><?= esc($title) ?></title>
    <!-- MDB icon -->
    <link rel="icon" href="<?= base_url('Admin/Assets/Images/logo.png') ?>" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="<?php echo base_url('Admin/Assets/CSS/mdb.min.css') ?>" />
    <!-- PRISM -->
    <link rel="stylesheet" href="<?php echo base_url('Admin/Assets/CSS/new-prism.css') ?>" />
    <link rel="stylesheet" href="<?php echo base_url('Admin/Assets/CSS/main.css') ?>" />
    <!-- Custom styles -->
    <!-- {{-- jQuery --}} -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- {{-- bootstrap icon --}} -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- {{-- Datatable cdn --}} -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Include Froala CSS -->
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@4.0.10/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css">
    
    <!-- Include Froala Fonts (Optional) -->
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@4.0.10/css/froala_editor.pkgd.min.css" rel="stylesheet">

    <!-- Include Froala JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@4.0.10/js/froala_editor.pkgd.min.js"></script>

    <style>
        @media (min-width: 1400px) {

            main,
            header,
            #main-navbar {
                padding-left: 240px;
            }
        }
    </style>
</head>

<body>
    <script>
        const storedTheme = localStorage.getItem('theme');
        if (storedTheme) {
            document.body.setAttribute('data-theme', storedTheme);
        } else {
            document.body.setAttribute('data-theme', 'light'); 
        }
    </script>

    <header>
        <div id="sidenav-1" class="sidenav" role="navigation" data-hidden="false" data-accordion="true">
            <a class="ripple d-flex justify-content-center py-4" href="" data-ripple-color="primary">
                <h3 class="logo">Blogs Admin</h3>
            </a>

            <ul class="sidenav-menu">
                <li class="sidenav-item <?= (uri_string() == 'admin/dashboard') ? 'active' : '' ?>">
                    <a class="sidenav-link" href="<?= base_url('admin/dashboard') ?>">
                        <i class="fas fa-chart-area pr-3"></i><span>Dashboard</span>
                    </a>
                </li>
                <li class="sidenav-item <?= (uri_string() == 'admin/category') || (uri_string() == 'admin/addParentCategory') ? 'active' : '' ?>">
                    <a class="sidenav-link" href="<?= base_url('admin/category') ?>">
                        <i class="fas fa-list pr-3"></i><span>Category</span>
                    </a>
                </li>
                <li class="sidenav-item <?= (uri_string() == 'admin/blogs' || uri_string() == 'admin/addBlog') ? 'active' : '' ?>">
                    <a class="sidenav-link" href="<?= base_url('admin/blogs') ?>">
                        <i class="fas fa-blog pr-3"></i><span>Blogs</span>
                    </a>
                </li>
            </ul>
        </div>
        <nav id="main-navbar" class="navbar navbar-expand-lg fixed-top bg-light">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggler -->
                <button data-toggle="sidenav" data-target="#sidenav-1" class="btn shadow-0 p-0 mr-3 d-block d-xxl-none"
                    aria-controls="#sidenav-1" aria-haspopup="true">
                    <i class="fas fa-bars fa-lg"></i>
                </button>

                <!-- Search form -->
                <form class="d-none d-md-flex input-group w-auto my-auto">
                    <input autocomplete="off" type="search" class="form-control rounded"
                        placeholder='Search (ctrl + "/" to focus)' style="min-width: 225px" />
                    <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
                </form>

                <!-- Right links -->
                <ul class="navbar-nav ml-auto d-flex flex-row">
                    <!-- Avatar -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                            id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
                            <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle"
                                height="22" alt="" loading="lazy" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">My profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- Container wrapper -->
        </nav>
    </header>        
    <main style="margin-top: 80px">
        <?php if (session()->getFlashdata('success')): ?>
            <div id="successSms" style="position: fixed; top: 100px; right: -300px; padding: 10px; background-color: #4caf50; color: white; border-radius: 5px; z-index: 1000; transition: right 0.5s ease;">
                <span id="successMessage">
                    <?= session()->getFlashdata('success'); ?>
                </span>
            </div>
        <?php endif; ?>
        <?= $this->include($view); ?>
    </main>


    <script type="text/javascript" src="<?php echo base_url('Admin/Assets/JS/new-prism.js') ?>"></script>
    <!-- MDB SNIPPET -->
    <script type="text/javascript" src="<?php echo base_url('Admin/Assets/JS/mdbsnippet.min.js') ?>"></script>
    <!-- MDB -->
    <script type="text/javascript" src="<?php echo base_url('Admin/Assets/JS/mdb.min.js') ?>"></script>

    <!-- {{-- datatable Js --}} -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
        $(document).ready(function() {
            $('#dataTable1').DataTable();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#successSms').css('right', '20px');
            setTimeout(function() {
                $('#successSms').css('right', '-300px');
            }, 3000);
        });
    </script>

    <!-- Custom scripts -->
    <script type="text/javascript">
        const sidenav = document.getElementById("sidenav-1");
        const instance = mdb.Sidenav.getInstance(sidenav);

        let innerWidth = null;

        const setMode = (e) => {
            // Check necessary for Android devices
            if (window.innerWidth === innerWidth) {
                return;
            }

            innerWidth = window.innerWidth;

            if (window.innerWidth < 1400) {
                instance.changeMode("over");
                instance.hide();
            } else {
                instance.changeMode("side");
                instance.show();
            }
        };

        setMode();

        // Event listeners
        window.addEventListener("resize", setMode);
    </script>

    <script>
        new FroalaEditor('#description', {
            toolbarButtons: [
                // First Row
                ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript'],
                ['fontFamily', 'fontSize', 'color', 'backgroundColor', 'inlineClass', 'inlineStyle'],
                ['paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent'],
                ['insertLink', 'insertImage', 'insertVideo', 'insertTable'],
                ['undo', 'redo', 'clearFormatting', 'selectAll', 'html']
            ],
            language: 'en',
            heightMin: 400,
            attribution: false,
        });
    </script>
</body>
</html>