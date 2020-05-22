<meta charset="utf-8" />
<?php
    $connect = mysql_connect("localhost","root","apmsetup");
    $dbconn  = mysql_select_db("schoolsuggest", $connect);
    
    $suggestid = $_POST['suggestid'];
    $name      = $_POST['name'];
    $schoolid  = $_POST['schoolid'];
    $content   = $_POST['content'];

    $sql  = "insert into comment (suggestid, name, schoolid, content)";
    $sql .= "values ('$suggestid', '$name', '$schoolid', '$content')";

    $result = mysql_query($sql);
    
    if ($result) {
        //echo "<script>alert(\"성공적으로 작성되었습니다\");</script>";
        echo "<script>window.location.href=\"./\";</script>"; 
    }
    else {
        echo "<script>alert(\"문제가 발생하였습니다\");</script>";
        echo "<script>window.location.href=\"./\";</script>"; 
    }
    mysql_close();
?>