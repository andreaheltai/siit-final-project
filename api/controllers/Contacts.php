<?php

require "models/ContactsModel.php";
require "helpers/response.php";

class Contacts {
    private $contactsModel;
    
    function __construct(){
        $this->contactsModel = new ContactsModel();
    }
    
    function addItem() {
        if (!isset($_POST['title']) 
         || !isset($_POST['content']) 
         || !isset($_POST['email'])) {
            return error_response ("Invalid Fields");
        } else {
            $params = [$_POST['title'], $_POST['content'], $_POST['email']];
            $newContactId = $this->contactsModel->insertItem($params);
            if (is_numeric($newContactId)) {
                return success_response ("Contact has been sent. Contact's registration number: " . $newContactId);
            } else {
                return error_response ("Contact could not be sent. Please try again.");
            }
        }
            
    }
    
}

?>