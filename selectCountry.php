<?php
require_once __DIR__ . '/interface1.php';
?>
<script>
  $( function() {   
    $( "#keywords" ).autocomplete({
      source: function( request, response ) {
        $.ajax( {
          url: "https://api.traffiter.com/countrySuggestion.php",
          dataType: "json",
          data: {
            keyword: request.term
          },
          success: function( data ) {
            response($.map(data, function (value, key) {
                return {
                    label: value.countryNameTc,
                    value: value.countryID
                };
            }));
          }
        } );
      },
      select: function( event, ui ) {
        event.preventDefault();
        $("#country_id").val(ui.item.value);
        console.log($("#country_id").val());
        $("#keywords").val(ui.item.label);
      }
    }).click(function() {
      $(this).autocomplete("search", " ");
    });
   
  } );
</script>

<!--Home page style-->
<header id="home" class="home">
  <div class="overlay-fluid-block">
    <div class="container text-center">
      <div class="row">
        <div class="home-wrapper">
          <div class="col-md-10 col-md-offset-1">
            <div class="home-content">
              <div class="row">
                <div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                  <div class="home-contact">
                    <div class="input-group">
                      <form action = "timeTablePlanning.php" method = "POST">
                        <div class="ui-widget">
                          <input type="text" id = "keywords" class="form-control" placeholder="Country Name">
                          <input type="hidden" id = "country_id" name = "country_id" value = "1" />
                          <input type="submit" class="form-control" value="Start Planning" />
                        </div>
                      </form>
                    </div><!-- /input-group -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>			
  </div>
</header>
<?php
require_once __DIR__ . '/interface2.php';
?>