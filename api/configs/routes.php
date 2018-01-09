<?php

//ARTICLES
$routes["articles"] = ["class" => "Articles", "method" => "getAll"];
$routes["articles/pages"] = ["class" => "Articles", "method" => "countAll"];
$routes["article/details/:d"] = ["class" => "Articles", "method" => "getItem"];
$routes["article/add"] = ["class" => "Articles", "method" => "addItem"];
$routes["article/edit"] = ["class" => "Articles", "method" => "editItem"];
$routes["article/delete"] = ["class" => "Articles", "method" => "deleteItem"];

//COMMENTS
$routes["comments/list/:d"] = ["class" => "Comments", "method" => "getAll"];
$routes["comment/add"] = ["class" => "Comments", "method" => "addItem"];

//CONTACTS
$routes["contact"] = ["class" => "Contacts", "method" => "addItem"];

//USERS
$routes["signup"] = ["class" => "Users", "method" => "signup"];
$routes["login"] = ["class" => "Users", "method" => "login"];

?>