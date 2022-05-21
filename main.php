<?php

$conn = mysqli_connect(
    '3.39.189.42',
    'ubuntu',
    'hive',
    'metastore');
    
$sql = "SELECT * FROM dramainfo";

$result = mysqli_query($conn, $sql);

$names = array();
while($row = mysqli_fetch_array($result)) {
    array_push($names,$row['name']);

}
////////////////////////////////////////////////////////////////
$sql_t = "SELECT * FROM totalkeyword";

$result_t = mysqli_query($conn, $sql_t);

$items = array();
$categories = array();
$links = array();
$counts = array();


while($row_t = mysqli_fetch_array($result_t)) {
    $item_list = $row_t['keyword'];
    $category_list = $row_t['category'];
    $link_list = "<a href={$row_t['link']}>click for buy</a>";
    $counts_list = $row_t['count'];

    array_push($items,$item_list);
    array_push($categories,$category_list);
    array_push($links,$link_list);
    array_push($counts, $counts_list);
}

$data = [
    ['keyword', 'count'],
    [$items[0], (int)$counts[0]],
    [$items[1], (int)$counts[1]],
    [$items[2], (int)$counts[2]],
    [$items[3], (int)$counts[3]],
    [$items[4], (int)$counts[4]],
    [$items[5], (int)$counts[5]],
    [$items[6], (int)$counts[6]],
    [$items[7], (int)$counts[7]],
    [$items[8], (int)$counts[8]],
    [$items[9], (int)$counts[9]],

];
$options = [
    'title' => 'total keywords',
    'width' => 500, 'height' => 370
];
////////////////////////////////////////////
$sql_c = "SELECT * FROM totalcategory";

$result_c = mysqli_query($conn, $sql_c);

$category_c = array();
$keyword_c = array();
// $link_c = array();

while($row = mysqli_fetch_array($result_c)) {

    array_push($category_c,$row['category']);
    array_push($keyword_c,$row['keyword']);
    // array_push($link_c, "<a href={$row['link']}>click for buy</a>");

}
// $new_keyword = array();

$keyword1 = explode(",",$keyword_c[0]);
$keyword2 = explode(",",$keyword_c[1]);
$keyword3 = explode(",",$keyword_c[2]);

// 카테고리 3개

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>main</title>
    <link rel="stylesheet" href="css/navbar&footer.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    
    <script src="//www.google.com/jsapi"></script>
    <script>
        let data = <?= json_encode($data) ?>;
        let options = <?= json_encode($options) ?>;
        google.load('visualization', '1.0', {'packages':['corechart']});
        google.setOnLoadCallback(function() {
            let chart = new google.visualization.ColumnChart(document.querySelector('#chart_div'));
            chart.draw(google.visualization.arrayToDataTable(data), options);
        });
    </script>

    <style type="text/css">
        .cal_top {
            text-align: center;
            font-size: 20px;
        }

        .cal {
            text-align: center;
        }

        table.calendar {
            border: 1px solid black;
            display: inline-table;
            text-align: left;

        }

        table.calendar td {
            vertical-align: top;
            border: 0.5px solid black;
            width: 90px;
            font-size: 14px;
        }

        table {

            border-collapse: collapse;
        }
    </style>
    <script>
        $(function () {
            $("#from").datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 3,
                onClose: function (selectedDate) {
                    $("#to").datepicker("option", "minDate", selectedDate);
                }
            });
            $("#to").datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 3,
                onClose: function (selectedDate) {
                    $("#from").datepicker("option", "maxDate", selectedDate);
                }
            });
        });
    </script>
</head>


