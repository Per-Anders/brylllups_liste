<?php 
session_start(); 
ob_start(); 
?> 

<?php include("includes/header.php")?> 



<?php 


if(isset($_GET['email'])){
    
    $email = $_GET['email'];
    
} else {
    header('Location: log_in.php');
}


?> 


<div class=" d-flex justify-content-center">
    <div class="card mt-5 col-lg-5">

        <div class="card text-center mt-4">
            <h4>Aktiver konto</h4>
        </div>

        <div class="card-body register-body">
            <p>En mail er sendt til <b><?php echo $email; ?></b>. Vennligst klikk på linken i eposten for å aktivere kontoen din.  </p>            
      
        </div>

    </div>
</div>


<?php include("includes/footer.php")?>