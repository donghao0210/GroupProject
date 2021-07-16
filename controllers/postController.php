<?php
    require_once 'db.php';
    require_once '../controllers/commentController.php';

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

        $sql = "DELETE p.*, c.* FROM post p
        INNER JOIN `comment` c
        WHERE p.post_id AND c.post_id = ? 
        AND p.created_by = ?;";

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

    function showPost(){
        $errorMsg = "";
        $post = getPost();

        if($post["status"] == 1) {
            $postDetail = $post["response"];
            // print_r($postDetail);

            foreach($postDetail as $p) {
                $post_id = $p['post_id'];
                $created_by = $p['created_by'];
                $user_name = $p['name'];
                $content = $p['content'];
                $created_at = $p['created_at'];
                //echo post
                echo "
                <form method='post' class=".' px-5 pt-3'.">
                <div class=".'card mb-3'.">
                <div class=".'card-body'.">
                    <h5 class=".'card-title'.">".$user_name."</h5>
                    <p class=".'card-text'.">".$content."</p>
                    <p class=".'card-text'."><small class=".'text-muted'.">".$created_at."</small></p>
                    <input type=".'hidden'." name=".'creator_id'." id=".'creator_id'." value=".$created_by." >
                    <input type=".'hidden'." name=".'post_id'." id=".'post_id'." value=".$post_id." >
                
                
                <br />";

                showComment($post_id);
                
                //if user loggedin and the post is created by him/her then show him/her delete button
                if(isset($_SESSION['user_id']) && isset($_SESSION['loggedin'])){
                    if($created_by == $_SESSION['user_id']){
                        // $deleteBtn = "<button type=".'submit'." class=".'btn'." name=".'delete_post'." id=".'delete_post'."> Delete Post</button>
                        // </div>";
                        $delBtnClass = "btn bg-warning text-dark";
                        echo "<button type=".'submit'." class=".'btn bg-warning text-dark'." name=".'delete_post'." id=".'delete_post'."> Delete Post</button>
                        </div></div>";
                    }
                    echo " <input type=".'text'." name=".'comment_cont'." id=".'comment_cont'." placeholder=".'Comment'." />    
                    <input type=".'submit'." class=".'post_button'." name=".'comment'." id=".'comment'." value='Comment'>
                    </form>";
                    //call add comment function
                    if(isset($_POST['comment']) && isset($_POST['comment_cont'])){
                        $user_id = $_SESSION["user_id"];
                        $post_id = $_POST['post_id'];
                        $comment = $_POST['comment_cont'];
                        addComment($user_id, $post_id, $comment);
                        unset($_POST['comment']);
                    }
                    
                }else{
                    echo "</form>";
                }
                                    
            }
        }

        else {
            $msg = $post["msg"];
        }
    }

?>