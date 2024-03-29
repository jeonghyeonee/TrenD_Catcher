<?php

$conn = mysqli_connect(
    '3.35.218.159',
    'hive',
    'hive',
    'metastore');
    
$sql = "SELECT * FROM dramainfo";

$result = mysqli_query($conn, $sql);

$names = array();
$infos = array();
$posters = array();
while($row = mysqli_fetch_array($result)) {
    array_push($infos,$row['info']);
    array_push($names,$row['name']);
    array_push($posters, $row['poster']);

}
/////////////////////////////////////////////
$sql1 = "SELECT * FROM drama2";

$result1 = mysqli_query($conn, $sql1);

$items = array();
$categories = array();
$links = array();
$counts = array();

while($row1 = mysqli_fetch_array($result1)) {
    $item_list = $row1['keyword'];
    $category_list = $row1['category'];
    $link_list = "<a href={$row1['link']}>click for buy</a>";
    $counts_list = $row1['count'];

    array_push($items,$item_list);
    array_push($categories,$category_list);
    array_push($links,$link_list);
    array_push($counts,$counts_list);

}

/////////////////////////////////////////////
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
    'width' => 700, 'height' => 350
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$names[1]?></title>
    <link rel="stylesheet" href="css/navbar&footer.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <script src="js/main.js"></script>

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

    <!-- word cloud -->
    <script  src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <style>
        html,
        body {
        height: 100%;
        width: 100%;
        margin: 0;
        padding: 0;
        }
    
        #myChart {
        height: 100%;
        width: 100%;
        min-height: 150px;
        }
    
        .zc-ref {
        display: none;
        }
    </style>


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
            Welcome to TREND_CATCHER dashboard page! ☺️
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
                        <img src="img/211676_home_icon.png" alt="">
                        <a class="no_click_icon" href="main.php">Home</a>
                    </div>
                </div>
                <div class="main_app">
                    <p>Apps</p>
                    <div class="main_nav_sebu">
                        <img src="img/패스 4.png" alt="">
                        <a class="click_icon" href="drama2.php">Dashboard</a>
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
                <div class="section1_left" style="width:790px">
                    <div style="margin-bottom: 10px;display: flex; align-items: center;width: 1900px;">
                        <img src="img/패스 4.png" alt="">
                        <h2 style="margin-left:10px;font-weight: bold; color: #FF0557">Dashboard</h2>
                        <span style="margin-left:10px">2 | <?=$names[1]?> </span>
                    </div>
                    <div class="box_l" style="width: 789px;height: 448px;">
                        <div class="box_title"><span>Drama Top keyword</span></div>
                        <div class="box_content">
                            <div id="chart_div"></div>  
                            <div class="box_content_inner">

                            </div>
                        </div>
                    </div>
                    <div class="box_l" style="margin-top: 38px;height: 397px;width: 789px;">
                        <div class="box_title"><span>Drama Information</span></div>
                        <div class="box_content" style="display: flex;justify-content:center;align-items: center;">
                            <img style="
                                width: 200px; height: 280px; padding : 40px 30px 10px; "alt="poster" src="<?=$posters[1]?>"> 
                            
                            <div>&nbsp;<?=$infos[1]?>&nbsp;</div>
                        </div>
                    </div>
                </div>

                <div class="section1_right" style="width:760px;margin-top:35px;margin-left:50px">
                    <div class="box_r" style="width: 755px;height: 534px;">
                        <div class="box_title"><span>Best Item</span></div>
                        <div class="box_content">
                            <div class="box_content_best_items"style="height:440px;display:flex;flex-direction:row;">
                                <div >
                                    <!--div 10개 배치-->
                                    <div class="best_item">
                                        <div class="best_item_text">
                                            <span class="best_num">Best 1</span>
                                            <span class="drama_name_category">
                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;</span><?=$categories[0]?><span></span>
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
                                            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span><?=$categories[1]?><span></span>
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
                                            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span><?=$categories[2]?><span></span>
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
                                            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span><?=$categories[3]?><span></span>
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
                                            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span><?=$categories[4]?><span></span>
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
                                </div>
                                <div style="margin-left:30px">
                                    <div class="best_item">
                                        <div class="best_item_text">
                                            <span class="best_num">Best 6</span>
                                            <span class="drama_name_category">
                                            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span><?=$categories[5]?><span></span>
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
                                            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span><?=$categories[6]?><span></span>
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
                                    <div class="best_item">
                                        <div class="best_item_text">
                                            <span class="best_num">Best 8</span>
                                            <span class="drama_name_category">
                                            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span><?=$categories[7]?><span></span>
                                            </span>
                                        </div>
                                        <div class="best_item_box">
                                            <div
                                                style="width:192px; height:26px; margin-left: 10px; display:flex;align-items: center;">
                                                <p><?=$items[7]?></p>
                                            </div>
                                            <div class="click_for_buy">
                                                <img src="img/basket-buy-cart-ecommerce-online-purse-shop-shopping_107515.png"
                                                    alt="">
                                                <span><?=$links[7]?></span>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="best_item">
                                        <div class="best_item_text">
                                            <span class="best_num">Best 9</span>
                                            <span class="drama_name_category">
                                            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span><?=$categories[8]?><span></span>
                                            </span>
                                        </div>
                                        <div class="best_item_box">
                                            <div
                                                style="width:192px; height:26px; margin-left: 10px; display:flex;align-items: center;">
                                                <p><?=$items[8]?></p>
                                            </div>
                                            <div class="click_for_buy">
                                                <img src="img/basket-buy-cart-ecommerce-online-purse-shop-shopping_107515.png"
                                                    alt="">
                                                <span><?=$links[8]?></span>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="best_item">
                                        <div class="best_item_text">
                                            <span class="best_num">Best 10</span>
                                            <span class="drama_name_category">
                                            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span><?=$categories[9]?><span></span>
                                            </span>
                                        </div>
                                        <div class="best_item_box">
                                            <div
                                                style="width:192px; height:26px; margin-left: 10px; display:flex;align-items: center;">
                                                <p><?=$items[9]?></p>
                                            </div>
                                            <div class="click_for_buy">
                                                <img src="img/basket-buy-cart-ecommerce-online-purse-shop-shopping_107515.png"
                                                    alt="">
                                                <span><?=$links[9]?></span>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box_r" style="margin-top: 38px;width: 747px;height: 319px;">
                        <div class="box_title"><span>WordCloud For 30 Top Category</span></div>
                        <div class="box_content">
                            <div id="myChart"><a class="zc-ref" href="https://www.zingchart.com">Powered by ZingChart</a></div>
                                <script>
                                    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
                                    var myConfig = {
                                    "graphset": [{
                                        "type": "wordcloud",
                                        "options": {
                                        "style": {
                                            "tooltip": {
                                            visible: true,
                                            text: '%text: %hits'
                                            }
                                        },
                                        "words": [{
                                            "text": "<?=$items[0]?>",
                                            "count": "<?=$counts[0]?>"
                                            },
                                            {
                                            "text": "<?=$items[1]?>",
                                            "count": "<?=$counts[1]?>"
                                            },
                                            {
                                            "text": "<?=$items[2]?>",
                                            "count": "<?=$counts[2]?>"
                                            },
                                            {
                                            "text": "<?=$items[3]?>",
                                            "count": "<?=$counts[3]?>"
                                            },
                                            {
                                            "text": "<?=$items[4]?>",
                                            "count": "<?=$counts[4]?>"
                                            },
                                            {
                                            "text": "<?=$items[5]?>",
                                            "count": "<?=$counts[5]?>"
                                            },
                                            {
                                            "text": "<?=$items[6]?>",
                                            "count": "<?=$counts[6]?>"
                                            },
                                            {
                                            "text": "<?=$items[7]?>",
                                            "count": "<?=$counts[7]?>"
                                            },
                                            {
                                            "text": "<?=$items[8]?>",
                                            "count": "<?=$counts[8]?>"
                                            },
                                            {
                                            "text": "<?=$items[9]?>",
                                            "count": "<?=$counts[9]?>"
                                            },
                                            {
                                            "text": "<?=$items[10]?>",
                                            "count": "<?=$counts[10]?>"
                                            },
                                            {
                                            "text": "<?=$items[11]?>",
                                            "count": "<?=$counts[11]?>"
                                            },
                                            {
                                            "text": "<?=$items[12]?>",
                                            "count": "<?=$counts[12]?>"
                                            },
                                            {
                                            "text": "<?=$items[13]?>",
                                            "count": "<?=$counts[13]?>"
                                            },
                                            {
                                            "text": "<?=$items[14]?>",
                                            "count": "<?=$counts[14]?>"
                                            },
                                            {
                                            "text": "<?=$items[15]?>",
                                            "count": "<?=$counts[15]?>"
                                            },
                                            {
                                            "text": "<?=$items[16]?>",
                                            "count": "<?=$counts[16]?>"
                                            },
                                            {
                                            "text": "<?=$items[17]?>",
                                            "count": "<?=$counts[17]?>"
                                            },
                                            {
                                            "text": "<?=$items[18]?>",
                                            "count": "<?=$counts[18]?>"
                                            },
                                            {
                                            "text": "<?=$items[19]?>",
                                            "count": "<?=$counts[19]?>"
                                            },
                                            {
                                            "text": "<?=$items[20]?>",
                                            "count": "<?=$counts[20]?>"
                                            },
                                            {
                                            "text": "<?=$items[21]?>",
                                            "count": "<?=$counts[21]?>"
                                            },
                                            {
                                            "text": "<?=$items[22]?>",
                                            "count": "<?=$counts[22]?>"
                                            },
                                            {
                                            "text": "<?=$items[23]?>",
                                            "count": "<?=$counts[23]?>"
                                            },
                                            {
                                            "text": "<?=$items[24]?>",
                                            "count": "<?=$counts[24]?>"
                                            },
                                            {
                                            "text": "<?=$items[25]?>",
                                            "count": "<?=$counts[25]?>"
                                            },
                                            {
                                            "text": "<?=$items[26]?>",
                                            "count": "<?=$counts[26]?>"
                                            },
                                            {
                                            "text": "<?=$items[27]?>",
                                            "count": "<?=$counts[27]?>"
                                            },
                                            {
                                            "text": "<?=$items[28]?>",
                                            "count": "<?=$counts[29]?>"
                                            }      

                                        ]
                                        }
                                    }]
                                    };
                                
                                    zingchart.render({
                                    id: 'myChart',
                                    data: myConfig,
                                    height: '100%',
                                    width: '100%'
                                    });
                                </script>
                        </div>

                    </div>
                </div>
            </section>

        </div>
    </main>

    <div id="footer">

    </div>

</body>

</html>