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

if(isset($_POST['submit'])) {
    $args = $_POST['data'];

    if(filter_var($_POST['link'], FILTER_VALIDATE_URL)) {
        $link = $_POST['link'];
    } else {
        $link = "http://www.google.com/search?q=".$_POST['link'];
        print($link);
    }



    $data = ["link" => $link, "origin_id" => $_SESSION['user_id']];
    $args = array_merge($data, $args);
    
 

    $onske = new Onsker();
    $onske->create($args);
    // header('Location: index.php');
}



?> 




<div class="card mt-5">

    <div class="card-body">
    <div class="card">
        <h4>Nytt ønske</h4>
    </div>
    <form action="" class="form-group" method="POST">
    <?php 
    $form = new Forms();

    echo $form->input_field($name="data[name]", $value="", $id="item", $class="form-control", $placeholder="Navn på gave");
    echo $form->input_field($name="link", $value="", $id="link", $class="form-control", $placeholder="Lim inn link til gave: https://");
    echo $form->integer_field($name="data[quantity]", $value="1", $id="link", $class="form-control", $placeholder="Antall");
    echo $form->submit_field($name="submit", $value="Lagre",$id="btn-buy",$class="btn-buy")
    ?> 
    </form>
    </div>
</div>







<?php include("includes/footer.php")?>