<?php 
session_start(); 
ob_start(); 
?> 

<?php include("includes/header.php")?> 



<?php 


if(isset($_GET['email']) && isset($_GET['token'])){
    
    $email = $_GET['email'];
    $token = $_GET['token'];
    
    
    $user = new Users();
    $result = $user->validate_token($email, $token);
    $args = ["active" => 1, "hash" => ""];    
    $confirmed = $user->update($args, $result->user_id);
 
    
} else {
    header('Location: log_in.php');
}


?> 


<div class=" d-flex justify-content-center">
    <div class="card mt-5 col-lg-5">

        <div class="card text-center mt-4">
            <h4>Konto aktivert</h4>
        </div>

        <div class="card-body register-body">
            <a class="text-center "href="log_in.php">Logg inn her</a>
      
        </div>

    </div>
</div>


<?php include("includes/footer.php")?>