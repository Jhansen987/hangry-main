@include('../headers.admin-header')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sales Report | Hangry</title>
</head>
<body class="orange-background-admin">
@if(session('success'))

<div class="toast-container position-fixed top-0 p-3" style="width:100%;">
  <div id="liveToast" class="toast" style="margin:auto;background-color:#fff;" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header" style="background-color:#dbdadb;">
      <img src="../icons/notification-gray-fill_icon.svg" class="rounded me-2" alt="...">
      <small class="me-auto" style="color:#5e5b5e;">Notification</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <span style="color:#5e5b5e;">{{session('success')}}</span>
    </div>
  </div>
</div>
<script>
    const toastLiveExample = document.getElementById('liveToast');
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
    toastBootstrap.show();
    const audio = new Audio("{{asset('sounds/alert-sound.mp3')}}");
    audio.play();
</script>
@endif

<div class="home-title-header-1 body-margin-top sales-report-header">
    Sales Report
</div>
<div class="div-for-google-chart-display" style="margin-bottom:3rem;">
    <div id="chart_div" class="chart-display"></div>
</div>


<!-- <div class="div-for-general-table">
  <table class="general-table">

      <tr>
        <th>Order ID</th>
        <th>Date Ordered</th>
        <th>Grand Total</th>
      </tr>

  </table>
</div> -->

@include ('../footers.admin-footer')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {
      var salesData = @json($salesPerMonth);
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Months');
      data.addColumn('number', 'Sales');

      for(var key in salesData){
        if(salesData.hasOwnProperty(key)){
          var month = getNameOfMonth(key);
          var totalSalesOfTheMonth = parseFloat(salesData[key]);
          data.addRow([month,totalSalesOfTheMonth]);
        }
      }

      var formatter = new google.visualization.NumberFormat({
        prefix: '\u20B1 ' // Set the peso sign as a prefix in the tooltip or label
      });
      
      formatter.format(data, 1);

      var options = {
        title: 'Sales Report for 2023',
        titleTextStyle:{fontSize:20},

        hAxis: {
            title: 'Months',
        },
        vAxis: {
            title: 'Total Sales in Philippine Peso ('+'\u20B1'+')'
        },
        colors: ['#cf4a26'] ,
        responsive: true
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('chart_div'));

      chart.draw(data, options);
    }

function getNameOfMonth($monthkey){
  var monthNames = [
    'Jan','Feb','Mar','Apr','May','Jun',
    'July','Aug','Sept','Oct','Nov','Dec'
  ];

  return monthNames[$monthkey-1];
}

// redraw the chart to make it responsive on the user's device everytime the user attempts to resize its browser
window.addEventListener('resize', function () {
    drawBasic(); // Redraw the chart using the drawBasic function
});
</script>

</body>
</html>
