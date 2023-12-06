<?php
$users = getusers();

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-email-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>

    </div>
    <h2>Manag users</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">USername</th>
                    <th scope="col">Email</th>
                    <th scope="col">password</th>
                    <th scope="col">Manage</th>
                </tr>users
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($users); $i++) { ?>
                    <tr>
                        <td><?php echo $users[$i]['id']; ?></td>
                        <td><?php echo $users[$i]['username']; ?></td>
                        <td><?php echo $users[$i]['email']; ?></td>
                        <td><?php echo $users[$i]['password']; ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updatmodal-<?php echo $users[$i]['id']; ?>">
                               Update
                            </button>

                            <div class="modal fade" id="updatmodal-<?php echo $users[$i]['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"> Update post </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="post">
                                        <div class="modal-body">
                                            <input type="text" name="username" value="<?php echo $users[$i]['username']; ?>">
                                            <input type="text" name="password" value="<?php echo $users[$i]['password']; ?>">
                                        </div>
                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="update" value="<?php echo $users[$i]['id']; ?>" class="btn btn-primary">Update </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletemodal-<?php echo $users[$i]['id']; ?>">
                                Delete
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="deletemodal-<?php echo $users[$i]['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"> Delete post </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Do you wabt to delete <?php echo $users[$i]['username']; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="" method="post">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="delete" value="<?php echo $users[$i]['id']; ?>" class="btn btn-danger">Delete </button>
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
</div>
</div>