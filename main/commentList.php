<meta charset="utf-8">
<?php
    $connect = mysql_connect("localhost","root","apmsetup");
    $dbconn  = mysql_select_db("schoolsuggest", $connect);

    $suggestid = $_GET['suggestid'];

    $sql  = "SELECT * FROM comment WHERE suggestid = $suggestid ORDER BY num DESC;";

    $result = mysql_query($sql, $connect);

    while ($row = mysql_fetch_array($result)) {
        echo "$row[name] : $row[content]";
        echo "<br>";
    }

    mysql_close();
?>