// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var myData ;
var ctv = document.getElementById("myPieChart");

$.ajax({
  type: "GET",
  url: "../Admin/api/data/rubriques.php",
  success: function(res) {
    myData = res;

    var myPieChart = new Chart(ctv, {
      type: 'doughnut',
      data: {
        labels: ["Gestion 100% Mobile", "Avantages inédits", "Cartes Gold& Platinum", "Toujours à votre écoute"],
        datasets: [{
          data: [myData.mobile, myData.avantages, myData.cartes, myData.ecoute],
          backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc','#333'],
          hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#fff'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 80,
      },
    });    
    
  }
});
