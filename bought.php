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
$max = $resultat->quantity - $resultat->status;
echo $max;

if(isset($_POST['submit'])) {

    

    $status = $resultat->status + $_POST['quantity'];
    if($status > 0 && $_POST['quantity'] <= $max) {
        $args = ["status" => $status];

        $onske->update($args, $_GET['id']);


        $data = ["gift_id" => $resultat->onske_id, "user_id" => $_SESSION['user_id'], "quantity" => $_POST['quantity']];
        $buyer->create($data);

        header('Location: profile.php?id='. $_SESSION['user_id']);
    } else {
        $msg =  "Du kan ikke kjøpe flere enn " . $max;
    }

   

}



?> 



<div class=" d-flex justify-content-center">
<div class="card mt-5 col-lg-5">
    <div class="card-header">
    Bekreft at du har kjøpt <?php echo $_GET['item']; ?> 
    </div>
    <div class="card-body">
    <?php if($msg != "") { ?> 
            <div class="alert alert-danger">
             <?php echo $msg; ?> 
            </div>
            <?php } ?> 
        <form action="" method="POST">
            <label for="quantity">Velg antall kjøpt</label>
            <input class="form-control col-lg-2"type="number" name="quantity" value="1" min="1" max="<?php echo $max; ?> ">
            <input id="btn-buy"type="submit" name="submit" value="Jeg har kjøpt denne gaven">
        </form>
        <br>

        <a href="index.php">tilbake</a>
    </div>
</div>
</div>


<?php } ?> 

<?php include("includes/footer.php")?>