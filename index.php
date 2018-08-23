<?php
require_once __DIR__ . '/interface1.php';
require_once __DIR__ . '/function.php';

?>
<style>
.wf-container:before,.wf-container:after {
    content: '';
    display: table;
}
.wf-container:after {
    clear: both;
}
.wf-column {
    float: left;
}

</style>

<section id="features" class="sections">
  <div class="container">
    <div class="wf-container">
      <?php
        $data = array('lang' => $lang , 'userID' => $userID);
        $result = CallAPI('POST', 'https://'.$apiDomain.'/getHomePage.php', $data);
        if ($result !== FALSE) {
          $jsonResult = json_decode($result );
          foreach ($jsonResult as $homepageGrid) {
            echo '<div class="wf-box" style = "padding:5px">'.
                '<a href = "locationDetail.php?locationID='.$homepageGrid->locationID.'">'.
                '<img src="' . $homepageGrid->image .'">'.
                '</a>'.
                '<div class="content" id = "content'. $homepageGrid->locationID.'">' .
                '<b>' .$homepageGrid->name. '</b>' .
                '<p>'.
                $homepageGrid->countryName. ' '.
                $homepageGrid->areaName. ' '.
                $homepageGrid->districtName.
                '</p>';
            if ( $homepageGrid->bookmarkID > 0) {
              echo '<i class="fa fa-heart"></i>';
            } else {
              echo '<a href = "javascript:addFavorite(' . $homepageGrid->locationID . ','. $userID .')" class = "heart" id = "'.$homepageGrid->locationID.'">'.
              '<i class="fa fa-heart-o"></i>'.
              '<i class="fa fa-heart"></i>'.
              '</a>' ;
            }
            echo  '</div>' .
            '</div>';
          }
        }
      ?>

    </div>
  </div>
</section>
<script src="assets/js/waterfall.js"></script>
<script>
  // $( ".wf-container").append(items.join(""));
  var waterfall = new Waterfall({
    containerSelector: '.wf-container',
    boxSelector: '.wf-box',
    minBoxWidth: 250
  }); 
</script>
<?php
require_once __DIR__ . '/interface2.php'; 
?>