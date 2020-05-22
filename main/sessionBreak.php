<?php
    session_start();
    if (isset($_SESSION['schoolid'])) {
        unset($_SESSION['schoolid']);
        session_destroy();
        header("Location: /");
        exit();
    }
    echo "<script>alert(\"문제가 발생하였습니다. 다시 시도해주세요.\");</script>";
?>