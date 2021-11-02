<?php
    $base_url = "https://www.thestar.com.my/rss/";
    $accepted_views = array("News", "Business", "Sport", "Metro", "Tech", "Education", "Opinion");
    $news_rss = array( "Nation", "Regional", "World", "Environment", "In Other Media", "True Or Not", "Education");
    $business_rss = array( "Business News", "SMEBiz");
    $sport_rss = array( "Football", "Golf", "Badminton", "Tennis", "Motorsport");
    $metro_rss = array( "Metro News", "Eat And Drink", "Focus", "Views");
    $tech_rss = array( "Tech News", "Reviews", "Games");
    $opinion_rss = array( "Columnists", "Letters");
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>TheStar News RSS Reader</title>
        <meta name="description" content="A simple RSS reader for TheStar news website">
        <meta name="author" content="leonlit">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/assets/css/mobile.css">
        <link rel="stylesheet" href="/assets/css/tablet.css">
        <link rel="stylesheet" href="/assets/css/desktop.css">
    </head>
    <body>
        <nav>
            <div id="title"><a href="/index.html">TheStar RSS Reader</a></div>
            <div id="navbar">
                <div class="nav_indicator" onclick="open_close_nav()">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <div id="nav_items_container">
                <div>
                    <div class="dropdown" id="dropdown_content-0">News<img class="dropdown_icon" src="/assets/img/triangle.png"/></div>
                    <div class="dropdown_content">
                        <a href="/view/News/Main">News</a>
                        <a href="/view/News/Nation">Nation</a>
                        <a href="/view/News/Regional">Regional</a>
                        <a href="/view/News/World">World</a>
                        <a href="/view/News/Environment">Environment</a>
                        <a href="/view/News/In Other Media">In Other Media</a>
                        <a href="/view/News/True Or Not">True Or Not</a>
                    </div>
                </div>
                <div>
                    <div class="dropdown" id="dropdown_content-1">Business<img class="dropdown_icon" src="/assets/img/triangle.png"/></div>
                    <div class="dropdown_content" >
                        <a href="/view/Business">Business</a>
                        <a href="/view/Business/Business News">Business News</a>
                        <a href="/view/Business/SMEBiz">SMEBiz</a>
                    </div>
                </div>
                <div>
                    <div class="dropdown" id="dropdown_content-2">Sport<img class="dropdown_icon" src="/assets/img/triangle.png"/></div>
                    <div class="dropdown_content">
                        <a href="/view/Sport/">Sport</a>
                        <a href="/view/Sport/Football">Football</a>
                        <a href="/view/Sport/Golf">Golf</a>
                        <a href="/view/Sport/Badminton">Badminton</a>
                        <a href="/view/Sport/Tennis">Tennis</a>
                        <a href="/view/Sport/Motorsport">Motorsport</a>
                    </div>
                </div> 
                <div>
                    <div class="dropdown" id="dropdown_content-3">Metro<img class="dropdown_icon" src="/assets/img/triangle.png"/></div>
                    <div class="dropdown_content">
                        <a href="/view/Metro/">Metro</a>
                        <a href="/view/Metro/Metro News">Metro News</a>
                        <a href="/view/Metro/Eat And Drink">Eat And Drink</a>
                        <a href="/view/Metro/Focus">Focus</a>
                        <a href="/view/Metro/Views">Views</a>
                    </div>
                </div>
                <div>
                    <div class="dropdown" id="dropdown_content-4">Tech<img class="dropdown_icon" src="/assets/img/triangle.png"/></div>
                    <div class="dropdown_content">
                        <a href="/view/Tech/">Tech</a>
                        <a href="/view/Tech/Tech News">Tech News</a>
                        <a href="/view/Tech/Reviews">Reviews</a>
                        <a href="/view/Tech/Games">Games</a>
                    </div>
                </div>
                <a href="/view/News/Education">Education</a>
                <div>
                    <div class="dropdown" id="dropdown_content-5">Opinion<img class="dropdown_icon" src="/assets/img/triangle.png"/></div>
                    <div class="dropdown_content">
                        <a href="/view/Opinion/">Opinion</a>
                        <a href="/view/Opinion/Columnists">Columnists</a>
                        <a href="/view/Opinion/Letters">Letters</a>
                    </div>
                </div>
            </div>
        </nav>

        <select name="limits" id="news_limits" onchange="limit_news()">
            <option selected="true" disabled="disabled">Limit news shown</option>
            <option value="1/">1</option>
            <option value="2/">2</option>
            <option value="3/">3</option>
            <option value="4/">4</option>
            <option value="5/">5</option>
            <option value="6/">6</option>
            <option value="7/">7</option>
            <option value="8/">8</option>
            <option value="9/">9</option>
            <option value="10/">10</option>
        </select>
        <?php
            if (isset($_GET["view"])) {
                $view = $_GET["view"];
                $sub_base = "";
                $temp_arr;
                switch ($view) {
                    case $accepted_views[0]:
                        $temp_arr = $news_rss;
                        break;
                    case $accepted_views[1]:
                        $temp_arr = $business_rss;
                        break;
                    case $accepted_views[2]:
                        $temp_arr = $sport_rss;
                        break;
                    case $accepted_views[3]:
                        $temp_arr = $metro_rss;
                        break;
                    case $accepted_views[4]:
                        $temp_arr = $tech_rss;
                        break;
                    case $accepted_views[5]:
                        break;
                    case $accepted_views[6]:
                        $temp_arr = $opinion_rss;
                        break;
                    default:
                        redirect_404();
                }
                
                if (isset($_GET["subCategory"])) {
                    $subCategory = $_GET["subCategory"];
                    if ($subCategory == "Main") {
                        create_section($view, "");
                    }else {
                        if (in_array($subCategory, $temp_arr)) {
                            create_section($view, $subCategory);
                        }else {
                            redirect_404();
                        }
                    }
                }else {
                    redirect_404();
                }
            }
        ?>
        <footer>&#169; <a href="https://github.com/Leonlit" target="_blank">Leonlit</a></footer>
    </body>
    <script src="/assets/js/index.js" async defer></script>
