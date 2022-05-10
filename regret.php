<?php 
session_start(); 
ob_start(); 
?> 




<?php include("includes/header.php")?> 

<?php if(!isset($_SESSION['email'])) {
 header('Location: log_in.php');
}  
?> 



<?php
$msg ="";

if(isset($_GET['id'])) {
$onske = new Onsker();
$buyer = new Buyers();


$resultat = $onske->find_by_id($_GET['id']);


if(isset($_POST['submit'])) {


    $status = $resultat->status - $_GET['qty'];
   

   
        $onske_data = ["status" => $status];

        $onske->update($onske_data, $_GET['id']);
        $buyer->delete($_GET['token']);

      
        header('Location: profile.php?id='. $_SESSION['user_id']);
    }

   




?> 



<div class=" d-flex justify-content-center">
<div class="card mt-5 col-lg-5">
    <div class="card-header">
    Bekreft at du vil angre <?php echo $_GET['item']; ?>  kjøpet
    </div>
    <div class="card-body">
    <?php if($msg != "") { ?> 
            <div class="alert alert-danger">
             <?php echo $msg; ?> 
            </div>
            <?php } ?> 
        <form action="" method="POST">
            <p>Er du sikker på at du vil angre kjøpet av <?php echo $_GET['qty'] ." stk " .$_GET['item']?>?</p>
            <input id="btn-buy"type="submit" name="submit" value="Ja jeg har ikke kjøpt det likevel">
        </form>
        <br>

        <a href="profile.php?id=<?php echo $_SESSION['user_id']?> ">Tilbake</a>
    </div>
</div>
</div>


<?php } ?> 

<?php include("includes/footer.php")?>