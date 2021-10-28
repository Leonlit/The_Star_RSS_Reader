<?php
    $view = $_GET["view"];
    $accepted_views = array("news", "sport", "metro", "education", "businesss", "tech", "opinion");
    $news_rss = array("/", "/Nation", "/Regional", "/World", "/Environment", "/In%20Other%20Media", "/True%20Or%20Not");
    $business_rss = array("/", "/Business%20News", "/SMEBiz");
    $sport_rss = array("/", "/Football", "/Golf", "/Badminton", "/Tennis", "/Motorsport");
    $metro_rss = array("/", "/Metro%20News", "/Eat%20And%20Drink", "/Focus", "/Views");
    $tech_rss = array("/", "/Tech%20News", "/Reviews", "/Games");
    $opinion_rss = array("/", "/Columnists", "/Letters");
    $education_rss = array("/");

    if (in_array($view, $accepted_views)) {

    }
?>