<?php

require "models/UsersModel.php";
require "helpers/response.php";
require "helpers/users.php";

class Users {
    private $UsersModel;
    
    function __construct(){
        $this->usersModel = new UsersModel();
    }
    
    function signup() {
        if (empty($_POST["username"])
         || empty($_POST["password"])
         || empty($_POST["repassword"])
         || empty($_POST["first_name"])
         || empty($_POST["email"])) {
            return error_response('Invalid fields.');
        } else if (!validEmail($_POST["email"])){
            return error_response('Email does not have a valid format.');
        } else if (!validPass($_POST["password"], $_POST["repassword"])) {
            return error_response('Passwords do not match.');
        } else if (!validPassFormat($_POST["password"])) {
            return error_response('Password should be at least 6 characters with at least 1 letter and 1 number.');
        } else if ($this->usersModel->checkEmail($_POST["email"]) !== 0) {
            return error_response ('Email is already used by another account');   
        } else if ($this->usersModel->checkUsername($_POST["username"]) !== false) {
            return error_response('Username is already used by another account.');
        } else {
            $encPass = passEnc($_POST['password']);
            $params = [$_POST["username"], $encPass, $_POST["first_name"], $_POST["email"]];
            $this->usersModel->insertItem($params);
            return success_response ('Account successfully created.');
        }
    } 
    
    function login() {
        if (empty($_POST['user']) || empty($_POST['password'])) {
            return error_response('Invalid fields');
        } else {
            $pass = $_POST['password'];
            $user = $_POST['user'];
            $result = $this->usersModel->checkUsername($user);
            if (empty($result)) {
                return error_response("User not found.");
            } else {
                $found = checkMailWithPass($result, $pass);
                if ($found === false) {
                    return error_response("User and password do not match.");
                } else {
                    $_SESSION["isLogged"] = TRUE;
                    $_SESSION["email"] = $result['email'];
                    $_SESSION["role"] = $result['role'];
                    $_SESSION["user_id"] = $result['id'];
                    //return $_SESSION;
                    return success_response("Login successful.");
                }
            }
        }
    }
    
}

?>