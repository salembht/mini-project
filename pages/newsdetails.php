<?php
$postid=$_POST["post"];
$post =getposts("*",$postid)[0];

?>
<div class="container">
    <div class="card w-50">
        <div class="card-header">
            <h5 class="card-title"><?php echo $post['title']; ?></h5>
        </div>
        <div class="card-body">
            <img src="<?php echo ROOT_PATH; ?>assets/image/<?php echo $post['imagepath']; ?>" class="card-img-bottom w-100" alt="...">
            <p class="card-text"><?php echo $post['content']; ?></p>
        </div>
        <div class="card-footer">
            This entry was posted in On
            <time datetime="" class="entry-date"><?php echo $post['postdate']; ?></time>
            <span> by <?php echo $post['author']; ?> </span>
        </div>
    </div>
</div>