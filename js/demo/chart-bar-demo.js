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

var maxe;
var mdr;
var ctx = document.getElementById("myBarChart");
$.ajax({
  type: "GET",
  url: "../Admin/api/data/getMax.php",
  success: function(response) {
    maxe = response;
    $.ajax({    //create an ajax request to display.php
      type: "GET",
      url: "../Admin/api/data/interactions.php",
      success: function (response) {
        mdr = response;

        var myBarChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: [mdr[0].localisation, mdr[1].localisation, mdr[2].localisation, mdr[3].localisation, mdr[4].localisation, mdr[5].localisation, mdr[6].localisation, mdr[7].localisation, mdr[8].localisation,mdr[9].localisation,mdr[10].localisation,mdr[11].localisation,mdr[12].localisation,mdr[13].localisation,mdr[14].localisation,mdr[15].localisation],
            datasets: [{
              label: "Interactions: ",
              backgroundColor: "#4e73df",
              hoverBackgroundColor: "#2e59d9",
              borderColor: "#4e73df",
              data: [mdr[0].interacted, mdr[1].interacted, mdr[2].interacted, mdr[3].interacted, mdr[4].interacted, mdr[5].interacted, mdr[6].interacted, mdr[7].interacted, mdr[8].interacted,mdr[9].interacted,mdr[10].interacted,mdr[11].interacted,mdr[12].interacted,mdr[13].interacted,mdr[14].interacted,mdr[15].interacted],
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
                  unit: 'tabs'
                },
                gridLines: {
                  display: false,
                  drawBorder: false
                },
                ticks: {
                  maxTicksLimit: 16
                },
                maxBarThickness: 25,
              }],
              yAxes: [{
                ticks: {
                  min: 0,
                  max: maxe.maxed,
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
              titleMarginBottom: 10,
              titleFontColor: '#6e707e',
              titleFontSize: 14,
              backgroundColor: "rgb(255,255,255)",
              bodyFontColor: "#858796",
              borderColor: '#dddfeb',
              borderWidth: 1,
              xPadding: 15,
              yPadding: 15,
              displayColors: false,
              caretPadding: 10,
              callbacks: {
                label: function (tooltipItem, chart) {
                  var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                  return datasetLabel + number_format(tooltipItem.yLabel);
                }
              }
            },
          }
        });
      }
    
    });
  }
});





// Bar Chart Example


