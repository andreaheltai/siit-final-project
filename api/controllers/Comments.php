<?php

require "models/CommentsModel.php";
require "helpers/response.php";

class Comments {
    private $commentsModel;
    
    function __construct(){
        $this->commentsModel = new CommentsModel();
    }
    
    function getAll($id) {
        $comments = $this->commentsModel->selectAll($id);
        return success_response ($comments);
    }
    
    function addItem() {
        if (!isset($_POST['status'])) {
            $status = "published";
        } else {
            $status = $_POST['status'];
        }
        
        if (!isset($_POST['article_id']) 
         || !isset($_POST['title']) 
         || !isset($_POST['content'])
         || !isset($_POST['user_id'])) {
            return error_response ("Invalid Fields");
        } else {
            $currentTime = date("Y-m-d H:i:sa");
            $params = [$_POST['user_id'], $_POST['article_id'], $_POST['title'], $_POST['content'], $status, $currentTime];
            $newCommentId = $this->commentsModel->insertItem($params);
            if (is_numeric($newCommentId)) {
                return success_response ("Comment " . $newCommentId . " has been added.");
            } else {
                return error_response ("Comment could not be added.");
            }
        }
            
    }
    
}

?>