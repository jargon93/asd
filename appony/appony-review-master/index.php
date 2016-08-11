<!DOCTYPE HTML>
<!--
	Verti by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Appony: Powered by VAS-MiS</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="homepage">
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("funcs/dbFunctions.php");

echo "<div id=\"page-wrapper\">\n"; 
echo "\n"; 
echo "			<!-- Header -->\n"; 
echo "				<div id=\"header-wrapper\">\n"; 
echo "					<header id=\"header\" class=\"container\">\n"; 
echo "\n"; 
echo "						<!-- Logo -->\n"; 
echo "							<div id=\"logo\">\n"; 
echo "								<h1><a href=\"index.html\">Appony</a></h1>\n"; 
echo "								<span>powered by VAS-MIS</span>\n"; 
echo "							</div>\n"; 
echo "\n"; 
echo "						<!-- Nav -->\n"; 
echo "							<nav id=\"nav\">\n"; 
echo "								<ul>\n"; 
echo "									<li class=\"current\"><a href=\"index.html\">Anasayfa</a></li>\n"; 
echo "									<li>\n"; 
echo "										<a href=\"#\">Turkcell Apps</a>\n"; 
echo "										<ul>\n"; 
echo "											<li><a href=\"#\">Fizy</a></li>\n"; 
echo "											<li><a href=\"#\">Bip</a></li>\n"; 
echo "											<li><a href=\"#\">Akıllı Depo</a></li>\n"; 
echo "											<li><a href=\"#\">Akademi</a></li>\n"; 
echo "\n"; 
echo "\n"; 
echo "											<li>\n"; 
echo "												<a href=\"#\">Diğer</a>\n"; 
echo "												<ul>\n"; 
echo "													<li><a href=\"#\">ÇalarkenDinlet</a></li>\n"; 
echo "													<li><a href=\"#\">Hesabım</a></li>\n"; 
echo "													<li><a href=\"#\">Akademim</a></li>\n"; 
echo "													<li><a href=\"#\">Evim</a></li>\n"; 
echo "													<li><a href=\"#\">Turkcell TV+</a></li>\n"; 
echo "\n"; 
echo "												</ul>\n"; 
echo "											</li>\n"; 
echo "										</ul>\n"; 
echo "									</li>\n"; 
echo "									\n"; 
echo "								</ul>\n"; 
echo "							</nav>\n"; 
echo "\n"; 
echo "					</header>\n"; 
echo "				</div>\n"; 
echo "\n"; 
echo "			<!-- Banner -->\n"; 
echo "				<div id=\"banner-wrapper\">\n"; 
echo "					<div id=\"banner\" class=\"box container\">\n"; 
echo "						<div class=\"row\">\n"; 
echo "							<div class=\"7u 12u(medium)\">\n"; 
echo "								<h2></h2>\n"; 
echo "								<p>Turkcell Uygulamaları Store puan/yorum takip aracı</p>\n"; 
echo "							</div>\n"; 
echo "							<div class=\"5u 12u(medium)\">\n"; 
echo "								<ul>\n"; 
echo "									<li><a href=\"#uygulamalar\" class=\"button big icon fa-arrow-circle-right\">Uygulamalar</a></li>\n"; 
echo "									<li><a href=\"#content\" class=\"button alt big icon fa-question-circle\">Ne işe yarar</a></li>\n"; 
echo "								</ul>\n"; 
echo "							</div>\n"; 
echo "						</div>\n"; 
echo "					</div>\n"; 
echo "				</div>\n"; 
echo "\n"; 
echo "			<!-- Features -->\n"; 
echo "				<div id=\"features-wrapper\">\n"; 
echo "					<div class=\"container\">\n"; 
echo "						<div class=\"row\" name=\"uygulamalar\">\n"; 
echo "							<div class=\"4u 12u(medium)\">\n"; 
echo "\n"; 
echo "								<!-- Box -->\n"; 
										getBoxDetails('fizy');
echo "\n"; 
echo "							</div>\n"; 
echo "							<div class=\"4u 12u(medium)\">\n"; 
echo "\n"; 
echo "								<!-- Box -->\n"; 
									getBoxDetails('bip');
echo "\n"; 
echo "							</div>\n"; 
echo "							<div class=\"4u 12u(medium)\">\n"; 
echo "\n"; 
echo "								<!-- Box -->\n"; 
									getBoxDetails('depo');
