<meta charset="utf-8" />
<?php
    $connect = mysql_connect("localhost","root","apmsetup");
    $dbconn  = mysql_select_db("schoolsuggest", $connect);

    $suggestid = $_GET['suggestid'];
    $schoolid  = $_GET['schoolid'];
    $option    = $_GET['option'];
    $date      = date("Y-m-d H:i:s");

    if ($name == "익명") {
        echo "<script>alert(\"익명으로는 투표를 할 수 없습니다\");</script>";
        echo "<script>window.location.href=\"./\";</script>";
        exit();
    }

    $sql = "select EXISTS (select * from vote_info where suggestid=$suggestid AND schoolid=$schoolid) as exist;";

    $result = mysql_query($sql);
    /*  +-------+
        | exist |
        +-------+
        |  1 , 0|
        +-------+  */
    $value  = mysql_result($result, 0, 0); // $sql 입력 이후 출력값 1열 1행의 값

    if ($value != 0) {
        echo "<script>alert(\"이미 이 건의에 투표를 하셨습니다.\");</script>";
        echo "<script>window.location.href=\"./\";</script>";
        exit();
    }

    $sql = "insert into vote_info (suggestid, schoolid, agreement, date)";
    
    if ($option == 1) {
        $sql .= "values ('$suggestid', '$schoolid', '1', '$date')";
    }
    elseif ($option == 0) {
        $sql .= "values ('$suggestid', '$schoolid', '0', '$date')";
    }
    else {
        echo "<script>alert(\"값이 올바르지 않습니다\");</script>";
        echo "<script>window.location.href=\"./\";</script>";
    }

    $result = mysql_query($sql);
    if ($result) {
        //echo "<script>alert(\"성공적으로 처리되었습니다\");</script>";
        echo "<script>window.location.href=\"./\";</script>"; 
    }
    else {
        echo "<script>alert(\"문제가 발생하였습니다\");</script>";
        echo "<script>window.location.href=\"./\";</script>"; 
    }

    mysql_close();
?>