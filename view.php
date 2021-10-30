<?php
    $base_url = "https://www.thestar.com.my/rss/";
    $accepted_views = array("news", "sport", "metro", "education", "businesss", "tech", "opinion");
    $news_rss = array( "Nation", "Regional", "World", "Environment", "In Other Media", "True Or Not");
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
    </head>
    <body>
    <?php

    if (isset($_GET["view"])) {
        $view = $_GET["view"];
        $sub_base = "";
        $temp_arr;
        switch ($view) {
            case "news":
                $sub_base = "News";
                $temp_arr = $news_rss;
                break;
            case "business":
                $sub_base = "Business";
                $temp_arr = $business_rss;
                break;
            case "sport":
                $sub_base = "Sport";
                $temp_arr = $sport_rss;
                break;
            case "metro":
                $sub_base = "Metro";
                $temp_arr = $metro_rss;
                break;
            case "tech":
                $sub_base = "Tech";
                $temp_arr = $tech_rss;
                break;
            case "education":
                $sub_base = "Education";
                break;
            case "opinion":
                $sub_base = "Opinion";
                $temp_arr = $opinion_rss;
                break;
            default:
                //redirect to 404 page
        }
        
        if (isset($_GET["subCategory"])) {
            $subCategory = $_GET["subCategory"];
            if (in_array($subCategory, $temp_arr)) {
                create_section($sub_base, $subCategory);
            }
        }else {
            create_section($sub_base, "");
        }
    }
    ?>
    </body>
</html>

<?php
    function filter_date($date) {
        $date_new = explode(":", $date);
        array_splice($date_new, 1, 2);
        return join(":", $date_new);
    }

    function create_section ($sub_base, $section) {
        $content = simplexml_load_file($GLOBALS["base_url"].$sub_base."/".$section) or die("Error: Cannot create object");
        echo "<div class='news_card_section'>";
        $items = $content->channel->item;
        if ($section `!= "") {
            echo "<h2>".$section."</h2>";
        }else {
            echo "<h2>".$section."</h2>";
        }
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