</html>

<?php
    function filter_date($date) {
        $date_new = explode(":", $date);
        array_splice($date_new, 1, 2);
        return join(":", $date_new);
    }

    function create_section ($sub_base, $section) {
        $content = simplexml_load_file($GLOBALS["base_url"].$sub_base."/".$section) or die("Error: Cannot create object");
        if ($section != "") {
            echo "<h2>".$section."</h2>";
        }else {
            echo "<h2>".$sub_base."</h2>";
        }
        echo "<div class='news_card_section'>";
        $items = $content->channel->item;
        $counter = 0;
        $limits = 10;

        if (isset($_GET["limit"])) {
            if ($_GET["limit"] == 0) {
                redirect_404();
            }
            $limits = $_GET["limit"];
        }

        foreach ($items as $container_rss) {
            $counter++;
            if ($counter > $limits) {
                break;
            }
            $premium = $container_rss->premium;
            $exclusive = $container_rss->isexclusive;
            $link = $container_rss->link;
            $description = $container_rss->description;
            $title = $container_rss-> title;
            $date = $container_rss -> pubDate;
            $tags = $container_rss -> section;
            $thumbs = $container_rss -> thumb-> attributes() -> url;

            $date_filtered = filter_date($date);
            echo "
                <div class='news_card'>
                    <div class='news_card_subsection'>"."<a target='_blank' href='".$link."'><img src='".$thumbs."'></a>
                        <hr>
                    </div>
                    <div class='news_card_subsection'>
                        <div class='news_card_title'>".$title."</div>";
                        if (isset($premium) || isset($exclusive)) {
                            echo "<div class='news_card_special_tags'>";
                            if ($premium == "True") {
                                echo "<span class='premium_tag'>Premium</span>";
                            }
                            if ($exclusive == "True") {
                                echo "<span>Exclusive</span>";
                            }
                            echo "</div>";
                        }
                        echo "<div class='news_card_description'>".$description."</div>
                        <span class='news_card_tags'>".$tags."</span>
                        <div class='news_card_date'>".$date_filtered."</div>
                    </div>
                </div>
            ";
        }
        echo "</div>";
    }

    function redirect_404(){
        echo "<script> location.replace('/400'); </script>";
    }
?>