<?php include("includes/header.php"); ?> 

<?php 


session_start();


?> 


<?php





$user = new Users();


$msg = "";

if(isset($_POST['submit'])) {

    $result = $user->login($_POST['email'], md5($_POST['password']));
    if($result) {

        $_SESSION['email'] = $result->email;
        $_SESSION['fname'] = $result->fname;
        $_SESSION['lname'] = $result->lname;
        $_SESSION['user_id'] = $result->user_id;
        header('Location: index.php');



    } else {
        $msg = "Feil brukernavn eller passord <br><a href='reset.php'>Resette passord?</a>";
    }


}


?> 


<div class=" d-flex justify-content-center">

    <div class="card mt-5 col-lg-5">
        <div class="card">
            <br>
            <h4 class="text-center">Logg inn</h4>
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
                echo $form->password_field($name="password", $value="", $id="password", $class="form-control", $placeholder="Passord");
                echo $form->submit_field($name="submit", $value="Logg inn",$id="",$class="btn-login");
                


                
            
            ?> 
            </div>
            </form>

        
            <a class="register-link" href="register.php">Har du ikke konto enda? registrer deg her</a>

        </div>

    </div>
</div>


<?php include("includes/footer.php")?>