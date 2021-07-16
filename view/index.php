<!DOCTYPE html>
<?php
    include './nav_bar.php'
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
    <link rel="icon" href="./style/images/GPTalk.png">
    <link rel="stylesheet" href="./style/style.css" />
    <script>
    </script>
  </head>

  <body>

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
            <div class="post_divider"><hr /></div>

              <input type="submit" name="post_content" id="post_content" class="post_button" value="<?php echo $post_btn;?>"/>
           
            </div>
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
  </body>
</html>
