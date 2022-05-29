<?php
session_start();
?>
<?php if(!$_SESSION['id']):?>
<?php header("Location:login.php")?>
<?php else:?>
<?php
include("inc/header.php");
?>
<div class="container">

    <h1>Welcome <?php echo $_SESSION['email'];?></h1>
</div>

<?php
include("inc/footer.php")
?>

<?php endif?>