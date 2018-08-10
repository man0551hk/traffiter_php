<?php
    require_once __DIR__ . '/vendor/autoload.php';
  $fb = new Facebook\Facebook([
    'app_id' => '1558355577612796', // 把 {app_id} 換成你的應用程式編號
    'app_secret' => '3b791c12364219428b76909e95391f5d', // 把 {app_secret} 換成你的應用程式密鑰
    'default_graph_version' => 'v2.2',
    ]);
  
  $helper = $fb->getRedirectLoginHelper();
  
  $permissions = ['email'];
  $loginUrl = $helper->getLoginUrl('https://traffiter.com/fb-callback.php', $permissions);
  
  echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';

  ?>