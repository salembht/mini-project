<?php
$posts =getposts();
?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
       
      </div>
      <h2>Manag posts</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Title</th>
              <th scope="col">Content</th>
              <th scope="col">Author</th>
              <th scope="col">Manage</th>
            </tr>
          </thead>
          <tbody>
            <?php for($i=0 ;$i<count($posts);$i++){ ?>
            <tr>
              <td><?php echo $posts[$i]['id'];?></td>
              <td><?php echo $posts[$i]['title'];?></td>
              <td><?php echo $posts[$i]['content'];?></td>
              <td><?php echo $posts[$i]['author'];?></td>
              <td><!-- Button trigger modal -->
<button type="button" class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#deletemodal-<?php echo $posts[$i]['id']; ?>">
Delete 
</button>

<!-- Modal -->
<div class="modal fade" id="deletemodal-<?php echo $posts[$i]['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Delete post </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Do you wabt to delete <?php echo $posts[$i]['title'];?> 
      </div>
      <div class="modal-footer"> 
        <form action="" method="post">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="delete" value="<?php echo $posts[$i]['id'];?>" class="btn btn-danger">Delete </button>
        </form>
      </div>
    </div>
  </div>
</div></td>
            </tr>
         <?php } ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>