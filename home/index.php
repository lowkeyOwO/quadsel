<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chart.js Dummy Code</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<canvas id="myChart" width="400" height="200"></canvas>
<script>
var data = {
  labels: ['January', 'February', 'March', 'April', 'May'],
  datasets: [{
    label: 'Dummy Bar Chart',
    backgroundColor: 'rgba(75, 192, 192, 0.2)',
    borderColor: 'rgba(75, 192, 192, 1)',
    borderWidth: 1,
    data: [65, 59, 80, 81, 56],
  }]
};
var options = {
  scales: {
    y: {
      beginAtZero: true
    }
  }
};
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: data,
  options: options
});
</script>

</body>
</html>
