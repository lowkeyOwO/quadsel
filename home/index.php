<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
  <style>
    #navbar-item {
      background: url(quadsel_logo.png) no-repeat center center;
      background-size: cover;
      width: 130px;
      height: 48px;
      /* Set a height for the navbar-item */
    }
  </style>
</head>

<body>
  <nav class="navbar has-shadow" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" id="navbar-item" href="./"></a>

      <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="mainNav">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>

    <div id="mainNav" class="navbar-menu">
      <div class="navbar-end">
        <a class="navbar-item" href="./">
          Analytics
        </a>

        <a class="navbar-item" href="./employee">
          Employee
        </a>
        <a class="navbar-item" href="./visitors">
          Visitors
        </a>
        <a class="navbar-item button is-danger mt-2">
          Logout
        </a>
      </div>
    </div>
  </nav>
  <div style="width: 800px; height: 400px;"><canvas id="acquisitions"></canvas></div>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      new Chart(document.getElementById('acquisitions'), {
        type: 'bar',
        data: {
          datasets: [{
            label: 'Bar Dataset',
            data: // Array of count(attendees),
            order: 2
          }, {
            label: 'Line Dataset',
            data: // Array of count(absentees),
            type: 'line',
            order: 1
          }],
          labels: // Array of Dates
        },
      });


      const $navbarBurgers = Array.from(document.querySelectorAll('.navbar-burger'));
      $navbarBurgers.forEach(el => {
        el.addEventListener('click', () => {
          const target = el.dataset.target;
          const $target = document.getElementById(target);
          el.classList.toggle('is-active');
          $target.classList.toggle('is-active');
        });
      });
    });
  </script>
</body>

</html>