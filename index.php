<?php
include("config/db.php");

if (isset($_POST["signup"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($email != "" && $password != "") {
        $hashed = sha1($password);
        $sql = "INSERT INTO users (email,password) VALUES ('$email','$hashed')";
        $query = $conn->query($sql);
        if ($query) {
            header('Location:login.php');
        } else {
            echo "Failed to register user";
        }
    } else {
        $error = "Please fill all details";
    }
}
?>
<?php
include("inc/header.php");
?>
<div class="container">
    <form action="index.php" method="POST">
        <fieldset>
            <legend>Signup</legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label mt-4">Email</label>
                        <input class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Password">
                    </div>
                </div>

            </div>
            <input type="submit" value="Sign up" name="signup" class="btn btn-primary mt-4" />
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                        if (isset($_POST["signup"])) :
                        ?>
                        <div class="alert alert-dismissable alert-warning">
                            <?php echo $error ?>
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



