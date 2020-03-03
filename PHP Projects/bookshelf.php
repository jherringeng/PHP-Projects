<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PHP Calculator</title>

    <style>
    .book{
        transform: rotateZ(90deg);
        transform-origin: top left;
        width: 90px !important;
        height: 45px !important;
        margin-bottom: 45px;
      }

    .shelf{
        height: 90px;
        margin-top: 10px;
      }
    </style>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  </head>

  <body>
    <?php

      session_start();

      if (isset( $_SESSION['myuser'] )) {

        $books = $_SESSION['myuser'];

      }

      else {

        $apple = new Book("Apple", "Tree", "2019", "fiction");
        $banana = new Book("Banana", "Tree", "2019", "fiction");

        $books = array (

          $apple,
          $banana

        );


        $_SESSION['myuser'] = $books;

      }

      $books = getPostData($books);

      $_SESSION['myuser'] = $books;
      $books = $_SESSION['myuser'];

     ?>

    <div class="container">
      <div class="card">
      <h5 class="card-header">PHP Bookshelf</h5>
      <div class="row">
        <div class="col-sm-4">
        <h5 class="card-title">Create books for bookshelf:</h5>

            <form method="post" attribute="post" action="bookshelf.php">
              <p>Title:<br/>
              <input type="text" id="name" name="name"></p>
              <p>Author:<br/>
              <input type="text" id="author" name="author"></p>
              <p>Year:<br/>
              <input type="text" id="year" name="year"></p>
              <label for="add">Fiction</label>
              <input type="radio" name="group1" id="fiction" value="fiction">
              <label for="subtract">Non-Fiction</label>
              <input type="radio" name="group1" id="nonfiction" value="nonfiction">
              <button class= "btn btn-primary" type="create" name="answer" id="answer" value="answer">Create</button>
            </form>


        <a href="" onclick="myAjax()" class="btn btn-danger" value="reset" id="reset">Reset</a>
      </div>

    <div class="col-sm-8">
      <div class="shelf border-bottom border-dark">
        <p class="card-text ">

          <?php echo showBooks($books); ?>

        </p>
      </div>

        Number of books: <?php echo Book::$book_num; ?>

    </div>

  </div>

    <?php
      class Book {
        public static $book_num = 0;
        public $name;
        public $author;
        public $year;
        public $type;
        public $bookNumber;

        function __construct($name, $author, $year, $type) {
          $this->name = $name;
          $this->author = $author;
          $this->year = $year;
          $this->type = $type;
          $this->bookNumber = self::$book_num;

          self::$book_num++;

        }

        public function getBookNum () {
          return static::$book_num;
        }
        function get_name() {
          return $this->name;
        }
        function get_author() {
          return $this->author;
        }
        function get_year() {
          return $this->year;
        }
        function get_type() {
          return $this->type;
        }

      }

      function showBook($book) {

        $name = $book->name;
        echo "<button class= \"btn btn-primary book border border-dark\" type=\"create\" name=\"answer\" id=\"answer\" value=\"answer\">".$name."</button>";

      }

      function showBooks($books) {

        foreach ($books as $book) {

            showBook($book);

        }

      }

      function getPostData($books) {

          if(!empty($_POST['group1'])) {
              $name = $_POST['name'];
              $author = $_POST['author'];
              $year = $_POST['year'];
              if($_POST['group1'] == "fiction") {
                $type = "fiction";
              }
              else if($_POST['group1'] == "nonfiction") {
                $type = "nonfiction";
              }

              $newBook = new Book($name, $author, $year, $type);
              $books[] = $newBook;

          }
          return $books;
      }

      ?>

      <script>

      function myAjax() {
            $.ajax({

                 type: "POST",
                 url: 'ajax.php',
                 data:{action:'call_this'},
                 success:function(html) {
                   alert("Session reset.");
                 }

            });
       }

       </script>


  </body>
</html>
