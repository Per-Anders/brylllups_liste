
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php"><i class="far fa-heart"></i> Bryllupsliste</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="new.php">nytt ønske <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="blank" target="_blank"><i class="far fa-heart"></i> Bryllupssiden</a>
      </li>
     
     <?php if(isset($_SESSION['email'])) { ?> 
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="far fa-user"></i> <?php echo $_SESSION['fname'] . " " .$_SESSION['lname']; ?> 
        </a>
        <div class="dropdown-menu " aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="profile.php?id=<?php echo $_SESSION['user_id']?>">Min side</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="log_out.php"><i class="fas fa-sign-out-alt"></i> Logg ut</a>
        </div>
      </li>
       <?php } ?> 


    </ul>
  </div>
</nav>
