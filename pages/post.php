<?php 

?>
<section class="py-5" data-aos="fade-up">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col">
                <div class="">
                    <div class="rounded d-flex justify-content-center">
                        <div class="shadow-lg p-5 bg-secondary">
                            <div class="text-center">
                                <h3 class="text-dark">Sign Up</h3>
                            </div>
                            <form action="" method="post" data-aos="flip-up" data-aos-delay="200" enctype="multipart/form-data">

                                <div class="p-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-dark"><i class="bi bi-paper-fill text-white"></i></span>
                                        <input type="text" name="title" class="form-control" placeholder="title" require>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-dark"><i class=" text-white"></i></span>
                                        <textarea type="text" name="content" class="form-control" placeholder="content" require style="resize: none;"></textarea>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-dark"><i class="-white"></i></span>
                                        <select name="catogry" class="form-select" aria-label="Default select example">
                                            <option selected>Open this select type</option>
                                            <option value="political">Political</option>
                                            <option value="finance"> Finance</option>
                                            <option value="sport">Sport</option>
                                            <option value="weather">Weather</option>
                                            <option value="cultural">cultural</option>
                                        </select>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-dark"><i class="bi bi-file-fill text-white"> post image</i> uplaod ure cv here</span>
                                        <input type="file" name="postimage" class="form-control" require>
                                    </div>
                                    <button class="btn btn-dark text-center mt-2" type="submit">
                                        post
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>