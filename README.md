# Air Quality in Bristol 

Visit application [here](https://bnmlynx.com/airquality/)

## About

This project involved taking a csv file containing 280,000+ records of air quality readings from a number of locations around Bristol and then extracting the relevant information to plot on two different graphs using the Google Charts API.

### Scatter Graph & Line Graph

The scatter graph shows the readings of Nitrogen Dioxide for a certain location at a certain time over the course of a year.

The line graph shows the readings of Nitrogen Dioxide over a 24hr period at a certain location.

### Breakdown of the technical process 

* Splitting of the CSV file into seperate XML files based on location
* Using XMlReader and XMLWriter for parsing the large files and removing redundant data (stream parsing rather than saving to memory for better efficiency and speed when handling large files)
* Using AJAX to post Location/Year/Time or Location/Time information (depending on chart) to the server request the relevant data for the chart
* Using PHP and XMLReader to parse the specified XML document and retrieve the relevant information in the form of an array
* Converting that array into JSON format specified by the Google Charts API and displaying the results on the graph

PHP Scripts involved can be found [here](https://github.com/bnmlynx/atwd2/tree/master/php)

JavaScript involved can be found [here](https://github.com/bnmlynx/atwd2/tree/master/js)


#### Subtle points 

* Each data point on the Scatter graph is colour coded to match the DEFRA air quality index guidelines 
* Changing the Location will automatically update the Available Years as each recording station has varying amounts of data


