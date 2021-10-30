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
        <link rel="stylesheet" href="assets/css/mobile.css">
        <link rel="stylesheet" href="assets/css/tablet.css">
        <link rel="stylesheet" href="assets/css/desktop.css">
    </head>
    <body>
    <nav>
            <div id="navbar">
                <div id="title"><a href="./index.html">TheStar RSS Reader</a></div>
                <div class="nav_indicator" onclick="open_close_nav()">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <div id="nav_items_container">
                <a href="./index.html">Home</a>
                <div>
                    <div class="dropdown">News<img class="dropdown_icon" src="assets/img/triangle.png"/></div>
                    <div class="dropdown_content">
                        <a href="view.php?view=News">News</a>
                        <a href="view.php?view=News&subCategory=Nation">Nation</a>
                        <a href="view.php?view=News&subCategory=Regional">Regional</a>
                        <a href="view.php?view=News&subCategory=World">World</a>
                        <a href="view.php?view=News&subCategory=Environment">Environment</a>
                        <a href="view.php?view=News&subCategory=In Other Media">In Other Media</a>
                        <a href="view.php?view=News&subCategory=True Or Not">True Or Not</a>
                    </div>
                </div>
                <div>
                    <div class="dropdown">Business<img class="dropdown_icon" src="assets/img/triangle.png"/></div>
                    <div class="dropdown_content">
                        <a href="view.php?view=Business">Business</a>
                        <a href="view.php?view=Business&subCategory=Business News">Business News</a>
                        <a href="view.php?view=Business&subCategory=SMEBiz">SMEBiz</a>
                    </div>
                </div>
                <div>
                    <div class="dropdown">Sport<img class="dropdown_icon" src="assets/img/triangle.png"/></div>
                    <div class="dropdown_content">
                        <a href="view.php?view=Sport">Sport</a>
                        <a href="view.php?view=Sport&subCategory=Football">Football</a>
                        <a href="view.php?view=Sport&subCategory=Golf">Golf</a>
                        <a href="view.php?view=Sport&subCategory=Badminton">Badminton</a>
                        <a href="view.php?view=Sport&subCategory=Tennis">Tennis</a>
                        <a href="view.php?view=Sport&subCategory=Motorsport">Motorsport</a>
                    </div>
                </div> 
                <div>
                    <div class="dropdown">Metro<img class="dropdown_icon" src="assets/img/triangle.png"/></div>
                    <div class="dropdown_content">
                        <a href="view.php?view=Metro">Metro</a>
                        <a href="view.php?view=Metro&subCategory=Metro News">Metro News</a>
                        <a href="view.php?view=Metro&subCategory=Eat And Drink">Eat And Drink</a>
                        <a href="view.php?view=Metro&subCategory=Focus">Focus</a>
                        <a href="view.php?view=Metro&subCategory=Views">Views</a>
                    </div>
                </div>
                <div>
                    <div class="dropdown">Tech<img class="dropdown_icon" src="assets/img/triangle.png"/></div>
                    <div class="dropdown_content">
                        <a href="view.php?view=Tech">Tech</a>
                        <a href="view.php?view=Tech&subCategory=Tech News">Tech News</a>
                        <a href="view.php?view=Tech&subCategory=Reviews">Reviews</a>
                        <a href="view.php?view=Tech&subCategory=Games">Games</a>
                    </div>
                </div>
                <a href="view.php?view=News&subCategory=Education">Education</a>
                <div>
                    <div class="dropdown">Opinion<img class="dropdown_icon" src="assets/img/triangle.png"/></div>
                    <div class="dropdown_content">
                        <a href="view.php?view=Opinion">Opinion</a>
                        <a href="view.php?view=Opinion&subCategory=Columnists">Columnists</a>
                        <a href="view.php?view=Opinion&subCategory=Letters">Letters</a>
                    </div>
                </div>
            </div>
        </nav>
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
                        //redirect to 404 page
                }
                
                if (isset($_GET["subCategory"])) {
                    $subCategory = $_GET["subCategory"];
                    if (in_array($subCategory, $temp_arr)) {
                        create_section($view, $subCategory);
                    }else {
                        //redirect to 404
                    }
                }else {
                    create_section($view, "");
                }
            }
        ?>
    </body>
    <script src="assets/js/index.js" async defer></script>
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
        
        foreach ($items as $container_rss) {
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
?>