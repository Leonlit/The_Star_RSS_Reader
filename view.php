<?php
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
        //foreach ($news_rss as $section) {
            create_section($sub_base, $news_rss[0]);
        //}
    }

    function create_section ($sub_base, $section) {
        $content = simplexml_load_file($GLOBALS["base_url"].$sub_base.$section) or die("Error: Cannot create object");
        $container_rss = $content->channel->item[0];
        //var_dump($container_rss);
        echo $container_rss-> lead;
        /* for ($count = 0; $count < 10; $count++) {
            $container_rss = $content->channel->item[$count];
            $premium = $container_rss->premium;
            $exclusive = $container_rss->isexclusive;
            $link = $container_rss->link;
            $description = $container_rss->description
            $title = $container_rss-> title;
            $date = $container_rss -> pubDate
            $lead = $container_rss -> lead
            $tags = $container_rss -> section

        } */
    }
?>