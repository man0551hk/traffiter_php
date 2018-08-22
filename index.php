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
      <script>
        var items = [];
        $.ajax({
          dataType: "json",
          url: "https://api.traffiter.com/getHomePage.php",
          data: {
            lang: 'en'
          },
          success: function( data ) {
            $.map(data, function (val, key) {
              var item = '<div class="wf-box" style = "padding:5px">' +
                '<a href = "">' + 
                '<img src="'  + val.image + '">' + 
                '</a>' + 
                '<div class="content">' + 
                  '<b>' + val.name + '</b>' +
                  '<p>' + val.countryName + ' ' + val.areaName + ' ' + val.districtName + '</p>' +
                '</div>' + 
              '</div>';
            items.push(item);
            });
            $( ".wf-container").append(items.join(""));
            var waterfall = new Waterfall({
              containerSelector: '.wf-container',
              boxSelector: '.wf-box',
              minBoxWidth: 250
            }); 
          }
        });
      </script>
    <?php
      // $result = [];

      // try {
      //   $result = CallAPI('POST', 'https://api.traffiter.com/getHomePage.php', 'lang=tc');
      // }
      // catch (Exception $e) {
      //   echo $e;
      // }
      
      // if (isset($result))
      // {
      //   $homepageGrids = json_decode($result);
      //   foreach ($homepageGrids as $homepageGrid) {
      //     // print_r($homepageGrid);
      //     // echo $homepageGrid->locationID;
      //     echo '<div class="wf-box" style = "padding:5px">';
      //       echo '<a href = "">';
      //       echo '<img src="'.$homepageGrid->image.'">';
      //       echo '</a>';
      //       echo '<div class="content">';
      //         echo '<h3>'.$homepageGrid->name.'</h3>';
      //         echo '<p>'. $homepageGrid->countryName. ' - '.$homepageGrid->areaName. ' - '. $homepageGrid->districtName. '</p>';
      //       echo '</div>';
      //     echo '</div>';
      //   }
      // }
      // else {
      //   echo 'empty';
      // }
    ?>

       
    </div>
  </div>
</section>
<script src="assets/js/waterfall.js"></script>
<script>

</script>
<?php
require_once __DIR__ . '/interface2.php'; 
?>