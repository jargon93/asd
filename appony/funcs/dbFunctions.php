<?php
require("config.inc.php");
require("Database.class.php");

$servername='localhost';
$username='appony'; 
$password='appony1020';
$dbname='appony';

function createRatingRecord($appID,$raterCount,$rating)
{
echo "</br>INFO-DB IOS Values-appid: ".$appID;
echo "</br>INFO-DB IOS Values-rater num: ".$raterCount;
echo "</br>INFO-DB IOS Values-rating: ".$rating;;
$servername='46.101.113.44';
$username='appony'; 
$password='appony1020';
$dbname='appony';
$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "INSERT INTO appony.`app_rating_history` (`app_id`, `rater_num`, `rating`) VALUES ('".$appID."', '".$raterCount."', '".$rating."');";

	if ($conn->query($sql) === TRUE) {
    	echo "</br>INFO: New record created successfully";
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
}

function createAndroidRatingRecord($appname,$raterCount,$rating)
{
echo "</br>INFO-DB Android Values-appname: ".$appname;
echo "</br>INFO-DB Android Values-rater num: ".$raterCount;
echo "</br>INFO-DB Android Values-rating: ".$rating;;
$servername='46.101.113.44';
$username='appony'; 
$password='appony1020';
$dbname='appony';
$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "INSERT INTO appony.`android_app_rating_history` (`app_name`, `rater_num`, `rating`) VALUES ('".$appname."', '".$raterCount."', '".$rating."');";

	if ($conn->query($sql) === TRUE) {
    	echo "</br>INFO: New record created successfully";
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
}




function createApp($appID,$appName,$androidName)
{
$servername='46.101.113.44';
$username='appony'; 
$password='appony1020';
$dbname='appony';
$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "INSERT INTO appony.`app_list` (`appid`, `appname`,`android_name`) VALUES ('".$appID."', '".$appName."','".$androidName."');";

	if ($conn->query($sql) === TRUE) {
    	echo "</br>INFO: New record created successfully</br>";
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();

}

function getAndroidRating($appname){

$servername='46.101.113.44';
$username='appony'; 
$password='appony1020';
$dbname='appony';
$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "select app_name, rating, rater_num from appony.android_app_rating_history a WHERE a.app_name='".$appname."' and rate_date in (
select max(rate_date) from appony.android_app_rating_history where app_name='".$appname."');
";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$raterCount=$row["rater_num"];
    	$rating=$row["rating"];
    }

	$conn->close();
	return $rating;
}

}

function getAndroidRaterNum($appname){
$servername='46.101.113.44';
$username='appony'; 
$password='appony1020';
$dbname='appony';
$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "select app_name, rating, rater_num from appony.android_app_rating_history a WHERE a.app_name='".$appname."' and rate_date in (
select max(rate_date) from appony.android_app_rating_history where app_name='".$appname."');
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$raterCount=$row["rater_num"];
    	$rating=$row["rating"];
    }

	$conn->close();
	return $raterCount;
}
}


function getIOSRaterNum($appname){
$servername='46.101.113.44';
$username='appony'; 
$password='appony1020';
$dbname='appony';

$iosID=getIosID($appname);

$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "select app_id, rating, rater_num from appony.app_rating_history a WHERE a.app_id='".$iosID."' and rate_date in (
select max(rate_date) from appony.app_rating_history where app_id='".$iosID."')";

//echo $sql;

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$raterCount=$row["rater_num"];
    	$rating=$row["rating"];
    }
	$conn->close();
	return $raterCount;
}
}

function getImageUrl($appname){
$servername='46.101.113.44';
$username='appony'; 
$password='appony1020';
$dbname='appony';
$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "select appid from appony.app_list a WHERE a.appname='".$appname."'";


$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$appIosID=$row["appid"];
    }

$fizyUrl='http://itunes.apple.com/lookup?id='.$appIosID.'&country=tr';
$fizyGet = file_get_contents($fizyUrl);
$fizyJson=json_decode($fizyGet);
$fizyImageURL=$fizyJson->results[0]->artworkUrl512;
$fizyRating=$fizyJson->results[0]->averageUserRating;
$fizyRaterNum=$fizyJson->results[0]->userRatingCount;
$fizyCurrentRating=$fizyJson->results[0]->averageUserRatingForCurrentVersion;
$fizyCurrentRaterNum=$fizyJson->results[0]->userRatingCountForCurrentVersion;


	$conn->close();
	return $fizyImageURL;
}
}





function getIOSRating($appname){
$servername='46.101.113.44';
$username='appony'; 
$password='appony1020';
$dbname='appony';

$iosID=getIosID($appname);

$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "select app_id, rating, rater_num from appony.app_rating_history a WHERE a.app_id='".$iosID."' and rate_date in (
select max(rate_date) from appony.app_rating_history where app_id='".$iosID."')";


