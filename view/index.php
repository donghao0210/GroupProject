<!DOCTYPE html>
<html lang="en">
  <head>
<?php
    include './nav_bar.php'
?>

    <title>GP Talk || Social Media</title>
    <link rel="icon" href="./style/images/GPTalk.png">
    <link rel="stylesheet" href="./style/index.css" />
    <script type="text/javascript">
      function count()
      {
        var total=document.getElementById("content").value;
        total=total.replace(/\s/g, '');
        document.getElementById("total").innerHTML="Total Characters:"+total.length;
      }
    </script>
  </head>

  <body>

    <!-- navbar ends -->
    <!-- content starts -->
    <form method="post">
        <?php
          if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
              $post_btn = 'POST';
              $readonly = '';
          }
          else {
              $post_btn = 'Sign-In to Post';
              $readonly = 'disabled';
          }
        ?>
        <div class="px-5 pt-3 input-group mb-3">
          <img class="input-group-text" src="./style/images/profile.png" alt="profile" />
          <input class="form-control" type="text" id="content"  onkeyup="count();" name="content" placeholder="What's on your mind?<?php if(isset($_SESSION['loggedin'])){echo ', '.$_SESSION['name'];}?>"  <?php echo $readonly;?> />
          <div class="post_divider"><hr /></div>
          <button type="submit" name="post_content" id="post_content" class="btn btn-lg btn-secondary"><?php echo $post_btn;?></button>
          <div class="input-group mt-3 text-end">
            <p id="total">Total Characters:0</p><p>&nbsp;/ 225</p>
          </div>
        </div>
        <hr />
        </form>

        <?php
          if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            if(isset($_POST['post_content']) && isset($_POST['content'])){
                $content = $_POST['content'];
                $user_id = $_SESSION["user_id"];
                addPost($user_id, $content);
            }
          }
          else if(!isset($_SESSION['loggedin'])){
            if(isset($_POST['post_content'])){
              echo '<script language="javascript">window.location.href ="'.'../view/login.php'.'"</script>';
            }
          }

          //delete post
          if(isset($_POST['delete_post'])){
            $post_id = $_POST['post_id'];
            $creator_id = $_POST['creator_id'];
            removeAllComment($post_id);
            removePost($post_id, $creator_id);
          }

          //showPost
          showPost();


          //delete comment
          if(isset($_POST["delete_comment"])) {
              //  echo '<script>alert("'.$_POST["delete_comment"].'."is deleted")</script>';
            removeComment($_POST["comment_id"], $_POST["comment_by"], $_POST["post_id"]);
          }

        ?>
  </body>
</html>
