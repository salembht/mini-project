<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>EKHABARINA</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?php echo ROOT_PATH; ?>assets/css/styles.css" rel="stylesheet" />
    <link href="<?php echo ROOT_PATH; ?>assets/css/aos.css" rel="stylesheet">
    <link href="<?php echo ROOT_PATH; ?>assets/css/blogmate.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg  bg-primary-light p-0">
            <div class="container px-5">
                <a class="navbar-brand" href="<?php echo ROOT_PATH; ?>"><img src="<?php echo ROOT_PATH; ?>assets/image/logo-no-background.png" alt="logo" width="150px" height="50px"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                        <!-- <li class="nav-item" ><a class="nav-link" href="blog">Blog</a></li> -->
                        <!-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownPortfolio" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Portfolio</a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownPortfolio">
                                    <li><a class="dropdown-item" href="portfolio">Portfolio Overview</a></li>
                                    <li><a class="dropdown-item" href="project">Portfolio Item</a></li>
                                </ul>
                            </li> -->
                        <!-- <li class="nav-item" ><a class="nav-link" href="portfolio">Portfolio</a></li> -->

                        <?php if (!isSignin()) { ?>
                            <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_PATH; ?>">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_PATH; ?>signin">Sign In</a></li>
                        <?php } else { ?>
                                <?php if(isAdmin()){ ?><li class="nav-item"><a class="nav-link" href="<?php echo ROOT_PATH; ?>dashboard/home">Dashboard</a></li><?php }?>
                            <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_PATH; ?>">News</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_PATH; ?>post">Post</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_PATH; ?>signout">Sign Out</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>