<?php
require_once __DIR__ . '/interface1.php';
require_once __DIR__ . '/function.php';
// require_once __DIR__ . '/vendor/autoload.php';
// use CaseHelper\CaseHelperFactory;
// $ch = CaseHelperFactory::make(CaseHelperFactory::INPUT_TYPE_CAMEL_CASE);
?>


<section id="business" class="portfolio sections">
    <div class="container">
    <?php
        if (isset($_GET["locationID"]))
        {
            $locationID = $_GET["locationID"];
            $data = array('lang' => $lang , 'userID' => $userID, 'locationID' => $locationID);
            $result = CallAPI('POST', 'https://'.$apiDomain.'/locationDetail.php', $data);
            if ($result !== FALSE) {
              $jsonResult = json_decode($result);
              //var_dump($jsonResult);
              ?>
                <div class="head_title text-center">
                    <h1><?php echo $jsonResult->name; ?></h1>
					<p><?php echo $jsonResult->countryName. ' ' . $jsonResult->areaName. ' ' .  $jsonResult->districtName; ?></p>
                </div>
              <?php
            }
            ?>
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php
                        $imageList = $jsonResult->image;
                        for($i = 0; $i < sizeof($imageList); $i++)
                        {
                            if ($i == 0)
                            {
                                echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" class="active"></li>';
                            }
                            else {
                                echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" ></li>';
                            }
                           
                        }
                    ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php 
                        for($i = 0; $i < sizeof($imageList); $i++)
                        {
                            if ($i == 0) {
                                echo '<div class="item active">';
                            }
                            else {
                                echo '<div class="item">';
                            }
                            echo '<img src="'.$imageList[$i].'" style="width:100%;">';
                            echo '</div>';
                        }
                    ?>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
                </a>
            </div>
            <div id = "content<?php echo $jsonResult->locationID;?>">
                <?php
                if ( $jsonResult->bookmarkID > 0) {
                    echo '<i class="fa fa-heart"></i>';
                } else {
                    echo '<a href = "javascript:addFavorite(' . $jsonResult->locationID . ','. $userID .')" class = "heart" id = "'.$jsonResult->locationID.'">'.
                    '<i class="fa fa-heart-o"></i>'.
                    '<i class="fa fa-heart"></i>'.
                    '</a>' ;
                }
                ?>
            </div>
            <?php
        } 
        else {
            die();
        }
        ?> 
    </div> <!-- /container -->       
</section>




<?php
    require_once __DIR__ . '/interface2.php'; 
?>