echo "\n"; 
echo "							</div>\n"; 
echo "						</div>\n"; 
echo "					</div>\n"; 
echo "				</div>\n"; 
echo "\n"; 


echo "\n"; 
echo "			<!-- Features -->\n"; 
echo "				<div id=\"features-wrapper\">\n"; 
echo "					<div class=\"container\">\n"; 
echo "						<div class=\"row\" name=\"uygulamalar\">\n"; 
echo "							<div class=\"4u 12u(medium)\">\n"; 
echo "\n"; 
echo "								<!-- Box -->\n"; 
									getBoxDetails('hesabim');
echo "\n"; 
echo "							</div>\n"; 
echo "							<div class=\"4u 12u(medium)\">\n"; 
echo "\n"; 
echo "								<!-- Box -->\n";
									getBoxDetails('akademi');
echo "\n"; 
echo "							</div>\n"; 
echo "							<div class=\"4u 12u(medium)\">\n"; 
echo "\n"; 
echo "								<!-- Box -->\n"; 
									getBoxDetails('RBT');
echo "\n"; 
echo "							</div>\n"; 
echo "						</div>\n"; 
echo "					</div>\n"; 
echo "				</div>\n"; 
echo "\n"; 




echo "			<!-- Main -->\n"; 
echo "				<div id=\"main-wrapper\">\n"; 
echo "					<div class=\"container\">\n"; 
echo "						<div class=\"row 200%\">\n"; 
echo "							<div class=\"4u 12u(medium)\">\n"; 
echo "\n"; 
echo "								<!-- Sidebar -->\n"; 
echo "									<div id=\"sidebar\">\n"; 
echo "										<section class=\"widget thumbnails\">\n"; 
echo "											<h3>Kullanılan teknolojiler</h3>\n"; 
echo "											<div class=\"grid\">\n"; 
echo "												<div class=\"row 50%\">\n"; 
echo "													<div class=\"6u\"><a href=\"#\" class=\"image fit\"><img src=\"https://storage.googleapis.com/static.ianlewis.org/prod/img/docker/large_v-trans.png\" alt=\"\" /></a></div>\n"; 
echo "													<div class=\"6u\"><a href=\"#\" class=\"image fit\"><img src=\"https://blog.rosehosting.com/blog/wp-content/uploads/2016/03/build-nginx-with-pagespeed-module.png\" alt=\"\" /></a></div>\n"; 
echo "													<div class=\"6u\"><a href=\"#\" class=\"image fit\"><img src=\"https://cdn2.iconfinder.com/data/icons/ios7-inspired-mac-icon-set/1024/_app_store_5122x.png\" alt=\"\" /></a></div>\n"; 
echo "													<div class=\"6u\"><a href=\"#\" class=\"image fit\"><img src=\"http://cdn.thedroidguy.com/wp-content/uploads/2015/10/pslogo.jpg\" alt=\"\" /></a></div>\n"; 
echo "												</div>\n"; 
echo "											</div>\n"; 
echo "										</section>\n"; 
echo "									</div>\n"; 
echo "\n"; 
echo "							</div>\n"; 
echo "							<div class=\"8u 12u(medium) important(medium)\">\n"; 
echo "\n"; 
echo "								<!-- Content -->\n"; 
echo "									<div id=\"content\">\n"; 
echo "										<section class=\"last\">\n"; 
echo "											<h2>Nasıl geliştirdik, ne işe yarar?</h2>\n"; 
echo "											<p><strong>Appony</strong>,Turkcell uygulamaların store puan ve yorumlarını takip etmek, puan azalış ve artışlarında alarm üretebilmek geliştirilmiş bir uygulamaladır. Uygulama cloud'dan alınan bir sanal sunucu üzerinde; docker kullanılarak oluşturulmuş appony container'inda çalışmaktadır. Nginx web sunucusu üzerinde Itunes ve Google Play Store API'lar ile konuşabilen php tabanlı bir yazılımdır. Trend analizi için veriler mySQL üzerinde depolanmaktadır. Veritabanı da docker üzerinde bir imaj olarak çalıştırılmaktadır.</p>\n"; 
echo "											\n"; 
echo "											<p><a href=\"#uygulamalar\" class=\"button icon fa-arrow-circle-right\"> Tüm Uygulamaları Gör</a></p>\n"; 
echo "\n"; 
echo "										</section>\n"; 
echo "									</div>\n"; 
echo "\n"; 
echo "							</div>\n"; 
echo "						</div>\n"; 
echo "					</div>\n"; 
echo "				</div>\n"; 
echo "\n"; 
echo "\n"; 
echo "\n"; 
echo "</br></br></br>\n"; 
echo "\n"; 


