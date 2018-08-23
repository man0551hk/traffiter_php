<?php
require_once __DIR__ . '/interface1.php';
require_once __DIR__ . '/function.php';
?>
<script>
  var totalDays = 5;
  function addDay () {
    totalDays +=1;
    GenerateDay(totalDays);
  }

  function GenerateDay(totalDays){
    var text = "";
    text += "<td width = '20%' id = 'day" + totalDays + "cell'><table id = 'day" + totalDays + "' width = '100%'>";
    text += "<tr><td> Day " + (totalDays+1) +  "</td></tr>";
    for(var i = 0; i <= 23; i++) {
      for (var j = 0; j <= 3; j++) {
        text += "<tr><td bgcolor ='blue'>&nbsp;</td></tr>";
      }
    }
    text += "</table></td>";
    $('#daysCellRow').append(text);
  }

  function DeduceDay () {
    if (totalDays > 0) {
      $( "#day" + totalDays + "cell" ).remove();
      totalDays -=1;
    }
  }
</script>
  <section id="timetable" class="sections">
    <div class="cd-pricing-container cd-has-margins">
    
      <?php
      if (isset($_POST["country_id"]))
      {
          $countryID = $_POST["country_id"];
          $data = array('lang' => $lang , 'userID' => $userID, 'countryID' => $countryID);
          $result = CallAPI('POST', 'https://'.$apiDomain.'/locationDetail.php', $data);
      }
      ?>


      <a href = '#' onclick = "addDay()">Add Day</a>
      <a href = '#' onclick = "DeduceDay()">Deduce Day</a>

    <table width="100%">
      <tr id = 'mainRow'>
        <td id='timeCell' width ='5%'>
          <table>
            <tr><td>&nbsp;</td></tr>
          <?php
            for($i = 0; $i <= 23; $i++) {
              for ($j = 0; $j <= 3; $j++) {
                echo '<tr><td>'.sprintf("%02d", $i) .':'.sprintf("%02d",($j * 15)).'</td></tr>';
              }
            }
          ?>
          </table>
        </td>
        <td width ='95%'>
          <table id ="daysCell" width = '100%'>
            <tr id ="daysCellRow">
              <?php
                for($k = 0; $k <= 4; $k++) {
                  echo "<td width = '20%' id = 'day".$k."cell'><table id = 'day".$k."' width = '100%'>";
                  echo "<tr><td> Day ".($k+1) . "</td></tr>";
                  for($i = 0; $i <= 23; $i++) {
                    for ($j = 0; $j <= 3; $j++) {
                      echo '<tr><td bgcolor ="yellow">&nbsp;</td></tr>';
                    }
                  }
                  echo "</table></td>";
                }
              ?>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    </div>
  </section>
<?php
    require_once __DIR__ . '/interface2.php'; 
?>