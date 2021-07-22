<!DOCTYPE html>
<html lang="en">
  <head>
<!-- navbar starts -->
<?php
    include './nav_bar.php'
?>
<!-- navbar ends -->

    <title>GP Talk || Social Media</title>
    <link rel="icon" href="./style/images/GPTalk.png">
    <link rel="stylesheet" href="./style/index.css" />
    <script type="text/javascript">
      function count()  //Word count function
      {
        var total=document.getElementById("content").value;
        total=total.replace(/\s/g, '');
        document.getElementById("total").innerHTML="Total Characters:"+total.length; //show how many charaacter that have entered by the user 
      }
    </script>
  </head>

  <body>
    <!-- content starts -->
    <form method="post">
        <?php
          if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { //once the user log in can access post button to post 
              $post_btn = 'POST';
              $readonly = '';
          }
          else { //once the user haven't log in will show sign in button and only can read the post and comment
              $post_btn = 'Sign-In to Post'; 
              $readonly = 'disabled';
          }
        ?>
        <div class="px-5 pt-3 input-group mb-3">
          <img class="input-group-text" src="./style/images/profile.png" alt="profile" /> <!-- show image profile on post text area  -->
          <!--  text area, user can enter anything unless not more than 255 character and will distribute to database (id information) -->
          <input class="form-control" maxlength="255" type="text" id="content"  onkeyup="count();" name="content" placeholder="What's on your mind?<?php if(isset($_SESSION['loggedin'])){echo ', '.$_SESSION['name'];}?>"  <?php echo $readonly;?> />
          <div class="post_divider"><hr /></div>
          <button type="submit" name="post_content" id="post_content" class="btn btn-lg btn-secondary"><?php echo $post_btn;?></button> <!-- Post button -->
          <div class="input-group mt-3 text-end">
            <p id="total">Total Characters:0</p><p>&nbsp;/ 255</p>  <!-- show how many charaacter that have entered by the user  -->
          </div>
        </div>
        <hr />
        </form>

        <?php // add post (acc information and the post content)
          if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            if(isset($_POST['post_content']) && isset($_POST['content'])){
                $content = $_POST['content'];
                $user_id = $_SESSION["user_id"];
                addPost($user_id, $content);
            }
          }
          else{
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
            removeComment($_POST["comment_id"], $_POST["comment_by"], $_POST["post_id"]);
          }

        ?>
  </body>
</html>