$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$raterCount=$row["rater_num"];
    	$rating=$row["rating"];
    }
	$conn->close();
	return $rating;
}
}



function getAndroidTRend($appName){
$servername='46.101.113.44';
$username='appony'; 
$password='appony1020';
$dbname='appony';
$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "select rating,rater_num, format(date_format(rate_date,'%m'),'0') ay, format(date_format(rate_date,'%d'),'0') gun,
			date_format(rate_date,'%Y') yil from appony.android_app_rating_history a WHERE a.app_name='".$appName."';";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $trendData="{ x: new Date(2016,7,3), y: 0 }";
    $raterData="{ x: new Date(2016,7,3), y: 0 }";

//{ x: new Date(2010,1,3), y: 510 },\n"; 
    while($row = $result->fetch_assoc()) {
    	$ay=$row["ay"]-1;
    	$trendData=$trendData.",{ x: new Date(".$row["yil"].",".$ay.",".$row["gun"]."), y: ".$row["rating"]."}";
    	//$raterData=$raterData."</br>,{ x: '".$row["dater"]."', y: ".$row["rater_num"]."}";
    }

	$conn->close();
	//echo $trendData.'</br>';
	//echo $raterData.'</br>';
	return $trendData;

}

}

function getIosID($appName){
$servername='46.101.113.44';
$username='appony'; 
$password='appony1020';
$dbname='appony';
$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 
			$sql = "select appid from appony.app_list a WHERE a.appname='".$appName."';";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$appIosID=$row["appid"];
		    }

		    }

	$conn->close();
	//echo $trendData.'</br>';
	//echo $raterData.'</br>';
	return $appIosID;

}


function getIosTRend($appName){
$servername='46.101.113.44';
$username='appony'; 
$password='appony1020';
$dbname='appony';
$conn = new mysqli($servername, $username, $password, $dbname);

$appIosID=getIosID($appName);

	//echo "</br>apple name: ".$appName;

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	//echo "</br>apple ID: ".$appIosID;
	$sql = "select rating,rater_num, format(date_format(rate_date,'%m'),'0') ay, format(date_format(rate_date,'%d'),'0') gun,
			date_format(rate_date,'%Y') yil from appony.app_rating_history a WHERE a.app_id='".$appIosID."';";
//echo "</br> SQL: ".$sql;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $trendData="{ x: new Date(2016,7,2), y: 0 }";
    $raterData="{ x: new Date(2016,7,2), y: 0 }";

//{ x: new Date(2010,1,3), y: 510 },\n"; 
    while($row = $result->fetch_assoc()) {
    	$ay=$row["ay"]-1;
    	$trendData=$trendData.",{ x: new Date(".$row["yil"].",".$ay.",".$row["gun"]."), y: ".$row["rating"]."}";
    	//$raterData=$raterData."</br>,{ x: '".$row["dater"]."', y: ".$row["rater_num"]."}";
    }

	$conn->close();
	//echo $trendData.'</br>';
	//echo $raterData.'</br>';
	return $trendData;

}

}



function getBoxDetails($appName){
$iosRating=getIOSRating($appName);
$iosRaterNum=getIOSRaterNum($appName);
$AndroidRating=getAndroidRating($appName);
$AndroidRaterNum=getAndroidRaterNum($appName);
$ImageURL=getImageUrl($appName);
echo "									<section class=\"box feature\">\n"; 
echo "										<a href=\"#\" class=\"image featured\"><img src=\"".$ImageURL."\" alt=\"\" /></a>\n"; 
echo "										<div class=\"inner\">\n"; 
echo "											<header>\n"; 
echo "												<center><h2>".$appName."</h2></center>\n"; 
echo "												<p><p><center><a class=\"button big icon fa-apple\">".$iosRating."</a>
																			<a class=\"button big icon fa-android\">".$AndroidRating."</a>
																			</p></center> </p>\n"; 
echo "											</header>\n"; 
echo "											<p>".$appName." Apple Store'da <b>".$iosRaterNum." </b> , Google Play'de  <b>".$AndroidRaterNum."</b> kullanıcı tarafından değerlendirilmiştir </p>\n"; 
echo "										</div>\n"; 
echo "									</section>\n"; 
}



