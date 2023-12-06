<?php
$requests=getrequstes();
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-email-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>

    </div>
    <h2>Manage requstes</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">cv</th>
                    <th scope="col">Manage</th>
                </tr>requests
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($requests); $i++) { ?>
                    <tr>
                        <td><?php echo $requests[$i]['id']; ?></td>
                        <td><?php echo $requests[$i]['username']; ?></td>
                        <td><?php echo $requests[$i]['email']; ?></td>
                        <td><?php echo $requests[$i]['cv']; ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showmodal-<?php echo $requests[$i]['id']; ?>">
                               show
                            </button>

                            <div class="modal fade" id="showmodal-<?php echo $requests[$i]['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"> Update post </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                       
                                        <div class="modal-body">
                                            <p> user name:<?php echo $requests[$i]['username']; ?> </p><br>
                                            <img src="<?php echo ROOT_PATH?>assets/cvs/<?php echo $requests[$i]['cv']; ?>" alt="" height="100%" width="100%">
                                        </div>
                                        <div class="modal-footer">
                                            <form action="" method="post">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="accept" value="<?php echo $requests[$i]['id']; ?>" class="btn btn-primary">accept </button>
                                                </form>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletemodal-<?php echo $requests[$i]['id']; ?>">
                                Delete
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="deletemodal-<?php echo $requests[$i]['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"> Delete post </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Do you wabt to delete <?php echo $requests[$i]['username']; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="" method="post">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="delete" value="<?php echo $requests[$i]['id']; ?>" class="btn btn-danger">Delete </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>