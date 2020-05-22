<?php
    $schoolid = $_POST['schoolid'];
    $name = $_POST['name'];

    if(trim($name) == '')
        $name = "익명";

    if (isset($schoolid) && is_numeric($schoolid)) {
        session_start();
        $_SESSION['schoolid'] = $schoolid;
        $_SESSION['name'] = $name;
        header("Location: ./main");
        exit();
    }
    elseif (!isset($schoolid) || !is_numeric($schoolid)) {
        echo "<script>alert(\"학번이 잘못되었습니다. 확인 후 다시 시도해주세요.\");</script>";
        echo "<script>window.location.href=\"/\";</script>"; 
    }
    else {
        echo "<script>alert(\"문제가 발생하였습니다. 다시 시도해주세요.\");</script>";
        echo "<script>window.location.href=\"/\";</script>"; 
    }
?>
<meta charset="utf-8" />