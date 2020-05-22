<meta charset="utf-8" />
<?php
    $connect = mysql_connect("localhost","root","apmsetup");
    $dbconn  = mysql_select_db("schoolsuggest", $connect);

    $sql  = "create table suggest ( "          ;
    $sql .= "num int not null auto_increment, ";
    $sql .= "title tinytext, "                 ;
    $sql .= "content text, "                   ;
    $sql .= "name tinytext, "                  ;
    $sql .= "schoolid tinyint, "               ;
    $sql .= "date datetime, "                  ;
    $sql .= "primary key(num))"                ;
    $result = mysql_query($sql, $connect);
    echo "suggest : ";
    if ($result)
        echo "true<br>";
    else
        echo "false<br>";

    $sql  = "create table vote_info ( "        ;
    $sql .= "num int not null auto_increment, ";
    $sql .= "suggestid tinyint, ";
    $sql .= "schoolid tinyint, ";
    $sql .= "agreement tinyint, ";
    $sql .= "date datetime, ";
    $sql .= "primary key(num))"                ;
    $result = mysql_query($sql, $connect);
    echo "vote_info : ";
    if ($result)
        echo "true<br>";
    else
        echo "false<br>";

    $sql  = "create table comment ( "          ;
    $sql .= "num int not null auto_increment, ";
    $sql .= "suggestid int, "                  ;
    $sql .= "name tinytext, "                  ;
    $sql .= "schoolid tinyint, "               ;
    $sql .= "content text, "                   ;
    $sql .= "primary key(num))"                ;
    $result = mysql_query($sql, $connect);
    echo "comment : ";
    if ($result)
        echo "true";
    else
        echo "false";
    mysql_close();
?>