function getIosAllTrend(){

$fizyTrend=getIosTRend('fizy');
$bipTrend=getIosTRend('bip');
$depoTrend=getIosTRend('depo');
echo "  <script type=\"text/javascript\">\n"; 
echo "  window.onload = function () {\n"; 
echo "      var chartIOS = new CanvasJS.Chart(\"chartContainerIOS\",\n"; 
echo "      {\n"; 
echo "\n"; 
echo "          title:{\n"; 
echo "              text: \"IOS App Store Rating Trend\",\n"; 
echo "              fontSize: 30\n"; 
echo "          },\n"; 
echo "                        animationEnabled: true,\n"; 
echo "          axisX:{\n"; 
echo "\n"; 
echo "              gridColor: \"Yellow\",\n"; 
echo "              tickColor: \"silver\",\n"; 
echo "              valueFormatString: \"DD/MMM\"\n"; 
echo "\n"; 
echo "          },                        \n"; 
echo "                        toolTip:{\n"; 
echo "                          shared:true\n"; 
echo "                        },\n"; 
echo "          theme: \"theme1\",\n"; 
echo "          axisY: {\n"; 
echo "              gridColor: \"Silver\",\n"; 
echo "              tickColor: \"silver\"\n"; 
echo "          },\n"; 
echo "          legend:{\n"; 
echo "              verticalAlign: \"center\",\n"; 
echo "              horizontalAlign: \"right\"\n"; 
echo "          },\n"; 
echo "          data: [\n"; 
echo "          {        \n"; 
echo "              type: \"line\",\n"; 
echo "              showInLegend: true,\n"; 
echo "              lineThickness: 2,\n"; 
echo "              name: \"Fizy\",\n"; 
echo "              markerType: \"square\",\n"; 
echo "              color: \"#F08080\",\n"; 
echo "              dataPoints: [\n"; 
echo $fizyTrend;
echo "              ]\n"; 
echo "          },\n"; 
echo "          {        \n"; 
echo "              type: \"line\",\n"; 
echo "              showInLegend: true,\n"; 
echo "              name: \"Bip\",\n"; 
echo "              color: \"#20B2AA\",\n"; 
echo "              markerType: \"triangle\",\n"; 
echo "              lineThickness: 2,\n"; 
echo "\n"; 
echo "              dataPoints: [\n"; 
echo $bipTrend;
//  echo "              { x: new Date(2016,08,02), y: 510 },\n"; 
//  echo "              { x: new Date(2016,08,03), y: 560 },\n"; 
//  echo "              { x: new Date(2016,08,04), y: 540 },\n"; 
// echo "               { x: new Date(2016,08,05), y: 558 }\n"; 
echo "              ]\n"; 
echo "          },\n"; 
echo "          {           \n"; 
echo "              type: \"line\",\n"; 
echo "              showInLegend: true,\n"; 
echo "              name: \"Depo\",\n"; 
echo "              color: \"#00B2FF\",\n"; 
echo "              lineThickness: 2,\n"; 
echo "\n"; 
echo "              dataPoints: [\n"; 
echo $depoTrend;
//  echo "              { x: new Date(2016,08,02), y: 410 },\n"; 
//  echo "              { x: new Date(2016,08,03), y: 660 },\n"; 
//  echo "              { x: new Date(2016,08,04), y: 740 },\n"; 
// echo "               { x: new Date(2016,08,05), y: 858 }\n"; 
echo "              ]\n"; 
echo "          }\n"; 
echo "          \n"; 
echo "          ],\n"; 
echo "          legend:{\n"; 
echo "            cursor:\"pointer\",\n"; 
echo "            itemclick:function(e){\n"; 
echo "              if (typeof(e.dataSeries.visible) === \"undefined\" || e.dataSeries.visible) {\n"; 
echo "                  e.dataSeries.visible = false;\n"; 
echo "              }\n"; 
echo "              else{\n"; 
echo "                e.dataSeries.visible = true;\n"; 
echo "              }\n"; 
echo "              chartIOS.render();\n"; 
echo "            }\n"; 
echo "          }\n"; 
echo "      });\n"; 
echo "\n"; 
echo "chartIOS.render();\n"; 
echo "}\n"; 
echo "</script>\n"; 
echo "<script type=\"text/javascript\" src=\"https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js\"></script>\n"; 
echo "\n"; 
echo "  <div id=\"chartContainerIOS\" style=\"height: 300px; width: 95%;\">\n"; 
echo "  </div>\n"; 

}


