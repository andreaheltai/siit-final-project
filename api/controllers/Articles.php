<?php

require "models/ArticlesModel.php";
require "helpers/response.php";

class Articles {
    private $articlesModel;
    
    function __construct(){
        $this->articlesModel = new ArticlesModel();
    }
    
    function getAll() {
        $search = (!empty($_GET["search"])) ? $_GET["search"] : '';
        $page = (!empty($_GET["page"])) ? $_GET["page"] : 1;
        $itemsOnPage = (!empty($_GET["items"])) ? $_GET["items"] : 5;
        $start = $itemsOnPage * ($page -1);
        $response = $this->articlesModel->limitAll($search, $start, $itemsOnPage);
        return success_response($response);
    }
    
    function countAll() {
        $search = (!empty($_GET["search"])) ? $_GET["search"] : '';
        $itemsOnPage = (!empty($_GET["items"])) ? $_GET["items"] : 5;
        $articles = $this->articlesModel->selectAll($search);
        $totalArticles = count($articles);
        $nrPages = ceil($totalArticles / $itemsOnPage);
        return success_response($nrPages);
    }
    
    function getItem($id) {
        if (!isset($id)) {
            return error_response("Empty article id");
        } else {
            $article = $this->articlesModel->selectItem($id);
            return success_response($article);
        }
    }
    
    function addItem() {
        $file = $_FILES["image"];
        if (!isset($_POST['title']) 
         || !isset($_POST['content']) 
         || !isset($_POST['user_id'])) {
            return error_response ("Invalid Fields");
        } else {
            $published = $_POST['published'];
            if (!isset($published)) {$published = 1;}
            $currentTime = date("Y-m-d H:i:sa");
            $params = [$_POST['title'], $_POST['content'], $_POST['user_id'], $published, $currentTime];
            $newArticleId = $this->articlesModel->insertItem($params);
            if (empty($file)) {
                return success_response ("Article " . $newArticleId . " was added successfully without an image.");
            } else {
                $addedPhoto = $this -> addPhoto($file, $newArticleId);
                if (($addedPhoto['ok']) && (is_numeric($addedPhoto['data']))) {
                    return success_response ("Article " . $newArticleId . " with image was added successfully.");
                } else {
                    return error_response ("Article " . $newArticleId . " was added successfully. Photo could not be added.");
                }
            }
            
        }
    }
    
    function editItem(){
        $articleId = $_POST['id'];
        $file = $_FILES["image"];
        if (!isset($_POST['title']) 
         || !isset($_POST['content']) 
         || !isset($_POST['id']) 
         || !isset($_POST['published'])) {
            return error_response ("Invalid Fields");
        } else {
            $params = [$_POST['title'], $_POST['content'], $_POST['published'], $_POST['id']];
            $articlesUpdated = $this->articlesModel->updateItem($params);
            if (empty($file)) {
                return success_response ($articlesUpdated);
            } else {
                $addedPhoto = $this->addPhoto($file, $articleId);
                if (($addedPhoto['ok']) && (is_numeric($addedPhoto['data']))) {
                    $articlesUpdated = 1;
                    return success_response ($articlesUpdated . " articles updated.");
                } else {
                    return error_response ($articlesUpdated . " articles updated. Photo could not be added.");
                }
            }
        }
    }
    
    function deleteItem(){
        $articleId = [$_POST['id']]; 
        if (empty($articleId)) {
             return error_response ("Empty article id");
         } else {
             $deleted = $this->articlesModel->deleteItem($articleId);
             return success_response ($deleted . ' articles deleted.');
        }
    }
    
    function addPhoto($photo, $articleId){
        require "helpers/images.php";
        $tmp_name = $photo["tmp_name"];
        if (!empty($tmp_name)) {
            if (isImage($tmp_name)) {
                $renamedImage = renameImage($photo, $articleId);
                $upload_path = moveFile($renamedImage, $tmp_name);
                if (!empty($upload_path)) {
                    $image_params = [$articleId, $upload_path];
                    $updatedImg = $this->articlesModel->updateImage($image_params);
                    return success_response ($updatedImg);
                } else {
                    return error_response ("Image upload unsuccessful");
                }
            } else {
                return error_response ("Only JPG, JPEG, PNG & GIF files are allowed."); 
            }
        } 
    }
    
}

?>