<body>
    <nav class="upperbar">
        <div class="logo">
            <a href="main.php" style="text-decoration:none;">
                <span class="upperbar_t1">TREN</span>
                <span class="upperbar_t2">D_</span>
                <span class="upperbar_t3">CATCHER</span>
            </a>
        </div>

        <p class="welcome">
            Welcome to TREND_CATCHER home page! ☺️
        </p>

    </nav>

    <main>
        <div class="main_first">
            <div class="main_first_icon">
                <div class="main_profile">
                    <div class="main_profile_icon"></div>
                    <div class="main_profile_text">
                        <p class="main_profile_p1">DB</p>
                        <p class="main_profile_p2">Dashboard</p>
                    </div>
                </div>
                <div class="main_nav">
                    <p>Navigation</p>
                    <div class="main_nav_sebu">
                        <img src="img/211676_home_icon.svg" alt="">
                        <a class="click_icon" href="main.html">Home</a>
                    </div>
                </div>
                <div class="main_app">
                    <p>Navigation</p>
                    <div class="main_nav_sebu">
                        <img src="img/패스 4.svg" alt="">
                        <a class="no_click_icon" href="drama1.php">Dashboard</a>
                    </div>
                    <div class="main_nav_sebu_p">
                        <img src="img/g1580.svg" alt="">
                        <a class="sebutext" href="Project.html">Project</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="main_content">
            <section id="section1">
                <div class="section1_left">
                    <div class="box_l">
                        <div class="box_title"><span>Korea Top 10 Drama</span></div>
                        <div class="box_content">
                            <div class="box_content_inner">
                                <div class="top_drama_list">
                                    <span>
                                        <a>1 | &nbsp;</a><a href="drama1.php"><?=$names[0]?></a>
                                    </span>
                                </div>
                                <div class="top_drama_list">
                                    <span>
                                        <a>2 | &nbsp;</a><a href="drama2.php"><?=$names[1]?></a>
                                    </span>
                                </div>

                                <div class="top_drama_list">
                                    <span>
                                        <a>3 | &nbsp;</a><a href="drama3.php"><?=$names[2]?></a>
                                    </span>
                                </div>

                                <div class="top_drama_list">
                                    <span>
                                        <a>4 | &nbsp;</a><a href="drama4.php"><?=$names[3]?></a>
                                    </span>
                                </div>

                                <div class="top_drama_list">
                                    <span>
                                        <a>5 | &nbsp;</a><a href="drama5.php"><?=$names[4]?></a>
                                    </span>
                                </div>
                            </div>
                            <div class="box_content_inner">
                                <div class="top_drama_list">
                                    <span>
                                        <a>6 | &nbsp;</a><a href="drama6.php"><?=$names[5]?></a>
                                    </span>
                                </div>
                                <div class="top_drama_list">
                                    <span>
                                        <a>7 | &nbsp;</a><a href="drama7.php"><?=$names[6]?></a>
                                    </span>
                                </div>

                                <div class="top_drama_list">
                                    <span>
                                        <a>8 | &nbsp;</a><a href="drama8.php"><?=$names[7]?></a>
                                    </span>
                                </div>

                                <div class="top_drama_list">
                                    <span>
                                        <a>9 | &nbsp;</a><a href="drama9.php"><?=$names[8]?></a>
                                    </span>
                                </div>

                                <div class="top_drama_list">
                                    <span>
                                        <a>10 | &nbsp;</a><a href="drama10.php"><?=$names[9]?></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box_l" style="margin-top: 38px;">
                        <div class="box_title"><span>Top Keyword Graph for All Dramas </span>
                            <span></span></div>
                        <div id="chart_div"></div>
                    </div>
                </div>
                <div class="section1_middle">
                    <div class="box_m">
                        <div class="box_title"><span>Weekly Best 7 Items</span></div>
                        <div class="box_content_best_items">
                            <!--div 7개 배치-->
                            <div class="best_item">
                                <div class="best_item_text">
                                    <span class="best_num">Best 1</span>
                                    <span class="drama_name_category">
                                        <span><?=$names[0]?></span><span>&nbsp; | &nbsp;</span><?=$categories[0]?><span></span>
                                    </span>
                                </div>
                                <div class="best_item_box">
                                    <div
                                        style="width:192px; height:26px; margin-left: 10px; display:flex;align-items: center;">
                                        <p><?=$items[0]?></p>
                                    </div>
                                    <div class="click_for_buy">
                                        <img src="img/basket-buy-cart-ecommerce-online-purse-shop-shopping_107515.png"
                                            alt="">
                                        <span><?=$links[0]?></span>
                                    </div>

                                </div>

                            </div>
                            <div class="best_item">
                                <div class="best_item_text">
                                    <span class="best_num">Best 2</span>
                                    <span class="drama_name_category">
                                    <span><?=$names[1]?></span><span>&nbsp; | &nbsp;</span><?=$categories[1]?><span></span>
                                    </span>
                                </div>
                                <div class="best_item_box">
                                    <div
                                        style="width:192px; height:26px; margin-left: 10px; display:flex;align-items: center;">
                                        <p><?=$items[1]?></p>
                                    </div>
                                    <div class="click_for_buy">
                                        <img src="img/basket-buy-cart-ecommerce-online-purse-shop-shopping_107515.png"
                                            alt="">
                                        <span><?=$links[1]?></span>
                                    </div>

                                </div>

                            </div>
                            <div class="best_item">
                                <div class="best_item_text">
                                    <span class="best_num">Best 3</span>
                                    <span class="drama_name_category">
                                    <span><?=$names[2]?></span><span>&nbsp; | &nbsp;</span><?=$categories[2]?><span></span>
                                    </span>
                                </div>
                                <div class="best_item_box">
                                    <div
                                        style="width:192px; height:26px; margin-left: 10px; display:flex;align-items: center;">
                                        <p><?=$items[2]?></p>
                                    </div>
                                    <div class="click_for_buy">
                                        <img src="img/basket-buy-cart-ecommerce-online-purse-shop-shopping_107515.png"
                                            alt="">
                                        <span><?=$links[2]?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="best_item">
                                <div class="best_item_text">
                                    <span class="best_num">Best 4</span>
                                    <span class="drama_name_category">
                                    <span><?=$names[3]?></span><span>&nbsp; | &nbsp;</span><?=$categories[3]?><span></span>
                                    </span>
                                </div>
                                <div class="best_item_box">
                                    <div
                                        style="width:192px; height:26px; margin-left: 10px; display:flex;align-items: center;">
                                        <p><?=$items[3]?></p>
                                    </div>
                                    <div class="click_for_buy">
                                        <img src="img/basket-buy-cart-ecommerce-online-purse-shop-shopping_107515.png"
                                            alt="">
                                        <span><?=$links[3]?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="best_item">
                                <div class="best_item_text">
                                    <span class="best_num">Best 5</span>
                                    <span class="drama_name_category">
                                    <span><?=$names[4]?></span><span>&nbsp; | &nbsp;</span><?=$categories[4]?><span></span>
                                    </span>
                                </div>
                                <div class="best_item_box">
                                    <div
                                        style="width:192px; height:26px; margin-left: 10px; display:flex;align-items: center;">
                                        <p><?=$items[4]?></p>
                                    </div>
                                    <div class="click_for_buy">
                                        <img src="img/basket-buy-cart-ecommerce-online-purse-shop-shopping_107515.png"
                                            alt="">
                                        <span><?=$links[4]?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="best_item">
                                <div class="best_item_text">
                                    <span class="best_num">Best 6</span>
                                    <span class="drama_name_category">
                                    <span><?=$names[5]?></span><span>&nbsp; | &nbsp;</span><?=$categories[5]?><span></span>
                                    </span>
                                </div>
                                <div class="best_item_box">
                                    <div
                                        style="width:192px; height:26px; margin-left: 10px; display:flex;align-items: center;">
                                        <p><?=$items[5]?></p>
                                    </div>
                                    <div class="click_for_buy">
                                        <img src="img/basket-buy-cart-ecommerce-online-purse-shop-shopping_107515.png"
                                            alt="">
                                        <span><?=$links[5]?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="best_item">
                                <div class="best_item_text">
                                    <span class="best_num">Best 7</span>
                                    <span class="drama_name_category">
                                    <span><?=$names[6]?></span><span>&nbsp; | &nbsp;</span><?=$categories[6]?><span></span>
                                    </span>
                                </div>
                                <div class="best_item_box">
                                    <div
                                        style="width:192px; height:26px; margin-left: 10px; display:flex;align-items: center;">
                                        <p><?=$items[6]?></p>
                                    </div>
                                    <div class="click_for_buy">
                                        <img src="img/basket-buy-cart-ecommerce-online-purse-shop-shopping_107515.png"
                                            alt="">
                                        <span><?=$links[6]?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section1_right">
                    <div class="box_r">
                        <div class="box_title"><span>Trend Prediction</span></div>
                        <div class="box_content">

                            <!---->
                            <div class="category">
                                <div class="cate">
                                    <div class="category_circle1"><span><?=$category_c[0]?></span></div>
                                    <div>
                                        <?php
                                        if (count($keyword1) <5){
                                            for ($i=0;$i<count($keyword1); $i++){
                                                echo trim($keyword1[$i])."<br>";
                                            }
                                        }
                                        else{
                                            for ($i=0;$i<5; $i++){
                                                echo trim($keyword1[$i])."<br>";
                                            }
                                        }
                                        
                                        ?>
                                    </div>

                                </div>
                                <div class="cate">
                                    <div class="category_circle2"><span><?=$category_c[1]?></span></div>
                                    <div>
                                    <?php
                                        if (count($keyword2) <5){
                                            for ($i=0;$i<count($keyword2); $i++){
                                                echo trim($keyword2[$i])."<br>";
                                            }
                                        }
                                        else{
                                            for ($i=0;$i<5; $i++){
                                                echo trim($keyword2[$i])."<br>";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="cate">
                                    <div class="category_circle3"><span><?=$category_c[2]?></span></div>
                                    <div>
                                    <?php
                                        if (count($keyword3) <5){
                                            for ($i=0;$i<count($keyword3); $i++){
                                                echo trim($keyword3[$i])."<br>";
                                            }
                                        }
                                        else{
                                            for ($i=0;$i<5; $i++){
                                                echo trim($keyword3[$i])."<br>";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="box_r" style="margin-top: 38px;height: 275px;">
                        <div class="box_title"><span>Calander</span></div>
                        <div class="box_content_calandar">



                            <!-- calendar 태그 -->
                            <div class="cal_top">
                                <a href="#" id="movePrevMonth"><span id="prevMonth" class="cal_tit">&lt; </span></a>
                                <span id="cal_top_year"></span>
                                <span id="cal_top_month"></span>
                                <a href="#" id="moveNextMonth"><span id="nextMonth" class="cal_tit">&gt;</span></a>
                            </div>
                            <div id="cal_tab" class="cal">
                            </div>

                            <script type="text/javascript">
                                var today = null;
                                var year = null;
                                var month = null;
                                var firstDay = null;
                                var lastDay = null;
                                var $tdDay = null;
                                var $tdSche = null;
                                var jsonData = null;
                                $(document).ready(function () {
                                    drawCalendar();
                                    initDate();
                                    drawDays();
                                    drawSche();
                                    $("#movePrevMonth").on("click", function () {
                                        movePrevMonth();
                                    });
                                    $("#moveNextMonth").on("click", function () {
                                        moveNextMonth();
                                    });
                                });

                                //Calendar 그리기
                                function drawCalendar() {
                                    var setTableHTML = "";
                                    setTableHTML += '<table class="calendar">';
                                    setTableHTML +=
                                        '<tr><th>SUN</th><th>MON</th><th>TUE</th><th>WED</th><th>THU</th><th>FRI</th><th>SAT</th></tr>';
                                    for (var i = 0; i < 6; i++) {
                                        setTableHTML += '<tr height="30">';
                                        for (var j = 0; j < 7; j++) {
                                            setTableHTML +=
                                                '<td style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap">';
                                            setTableHTML += '    <div class="cal-day"></div>';
                                            setTableHTML += '    <div class="cal-schedule"></div>';
                                            setTableHTML += '</td>';
                                        }
                                        setTableHTML += '</tr>';
                                    }
                                    setTableHTML += '</table>';
                                    $("#cal_tab").html(setTableHTML);
                                }

                                //날짜 초기화
                                function initDate() {
                                    $tdDay = $("td div.cal-day")
                                    $tdSche = $("td div.cal-schedule")
                                    dayCount = 0;
                                    today = new Date();
                                    year = today.getFullYear();
                                    month = today.getMonth() + 1;
                                    if (month < 10) {
                                        month = "0" + month;
                                    }
                                    firstDay = new Date(year, month - 1, 1);
                                    lastDay = new Date(year, month, 0);
                                }

                                //calendar 날짜표시
                                function drawDays() {
                                    $("#cal_top_year").text(year);
                                    $("#cal_top_month").text(month);
                                    for (var i = firstDay.getDay(); i < firstDay.getDay() + lastDay.getDate(); i++) {
                                        $tdDay.eq(i).text(++dayCount);
                                    }
                                    for (var i = 0; i < 42; i += 7) {
                                        $tdDay.eq(i).css("color", "red"); // sunday
                                    }
                                    for (var i = 6; i < 42; i += 7) {
                                        $tdDay.eq(i).css("color", "blue"); // saturday
                                    }
                                    
                                    var a = 10; // 색칠 시작
                                    var b = 15; // 색칠 끝
                                    for (var i = a; i <= b ; i += 1) {
                                        $tdDay.eq(i).css("background-color", "#FF0557"); // 7일 표시
                                        $tdDay.eq(i).css("height", "26px"); // 
                                    }
                                }

                                //calendar 월 이동
                                function movePrevMonth() {
                                    month--;
                                    if (month <= 0) {
                                        month = 12;
                                        year--;
                                    }
                                    if (month < 10) {
                                        month = String("0" + month);
                                    }
                                    getNewInfo();
                                }

                                function moveNextMonth() {
                                    month++;
                                    if (month > 12) {
                                        month = 1;
                                        year++;
                                    }
                                    if (month < 10) {
                                        month = String("0" + month);
                                    }
                                    getNewInfo();
                                }

                                //정보갱신
                                function getNewInfo() {
                                    for (var i = 0; i < 42; i++) {
                                        $tdDay.eq(i).text("");
                                        $tdSche.eq(i).text("");
                                    }
                                    dayCount = 0;
                                    firstDay = new Date(year, month - 1, 1);
                                    lastDay = new Date(year, month, 0);
                                    drawDays();
                                    drawSche();
                                }

                                //데이터 등록
                                function setData() {
                                    jsonData = {
                                        "2019": {
                                            "07": {
                                                "17": "제헌절"
                                            },
                                            "08": {
                                                "7": "칠석",
                                                "15": "광복절",
                                                "23": "처서"
                                            },
                                            "09": {
                                                "13": "추석",
                                                "23": "추분"
                                            }
                                        }
                                    }
                                }
                                //스케줄 그리기
                                function drawSche() {
                                    setData();
                                    var dateMatch = null;
                                    for (var i = firstDay.getDay(); i < firstDay.getDay() + lastDay.getDate(); i++) {
                                        var txt = "";
                                        txt = jsonData[year];
                                        if (txt) {
                                            txt = jsonData[year][month];
                                            if (txt) {
                                                txt = jsonData[year][month][i];
                                                dateMatch = firstDay.getDay() + i - 1;
                                                $tdSche.eq(dateMatch).text(txt);
                                            }
                                        }
                                    }
                                }
                            </script>


                        </div>
                    </div>
            </section>
            <section id="section2">
                <div class="banner">
                    <p>2022 Drama Trend Catcher</p>
                    <svg id="구성_요소_1_1" data-name="구성 요소 1 – 1" xmlns="http://www.w3.org/2000/svg" width="120"
                        height="120" viewBox="0 0 120 120">
                        <path id="패스_19" data-name="패스 19" d="M0-20.806l30,30H0Z" transform="translate(90 20.806)"
                            fill="#ff0557" />
                        <path id="패스_20" data-name="패스 20" d="M0-20.806l30,30H0Z" transform="translate(90 50.806)"
                            fill="#ff0557" />
                        <path id="패스_21" data-name="패스 21" d="M0-20.806l30,30H0Z" transform="translate(60 20.806)"
                            fill="#ff0557" />
                        <path id="패스_22" data-name="패스 22" d="M0-20.806l30,30H0Z" transform="translate(30 20.806)"
                            fill="#ff0557" />
                        <path id="패스_23" data-name="패스 23" d="M0-20.806l30,30H0Z" transform="translate(60 52.806)"
                            fill="#ff0557" />
                        <path id="패스_24" data-name="패스 24" d="M0-20.806l30,30H0Z" transform="translate(90 80.806)"
                            fill="#ff0557" />
                        <path id="패스_25" data-name="패스 25" d="M0-20.806l30,30H0Z" transform="translate(30 50.806)"
                            fill="#ff0557" />
                        <path id="패스_26" data-name="패스 26" d="M0-20.806l30,30H0Z" transform="translate(60 80.806)"
                            fill="#ff0557" />
                        <path id="패스_27" data-name="패스 27" d="M0-20.806l30,30H0Z" transform="translate(0 22.806)"
                            fill="#ff0557" />
                        <path id="패스_28" data-name="패스 28" d="M0-20.806l30,30H0Z" transform="translate(90 110.806)"
                            fill="#ff0557" />
                    </svg>
                </div>
            </section>
        </div>
    </main>

    <div id="footer">

    </div>

</body>

</html>