<?php

namespace flight;

use Flight;

class playUp {

    public static function reviewscheck($package,$lang) {

        header('Content-Type: application/json; charset=utf-8');
        $header [] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
        $header [] = "Content-Type: application/x-www-form-urlencoded;charset=utf-8";
        $header [] = "Host: play.google.com";
        $header [] = "Pragma: no-cache";
        $header [] = "Referer: https://play.google.com/store/apps/details?id=".$package;
        $user_agent='User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:25.0) Gecko/20100101 Firefox/25.0';
        $ch = curl_init("https://play.google.com/store/getreviews?authuser=0");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header );
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "reviewType=0&pageNum=0&id=".$package."&reviewSortOrder=0&token=1&xhr=1&hl=".$lang);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($ch);
        curl_close($ch);
        preg_match("/\"ecr\",[0-9],\"(.*)\",0/", $return, $data);

        $yorumlar = str_replace('\"','',preg_replace_callback('/\\\\u([0-9a-f]{4})/i', function ($match) {
            return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
        }, $data[1]));

        $html = str_get_html($yorumlar);
        $reviews = array();
        foreach($html->find('.single-review') AS $veri) {
            $tekilyorum = str_get_html($veri);
            $kullaniciID = explode("?id=",$tekilyorum->find('a',0)->href)[1];
            $kullaniciAdi = strip_tags($tekilyorum->find('.author-name',0));
            $title = strip_tags($tekilyorum->find('.review-title',0));
            $yorum = strip_tags(explode("<div class",explode("</span>",$tekilyorum->find('.review-body',0))[1])[0]);
            $yildiz = explode("%;>",explode('width:',$tekilyorum->find('.current-rating',0))[1])[0];
            if($yildiz <= 100 && $yildiz >= 80)
                $yildiz = 5;
            else if($yildiz < 80 && $yildiz >= 60)
                $yildiz = 4;
            else if($yildiz < 60 && $yildiz >= 40)
                $yildiz = 3;
            else if($yildiz < 40 && $yildiz >= 20)
                $yildiz = 2;
            else if($yildiz < 20 && $yildiz >= 0)
                $yildiz = 1;
            $reviews[] = array(
                "userID"    => trim($kullaniciID),
                "userName"  => trim($kullaniciAdi),
                "title"     => trim($title),
                "content"   => trim($yorum),
                "star"      => trim($yildiz)
            );

        }

        Flight::json(array("status" => 1,"data" => $reviews));

	}

    public static function packagecheck($package,$lang) {

        header('Content-Type: application/json; charset=utf-8');
        $header [] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
        $header [] = "Content-Type: application/x-www-form-urlencoded;charset=utf-8";
        $header [] = "Host: play.google.com";
        $header [] = "Pragma: no-cache";
        $header [] = "Referer: https://play.google.com/store/apps/details?id=".$package."&authuser=0&hl=tr";
        $user_agent='User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:25.0) Gecko/20100101 Firefox/25.0';
        $ch = curl_init("https://play.google.com/store/apps/details?id=".$package."&authuser=0&hl=".$lang);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header );
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($ch);
        curl_close($ch);

        $html = str_get_html($return);

        $title = trim(strip_tags($html->find('.id-app-title',0)));
        $resim = "https:".trim($html->find('.cover-image',0)->src);
        $yapimci = trim(strip_tags($html->find('.left-info .primary',0)));
        $kategori = trim(strip_tags($html->find('.left-info .category',0)));
        $puanverentoplam = trim(strip_tags($html->find('.right-info .rating-count',0)));
        $download = trim(strip_tags($html->find('.details-section-contents .meta-info .content',2)));
        $aciklama = trim(strip_tags($html->find('.details-section-contents .show-more-content',0)));
        $yildiz = trim(explode("%;",explode('width:',$html->find('.current-rating',0))[1])[0]);
        if($yildiz <= 100 && $yildiz >= 80)
            $yildiz = 5;
        else if($yildiz < 80 && $yildiz >= 60)
            $yildiz = 4;
        else if($yildiz < 60 && $yildiz >= 40)
            $yildiz = 3;
        else if($yildiz < 40 && $yildiz >= 20)
            $yildiz = 2;
        else if($yildiz < 20 && $yildiz >= 0)
            $yildiz = 1;

        $uygulama = array(
            "name"          => $title,
            "image"         => $resim,
            "developer"     => $yapimci,
            "category"      => $kategori,
            "star"          => $yildiz,
            "ratingCount"   => $puanverentoplam,
            "downloadCount" => $download,
            "description"   => $aciklama
        );

        Flight::json(array("status" => 1, "data" => $uygulama));

	}

}