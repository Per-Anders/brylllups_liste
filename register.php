<?php 
session_start(); 
ob_start(); 
?> 

<?php include("includes/header.php")?> 


<?php

$ip = getIp();
$agent = getAgent();

$user = new Users();


$msg = "";

if(isset($_POST['submit'])) {

    if($_POST['password1'] === $_POST['password2']) {


        if(strlen($_POST['password1']) >= 5 && strlen($_POST['password2']) >= 5 ) {

            $result = $user->check_email($_POST['data']['email']);
            if ($result == 0) {
                
                $email = $_POST['data']['email'];
                
                $hash = md5(rand(0,1000));
                
                $args = $_POST['data'];
                $hashed_password = md5($_POST['password2']);
                $data = ["password" => $hashed_password, "agent" => $agent, "ip" => $ip, "hash" => $hash];
                $args = array_merge($args, $data);
                $user->create($args);
                
               
                // send email til bruker her.
                
                $to =  $email;
                $subject = "Ønskelisten | Aktivering av konto";
                $message = '
                
                Takk for at du registrerte deg!
                Din konto har blitt opprettet.
                
                Vennligst klikk på denne linken for å aktivere kontoen din:
                http://www.awesomedev.no/verify.php?email='.$email.'&token='.$hash.'
                ';
                
                $headers = "From: noreply@awesomedev.no" . "\r\n";
                
                // echo $to;
                // echo $subject;
                // echo $message;
                // echo $headers;
                
                mail($to, $subject,$message, $headers);
                
                $msg = "En mail har blitt sendt til <b>" .$email . "</b>. Klikk på linken i mailen for å aktivere kontoen din";
                
                header('Location: thank_you.php?email='. $email);
                
    
            } else {
                $msg = "Epost er allerede registrert, prøv en annen";
            }
    
        } else {
            $msg = "Passord må være 5 eller lenger";
        }



    } else {
        $msg = "passordene er ikke like";
    }


}


?> 


<div class=" d-flex justify-content-center">
    <div class="card mt-5 col-lg-5">

        <div class="card text-center mt-4">
            <h4>Registrer deg</h4>
        </div>


        <div class="card-body register-body">

        <?php if($msg != "") { ?> 
            <div class="alert alert-danger">
             <?php echo $msg; ?> 
            </div>
            <?php } ?> 


        <form action="" method="POST">
        <div class="row">
            <?php 
            
                $form = new Forms();
                echo $form->input_field($name="data[fname]", $value="", $id="fname", $class="form-control col-lg-6", $placeholder="Fornavn");
                echo $form->input_field($name="data[lname]", $value="", $id="lname", $class="form-control col-lg-6", $placeholder="Etternavn");
                echo $form->email_field($name="data[email]", $value="", $id="lname", $class="form-control", $placeholder="Epost");
                
                echo $form->password_field($name="password1", $value="", $id="password", $class="form-control", $placeholder="Passord");
                echo $form->password_field($name="password2", $value="", $id="conform_password", $class="form-control", $placeholder="Bekreft passord");
                echo $form->submit_field($name="submit", $value="Registrer",$id="",$class="btn-register");
                ?> 
        
            </div>
            </form>
            <br>

            <a class="login-link"href="log_in.php">Allerede registrert? Logg inn her</a>
            
        </div>

    </div>
</div>


<?php include("includes/footer.php")?>