echo "			<!-- Graph IOS-->\n"; 
echo "				<div id=\"banner-wrapper\">\n"; 
echo "					<div id=\"banner\" class=\"box container\">\n"; 
getIosAllTrend();
 
echo "					</div>\n"; 
echo "				</div>\n"; 

echo "</br></br></br>\n"; 

echo "			<!-- Graph Android-->\n"; 
echo "				<div id=\"banner-wrapper\">\n"; 
echo "					<div id=\"banner\" class=\"box container\">\n"; 
//getAndroidAllTrend();
echo "					</div>\n"; 
echo "				</div>\n"; 

echo "			<!-- Footer -->\n"; 
echo "				<div id=\"footer-wrapper\">\n"; 
echo "					<footer id=\"footer\" class=\"container\">\n"; 
echo "						<div class=\"row\">\n"; 
echo "							<div class=\"8u 12u(medium) 12u$(small)\">\n"; 
echo "\n"; 
echo "								<!-- Links -->\n"; 
echo "									<section class=\"widget links\">\n"; 
echo "										<h3>Appony Hakkında</h3>\n"; 
echo "										<ul class=\"style2\">\n"; 
echo "											<li>Turkcell VAS Yazılım Geliştirme Kulübü tarafından, 2016 GNCYTNK Staj programı Yeni Nesil Teknolojiler dersi kapsamında geliştirilmiştir.</li>\n"; 
echo "										</ul>\n"; 
echo "									</section>\n"; 
echo "\n"; 
echo "							</div>\n"; 
echo "							<div class=\"3u 6u$(medium) 12u$(small)\">\n"; 
echo "\n"; 
echo "								<!-- Contact -->\n"; 
echo "									<section class=\"widget contact last\">\n"; 
echo "										<h3>Bize Ulaşın</h3>\n"; 
echo "										<ul>\n"; 
echo "											<li><a href=\"#\" class=\"icon fa-twitter\"><span class=\"label\">Twitter</span></a></li>\n"; 
echo "											<li><a href=\"#\" class=\"icon fa-facebook\"><span class=\"label\">Facebook</span></a></li>\n"; 
echo "											<li><a href=\"#\" class=\"icon fa-instagram\"><span class=\"label\">Instagram</span></a></li>\n"; 
echo "											<li><a href=\"#\" class=\"icon fa-dribbble\"><span class=\"label\">Dribbble</span></a></li>\n"; 
echo "											<li><a href=\"#\" class=\"icon fa-pinterest\"><span class=\"label\">Pinterest</span></a></li>\n"; 
echo "										</ul>\n"; 
echo "										<p>Turkcell Teknoloji Plaza<br />\n"; 
echo "										Soğanlık Kartal<br />\n"; 
echo "										05322100000</p>\n"; 
echo "									</section>\n"; 
echo "\n"; 
echo "							</div>\n"; 
echo "						</div>\n"; 
echo "						<div class=\"row\">\n"; 
echo "							<div class=\"12u\">\n"; 
echo "								<div id=\"copyright\">\n"; 
echo "									<ul class=\"menu\">\n"; 
echo "										<li>&copy; Appony. All rights reserved</li><li>Design: HTML5 UP / Verti</li>\n"; 
echo "									</ul>\n"; 
echo "								</div>\n"; 
echo "							</div>\n"; 
echo "						</div>\n"; 
echo "					</footer>\n"; 
echo "				</div>\n"; 
echo "\n"; 
echo "			</div>\n"; 
echo "\n"; 
echo "		<!-- Scripts -->\n"; 
echo "\n"; 
echo "			<script src=\"assets/js/jquery.min.js\"></script>\n"; 
echo "			<script src=\"assets/js/jquery.dropotron.min.js\"></script>\n"; 
echo "			<script src=\"assets/js/skel.min.js\"></script>\n"; 
echo "			<script src=\"assets/js/util.js\"></script>\n"; 
echo "			<!--[if lte IE 8]><script src=\"assets/js/ie/respond.min.js\"></script><![endif]-->\n"; 
echo "			<script src=\"assets/js/main.js\"></script>\n";


?>
	</body>
</html>