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
    
    if(!empty($result)){
        echo "fant";
   
 
    
    if(isset($_POST['submit'])){
        
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        
        if($password == $password2) {
        
            $hashed_pass = md5($password2);
            echo $hashed_pass;
            
            $args = ["hash" => "", "password" => $hashed_pass];
    
            print_r($args);
    
            $user->update($args, $result->user_id);
            
            header('Location: log_in.php');
        }
    }
     
  
    
} else {
    header('Location: log_in.php');
}


?> 


<div class=" d-flex justify-content-center">
    <div class="card mt-5 col-lg-5">

        <div class="card text-center mt-4">
            <h4>Nytt passord</h4>
        </div>

        <div class="card-body register-body">
          <form class="form-group"action="" method="POST"> 
                <input class="form-control" type="password" name="password" placeholder="Skriv inn nytt passord">
                <input class="form-control"type="password" name="password2" placeholder="Bekreft nytt passordet"> 
                <input class="float-right"type="submit" name="submit" value="Lagre" >
          </form>
      
        </div>

    </div>
</div>

<?php 

}

?> 


<?php include("includes/footer.php")?>