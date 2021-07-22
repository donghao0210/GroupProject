<?php
    require_once 'db.php';                                  // importing dp.php into the page
    require_once '../controllers/postController.php';       // importing postController.php into the page


    function addComment($user_id, $post_id, $comment){      // add comment function
        $conn = connectDatabase();     // connect to database
        $errorMsg = "";                // initial $errorMessage

        $sql = "INSERT INTO comment (`created_by`, `post_id`, `content`) VALUES (?, ?, ?);";     // sql command for inserting into `comment` table

        $stmt = $conn->prepare($sql);         // prepare sql query statement
        $stmt->bind_param("iis", $user_id, $post_id, $comment);    // bind the user input into the sql command and assign into $stmt
        if($stmt->execute()) {    // if $smt is successfully executed
            if(strlen($comment) > 150){
                echo '<script>alert("Posted! Content exceeded 150 characters. Only first 150 characters will be recorded")</script>';
            }

            else {
                echo '<script>alert("Posted!")</script>';
            }
        }
        else {    // if $smt is not executed
            $errorMsg = $conn->error;
        }
        echo "<div class='text-danger'>".$errorMsg."</div>";
        
        $stmt->close();   // close statement
        $conn->close();   // close database connection
    }

    function removeComment($comment_id, $user_id, $post_id){        // remove comment function
        $conn = connectDatabase();     // connect to database
        $errorMsg = "";

        $sql = "DELETE FROM comment WHERE comment_id = ? AND created_by = ? AND post_id = ?;";         // sql command to delete from comment table in database

        $stmt = $conn->prepare($sql);         // prepare sql query statement
        $stmt->bind_param("iii", $comment_id, $user_id, $post_id);    // bind the data into the sql command and assign into $stmt
        if($stmt->execute()) {    // if $smt is successfully executed
            echo '<script>alert("Comment Deleted!")</script>';
            echo '<script language="javascript">window.location.href ="'.'../view/index.php'.'"</script>';
        }
        else {    // if $smt is not executed
            $errorMsg = $conn->error;
        }
        echo "<div class='text-danger'>".$errorMsg."</div>";
        
        $stmt->close();   // close statement
        $conn->close();   // close database connection
    }

    function removeAllComment($post_id){        // remove all comment function
        $conn = connectDatabase();     // connect to database
        $errorMsg = "";

        $sql = "DELETE FROM comment WHERE post_id = ?;";         // sql command to delete from comment table in database
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("i", $post_id);
        if($stmt->execute()) {
            // echo '<script>alert("All Comment Deleted!")</script>';
        }
        else {
            $errorMsg = $conn->error;
        }
        echo "<div class='text-danger'>".$errorMsg."</div>";
        
        $stmt->close();   // close statement
        $conn->close();   // close database connection
    }


    function getComment(){      // get comment function
        $conn = connectDatabase();// connect to database
        $errorMsg = "";
        $output = array();

        $sql = "SELECT c.comment_id, c.post_id, c.created_by, c.content, c.created_at, u.name 
                FROM comment c
                INNER JOIN user u ON c.created_by = u.id
                ORDER BY created_at DESC;";         // sql command for selecting comment information 
        
        if($result = $conn->query($sql)) {
            while($row = $result->fetch_assoc()) {  // while loop fetching the output from the database and assign the output into $row
                array_push($output, $row);          // add the $row into $output array
            }
        }
        else {    // if failed to call the sql command
            $conn->close();   // close the database connection
            return array("status"=>0, "msg"=>"Error: ".$sql."<br />".$conn->error);   // return status as 0 and errormessage
        }

        $conn->close();   // close database connection
        return array("status"=>1, "response"=>$output);   // return the status as 1 and response as $output
    }

    function showComment($post_id) {      // show comment function
        $comment = getComment();          // calling function get comments and assigned the return value into $comment

        if($comment["status"] == 1) {     // if status == 1
            $commentDetail = $comment["response"];      // assign the response into $commentDetail

            echo "<div class=".'comment-container'.">";
            foreach($commentDetail as $c) {             // foreach loop to print comments
                if($c["post_id"] == $post_id) {         // if comment's post_id is same as the $post_id
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
                                <input type=".'hidden'." name=".'post_id'." id=".'post_id'." value=".$c["post_id"]." >
                                <button type=".'submit'." class=".'delete-comment-button'." name=".'delete_comment'." id=".'delete_comment'."> Delete Comment</button>
                                ";
                        }  
                    }
                }
                echo "</form>";
            }
            echo "</div>";
        }

        else {
            $msg = $comment["msg"];
        }
    }

?>