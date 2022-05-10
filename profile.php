<?php 
session_start(); 
ob_start(); 
?> 

<?php include("includes/header.php")?> 


<?php if(!isset($_SESSION['user_id'])) {
 header('Location: log_in.php');
} else {

if($_GET['id'] == $_SESSION['user_id']) {

$user = new Users();
$logged_in = $user->find_by_id($_SESSION['user_id']);


?> 



<div class="d-flex justify-content-center">
<div class="jumbotron text-center col-lg-10">
    <h3>Hei <?php  echo $logged_in->fname . " " . $logged_in->lname?></h3>
    <p>Her er oversikten over gavene du har kjøpt</p>
</div>
</div>


<div class="row d-flex justify-content-center">




<?php  

$result = $user->get_buy_history($logged_in->user_id);

foreach($result as $item) { ?> 
    <div class="card wishcards col-lg-3 col-md-12, col-sm-12">
        <div class="card-body">
                <h4><?php echo $item->quantity ?> <?php echo $item->name;?> </h4>
                    <a class=""href="<?php echo $item->link; ?>" target="_blank">Klikk her for å se</a>       
                    <br>      
                    <a href="regret.php?id=<?php echo $item->onske_id ?>&item=<?php echo $item->name?>&qty=<?php echo $item->quantity?>&token=<?php echo $item->buy_id?> " id="regret">Angre</a>
                </div>
    </div>    
<?php }} else {
    header('Location: index.php');
}} ?> 
</div>


<?php include("includes/footer.php")?>