function getAndroidAllTrend(){

$fizyTrend=getAndroidTRend('fizy');
$bipTrend=getAndroidTRend('bip');
$depoTrend=getAndroidTRend('depo');
$akademiTrend=getAndroidTRend('akademi');
echo "  <script type=\"text/javascript\">\n"; 
echo "  window.onload = function () {\n"; 
echo "      var chart2 = new CanvasJS.Chart(\"chartContainer2\",\n"; 
echo "      {\n"; 
echo "\n"; 
echo "          title:{\n"; 
echo "              text: \"IOS App Store Rating Trend\",\n"; 
echo "              fontSize: 30\n"; 
echo "          },\n"; 
echo "                        animationEnabled: true,\n"; 
echo "          axisX:{\n"; 
echo "\n"; 
echo "              gridColor: \"Yellow\",\n"; 
echo "              tickColor: \"silver\",\n"; 
echo "              valueFormatString: \"DD/MMM\"\n"; 
echo "\n"; 
echo "          },                        \n"; 
echo "                        toolTip:{\n"; 
echo "                          shared:true\n"; 
echo "                        },\n"; 
echo "          theme: \"theme1\",\n"; 
echo "          axisY: {\n"; 
echo "              gridColor: \"Silver\",\n"; 
echo "              tickColor: \"silver\"\n"; 
echo "          },\n"; 
echo "          legend:{\n"; 
echo "              verticalAlign: \"center\",\n"; 
echo "              horizontalAlign: \"right\"\n"; 
echo "          },\n"; 
echo "          data: [\n"; 
echo "          {        \n"; 
echo "              type: \"line\",\n"; 
echo "              showInLegend: true,\n"; 
echo "              lineThickness: 2,\n"; 
echo "              name: \"Fizy\",\n"; 
echo "              markerType: \"square\",\n"; 
echo "              color: \"#F08080\",\n"; 
echo "              dataPoints: [\n"; 
echo $fizyTrend;
echo "              ]\n"; 
echo "          },\n"; 
echo "          {        \n"; 
echo "              type: \"line\",\n"; 
echo "              showInLegend: true,\n"; 
echo "              name: \"Bip\",\n"; 
echo "              color: \"#20B2AA\",\n"; 
echo "              markerType: \"triangle\",\n"; 
echo "              lineThickness: 2,\n"; 
echo "\n"; 
echo "              dataPoints: [\n"; 
echo $bipTrend;
//  echo "              { x: new Date(2016,08,02), y: 510 },\n"; 
//  echo "              { x: new Date(2016,08,03), y: 560 },\n"; 
//  echo "              { x: new Date(2016,08,04), y: 540 },\n"; 
// echo "               { x: new Date(2016,08,05), y: 558 }\n"; 
echo "              ]\n"; 
echo "          },\n";
echo "          {        \n"; 
echo "              type: \"line\",\n"; 
echo "              showInLegend: true,\n"; 
echo "              name: \"Akademi\",\n"; 
echo "              color: \"#20B2AA\",\n"; 
echo "              markerType: \"triangle\",\n"; 
echo "              lineThickness: 2,\n"; 
echo "\n"; 
echo "              dataPoints: [\n"; 
echo $akademiTrend;
//  echo "              { x: new Date(2016,08,02), y: 510 },\n"; 
//  echo "              { x: new Date(2016,08,03), y: 560 },\n"; 
//  echo "              { x: new Date(2016,08,04), y: 540 },\n"; 
// echo "               { x: new Date(2016,08,05), y: 558 }\n"; 
echo "              ]\n"; 
echo "          },\n";  
echo "          {           \n"; 
echo "              type: \"line\",\n"; 
echo "              showInLegend: true,\n"; 
echo "              name: \"Depo\",\n"; 
echo "              color: \"#00B2FF\",\n"; 
echo "              lineThickness: 2,\n"; 
echo "\n"; 
echo "              dataPoints: [\n"; 
echo $depoTrend;
//  echo "              { x: new Date(2016,08,02), y: 410 },\n"; 
//  echo "              { x: new Date(2016,08,03), y: 660 },\n"; 
//  echo "              { x: new Date(2016,08,04), y: 740 },\n"; 
// echo "               { x: new Date(2016,08,05), y: 858 }\n"; 
echo "              ]\n"; 
echo "          }\n"; 
echo "          \n"; 
echo "          ],\n"; 
echo "          legend:{\n"; 
echo "            cursor:\"pointer\",\n"; 
echo "            itemclick:function(e){\n"; 
echo "              if (typeof(e.dataSeries.visible) === \"undefined\" || e.dataSeries.visible) {\n"; 
echo "                  e.dataSeries.visible = false;\n"; 
echo "              }\n"; 
echo "              else{\n"; 
echo "                e.dataSeries.visible = true;\n"; 
echo "              }\n"; 
echo "              chart2.render();\n"; 
echo "            }\n"; 
echo "          }\n"; 
echo "      });\n"; 
echo "\n"; 
echo "chart2.render();\n"; 
echo "}\n"; 
echo "</script>\n"; 
echo "<script type=\"text/javascript\" src=\"https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js\"></script>\n"; 
echo "\n"; 
echo "  <div id=\"chartContainer2\" style=\"height: 300px; width: 95%;\">\n"; 
echo "  </div>\n"; 

}


?>