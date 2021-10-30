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
        $base_url = "https://www.thestar.com.my/rss/";
        $accepted_views = array("news", "sport", "metro", "education", "businesss", "tech", "opinion");
        $news_rss = array("/", "/Nation", "/Regional", "/World", "/Environment", "/In Other Media", "/True Or Not");
        $business_rss = array("/", "/Business News", "/SMEBiz");
        $sport_rss = array("/", "/Football", "/Golf", "/Badminton", "/Tennis", "/Motorsport");
        $metro_rss = array("/", "/Metro News", "/Eat And Drink", "/Focus", "/Views");
        $tech_rss = array("/", "/Tech News", "/Reviews", "/Games");
        $opinion_rss = array("/", "/Columnists", "/Letters");
        $education_rss = array("/");

        if ($view === "news") {
            $sub_base = "News";
            foreach ($news_rss as $section) {
                create_section($sub_base, $section);
            }
        }
    }
    ?>
    </body>
</html>

<?php

function print_title ($string) {
    return substr($string, 1);
}

function create_section ($sub_base, $section) {
    $content = simplexml_load_file($GLOBALS["base_url"].$sub_base.$section) or die("Error: Cannot create object");
    echo "<div class='news_card_section'>";
    $items = $content->channel->item;
    $sectionTitle = print_title($section);
    if ($sectionTitle != "") {
        echo "<h2>".$sectionTitle."</h2>";
    }
    foreach ($items as $container_rss) {
        $premium = $container_rss->premium;
        $exclusive = $container_rss->isexclusive;
        $link = $container_rss->link;
        $description = $container_rss->description;
        $title = $container_rss-> title;
        $date = $container_rss -> pubDate;
        $lead = $container_rss -> lead;
        $tags = $container_rss -> section;
        echo "
            <div class='news_card'>
                <div class='news_card_subsection'>"."<a target='_blank' href='".$link."'>".$lead."</a>
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
                    <div class='news_card_date'>".$date."</div>
                </div>
            </div>
        ";
    }
    echo "</div>";
}
?>