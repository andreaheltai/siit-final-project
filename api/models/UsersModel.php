<?php

require_once "DB.php";

class UsersModel extends DB {
    
    function insertItem($params) {
        $query = 'insert into users (user_name, password, first_name, email) values (? , ? , ?, ?); ';
        $sth = $this->db->prepare($query);
        $sth->execute($params); 
        return $this->db->lastInsertId();
    }
    
    function checkUsername($username) {
        $query = 'SELECT * FROM users WHERE user_name = ?';
        $sth = $this->db->prepare($query);
        $sth->execute([$username]); 
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
    
    function checkEmail($email) {
        $query = 'SELECT * FROM users WHERE email = ?';
        $sth = $this->db->prepare($query);
        $sth->execute([$email]); 
        return $sth->rowcount();
    }
}

?>