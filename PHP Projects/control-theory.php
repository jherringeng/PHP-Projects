<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PHP Calculator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

  </head>

  <body>
    <div class="container">
      <div class="card">
      <h5 class="card-header">PHP Calculator</h5>
      <div class="card-body">
        <h5 class="card-title">Enter values for calculator:</h5>
        <p class="card-text">

          <div class="row">
            <div class="col-sm-4">
            <form method="post" attribute="post" action="control-theory.php">
              <p>Numerator:<br/>
              <input type="text" id="num" name="num"></p>
              <p>Denominator s-term:<br/>
              <input type="text" id="denS" name="denS"></p>
              <p>Denominator term:<br/>
              <input type="text" id="denR" name="denR"></p>
              <p>Reference:</p>
              <label for="add">Impulse</label>
              <input type="radio" name="group1" id="add" value="impulse">
              <label for="subtract">Step</label>
              <input type="radio" name="group1" id="subtract" value="step">
              <label for="times">Ramp</label>
              <input type="radio" name="group1" id="times" value="ramp">

              <p></p>
              <button class= "btn btn-primary" type="submit" name="answer" id="answer" value="answer">Calculate</button>
            </form>
            <a href="control-theory.php" class="btn btn-danger" value="reset" id="reset">Reset</a>
          </div>

        </p>
        <div class ="col-sm-8">
            <p class="card-text">
              <p>
$$G(s) = {<?php echo getNum()?> \over <?php echo getDenS()?>s + <?php echo getDenR()?>;}.$$
$$C(s) = {<?php echo getRefNum()?> \over <?php echo getRefDen()?>}{<?php echo getNum()?> \over <?php echo getDenS()?>s + <?php echo getDenR()?>;}.$$
              </p>
            </p>

            <p>
              <table class="table table-bordered">
              <?php
                $timeSeries = range(0.0, 5.0, 0.5);

                   echo "<tr>";
                   echo "<td>Name</td>";
                   foreach ($timeSeries as $item) {
                       echo "<td>".$item."</td>";
                   }
                   echo "</tr>";
                   echo "<tr>";
                   echo "<td>Response</td>";
                   $datapoints = array ();
                   foreach ($timeSeries as $item) {
                       $number = (getNum() / getDenR()) - (getNum() / getDenR()) * exp(-getDenR() * $item);
                       echo "<td>".number_format($number, 2)."</td>";
                       array_push($datapoints, array("y" => $number, "label" => strval( $item ) ) );
                   }
                   echo "</tr>";
                   echo "</table>";

              ?></p>

            <div id="chartContainer" style="height: 300px; width: 100%;"></div>

        </div>

      </div>
    </div>

    </div>

    <?php

      function getRefNum() {

        return 1;

      }

      function getRefDen() {

        if(!empty($_POST['group1'])) {

          if($_POST['group1'] == "impulse") {
            return 1;
          }
          else if($_POST['group1'] == "step") {
            return "s";
          }
          else if($_POST['group1'] == "ramp") {
            return "s^2";
          }

        }
        else {
          return 1;
        }

      }

      function getNum() {

        if(!empty($_POST['num'])) {
          return $_POST['num'];
        }
        else {
          return 1;
        }
      }

      function getDenS() {

        if(!empty($_POST['denS'])) {
          return $_POST['denS'];
        }
        else {
          return 1;
        }
      }

      function getDenR() {

        if(!empty($_POST['denR'])) {
          return $_POST['denR'];
        }
        else {
          return 1;
        }
      }

      function getRefSignal() {
        if(!empty($_POST['group1'])) {

            if($_POST['group1'] == "impulse") {
              $refNum = 1;
              $refDen = 1;
            }
            else if($_POST['group1'] == "step") {
              $refNum = 1;
              $refDen = "s";;
            }
            else if($_POST['group1'] == "ramp") {
              $refNum = 1;
              $refDen = "s^2";
            }

        }
      }
  ?>

<script type="text/javascript">

    $(function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "light2",
            animationEnabled: true,
            title: {
                text: "Column Chart in PHP using CanvasJS"
            },
            data: [
            {
                type: "spline",
                dataPoints: <?php echo json_encode($datapoints, JSON_NUMERIC_CHECK); ?>
            }
            ]
        });
        chart.render();
    });
</script>


  </body>
</html>
