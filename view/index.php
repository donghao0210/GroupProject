<!DOCTYPE html>
<?php
    session_start();        // starting session
    require_once '../controllers/postController.php';
    require_once '../controllers/commentController.php';
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GP Talk || Social Media</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
      integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
      crossorigin="anonymous"
    />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <link rel="icon" href="./style/images/GPTalk.png">
    <link rel="stylesheet" href="./style/style.css" />
    <script>
    </script>
  </head>

  <body>
    <!-- navbar start -->
    <div class="navbar">
      <div class="navbar_left">
        <img class="navbar_logo" src="./style/images/GPTalk.png" alt="logo" />
      </div>

      <div class="navbar_center">
        <a class="active_icon" href="index.php">
          <span> Home <i class="fas fa-home"></i> </span>
        </a>
          <?php
            //if user is login show login button
            if(!isset($_SESSION['loggedin'])){
                echo 
                "<a href=".'login.php'.">
                  <span> Sign In <i class=".'fas fa-sign-in-alt'."></i></span>
                </a>";
            //if user is login show logout button
            }else if(isset($_SESSION['loggedin'])){
              if($_SESSION['loggedin']==true){
                echo 
                "<a href=".'logout.php'.">
                  <span> Sign Out <i class=".'fas fa-sign-out-alt'."></i></span>
                </a>";
              }
            }
          ?>
      </div>

      <div class="navbar_right">
        <div class="navbar_right_profile">
          <?php 
            //if user is login show his name
            if(isset($_SESSION['loggedin'])){
              echo"
              <img src=".'./style/images/profile.png'." alt=".'profile'." />
              <span>".$_SESSION['name']."</span>";
              }
          ?>
        </div>
      </div>
    </div>
    <!-- navbar ends -->
    <!-- content starts -->
    <form method="post">
      <div class="media_container">
        <div class="share">
          <div class="share_upSide">
            <img src="./style/images/profile.png" alt="profile" />
              <?php
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                  $post_btn = 'POST';
                  $readonly = '';
                }else{
                  $post_btn = 'Sign-In to Post';
                  $readonly = 'disabled';
                }
              ?>
            <input type="text" name="content" placeholder="What's on your mind?<?php if(isset($_SESSION['loggedin'])){echo ', '.$_SESSION['name'];}?>"  <?php echo $readonly;?> />
          </div>
          <hr />
          <div class="post_divider"><hr />
            <button type="submit" name="post_content" id="post_content" class="post_button" value="<?php echo $post_btn;?>"><?php echo $post_btn;?></button>
          </div>

      </div>
    </form>
          </form>
            <?php
              if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                if(isset($_POST['post_content']) && isset($_POST['content'])){
                    $content = $_POST['content'];
                    $user_id = $_SESSION["user_id"];
                    addPost($user_id, $content);
                }
              }else if(!isset($_SESSION['loggedin'])){
                if(isset($_POST['post_content'])){
                  echo '<script language="javascript">window.location.href ="'.'../view/login.php'.'"</script>';
                }
              }

              //Delete Comment
              // if(isset($_POST['delete_comment'])){
              //   $post_id = $_POST['post_id'];
              //   $creator_id = $_POST['creator_id'];
              //   removePost($post_id, $creator_id);
              // }

              //delete post
              if(isset($_POST['delete_post'])){
                $post_id = $_POST['post_id'];
                $creator_id = $_POST['creator_id'];
                removePost($post_id, $creator_id);
              }

              //showPost
              showPost();

              //show comment
              $comment = getComment();
              // print_r($comment);
              // showComment($post_id);
            ?>
        </div>
      </div>
    </div>
  <footer>
    <div class="container">
        <hr>
        <p class="end">Copyright © 2021 by GP Talk. All rights reserved.</p>
    </div>
  </footer>
  </body>
</html>
