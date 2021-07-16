<!doctype html>
<html lang="en">
  <head>
  <?php
    session_start();        // starting session
    require_once '../controllers/postController.php';
    require_once '../controllers/commentController.php';
    require_once '../controllers/userController.php';

?>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="./style/images/GPTalk.png">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    
    <link rel="stylesheet" href="./style/nav_bar.css" />

  </head>
    
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <img class="navbar_logo" src="./style/images/GPTalk.png" alt="logo"  />
    <a class="navbar-brand" href="#">GPTalk</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <button class=".' btn btn-outline-secondary'." onclick="window.location.href='./index.php'" type=".'button'.">Home</button>
            </li>
            <form method="POST">
        <?php
            //if user is login show login button
            if(!isset($_SESSION['loggedin'])){
                echo "<li class=".'nav-item'.">
                        <button class=".' btn btn-outline-secondary'." name=".'sign_in'." type=".'submit'.">Sign-in</button>
                    </li> ";
            //if user is login show logout button
            }else if(isset($_SESSION['loggedin'])){
              if($_SESSION['loggedin']==true){
                echo "<li class=".'nav-item'.">
                        <button class=".' btn btn-outline-secondary'." name=".'sign_out'." type=".'submit'.">Log-Out</button>
                    </li> ";
              }
            }
          ?>
      </ul>
    </div>
</form>
        <?php 
        //if user is login show his name
        if(isset($_SESSION['loggedin'])){
            echo"
            <img src=".'./style/images/profile.png'." alt=".'profile'." />
            <span>".$_SESSION['name']."</span>";
            }

        //check user click log-in or output
        if(isset($_POST['sign_out'])){
            userLogout();
        }else if(isset($_POST['sign_in'])){
            echo '<script language="javascript">window.location.href ="'.'./login.php'.'"</script>';
        }
        ?>
</div>
</nav>
</html>