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


    function getComment(){
        $conn = connectDatabase();// connect to database
        $errorMsg = "";
        $output = array();
        // $sql ="SELECT post_id, created_by, content, created_at FROM post ORDER BY created_at DESC;";
        $sql = "SELECT c.comment_id, c.post_id, c.created_by, c.content, c.created_at, u.name 
                FROM comment c
                INNER JOIN user u ON c.created_by = u.id
                ORDER BY created_at DESC;";
        
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

    function showComment($post_id) {
        $comment = getComment();

        if($comment["status"] == 1) {
            $commentDetail = $comment["response"];

            echo "<div class=".'comment-container'.">";
            foreach($commentDetail as $c) {
                if($c["post_id"] == $post_id) {
                    echo "
                        <form method='post'>
                            <div class=".'comment-card'.">
                                <div class=".'comment-card-body'.">
                                    <h5 class=".'card-title'.">".$c["name"]."</h5>
                                    <p class=".'card-text'."><small class=".'text-muted'.">".$c["created_at"]."</small></p>
                                    <p class=".'card-text'.">".$c["content"]."</p>
                                </div>
                            </div>
                    ";

                    //if user loggedin and the post is created by him/her then show him/her delete button
                    if(isset($_SESSION['user_id']) && isset($_SESSION['loggedin'])){
                        if($c["created_by"] == $_SESSION['user_id']){
                            echo "
                                <input type=".'hidden'." name=".'comment_by'." id=".'comment_by'." value=".$c["created_by"]." >
                                <input type=".'hidden'." name=".'comment_id'." id=".'comment_id'." value=".$c["comment_id"]." >
                                <button type=".'submit'." class=".'delete-comment-button'." name=".'delete_comment'." id=".'delete_comment'."> Delete Comment</button>
                            ";
                        }  
                    }

                    // if(isset($_POST["delete_comment"])) {
                    //     removeComment($_POST["comment_id"], $_POST["comment_by"], $_POST["post_id"]);
                    // }
                }
            }
            echo "</form></div>";
        }

        else {
            $msg = $comment["msg"];
        }
    }

?>