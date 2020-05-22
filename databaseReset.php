<meta charset="utf-8" />
<?php
    $connect = mysql_connect("localhost","root","apmsetup");
    $dbconn  = mysql_select_db("schoolsuggest", $connect);

    $sql = "truncate suggest;";
    $result = mysql_query($sql, $connect);
    echo "truncate suggest : ";
    if ($result)
        echo "true<br>";
    else {
        echo "false<br>";
    }

    $sql = "truncate vote_info;";
    $result = mysql_query($sql, $connect);
    echo "truncate vote_info : ";
    if ($result)
        echo "true<br>";
    else {
        echo "false<br>";
    }

    $sql = "truncate comment;";
    $result = mysql_query($sql, $connect);
    echo "truncate comment : ";
    if ($result)
        echo "true";
    else {
        echo "false";
    }

    mysql_close();
?>