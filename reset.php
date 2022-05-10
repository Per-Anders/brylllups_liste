<?php 
session_start(); 
ob_start(); 
?> 


<?php include("includes/header.php")?> 



<?php
$ip = getIp();

$user = new Users();


$msg = "";

if(isset($_POST['submit'])) {
    
    $user = new Users();

    // lag en funksjon for å finne epost
    $usr = $user->validate_email($_POST['email']);
    if(!empty($usr)) {
        
            $hash = md5(rand(0,1000));
                
                $args = ["hash" => $hash];
                $user->update($args, $usr->user_id);
                
                
               
                // send email til bruker her.
                
                $to =  $usr->email;
                $subject = "Ønskelisten | Tilbakestille passord";
                $message = '
                
                Heisann, du har sendt en forespørsel om å resette passordet ditt fra ip:'.$ip. '
                Hvis det ikke var deg kan du ignorere dette
                
                
                Klikk her for å opprette nytt passord
                http://www.awesomedev.no/password_reset.php?email='.$usr->email.'&token='.$hash.'
                ';
                
                $headers = "From: noreply@awesomedev.no" . "\r\n";
                
                
                mail($to, $subject,$message, $headers);
                
                $msg = "En mail har blitt sendt til <b>" . $usr->email . "</b>. Klikk på linken i mailen for å opprette et nytt passord";
                
               
                
        
        
        
    } else {
        $msg = "Epost finnes ikke ";
    }
}



?> 


<div class=" d-flex justify-content-center">

    <div class="card mt-5 col-lg-5">
        <div class="card">
            <br>
            <h4 class="text-center">Resett passord</h4>
        </div>
        <div class="card-body login">
        <?php if($msg != "") { ?> 
            <div class="alert alert-danger">
             <?php echo $msg; ?> 
            </div>
            <?php } ?> 

        <form action="" method="POST">
        <div class="row">
            <?php 
            
                $form = new Forms();
                echo $form->email_field($name="email", $value="", $id="email", $class="form-control", $placeholder="Epost");
                echo $form->submit_field($name="submit", $value="Send mail",$id="",$class="btn-login");
                


                
            
            ?> 
            </div>
            </form>

        
            <a class="register-link" href="register.php">Har du ikke konto enda? registrer deg her</a>

        </div>

    </div>
</div>


<?php include("includes/footer.php")?>