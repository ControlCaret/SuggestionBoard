<?php
    $connect = mysql_connect("localhost","root","apmsetup");
    mysql_select_db("schoolsuggest", $connect);
    date_default_timezone_set('Asia/Seoul');
    session_start();
    $name = $_SESSION['name'];
    $schoolid = $_SESSION['schoolid'];

    if (!isset($schoolid))
        header("Location: /");
?>
<html lang="ko">
    <head>
        <meta charset="UTF-8">
        <title>정보학교 건의게시판</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="../css/mdb.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="../css/style.css" rel="stylesheet" >
    </head>
    <body onload="">
        <nav class="navbar navbar-expand-sm navbar-dark justify-content-between success-color text-white scrolling-navbar">
            <h3>
                <strong>정보학교 건의게시판</strong>
            </h3>
        
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobileMenu" aria-controls="mobileMenu" aria-expanded="false" aria-label="Toggle Menu"><span><i class="fa fa-bars fa-1x"></i></span></button>
            <div class="collapse navbar-collapse my-1" id="mobileMenu">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link d-block d-sm-none" data-toggle="modal" data-target="#suggestModal"><i class="fa fa-plus" aria-hidden="true"></i>건의 작성</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-orderbytime d-block d-sm-none" href="?option=all">전체</a>
                        <a class="nav-link nav-orderbytime d-block d-sm-none" href="?option=today">오늘</a>
                        <a class="nav-link nav-orderbytime d-block d-sm-none" href="?option=yesterday">어제</a>
                        <a class="nav-link nav-orderbytime d-block d-sm-none" href="?option=week">최근 1주일</a>
                        <a class="nav-link nav-orderbytime d-block d-sm-none" href="?option=month">최근 1달</a>
                        <a class="nav-link nav-orderbytime d-block d-sm-none" href="?option=year">최근 1년</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-block d-sm-none" href="sessionBreak.php"><i class="fa fa-power-off" aria-hidden="true"></i>로그아웃</a>
                    </li>
                </ul>
            </div>
            
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-2 d-none d-sm-block d.md-none">
                    <hr>
                    <button type="button" class="btn btn-round btn-success w-100 ml-0" data-toggle="modal" data-target="#suggestModal" ripple-radius style="font-size: 20px;"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;건의 작성</button>
                    <hr>
                    <ul class="list-group">
                        <h5　class="em-1">
                            <li><a href="?option=all" class="text-success"><i class="fa fa-arrow-right" aria-hidden="true"></i>전체</a></li>
                            <li><a href="?option=today" class="text-success"><i class="fa fa-arrow-right" aria-hidden="true"></i>오늘</a></li>
                            <li><a href="?option=yesterday" class="text-success"><i class="fa fa-arrow-right" aria-hidden="true"></i>어제</a></li>
                            <li><a href="?option=week" class="text-success"><i class="fa fa-arrow-right" aria-hidden="true"></i>최근 1주일</a></li>
                            <li><a href="?option=month" class="text-success"><i class="fa fa-arrow-right" aria-hidden="true"></i>최근 1달</a></li>
                            <li><a href="?option=year" class="text-success"><i class="fa fa-arrow-right" aria-hidden="true"></i>최근 1년</a></li>
                        </h5>
                    </ul>
                    <hr>
                    <form class="form-inline my-1 d-flex justify-content-center">
                        <div class="md-form form-sm my-0">
                            <input class="form-control form-control-sm mr-sm-2 mb-0" type="text" placeholder="#번호" aria-label="Search Number" id="numbersearch" style="width: 75px;">
                        </div>
                        <button class="btn btn-success btn-round btn-search my-0" type="button" onclick="bookmark()"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                    <hr>
                    <button type="button" class="btn btn-round btn-danger w-100 ml-0" ripple-radius style="font-size: 16px;" onclick="location.href='sessionBreak.php';"><i class="fa fa-power-off" aria-hidden="true"></i> 로그아웃</button>
                    <hr>
                </div>
                <div class="col-2 d-block d-sm-none sidebar-mobile">
                    <button type="button" class="btn btn-round btn-success btn-mobile" data-toggle="modal" style="font-size: 20px;" data-target="#suggestModal" ripple-radius><i class="fa fa-1x fa-plus" aria-hidden="true"></i></button>
                    <button type="button" class="btn btn-round btn-danger btn-mobile" ripple-radius style="font-size: 20px;" onclick="location.href='sessionBreak.php';"><i class="fa fa-1x fa-power-off" aria-hidden="true"></i></button>
                </div>
                <!-- -->
                <div class="col-10">
                    <br>
                    <div class="row">
                        <?php
                            if (trim($option) == '' || $option == all)
                                $sql  = "SELECT * FROM suggest ORDER BY num DESC;";
                            elseif ($option == today)
                                $sql  = "SELECT * FROM suggest WHERE date = CURDATE() ORDER BY num DESC;";
                            elseif ($option == yesterday)
                                $sql  = "SELECT * FROM suggest WHERE date = CURDATE() - INTERVAL 1 DAY ORDER BY num DESC;";
                            elseif ($option == week)
                                $sql  = "SELECT * FROM suggest WHERE date > date_add(CURDATE(), INTERVAL -1 WEEK) ORDER BY num DESC;";
                            elseif ($option == month)
                                $sql  = "SELECT * FROM suggest WHERE date > date_add(CURDATE(), INTERVAL -1 MONTH) ORDER BY num DESC;";
                            elseif ($option == year)
                                $sql  = "SELECT * FROM suggest WHERE date > date_add(CURDATE(), INTERVAL -1 YEAR) ORDER BY num DESC;";
                            else
                                $sql  = "SELECT * FROM suggest ORDER BY num DESC;";

                            $result = mysql_query($sql);

                            while ($row = mysql_fetch_array($result)) {
                                /*max = $row[agree] + $row[disagree];
                                if ($max == 0) {
                                    $max = 1; //Division by zero
                                }
                                if ($max == 1 && $row[agree] == 0 && $row[disagree] == 0) {
                                    $width = 1 / $max * 100;
                                    $color = "warning-color";
                                }
                                else {
                                    $width = $row[agree] / $max * 100;
                                    $color = "success-color";
                                }*/
                                
                                /* Progress Bar
                                <div class=\"progress danger-color w-100 \">
                                    <div class=\"progress-bar $color\" role=\"progressbar\" style=\"width: $width%\" aria-valuenow=\"$row[agree]\" aria-valuemin=\"0\" aria-valuemax=\"$max\"></div>
                                </div>
                                */

                                $date = substr($row[date], 0, 16); //print datetime without seconds

                                echo "
                                <bookmark id=\"$row[num]\"></bookmark>
                                <div class=\"col-lg-4 col-md-6 mb-4\">
                                    <div class=\"card text-center wow fadeInLeft fast\">
                                        <div class=\" card-header success-color white-text\">
                                            #$row[num]. $row[title]<small class=\"text-muted\">&nbsp;$row[name]</small>
                                        </div>
                                        <div class=\"card-body pb-1\">
                                            <p class=\"card-text\">$row[content]</p><hr class=\"mb-1\">
                                            <small class=\"text-muted\">$date</small>
                                        </div>
                                        <div class=\"card-footer\">
                                            <button type=\"button\" class=\"btn btn-round btn-success btn-vote mr-1\" onclick=\"location.href='vote.php?name=$name&suggestid=$row[num]&schoolid=$schoolid&option=1'\">동의</button>
                                            <button type=\"button\" class=\"btn btn-round btn-danger btn-vote mr-1\" onclick=\"location.href='vote.php?name=$name&suggestid=$row[num]&schoolid=$schoolid&option=0'\">반대</button>
                                            <button type=\"button\" class=\"btn btn-round btn-light btn-comment\" id=\"$row[num]\" data-toggle=\"modal\" data-target=\"#commentModal\" onclick=\"comment(this.id)\"><i class=\"fa fa-comment\" aria-hidden=\"true\"></i></button>
                                            
                                        </div>
                                    </div>
                                </div>
                                ";
                            }
                            mysql_close();
                        ?>
                        <br>
                    </div>
                </div>
                <!-- -->
            </div>
        </div>

        <!-- Modal -->

        <div class="modal fade" id="suggestModal" tabindex="-1" role="dialog" aria-labelledby="suggestModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="suggestModalLabel"><i class="fa fa-pencil prefix"></i> 건의 작성</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="input.php" method="POST">
                        <div class="modal-body">
                            <div class="md-form form-lg">
                                <input type="text" class="form-control form-control-lg" name="title" autocomplete="off" required>
                                <label for="inputLGEx">제목</label>
                            </div>
                            <div class="md-form">
                                <textarea id="" class="form-control md-textarea" rows="4" name="content" required></textarea>
                                <label for="">건의사항</label>
                            </div>
                            <input type="hidden" name="name" value="<?php echo $name;?>">
                            <input type="hidden" name="schoolid" value="<?php echo $schoolid;?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-round btn-danger" data-dismiss="modal">닫기</button>
                            <button type="submit" class="btn btn-round btn-success">작성하기</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade right" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModal" aria-hidden="true" data-backdrop="false">
            <div class="modal-dialog modal-full-height modal-right" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title w-100">댓글 작성</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="comment.php" method="POST">
                            <div class="md-form">
                                <i class="fa fa-comment prefix" aria-hidden="true"></i>
                                <textarea id="" class="form-control md-textarea" rows="1" name="content" required></textarea>
                                <label for="">댓글</label>
                                <input type="hidden" name="name" value="<?php echo $name;?>">
                                <input type="hidden" name="schoolid" value="<?php echo $schoolid;?>">
                                <input type="hidden" name="suggestid" id="suggestid" value="0">
                                <button type="submit" class="btn btn-round btn-success w-100 btn-md">작성하기</button>
                            </div>
                        </form>
                        <?php
                            echo "<iframe id=\"iframe-comment\" class=\"h-50\" src=\"\"></iframe>"
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-round btn-danger btn-md" data-dismiss="modal">닫기</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- /Modal -->

        <!-- JQuery -->
        <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="../js/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="../js/mdb.min.js"></script>
        <!-- Custom JavaScript -->
        <script type="text/javascript" src="../js/script.js"></script>
    </body>
</html>