<?php

require_once "DB.php";

class ArticlesModel extends DB {
    
    function limitAll($searchTerm, $start, $itemsNumber) {
        $query = 'select 
                    articles.id as id, 
                    articles.title as title, 
                    articles.content as content, 
                    articles.creation_date as creation_date, 
                    users.user_name as user_name 
                from articles inner join users on articles.user_id=users.id 
                where published = 1 && (title like "%' . $searchTerm . '%" || content like "%' . $searchTerm . '%") 
                order by articles.creation_date DESC 
                limit ' . $start . ',' . $itemsNumber. ';'; 
        $sth = $this->db->prepare($query);
        $sth->execute(); 
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function selectAll($searchTerm) {
        $query = 'select * from articles where published = 1 && (title like "%' . $searchTerm . '%" || content like "%' . $searchTerm . '%");'; 
        $sth = $this->db->prepare($query);
        $sth->execute(); 
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function selectItem($id) {
       $query = 'select 
                    articles.id as id, 
                    articles.title as title, 
                    articles.content as content, 
                    articles.creation_date as creation_date, 
                    articles.published as published,
                    users.user_name as user_name  
                from articles inner join users on articles.user_id=users.id 
                where articles.id = '.$id.';';
        $sth = $this->db->prepare($query);
        $sth->execute(); 
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
    
    function insertItem($params) {
        $query = 'insert into articles(title, content, user_id, published, creation_date) values (? , ? , ?, ?, ?); ';
        $sth = $this->db->prepare($query);
        $sth->execute($params); 
        return $this->db->lastInsertId();
    }
    
    function updateItem($params) {
        $query = 'UPDATE articles SET title = ?, content = ?, published = ? where id = ?;';
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $sth->rowcount();
    }
    
    function deleteItem($id) {
        $query = 'UPDATE articles SET published = 0 WHERE id = ?';
        $sth = $this->db->prepare($query);
        $sth->execute($id);
        return $sth->rowcount();
    }
    
    function updateImage($params){
        $query = 'insert into images(article_id, image_url) values (? , ?);';
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $this->db->lastInsertId();
    }
}

?>