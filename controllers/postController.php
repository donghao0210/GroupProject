<?php
    require_once 'db.php';

    function addPost($user_id, $content){
        $conn = connectDatabase();     // connect to database
        $errorMsg = "";
        //connect db
        $sql = "INSERT INTO post (`created_by`, `content`) VALUES (?, ?);";
        //prepare db
        $stmt = $conn->prepare($sql);
        //assign my data into 1 integer 1 strings
        $stmt->bind_param("iss", $user_id, $content);
        if($stmt->execute()) {
            echo '<script>alert("Posted!")</script>';
        }
        else {
        $errorMsg = $conn->error;
        }
        echo "<div class='text-danger'>".$errorMsg."</div>";
        
        $stmt->close();
        $conn->close();
    }

    function removePost($post_id, $user_id){
        $conn = connectDatabase();     // connect to database
        $errorMsg = "";
        //connect db
        $sql = "DELETE FROM post WHERE post_id = ? AND created_by = ?;";
        //prepare db
        $stmt = $conn->prepare($sql);
        //assign my data into 1 integer
        $stmt->bind_param("ii", $post_id, $user_id);
        if($stmt->execute()) {
            echo '<script>alert("Post Deleted!")</script>';
        }
        else {
        $errorMsg = $conn->error;
        }
        echo "<div class='text-danger'>".$errorMsg."</div>";
        
        $stmt->close();
        $conn->close();
    }

    function showPost() {
        $errorMsg = "";
        $conn = connectDatabase();// connect to database
        $sql ="SELECT post_id, created_by, content, created_at FROM post ORDER BY created_at DESC;";
        $sql ="SELECT post.post_id, post.created_by, post.content, post.created_at 
            , user.name
            FROM (post
            INNER JOIN user ON post.created_by = user.id)
            ORDER BY created_at DESC;";
        //execute the query
        $result = mysqli_query($conn, $sql);

        if(mysqli_connect_errno()) {
            echo "MySQL connection failed : ". mysqli_connect_error();
        }
        else {
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)) {
                    $post_id = $row['post_id'];
                    $created_by = $row['created_by'];
                    $user_name = $row['name'];
                    $content = $row['content'];
                    $created_at = $row['created_at'];
                    //echo post
                    echo "
                    <form method='post'>
                    <div class=".'news_feed'.">
                    <div class=".'news_feed_title'.">
                    <div class=".'news_feed_title_content'.">
                        <p>".$user_name."</p>
                        <input type=".'hidden'." name=".'creator_id'." id=".'creator_id'." value=".$created_by." >
                        <input type=".'hidden'." name=".'post_id'." id=".'post_id'." value=".$post_id." >
                        <span>".$created_at." . <i class=".'fas fa-globe-americas'."></i></span>
                    </div>
                    </div>
                    <div class=".'news_feed_description'.">
                    <p class=".'news_feed_subtitle'.">
                    ".$content."
                    </p>
                    </div><br />"
                    ;
                    //if user loggedin and the post is created by him/her then show him/her delete button
                    if(isset($_SESSION['user_id']) && isset($_SESSION['loggedin'])) {
                        if($created_by == $_SESSION['user_id']) {
                            echo "<input type=".'submit'." class=".'post_button'." name=".'delete_post'." id=".'delete_post'." value='Delete Post'>
                            </div></form>";
                        }
                        else {
                            echo "</div></form>";
                        }
                    }
                    else {
                        echo "</div></form>";
                    }
                
                }
            }
            
        }
    }

?>