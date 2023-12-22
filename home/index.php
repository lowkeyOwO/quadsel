<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
  <style>
    #navbar-item {
      background: url(quadsel_logo.png) no-repeat center center;
      background-size: cover;
      width: 130px;
    }
  </style>

</head>

<body>
  <nav class="navbar has-shadow " role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" id="navbar-item" href="./">
      </a>

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
  <script>
    <?php
    
    ?>
    document.addEventListener('DOMContentLoaded', () => {
      const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
      console.log("hello")
      $navbarBurgers.forEach(el => {
        el.addEventListener('click', () => {
          const target = el.dataset.target;
          const $target = document.getElementById(target);
          el.classList.toggle('is-active');
          $target.classList.toggle('is-active');
        });
      });

    });</script>
</body>

</html>