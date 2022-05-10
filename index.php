<?php 
session_start(); 
ob_start(); 
?> 



<?php include("includes/header.php")?> 


<?php if(!isset($_SESSION['email'])) {
 header('Location: log_in.php');
}  
?> 



    



<div class="d-flex justify-content-center">
<div class="jumbotron text-center col-lg-10">
    <h3>Velkommen til x og x's Bryllupsliste</h3>
    <p>Klikk på linkene for å <b>se ønskene</b>, klikk på <b>Oppdater</b> for å indikere hvor mye du har kjøpt</p>
</div>
</div>






<div class="row d-flex justify-content-center wrapper">




<?php  
$onsker = new Onsker();
$result = $onsker->find_all();









foreach($result as $item) { ?> 
    <div class="card wishcards col-lg-3 col-md-12, col-sm-12">
        <div class="card-body">
                <h4 class="onske-title" title="<?php echo $item->name;?>"><?php echo $item->name;?> </h4>
                    Ønsket antall: <?php echo $item->quantity ?> <br>
                    Status: <?php echo $item->status ?> av <?php echo $item->quantity ?> kjøpt <br>
                    <div> 
                    <a id="onske-link"class=""href="<?php echo $item->link; ?>" target="_blank">Klikk her for å se</a>             
                    </div>
                    <?php if($item->status == $item->quantity):?> 
                    
                    <?php else: ?>  
                    <a href="bought.php?id=<?php echo $item->onske_id ?>&item=<?php echo $item->name?> " id="btn-buy">Oppdater</a>
                    <?php endif; ?> 
                </div>
    </div>    
<?php } ?> 
</div>


<?php include("includes/footer.php")?>