<?php

$posts = rturenpost();

$start =isset($_GET['page']) ? $_GET['page'] : 0;
$end=$start+5;
?>
<div class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <div class="col-main col-sm-9">

                <div class="blog-wrapper" id="main">
                    <div class="page-title new_page_title">
                        <h2>News</h2>
                    </div>
                    <div class="site-content" id="primary">
                        <div role="main" id="content">
                            <?php for ($i = $start; $i <$end ; $i++) {
                                if (!empty($posts[$i])) {  ?>

                                    <article class="blog_entry clearfix wow bounceInUp animated">
                                        <header class="blog_entry-header clearfix">
                                            <div class="blog_entry-header-inner">
                                                <h2 class="blog_entry-title "> <?php echo $posts[$i]['title']; ?> </h2>
                                            </div>

                                        </header>
                                        <div class="entry-content">
                                            <div class="card-img"><img alt="blog-img4" src="<?php echo ROOT_PATH; ?>assets/image/<?php echo $posts[$i]['imagepath']; ?>" class="w-50 "></div>
                                            <div class="entry-content">
                                                <p> <?php echo substr($posts[$i]['content'],0, strlen($posts[$i]['content']) /2  ) ; ?>... </p>
                                            </div>
                                            <p>
                                            <form action="newsdetails" method="post"> <button class="btn btn-secondary" type="submit" name="post" value="<?php echo $posts[$i]['id']; ?>">Read more</button></form>
                                            </p>
                                        </div>
                                        <footer class="entry-meta"> This entry was posted in On
                                            <time datetime="" class="entry-date"><?php echo $posts[$i]['postdate']; ?></time>
                                            <span> by <?php echo $posts[$i]['author']; ?> </span>
                                        </footer>
                                    </article>
                            <?php }
                            } ?>

                        </div>
                    </div>
                    <!-- the pagtion  -->
                    <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <?php for($i=0;$i<count($posts)/5;$i++){?>
    <li class="page-item"><a class="page-link" href="<?php echo ROOT_PATH; ?>home?page=<?php echo $i*5 ?>"><?php echo $i+1 ?></a></li>
    <?php }?>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
                </div>
            </div>
            <div class="col-right sidebar col-sm-3">
                <div role="complementary" class="widget_wrapper13" id="secondary">
                    <div class="popular-posts widget widget__sidebar wow bounceInUp animated" id="recent-posts-4">
                        <h3 class="widget-title">Most Popular Post</h3>
                        <div class="widget-content">
                            <ul class="posts-list unstyled clearfix">
                                <li>
                                    <figure class="featured-thumb"> <a href="<?php echo ROOT_PATH; ?>newsdetails" class="nav-link"> <img width="80" height="53" alt="blog image" src="<?php echo ROOT_PATH; ?>assets/image/benches.jpg"> </a> </figure>
                                    featured-thumb
                                    <h4><a title="Pellentesque posuere" href="blog_detail.html">Pellentesque posuere</a></h4>
                                    <p class="post-meta"><i class="icon-calendar"></i>
                                        <time datetime="2014-07-10T07:09:31+00:00" class="entry-date"></time>
                                        .
                                    </p>
                                </li>

                            </ul>
                        </div>
                        <!--widget-content-->
                    </div>
                    <div class="popular-posts widget widget_categories wow bounceInUp animated" id="categories-2">
                        <h3 class="widget-title">Categories</h3>

                        <ul>
                            <!-- <form action="" method="post"> <button class="btn btn-light w-100 " type="submit" name="type" value="political">political</button></form> -->
                            <!-- <form action="" method="post"> <button class="btn btn-light  w-100" type="submit" name="type" value="finance">finance</button></form> -->
                            <!-- <form action="" method="post"> <button class="btn btn-light w-100" type="submit" name="type" value="sport">sport</button></form> -->
                            <!-- <form action="" method="post"> <button class="btn btn-light w-100" type="submit" name="type" value="weather">weather</button></form> -->
                            <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_PATH; 
                                                                                ?>home?type=political">Political</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_PATH; ?>home?type=finance">Finance</a></li>

                    <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_PATH; 
                                                                    ?>home?type=sport">Sport</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_PATH; 
                                                                    ?>home?type=weather">Weather</a></li>
                                                                    <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_PATH; 
                                                                    ?>home?type=cultural">Cultural</a></li>
                            <!-- <form action="" method="post"> <button class="btn btn-light w-100" type="submit" name="type" value="cultural">cultural</button></form> -->
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>