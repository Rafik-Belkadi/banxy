// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function (n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Area Chart Example
var ctc = document.getElementById("myAreaChart");
var myAreaData;
var hoursArray = [];
var numRowsArray = [];

$.ajax({    //create an ajax request to display.php
  type: "GET",
  url: "../Admin/api/data/interaction-time.php",
  success: function (response) {
    myAreaData = response;
    myAreaData.forEach(element => {
      hoursArray.push(element.heure);
      numRowsArray.push(element.nombre);
    });

    var myLineChart = new Chart(ctc, {
      type: 'line',
      data: {
        labels: hoursArray,
        datasets: [{
          label: "Interactions: ",
          lineTension: 0.3,
          backgroundColor: "rgba(78, 115, 223, 0.05)",
          borderColor: "rgba(78, 115, 223, 1)",
          pointRadius: 3,
          pointBackgroundColor: "rgba(78, 115, 223, 1)",
          pointBorderColor: "rgba(78, 115, 223, 1)",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
          pointHoverBorderColor: "rgba(78, 115, 223, 1)",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: numRowsArray,
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            time: {
              unit: 'date'
            },
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
              maxTicksLimit: 7,
              callback: (value, index, values) => number_format(value) + 'H'
            }
          }],
          yAxes: [{
            ticks: {
              maxTicksLimit: 5,
              padding: 10,
              // Include a dollar sign in the ticks
              callback: function (value, index, values) {
                return number_format(value);
              }
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          intersect: false,
          mode: 'index',
          caretPadding: 10,
          callbacks: {
            label: function (tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + number_format(tooltipItem.yLabel);
            }
          }
        }
      }
    });
  }
});

// Area Chart Example
var chartById = document.getElementById("chartById");
var myData;
var hours_array = [];
var numRows_array = [];
var myId = document.getElementById("id");
var myIds = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];

var hotels = ["IBIS Alger BEZ", "Sheraton CDP", "El Djazair", "Aeroport de Bejaia", "Four Points Setif", "Novotel Setif", "Marriott Constantine", "Protea Constantine", "Novotel Constantine", "Sheraton Annaba", "Four Points Oran	", "Le Meridien Oran", "Sheraton Oran", "MGallery Royal Hotel Oran", "Renaissance Tlemcen"]
var currentIndex = 0;
myId.textContent = hotels[currentIndex];

var chartData = {
  type: 'line',
  data: {
    labels: [],
    datasets: [{
      label: "Interactions: ",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7,
          callback: (value, index, values) => number_format(value) + 'H'
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function (value, index, values) {
            return number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function (tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
};
var myLineChart = new Chart(chartById, chartData);

var getData = function (id) {
  $.ajax({    //create an ajax request to display.php
    type: "GET",
    url: "../Admin/api/data/test.php?id=" + id,
    beforeSend: function() {
      $("#chartById").hide();
      $("#loader").show();
    },
    complete: function() {
      $("#loader").hide();
      $("#chartById").show();
    },
    success: function (response) {
      myData = response;
      myData.hours_array.forEach(element => {
        hours_array.push(element.heure);
        numRows_array.push(element.nombre);
      });

      myLineChart.data.labels = hours_array;
      myLineChart.data.datasets[0].data = numRows_array;
      myLineChart.update();
    }
  });
}
getData(myIds[currentIndex]);


$("#increment").click(function () {
  if (currentIndex == 14) {
    currentIndex = 0
  } else {
    currentIndex += 1;
  }
  myId.textContent = hotels[currentIndex];

  hours_array = [];
  numRows_array = [];
  getData(myIds[currentIndex]);
});

$("#decrement").click(function () {
  if (currentIndex == 0) {
    currentIndex = 14;
  } else {
    currentIndex -= 1;
  }
  myId.textContent = hotels[currentIndex];

  ours_array = [];
  numRows_array = [];
  getData(myIds[currentIndex]);
});




