<?php
include 'config.php';
?>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
  <div class="container-fluid top-options">
    <div class="row">
      <div class="col-md-12">
        <form id="scatter" class="row">
          <div class="form-group col-md-3">
            <label for="location">Location</label>
            <select class="form-control" id="location" name="location">
             <?php
                foreach($available_locations as $key=>$value) {
                  echo '<option value="'. $key .'">' . $value . '</option>';
                }
              ?>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label for="time">Time</label>
            <select class="form-control" id="time" name="time">
             <?php
              foreach($available_times as $available_time) {
                echo '<option value="'. $available_time .'">' . substr($available_time, 0, -3) . '</option>';
                }
              ?>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label for="year">Year</label>
            <select class="form-control" id="year" name="year">
             <?php
              foreach($available_years as $available_year) {
                echo '<option value="'. $available_year .'">' . $available_year . '</option>';
                }
              ?>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label for="submit">See Levels Of Nitrogen Dioxide</label>
            <button type="submit" value="Submit" class="btn btn-primary btn-block">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--Div that will hold the chart-->
  <div id="chart_div">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-10 text-center mt">
          <h6>Scatter Chart</h6>
           <h1>Please select a <span class="underline">Location</span>, a <span class="underline">Time</span> and a <span class="underline">Year</span> from above to view the levels of Nitrogen Dioxide</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="text-center">
      <div id="image"></div>
  </div>


  <div class="bottom-right">
    <a href="lineChart.php" class="btn btn-outline-dark" role="button">View Line Chart</a>
  </div>
  <!--Load the AJAX API-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/functions.js"></script>
  </body>
</html>
