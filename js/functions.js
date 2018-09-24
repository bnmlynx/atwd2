$(document).ready(function() {
  $resizeData = '';
  // Load the Visualization API and the piechart package.
  google.charts.load('current', {'packages':['corechart']});
  //google.visualization.events.addListener(chart, 'animationfinish', test);

/*
  $("#defaultCheck1").change(function() {
    if($('input.form-check-input').is(':checked')) {
      animate();
      //alert('hello');
      //console.log($z);
    }
  }); */

  //Updates the available years of data once the user changes a station
  $("#location").change(function() {
    var value = $(this).val();
    $.ajax({
        type: "POST",
        url: 'php/updateYears.php',
        data: {"location": value},
        dataType: 'json',
        success: function(response){
          var $year = $("#year");
          $year.empty();
          $.each(response, function(key, value){
              $year.append($("<option></option>").attr('value', value).text(value));
          });
        }
    });
  });

  //Updates the available date range for each location
  $( "#loc" ).change(function() {
    var value = $(this).val();
    $.ajax({
        type: "POST",
        url: 'php/updateDates.php',
        data: {"location": value},
        dataType: 'json',
        success: function(response){
          var $date = $("#date");

          $date.attr('min', response['min']);

          $date.attr('max', response['max']);

          $date.val(response['min']);
        }
    });
  });

  //Ajax for selecting data
  $("#scatter").submit(function(e) {
    e.preventDefault();
    var data = $("#scatter").serialize();

    $.ajax({
        type: "POST",
        url: 'php/getData.php',
        data: data,
        dataType: 'json',
        async: false,
        success: function(response){
          resizeData = response;
          drawChart(response);
          $('#image').html('<img class="reading-chart img-fluid" src="img/graph.png"><p class="text-center">DEFRA Air Quality Index</p>');
        }
    });
  });//end form sumbit

  //Ajax for selecting data for the day readings
  $("#line").submit(function(e) {
    e.preventDefault();
    var data = $("#line").serialize();
    $.ajax({
        type: "POST",
        url: 'php/getDataDay.php',
        data: data,
        dataType: 'json',
        async: false,
        success: function(response){
          resizeData = response;
          drawLineChart(response);
          $('#image').html('<img class="reading-chart img-fluid" src="img/graph.png"><p class="text-center">DEFRA Air Quality Index</p>');

        }
    });
  });//end form sumbit
});//end document ready

$(window).resize(function() {
  if($('form').attr('id') == 'scatter') {
    drawChart(resizeData);
  } else {
    drawLineChart(resizeData);
  }
});

//function for building the scatter chart with the json data
function drawChart(jsonData) {
  // Create our data table out of JSON data loaded from server.
  var data = new google.visualization.DataTable(jsonData);

  var options = {
      title: 'Amount of Nitrogen Dioxide (micrograms) Per Cubic Meter at a Specific Time Over a Year',
      hAxis: {title: 'Date'},
      vAxis: {title: 'Amount of No2 per cubic meter of air (µg/m3)'},
      trendlines: {
        0: {
          type: 'polynomial',
          degree: 3,
          pointSize: 20, // Set the size of the trendline dots.
          opacity: 0.5,
        }
      },
  };
  // Instantiate and draw our chart, passing in some options.

  var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));

  //google.visualization.events.addListener(chart, 'animationfinish', animate);

  chart.draw(data, options);
}

//function for building the line chart from the json data
function drawLineChart(jsonData) {

  var options = {
     title: 'Level of Nitrogen Dioxoide (micrograms) Per Cubic Meter Over a 24 Hour Period',
     hAxis: {title: 'Time of Day'},
     vAxis: {title: 'Amount of No2 Per Cubic Meter of Air (µg/m3)'},
  };
   // Create our data table out of JSON data loaded from server.
  var data = new google.visualization.DataTable(jsonData);

  // Instantiate and draw our chart, passing in some options.
  var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
  chart.draw(data, options);
}


//function for animating between data sets but was to distracting with numerous data points moving at once

/*function animate() {

    var data = $.ajax({
      type: "POST",
      url: 'php/getData.php',
      data: {"location": "data/brislington_no2.xml", "year": "2016", "time": "12:00:00"},
      dataType: 'json',
      async: false,
      //DRAW NEW CHART
    }).responseText;

    //alert(data);

    var o = options;

   /* var options = {
        title: 'Amount of nitrogen dioxide per cubic meter per day ',
        hAxis: {title: 'Date'},
        vAxis: {title: 'Amount of No2 per cubic meter of air (µg/m3)'},
        trendlines: {
          0: {
            type: 'polynomial',
            degree: 3,
            pointSize: 20, // Set the size of the trendline dots.
            opacity: 0.5,
          }
        },
        animation: {
          duration: 5000,
          easing: 'linear',
        },
        height: 600,
        width: 1400
    };

    data =  new google.visualization.DataTable(data);
    chart.draw(data, o);
}
*/
