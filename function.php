<?php
function CallAPI($method, $url, $data)
{
   
    // $data = array('facebook_id' => $id , 'first_name' => $first_name, 'last_name' => $last_name, 'email' => $email);
  
    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return $result;
}
?>