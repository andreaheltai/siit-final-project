<?php

require_once "DB.php";

class ContactsModel extends DB {
    
    function insertItem($params) {
        $query = 'insert into contacts (title, content, email) values (? , ? , ?); ';
        $sth = $this->db->prepare($query);
        $sth->execute($params); 
        return $this->db->lastInsertId();
    }
}

?>