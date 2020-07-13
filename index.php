<?php
session_start();
require_once('vendor/autoload.php');

$consumerKey = 'kcLFCb5DOkJIXJngeaeyCNQR2OcmsDOPjc9Myv3jDwJaY82txS';
$consumerSecret = 'KO7LhsLULUGKlPzKQrNbfO0V6ABMGwWKGr9CYolL3OH1b7w5z1';


$client = new Tumblr\API\Client($consumerKey, $consumerSecret);
$requestHandler = $client->getRequestHandler();
$requestHandler->setBaseUrl('https://www.tumblr.com/');

// If we are visiting the first time
if (!isset($_GET['oauth_verifier'])) {

    // grab the oauth token
    $resp = $requestHandler->request('POST', 'oauth/request_token', array());
    $out = $result = $resp->body;
    $data = array();
    parse_str($out, $data);

    // tell the user where to go
    echo '<a href="https://www.tumblr.com/oauth/authorize?oauth_token=' . $data['oauth_token'].'"> GO </a>';
    $_SESSION['t'] = $data['oauth_token'];
    $_SESSION['s'] = $data['oauth_token_secret'];

} else 
{

    $verifier = $_GET['oauth_verifier'];

    // use the stored tokens
    $client->setToken($_SESSION['t'], $_SESSION['s']);

    // to grab the access tokens
    $resp = $requestHandler->request('POST', 'oauth/access_token', array('oauth_verifier' => $verifier));
    $out = $result = $resp->body;
    $data = array();
    parse_str($out, $data);

    // and print out our new keys we got back
    $token = $data['oauth_token'];
    $secret = $data['oauth_token_secret'];
    echo "token: " . $token . "<br/>secret: " . $secret;

    // and prove we're in the money
    $client = new Tumblr\API\Client($consumerKey, $consumerSecret, $token, $secret);
    $info = $client->getUserInfo();
    echo "<br/><br/>congrats " . $info->user->name . "!";

}
?>