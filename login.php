<?php
session_start();
include("config/db.php");

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($email != "" && $password != "") {
        $hashed = sha1($password);
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$hashed';";
        $result = mysqli_query($conn, $sql)or die('Errror');
        
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){
                $_SESSION['id']  =  $row['id'];
                $_SESSION['email'] =  $row['email'];
                $_SESSION['password'] =  $row['password'];
                $_SESSION['role'] =  $row['role'];
                header('Location:dashboard.php');
            }
        }
        else{
            $error = "Either email or password incorrect";
        }
    } else {
        $error = "Please fill all details";
    }
}

?>

<?php if($_SESSION['id']):?>
<?php header("Location:dashboard.php")?>
<?php else:?>
<?php
include("inc/header.php");
?>
<div class="container">
    <form action="login.php" method="POST">
        <fieldset>
            <legend>Login</legend>
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
            <input type="submit" value="Login" name="login" class="btn btn-primary mt-4" />
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                        if (isset($_POST["login"])) :
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
<?php endif?>