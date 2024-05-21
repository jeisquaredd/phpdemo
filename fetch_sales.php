<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome!</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- For Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="includes/style.css?v=<?php echo time(); ?>">

</head>
<body>
    <div class="continer">
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
<script>
window.onload = function() {

var dataPoints = [];

var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    theme: "light2",
    zoomEnabled: true,
    title: {
        text: "Sales Transactions"
    },
    axisX:{
        title: "Date"
    },
    axisY: {
        title: "Total Sales in Peso",
        titleFontSize: 24,
        prefix: "₱"
    },
    data: [{
        type: "line",
        xValueFormatString: "YYYY-MM-DD",
        yValueFormatString: "₱#,##0.00",
        dataPoints: dataPoints
    }]
});

function addData(data) {
    var salesData = data.sales_data;
    for (var i = 0; i < salesData.length; i++) {
        dataPoints.push({
            x: new Date(salesData[i][0]),
            y: salesData[i][1]
        });
    }
    chart.render();
}

$.getJSON("fetch_sales_data.php", addData);

}
</script>

</body>
</html>
