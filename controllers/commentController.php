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

            foreach($commentDetail as $c) {
                if($c["post_id"] == $post_id) {
                    echo "Comment Id: ".$c["comment_id"]."</br>";
                    echo "Comment Username: ".$c["name"]."</br>";
                    echo "Comment Content: ".$c["content"]."</br>";
                    echo "Comment Created_at: ".$c["created_at"]."</br>";
                }
            }
        }

        else {
            $msg = $comment["msg"];
        }
    }

?>