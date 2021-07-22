<?php
    require_once 'db.php';
    require_once '../controllers/commentController.php';

//add post function
    function addPost($user_id, $content){
        $conn = connectDatabase();     // connect to database
        $errorMsg = "";
        //connect db

        $sql = "INSERT INTO post (`created_by`, `content`) VALUES (?, ?);";

        //prepare db
        $stmt = $conn->prepare($sql);
        //assign my data into 1 integer 1 strings
        $stmt->bind_param("is", $user_id, $content);
        if($stmt->execute()) {
            if(strlen($content) > 255){
                echo '<script>alert("Posted! Content exceeded 255 characters. Only first 255 characters will be recorded")</script>';
            }

            else {
                echo '<script>alert("Posted!")</script>';
            }
        }
        else {
        $errorMsg = $conn->error;
        }
        echo "<div class='text-danger'>".$errorMsg."</div>";
        
        $stmt->close();
        $conn->close();
    }
    //removePost function
    function removePost($post_id, $user_id){
        // removeAllComment($post_id);
        $conn = connectDatabase();     // connect to database
        $errorMsg = "";
        //connect db
        $sql = "DELETE FROM post WHERE post_id =? AND created_by = ?";

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
    //getPost function
    function getPost() {
        $errorMsg = "";
        $output = array();
        $conn = connectDatabase();// connect to database

        $sql ="SELECT post.post_id, post.created_by, post.content, post.created_at 
            , user.name
            FROM (post
            INNER JOIN user ON post.created_by = user.id)
            ORDER BY created_at DESC;";
        //execute the query
        $result = mysqli_query($conn, $sql);

        if($result = $conn->query($sql)) {
            while($row = $result->fetch_assoc()) {  // while loop fetching the output from the database and assign the output into $row
                array_push($output, $row);            // add the $row into $output array
            }
        }
        else {    // if failed to call the sql command
            $conn->close();   // close the database connection
            return array("status"=>0, "msg"=>"Error: ".$sql."<br />".$conn->error);   // return status as 0 and errormessage
        }

        $conn->close();
        return array("status"=>1, "response"=>$output);
    }
    //showPost function
    function showPost(){
        $errorMsg = "";
        $post = getPost();

        if($post["status"] == 1) {
            $postDetail = $post["response"];
            //loop the bd respone and submit then show to user
            foreach($postDetail as $p) {
                $post_id = $p['post_id'];
                $created_by = $p['created_by'];
                $user_name = $p['name'];
                $content = $p['content'];
                $created_at = $p['created_at'];

                echo "
                <form method='post' class=".' px-5 pt-3'.">
                <div class=".'card mb-3'.">
                <div class=".'card-body'.">
                    <h5 class=".'card-title'.">".$user_name."</h5>
                    <p class=".'card-text'."><small class=".'text-muted'.">".$created_at."</small></p>
                    <p class=".'card-text'.">".$content."</p>
                    <input type=".'hidden'." name=".'creator_id'." id=".'creator_id'." value=".$created_by." >
                    <input type=".'hidden'." name=".'post_id'." id=".'post_id'." value=".$post_id." >
                </div>
                ";

                //if user loggedin and the post is created by him/her then show him/her delete button
                if(isset($_SESSION['user_id']) && isset($_SESSION['loggedin'])){
                    if($created_by == $_SESSION['user_id']){
                        echo "
                            <div class=".'all-padding'.">
                                <button type=".'submit'." class=".'delete-post-button'." name=".'delete_post'." id=".'delete_post'."> Delete Post</button>
                            </div>
                        ";
                    }  
                }
                
                echo "
                    <div class=".'all-padding'.">
                        <p class=".'card-text'.">Comment</p>
                    </div>
                ";
                //show the comment under the post
                showComment($post_id);
                //if user is loggedin show comment button
                if(isset($_SESSION['user_id']) && isset($_SESSION['loggedin'])){
                    echo " 
                        <div class=".'all-padding'.">
                            <div class=".'input-group'.">
                                <input type=".'text'." maxlength=".'150'." class=".'form-control'." name=".'comment_cont'." id=".'comment_cont'." placeholder=".'Comment'." />    
                                <input type=".'submit'." class=".'comment-button'." name=".'comment'." id=".'comment'." value='Comment'>
                            </div>
                        </div>
                    ";

                    //call add comment function
                    if(isset($_POST['comment']) && isset($_POST['comment_cont'])){
                        $user_id = $_SESSION["user_id"];
                        $post_id = $_POST['post_id'];
                        $comment = $_POST['comment_cont'];
                        //submit the variable into the addComment function
                        addComment($user_id, $post_id, $comment);
                        //unset the 
                        unset($_POST['comment']);
                        echo '<script language="javascript">window.location.href ="'.'../view/index.php'.'"</script>';
                    }
                }
                
                //close the form and div
                echo "</form></div><br />";
                                    
            }
        }

        else {
            $msg = $post["msg"];
        }
    }

?>