<?php session_start(); ?>
<?php
include("config/db.php");
if (isset($_FILES['formFile'])) {
    $comment = $_POST['comment'];
    if ($comment != "") {
        $uploadok = 1;
        $file_name = $_FILES['formFile']['name'];
        $file_size = $_FILES['formFile']['size'];
        $file_tmp = $_FILES['formFile']['tmp_name'];
        $file_type = $_FILES['formFile']['type'];
        $target_dir = "assets/uploads";
        $target_file = $target_dir . basename($_FILES['formFile']['name']);
        $check = getimagesize($_FILES['formFile']['tmp_name']);

        $file_ext = strtolower(end(explode(
            '.',
            $_FILES['formFile']['name']
        )));

        $extensions = array("pdf");
        if (in_array($file_ext, $extensions) == false) {
            $msg = "Please upload only a pdf file";
        }
        if (file_exists($target_file)) {
            $msg = "Sorry file already exists";
        }
        if ($check == false) {
            $msg = "File is not a pdf";
        }
        if (empty($msg) == true) {
            move_uploaded_file($file_tmp, "assets/uploads/" . $file_name);
            $url = $_SERVER['HTTP_REFERER'];
            $seg = explode('/', $url);
            $path = $seg[0] . '/' . $seg[1] . '/' . $seg[2] . '/' . $seg[3];
            $full_url =  $path . '/' . 'assets/uploads/' . $file_name;
        }
        // $data =  array(
        //     'fn' => $file_name,
        //     'fs' => $file_size,
        //     'ft' => $file_tmp,
        //     'fty' => $file_type,
        //     'td' => $target_dir 
        // );

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit(); 
    } else {
        $msg = "Please fill all details";
    }
}
?>
<?php if ($_SESSION['id']) : ?>
<?php header("Location:dashboard.php") ?>
<?php else : ?>
<?php
    include("inc/header.php");
    ?>
<div class="container">
    <form action="del.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Add Blog</legend>
            <div class="row">
                <div class="col-md-6">
                    <!-- <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label mt-4">Email</label>
                        <input class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Password">
                    </div> -->
                    <div class="form-group">
                        <label for="comment" class="form-label mt-4">Comment</label>
                        <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="formFile" class="form-label mt-4">File input</label>
                        <input class="form-control" name="formFile" type="file" id="formFile">
                    </div>

                </div>

            </div>












            <input type="submit" value="Post" name="post" class="btn btn-primary mt-4" />
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                            if (isset($_POST["post"])) :
                            ?>
                        <div class="alert alert-dismissable alert-warning">
                            <?php echo $msg ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>
?>
<?php
    include("inc/footer.php")
    ?>
<?php endif ?>