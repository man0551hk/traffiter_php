<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/function.php';
require_once __DIR__ . '/config.php';
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
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
  
  if (! isset($accessToken)) {
    if ($helper->getError()) {
      header('HTTP/1.0 401 Unauthorized');
      echo "Error: " . $helper->getError() . "\n";
      echo "Error Code: " . $helper->getErrorCode() . "\n";
      echo "Error Reason: " . $helper->getErrorReason() . "\n";
      echo "Error Description: " . $helper->getErrorDescription() . "\n";
    } else {
      header('HTTP/1.0 400 Bad Request');
      echo 'Bad request';
    }
    exit;
  }

  $oAuth2Client = $fb->getOAuth2Client();

  $tokenMetadata = $oAuth2Client->debugToken($accessToken);
  $tokenMetadata->validateAppId($app_id); // Replace {app-id} with your app id
  $tokenMetadata->validateExpiration();
  $response = $fb->get('/me?fields=id,name,first_name,last_name,email,gender,birthday,location,picture', $accessToken);
  $result = $response->getDecodedBody();

  $id = $result['id'];
  $first_name = $result['first_name'];
  $last_name = $result['last_name'];
  $email = $result['email'];
  //$data = 'facebook_id='.$id.'&first_name='.$first_name.'&last_name='.$last_name.'&email='.$email;
  echo $id.'<br/>';
  echo $first_name.'<br/>';
  echo $last_name.'<br/>';
  echo $email.'<br/>';

  // CallAPI('POST', 'https://'.$apiDomain.'/saveUser.php', $data );

  $url = 'https://'.$apiDomain.'/saveUser.php';
  $data = array('facebook_id' => $id , 'first_name' => $first_name, 'last_name' => $last_name, 'email' => $email);

  // use key 'http' even if you send the request to https://...
  $options = array(
      'http' => array(
          'method'  => 'POST',
          'content' => http_build_query($data)
      )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  if ($result === FALSE) {

  } else {
    $decodeResult = json_decode($result);
    print_r($decodeResult);
    $userID = $decodeResult->userID;
    // $userID = $decodeResult["userID"];
    // echo $userID;
    $_SESSION['userID'] = $userID;
    $_SESSION['username'] = $first_name. ' ' . $last_name;
  }



  if (! $accessToken->isLongLived()) {
    try {
      $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
      echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
      exit;
    }
    // var_dump($accessToken->getValue());
  }
  
  $_SESSION['fb_access_token'] = (string) $accessToken;
 
  header("Location: member.php");
  die();
  ?>