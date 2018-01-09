<?php

require_once "DB.php";

class CommentsModel extends DB {
    
    function selectAll($id) {
        $query = 'select 
                    comments.id as id, 
                    comments.article_id as article_id, 
                    comments.title as title, 
                    comments.content as content, 
                    comments.creation_date as creation_date, 
                    users.user_name as user_name  
                from comments inner join users on comments.user_id=users.id
                where article_id = '.$id.' && status="published" 
                order by creation_date DESC;'; 
        $sth = $this->db->prepare($query);
        $sth->execute(); 
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function insertItem($params) {
        $query = 'insert into comments (user_id, article_id, title, content, status, creation_date) values (? , ? , ?, ?, ?, ?); ';
        $sth = $this->db->prepare($query);
        $sth->execute($params); 
        return $this->db->lastInsertId();
    }
}

?>