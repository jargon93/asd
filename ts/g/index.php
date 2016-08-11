<?php
require 'flight/Flight.php';
require 'flight/simple_html_dom.php';
require 'flight/playUp.php';

use flight\playUp;

Flight::route('/get/reviews/@package/@lang', function($package,$lang){
    playUp::reviewscheck($package,$lang);
});

Flight::route('/get/package/@package/@lang', function($package,$lang){
    playUp::packagecheck($package,$lang);
});

Flight::map('notFound', function () {
	Flight::redirect("/");
});

Flight::start();