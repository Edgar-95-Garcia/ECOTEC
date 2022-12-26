<?php
$GLOBALS['menu'] = 'talleres/horarios';
include_once("./cabecera.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bootstrap Collapse Demonstration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
  </script>
  <style>
    .card {
      width: 600px;
    }

    .card-body {
      width: 400px;
      float: left;
    }

    .right-body {
      width: 100px;
      margin: 10px;
      float: right;
    }

    img {
      width: 100px;
      height: 100px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2 style="padding-bottom: 15px; color:green;">
      GeeksforGeeks</h2>

    <p>A Computer Science Portal for Geeks</p>

    <div id="accordion">
      <div class="card">
        <div class="card-header">
          <a class="card-link" data-toggle="collapse" href="#description1">
            GeeksforGeeks
          </a>
        </div>
        <div id="description1" class="collapse show" data-parent="#accordion">
          <div class="card-body">
            GeeksforGeeks is a computer science portal.
            It is the best platform to lean programming.
          </div>
          <div class="right-body">
            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20190808143838/logsm.png">
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <a class="collapsed card-link" data-toggle="collapse" href="#description2">
            Bootstrap
          </a>
        </div>
        <div id="description2" class="collapse" data-parent="#accordion">
          <div class="card-body">
            Bootstrap is a free and open-source
            collection of tools for creating
            websites and web applications.
          </div>
          <div class="right-body">
            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20191126170417/logo6.png">
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <a class="collapsed card-link" data-toggle="collapse" href="#description3">
            HTML
          </a>
        </div>
        <div id="description3" class="collapse" data-parent="#accordion">
          <div class="card-body">
            HTML stands for Hyper Text Markup
            Language. It is used to design web
            pages using markup language.
          </div>
          <div class="right-body">
            <img src="https://www.geeksforgeeks.org/wp-content/uploads/html-768x256.png">
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<?php
include_once("./pie.php");
?>