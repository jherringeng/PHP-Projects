<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PHP Calculator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  </head>

  <body>
    <div class="container">
      <div class="card">
      <h5 class="card-header">PHP Calculator</h5>
      <div class="card-body">
        <h5 class="card-title">Enter values for calculator:</h5>
        <p class="card-text">

            <form method="post" attribute="post" action="calculator.php">
              <p>First Value:<br/>
              <input type="text" id="first" name="first"></p>
              <label for="add">Add</label>
              <input type="radio" name="group1" id="add" value="add">
              <label for="subtract">Subtract</label>
              <input type="radio" name="group1" id="subtract" value="subtract">
              <label for="times">Times</label>
              <input type="radio" name="group1" id="times" value="times">
              <label for="divide">Divide</label>
              <input type="radio" name="group1" id="divide" value="divide">
              <label for="divide">Power</label>
              <input type="radio" name="group1" id="power" value="power">
              <label for="divide">Root</label>
              <input type="radio" name="group1" id="root" value="root">
              <p>Second Value:<br/>
              <input type="text" id="second" name="second"></p>

              <p></p>
              <button class= "btn btn-primary" type="submit" name="answer" id="answer" value="answer">Calculate</button>
            </form>

        </p>
        <div class ="card-body">
            <p class="card-text">
              <p>
                  <?php
                    if(!empty($_POST['group1'])) {
                        $first = $_POST['first'];
                        $second = $_POST['second'];

                        if($_POST['group1'] == "add") {
                          echo "Answer: $first + $second = ", $first + $second;
                        }
                        else if($_POST['group1'] == "subtract") {
                          echo "Answer: $first - $second = ", $first - $second;
                        }
                        else if($_POST['group1'] == "times") {
                          echo "Answer: $first * $second = ", $first * $second;
                        }
                        else if($_POST['group1'] == "divide") {
                          echo "Answer: $first / $second = ", $first / $second;
                        }
                        else if($_POST['group1'] == "power") {
                          echo "Answer: $first ^ $second = ", pow($first, $second);
                        }
                        else if($_POST['group1'] == "root") {
                          echo "Answer: $first ^ (1/$second) = ", pow($first, 1 / $second);
                        }
                        $_POST = array();
                    }
                  ?>
                  </p>
            </p>
        </div>
        <a href="calculator.php" class="btn btn-danger" value="reset" id="reset">Reset</a>
      </div>
    </div>

    </div>

    <script>

    $(document).ready(function(){
      $('#reset').click(function(){
          var clickBtnValue = $(this).val();
          var ajaxurl = 'ajax.php',
          data =  {'action': clickBtnValue};
          $.post(ajaxurl, data, function (response) {
              // Response div goes here.
              alert("action performed successfully");
          });
      });
      });

    </script>

    <?php
    function myAjax() {
          $.ajax({
               type: "POST",
               url: 'your_url/ajax.php',
               data:{action:'call_this'},
               success:function(html) {
                 alert(html);
               }

          });
     }
     ?>

  </body>
</html>
