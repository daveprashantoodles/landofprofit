<?php
if (session_status() === PHP_SESSION_NONE) {
    @session_start();
}
$con = mysqli_connect("localhost", "root", "", "land_of_profit");

function random_generator($length) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}

function check_input($con, $data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = addslashes($data);
  $data = mysqli_real_escape_string($con, $data);
  return $data;
}

function check_textinput($con, $data) {
  $data = trim($data);
  $data = htmlspecialchars($data);
  $data = mysqli_real_escape_string($con, $data);
  return $data;
}

function getRealIpAddr(){
  if (!empty($_SERVER['HTTP_CLIENT_IP']))
  //check ip from share internet
  {
    $ip=$_SERVER['HTTP_CLIENT_IP'];
  }
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
  //to check ip is pass from proxy
  {
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  else
  {
    $ip=$_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}

function getCurrentURL()
{
    $currentURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
    $currentURL .= $_SERVER["SERVER_NAME"];
 
    if($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443")
    {
        $currentURL .= ":".$_SERVER["SERVER_PORT"];
    } 
 
    $currentURL .= $_SERVER["REQUEST_URI"];
    return $currentURL;
}

$crtUrl=getCurrentURL();
$base_url = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
$base_url .= $_SERVER["SERVER_NAME"];
$base_url = "http://localhost/Land_of_Profit";
// print_r($base_url);die("hello");
function truncate($text, $length, $suffix = '&hellip;', $isHTML = true) {
	// echo $text;exit;
	$i = 0;
	$simpleTags=array('br'=>true,'hr'=>true,'input'=>true,'image'=>true,'link'=>true,'meta'=>true);
	$tags = array();
	if($isHTML){
		preg_match_all('/<[^>]+>([^<]*)/', $text, $m, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
		foreach($m as $o){
			if($o[0][1] - $i >= $length)
				break;
			$t = substr(strtok($o[0][0], " \t\n\r\0\x0B>"), 1);
			// test if the tag is unpaired, then we mustn't save them
			if($t[0] != '/' && (!isset($simpleTags[$t])))
				$tags[] = $t;
			elseif(end($tags) == substr($t, 1))
				array_pop($tags);
			$i += $o[1][1] - $o[0][1];
		}
	}

	// output without closing tags
	$output = substr($text, 0, $length = min(strlen($text),  $length + $i));
	// closing tags
	$output2 = (count($tags = array_reverse($tags)) ? '</' . implode('></', $tags) . '>' : '');

	// Find last space or HTML tag (solving problem with last space in HTML tag eg. <span class="new">)
	$pos = (int)end(end(preg_split('/<.*>| /', $output, -1, PREG_SPLIT_OFFSET_CAPTURE)));
	// Append closing tags to output
	$output.=$output2;

	// Get everything until last space
	$one = substr($output, 0, $pos);
	// Get the rest
	$two = substr($output, $pos, (strlen($output) - $pos));
	// Extract all tags from the last bit
	preg_match_all('/<(.*?)>/s', $two, $tags);
	// Add suffix if needed
	if (strlen($text) > $length) { $one .= $suffix; }
	// Re-attach tags
	$output = $one . implode($tags[0]);

	//added to remove  unnecessary closure
	$output = str_replace('</!-->','',$output); 

	return $output;
}

// echo $base_url;exit;

$blogImg = "BlogImg"; 
$vtourImg = "vtourImg"; 
$projectImg = "projectImg"; 
$offerImg = "offerImg"; 
$serviceImg = "ServiceImg"; 
$loanImg = "LoanImg"; 
$sectorImg = "sectorImg"; 
$locationImg = "locationImg"; 
$aboutusImg = "aboutusImg";
$visionImg = "visionImg";
$wealthImg = "wealthImg";
$pensionImg = "pensionImg";
$bannerImg = "bannerImg";
$logoImg = "logoImg";
$home_pageImg ="home_pageImg";
$epc_img ="epc_imgs";
$currency= "$";

//Email
define("FROM_EMAIL", "contact@goringsaccountants.org.uk");
DEFINE('DS', DIRECTORY_SEPARATOR); 


$newsImg="news-img";
$clatestImg="latest-img";
$latestLaunchImg = "latest-launch-img";
$latestLaunchGallery = "latest-launch-gallery";



$albumImg="album-img";
$galleryImg="gallery-img";
$uploads="uploads";
$eventImg="event-img";
$bannerImg="banner-img";

$navlImg="img/image-not-available.png";

date_default_timezone_set("Asia/Kolkata");

$tdate=date("Y-m-d");

function getComapnyDetails($con){
	$sql = "select * from website_settings where id =1";
	$query = mysqli_query($con,$sql);
	$res = mysqli_fetch_assoc($query);
	return $res;
}
$getComapnyDetails=getComapnyDetails($con);

function getAllService($con){
	$sql = "select * from services where publish = 1 order by orders asc";
	$query = mysqli_query($con,$sql);
	$data = array();
	if(mysqli_num_rows($query)>0)
	{
		while($row = mysqli_fetch_assoc($query))
		{
			$data[] = $row; 
		}
	}
	return $data;
}
$getAllService=getAllService($con);


function getAllPage($con){
	$sql = "select * from page where publish = 1";
	$query = mysqli_query($con,$sql);
	$data = array();
	if(mysqli_num_rows($query)>0)
	{
		while($row = mysqli_fetch_assoc($query))
		{
			$data[] = $row; 
		}
	}
	return $data;
}
$getAllPage=getAllPage($con);
// echo '<pre>';print_r($getAllPage);exit;

function getAllBanner($con){
	$sql = "select * from banner where publish = 1";
	$query = mysqli_query($con,$sql);
	$data = array();
	if(mysqli_num_rows($query)>0)
	{
		while($row = mysqli_fetch_assoc($query))
		{
			$data[] = $row; 
		}
	}
	return $data;
}
$getAllBanner=getAllBanner($con);

function getHomePage($con){
	$sql = "select * from home_page where id = 1";
	$query = mysqli_query($con,$sql);
	$data = mysqli_fetch_assoc($query);
	return $data;
}
$getHomePage=getHomePage($con);

function getAllBlogs($con){
	$sql = "select * from blog where publish = 1 order by id desc";
	$query = mysqli_query($con,$sql);
	$data = array();
	if(mysqli_num_rows($query)>0)
	{
		while($row = mysqli_fetch_assoc($query))
		{
			$data[] = $row; 
		}
	}
	
	return $data;
}
$getAllBlogs=getAllBlogs($con);

function get_images_by_porperty_id($id){
	global $con;
	$sql ="SELECT * FROM `property_imgs`
			WHERE `property_id`='{$id}'
		  ";
	$q = mysqli_query($con,$sql);
	$data = array();
	if(mysqli_num_rows($q)>0)
	{
		$i=0;
		while($row = mysqli_fetch_assoc($q))
		{
			$data[] = $row; 
			$i++;
		}
	}
	return $data;
}

function getUserNameById($id){
	global $con;
	$sql = "select fname,lname from users where id = {$id}";
	$query = mysqli_query($con,$sql);
	$data = mysqli_fetch_assoc($query);
	return $data['fname'].' '.$data['lname'];
}

?>