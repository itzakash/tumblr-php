<?php


// $video_data = file_get_contents("http://localhost/videomate/assets/FinalVideo/1/final-83340.mp4");
require_once('vendor/autoload.php');

$consumerKey = 'kcLFCb5DOkJIXJngeaeyCNQR2OcmsDOPjc9Myv3jDwJaY82txS';
$consumerSecret = 'KO7LhsLULUGKlPzKQrNbfO0V6ABMGwWKGr9CYolL3OH1b7w5z1';


$client = new Tumblr\API\Client($consumerKey, $consumerSecret);

$token = 'FMLujSNgh8rADKMPrzDkWThSDfeI7rSlmrVHoLyEvlGDUeBiEQ';
$tokenSecret = 'UC9pYni1y15HA6GNt6Tz27nUokACpVl5uJjVQVsVyDIiAPldFf';

$client->setToken($token, $tokenSecret);

foreach ($client->getUserInfo()->user->blogs as $blog) {
	echo $blog->name . "\n";
}





// normal text
$post_data = array('title' => 'test title', 'body' => 'test body',"tags"=> array("cat","dog"));

$post_data = array('type' => 'video', 'caption' => 'hello video 123','data' => "http://localhost/videomate/assets/FinalVideo/1/final-83340.mp4");

$createPost = $client->createPost("itzakash08",$post_data);


$data1 = $client->getDashboardPosts($options = null);


print_r($data1);exit;

?>