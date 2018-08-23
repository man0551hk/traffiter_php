<?php
session_start();
  require_once __DIR__ . '/vendor/autoload.php';
  require_once __DIR__. '/interface1.php';
  $fb = new Facebook\Facebook([
    'app_id' => '1558355577612796', // 把 {app_id} 換成你的應用程式編號
    'app_secret' => '3b791c12364219428b76909e95391f5d', // 把 {app_secret} 換成你的應用程式密鑰
    'default_graph_version' => 'v2.2',
    ]);
  
  $helper = $fb->getRedirectLoginHelper();
  
  $permissions = ['email'];
  $loginUrl = $helper->getLoginUrl('https://'.$domain.'/fb-callback.php', $permissions);
  
?>

<section class="sections">
  <div class="container">
    <div class="row">
      <div class="main_contact whitebackground">
          <div class="contact_content">
            <div class="col-md-12">
              <?php echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>'; ?>
            </div>
          </div>
      </div>
    </div>
  </div>
</section>

<?php
  
  require_once __DIR__. '/interface2.php';
?>