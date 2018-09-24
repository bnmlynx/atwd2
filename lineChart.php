<?php include('config.php');?>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
		<?php include('inc/nav.php'); ?>
    <div class="container-fluid top-options">
      <div class="row">
        <div class="col-md-12">
          <form id="line" class="row justify-content-md-center">
            <div class="form-group col-md-3">
              <label for="location">Location</label>
              <select class="form-control" id="loc" name="location">
               <?php
                  foreach($available_locations as $key=>$value) {
                    echo '<option value="'. $key .'">' . $value . '</option>';
                  }
                ?>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="date">Date</label>
              <input
                id="date"
                class="form-control"
                <?php echo "min='". $available_dates['min']."'" . " max='" . $available_dates['max']."'"?>
                <?php echo "value='" . $available_dates['min'] . "'"?>
                type="date"
                name="date">
            </div>
            <div class="form-group col-md-3">
              <label for="submit">See Levels Of Nitrogen Dioxide</label>
              <button type="submit" value="Submit" class="btn btn-primary btn-block">Submit</button>
            </div>
          </form>
         </div>
      </div>
    </div>
    <!--Div that will hold the pie chart-->
    <div class="container-fluid">
      <div class="row justify-content-md-center">
        <div class="col-md-12">
          <div id="chart_div">
            <div class="col-md-10 offset-md-1 text-center mt">
              <h6>Line Chart</h6>
              <h1>Please select a <span class="underline">Location</span> and a <span class="underline">Date</span> from above to view the levels of Nitrogen Dioxide</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center">
        <div id="image"></div>
    </div>
    <div class="bottom-left">
      <a href="index.php" class="btn btn-outline-dark" role="button">View Scatter Chart</a>
    </div>
		
		<?php include('inc/footer.php'); ?>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>

  </body>
</html>
