<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

$app_id = '1558355577612796'; // 把 {app_id} 換成你的應用程式編號
$app_secret = '3b791c12364219428b76909e95391f5d';  // 把 {app_secret} 換成你的應用程式密鑰
$fb = new Facebook\Facebook([
    'app_id' => $app_id, 
    'app_secret' => $app_secret, 
    'default_graph_version' => 'v2.2',
    ]);

    $helper = $fb->getRedirectLoginHelper();
    try {
        $accessToken = $helper->getAccessToken();
        $logoutUrl = $helper->getLogoutUrl($accessToken, 'https://www.traffiter.com');
       
      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }
    
      session_destroy();
      header("Location: member.php");
      die();   
?>