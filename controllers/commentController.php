<?php
require_once 'db.php';
require_once '../controllers/postController.php';


function addComment($user_id, $post_id, $comment){
    $conn = connectDatabase();     // connect to database
    $errorMsg = "";
    //connect db
    $sql = "INSERT INTO comment (`created_by`, `post_id`, `content`) VALUES ( ?, ?, ?);";
    //prepare db
    $stmt = $conn->prepare($sql);
    //assign my data into 1 integer 1 strings
    $stmt->bind_param("iis", $user_id, $post_id, $comment);
    if($stmt->execute()) {
        echo '<script>alert("Comment Posted!")</script>';
    }
    else {
      $errorMsg = $conn->error;
    }
    echo "<div class='text-danger'>".$errorMsg."</div>";
    
    $stmt->close();
    $conn->close();
}

function removeComment($comment_id, $user_id, $post_id){
    $conn = connectDatabase();     // connect to database
    $errorMsg = "";
    //connect db
    $sql = "DELETE FROM comment WHERE comment_id = ? AND created_by = ? AND post_id = ?;";
    //prepare db
    $stmt = $conn->prepare($sql);
    //assign my data into 1 integer
    $stmt->bind_param("iii", $comment_id, $user_id, $post_id);
    if($stmt->execute()) {
        echo '<script>alert("Comment Deleted!")</script>';
    }
    else {
      $errorMsg = $conn->error;
    }
    echo "<div class='text-danger'>".$errorMsg."</div>";
    
    $stmt->close();
    $conn->close();
}


function showComment($post_id){
    $conn = connectDatabase();// connect to database
    $errorMsg = "";
    // $sql ="SELECT post_id, created_by, content, created_at FROM post ORDER BY created_at DESC;";
    $sql ="SELECT comment.comment_id, comment.created_by, comment.content, comment.created_at
            , user.name 
        FROM (comment
        INNER JOIN user ON comment.created_by = user.id)
        WHERE comment.post_id = ? 
        ORDER BY created_at DESC;";
    $stmt = $conn->prepare($sql);
    // $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $post_id);

        // if(mysqli_connect_errno()){
        //     echo "MySQL connection failed : ". mysqli_connect_error();
        // }
        // else{
        //     if(mysqli_num_rows($result) > 0){
        //         while($row = mysqli_fetch_array($result))
        //         {
        //             $comment_id = $row['comment_id'];
        //             $created_by = $row['created_by'];
        //             $user_name = $row['name'];
        //             $content = $row['content'];
        //             $created_at = $row['created_at'];
        //             echo " <div class=".'news_feed_title_content'.">
        //             <p>$user_name".'</p>'."
        //             <input disable type=".'hidden'." name=".'creator_id'." id=".'creator_id'." value=".$created_by." >
        //             <input disable type=".'hidden'." name=".'post_id'." id=".'post_id'." value=".$comment_id." >
        //             <span>".$created_at." . <i class=".'fas fa-globe-americas'."></i></span>
        //             <p class=".'news_feed_subtitle'.">
        //             ".$content."
        //             </p>
        //             </div>";
                    

        //             //echo post
        //             // echo "
        //             // <form method='post'>
        //             // <div class=".'news_feed'.">
        //             // <div class=".'news_feed_title'.">
        //             //   <div class=".'news_feed_title_content'.">
        //                 // <p>".$user_name."</p>
        //                 // <input type=".'hidden'." name=".'creator_id'." id=".'creator_id'." value=".$created_by." >
        //                 // <input type=".'hidden'." name=".'post_id'." id=".'post_id'." value=".$comment_id." >
        //                 // <span>".$created_at." . <i class=".'fas fa-globe-americas'."></i></span>
        //             //   </div>
        //             // </div>
        //             // <div class=".'news_feed_description'.">
        //             //   <p class=".'news_feed_subtitle'.">
        //             //   ".$content."
        //             //   </p>
        //             // </div><br />"
        //             // ;
        //             //if user loggedin and the post is created by him/her then show him/her delete button
        //             if(isset($_SESSION['user_id']) && isset($_SESSION['loggedin'])){
        //                 if($created_by == $_SESSION['user_id']){
        //                     echo "<input type=".'submit'." class=".'post_button'." name=".'delete_post'." id=".'delete_post'." value='Delete Post'>
        //                     </div></form>";
        //                 }else{
        //                     echo "</div></form>";
        //                 }
        //             }else{
        //                 echo "</div></form>";
        //             }
                   
        //         }
        //     }
            
        // }
}

?>