<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Library Management Software</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="style.css" rel="stylesheet">
</head>
<?php
session_start();
if (isset($_SESSION["email"]) && isset($_SESSION["password"])) {
  require_once 'dbconnect.php';
  $conn = dbconnect();
  if (!$conn) {
    echo "<script>alert('Cannot connect to database.')</script>";
  } else {
    $email = $_SESSION["email"];
  }
} else {
  header("location: .\\login");
  exit;
}
?>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="./">Basic Library Management Software</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.instagram.com/ujjwal.gkp/">Contact Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col">
        <div class="mainframe">

          <div class="margin_padding each_frame" id="dashboard"></div>

          <!-- Borrow Book -->
          <div class="margin_padding each_frame" id="borrow_book">
            <div class="p-3 mb-2 bg-body-secondary">
              <h2>Borrow Book</h2>
            </div>

            <form action="../bin/process.php" method="post" id="BORROW_BOOK">
              <div class="mb-3 row">
                <label for="bStudentId" class="col-sm-2 col-form-label">Student Id</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" name="bStudentId" id="bStudentId">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="bBookId" class="col-sm-2 col-form-label">Enter Book Id</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" name="bBookId" id="bBookId">
                </div>
              </div>
              <button type="submit" class="btn btn-primary" style="width:100%">Submit</button>
            </form>

          </div>

          <!-- Return Book -->
          <div class="margin_padding each_frame" id="return_book">
            <div class="p-3 mb-2 bg-body-secondary">
              <h2>Return Book</h2>
            </div>

            <form action="../bin/process.php" method="post" id="RETURN_BOOK">
              <div class="mb-3 row">
                <label for="rStudentId" class="col-sm-2 col-form-label">Student Id</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" name="rStudentId" id="rStudentId">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="rBookId" class="col-sm-2 col-form-label">Enter Book Id</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" name="rBookId" id="rBookId">
                </div>
              </div>
              <button type="submit" class="btn btn-primary" style="width:100%">Submit</button>
            </form>
          </div>

          <!-- View/manage Book -->
          <div class="margin_padding each_frame" id="view_book">
            <div class="p-3 mb-2 bg-body-secondary">
              <h2>View/Manage Book Details</h2>
            </div>

            <form class="row g-3" action="../bin/process.php" method="post" id="VIEW_BOOK">
              <div class="col-auto">
                <label for="bookIdLabel" class="visually-hidden">Enter Book Id</label>
                <input type="text" readonly class="form-control-plaintext" id="bookIdLabel" value="Enter Book Id">
              </div>
              <div class="col-auto">
                <label for="vmBookId" class="visually-hidden">Book Id</label>
                <input type="number" name="vmBookId" class="form-control" id="vmBookId" placeholder="1234">
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Search</button>
              </div>
            </form>
            <form action="../bin/process.php" method="post" id="UPDATE_BOOK">
              <div class="mb-3 row">
                <label for="vmBookName" class="col-sm-2 col-form-label">Book Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="vmBookName" name="vmBookName">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="vmBookAuthor" class="col-sm-2 col-form-label">Book Author</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="vmBookAuthor" name="vmBookAuthor">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="vmTotalBook" class="col-sm-2 col-form-label">Total Book Quantity</label>
                <div class="col-sm-10">
                  <label class="form-control" id="vmTotalBook">-</label>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="vmBookBorrowed" class="col-sm-2 col-form-label">Borrowed Book Quantity</label>
                <div class="col-sm-10">
                  <label class="form-control" id="vmBookBorrowed">-</label>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="vmBookAvail" class="col-sm-2 col-form-label">Available Book Quantity</label>
                <div class="col-sm-10">
                  <label class="form-control" id="vmBookAvail">-</label>
                </div>
              </div>
              <button class="btn btn-primary" id="deleteBook" style="width:49%">Delete Book</button>
              <button id="updateBook" class="btn btn-primary" style="width:50%">Update Book</button>
            </form>

          </div>

          <!-- New Stock -->
          <div class="margin_padding each_frame" id="new_stock">
            <div class="p-3 mb-2 bg-body-secondary">
              <h2>New Stock</h2>
            </div>

            <form action="../bin/process.php" method="post" id="NEW_STOCK">
              <div class="mb-3 row">
                <label for="nsBookId" class="col-sm-2 col-form-label">Book Id</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="nsBookId" name="nsBookId">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="nsBookQty" class="col-sm-2 col-form-label">Book Quantity</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="nsBookQty" name="nsBookQty">
                </div>
              </div>
              <button type="submit" class="btn btn-primary" style="width:100%">Append Book</button>
            </form>

          </div>

          <!-- ADD NEW BOOK TO LIBRARY -->
          <div class="margin_padding each_frame" id="add_book">
            <div class="p-3 mb-2 bg-body-secondary">
              <h2>Add New Book</h2>
            </div>

            <form action="../bin/process.php" method="post" id="ADD_BOOK">
              <div class="mb-3 row">
                <label for="aBookId" class="col-sm-2 col-form-label">Book Id</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="aBookId" name="aBookId">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="aBookName" class="col-sm-2 col-form-label">Book Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="aBookName" name="aBookName">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="aBookAuthor" class="col-sm-2 col-form-label">Book Author</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="aBookAuthor" name="aBookAuthor">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="aTotalBook" class="col-sm-2 col-form-label">Total Book Quantity</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="aTotalBook" name="aTotalBook">
                </div>
              </div>
              <button type="submit" class="btn btn-primary" style="width:100%">Create Book</button>
            </form>

          </div>

          <!-- View/Manage Student -->
          <div class="margin_padding each_frame" id="view_student">
            <div class="p-3 mb-2 bg-body-secondary">
              <h2>View/Manage Student Details</h2>
            </div>

            <form class="row g-3" action="../bin/process.php" method="post" id="VIEW_STUDENT">
              <div class="col-auto">
                <label for="vmStudentIdLabel" class="visually-hidden">Enter Student Id</label>
                <input type="text" readonly class="form-control-plaintext" id="vmStudentIdLabel"
                  value="Enter Student Id">
              </div>
              <div class="col-auto">
                <label for="vmStudentId" class="visually-hidden">Student Id</label>
                <input type="number" name="vmStudentId" class="form-control" id="vmStudentId" placeholder="0000">
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Search</button>
              </div>
            </form>
            <form action="../bin/process.php" method="post" id="UPDATE_STUDENT">
              <div class="mb-3 row">
                <label for="vmStudentName" class="col-sm-2 col-form-label">Student Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="vmStudentName" name="vmStudentName">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="vmStudentCourse" class="col-sm-2 col-form-label">Student Course</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="vmStudentCourse" name="vmStudentCourse">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="vmStudentBranch" class="col-sm-2 col-form-label">Student Branch</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="vmStudentBranch" name="vmStudentBranch">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="vmStudentYear" class="col-sm-2 col-form-label">Student Year</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="vmStudentYear" name="vmStudentYear">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="vmStudentPhone" class="col-sm-2 col-form-label">Student Phone</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="vmStudentPhone" name="vmStudentPhone">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="vmStudentEmail" class="col-sm-2 col-form-label">Student Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="vmStudentEmail" name="vmStudentEmail">
                </div>
              </div>
              <button class="btn btn-primary" id="deleteStudent" style="width:49%">Delete Student</button>
              <button id="updateStudent" class="btn btn-primary" style="width:50%">Update Student Details</button>
            </form>

          </div>

          <!-- ADD NEW STUDENT -->
          <div class="margin_padding each_frame" id="add_student">
            <div class="p-3 mb-2 bg-body-secondary">
              <h2>Add New Student</h2>
            </div>

            <form action="../bin/process.php" method="post" id="ADD_STUDENT">
              <div class="mb-3 row">
                <label for="asStudentId" class="col-sm-2 col-form-label">Student Id</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="asStudentId" name="asStudentId">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="asStudentName" class="col-sm-2 col-form-label">Student Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="asStudentName" name="asStudentName">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="asStudentCourse" class="col-sm-2 col-form-label">Student Course</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="asStudentCourse" name="asStudentCourse">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="asStudentBranch" class="col-sm-2 col-form-label">Student Branch</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="asStudentBranch" name="asStudentBranch">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="asStudentYear" class="col-sm-2 col-form-label">Studying Year</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="asStudentYear" name="asStudentYear">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="asStudentPhone" class="col-sm-2 col-form-label">Student Phone</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="asStudentPhone" name="asStudentPhone">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="asStudentEmail" class="col-sm-2 col-form-label">Student Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="asStudentEmail" name="asStudentEmail">
                </div>
              </div>
              <button type="submit" class="btn btn-primary" style="width:100%">Add Student</button>
            </form>

          </div>

        </div>
      </div>
      <!-- MENU BUTTONS -->
      <div class="col-2">
        <div class="container text-center">
          <div class="column">
            <div class="mainmenu">
              <div id="home">
                <div class="d-grid gap-2 each_menu">
                  <button onclick="change_frame(1)" class="btn btn-secondary border border-info-subtle"
                    id="btn_borrow_book" type="button">Borrow Book</button>
                  <button onclick="change_frame(2)" class="btn btn-secondary border border-info-subtle"
                    id="btn_return_book" type="button">Return Book</button>
                  <button onclick="change_menu(1)" class="btn btn-secondary border border-info-subtle"
                    id="btn_manage_book" type="button">Add/Manage Book</button>
                  <button onclick="change_menu(2)" class="btn btn-secondary border border-info-subtle"
                    id="btn_manage_student" type="button">Add/Manage Student</button>
                </div>
              </div>
              <div id="manage_book">
                <div class="d-grid gap-2 each_menu">
                  <button onclick="change_frame(3)" class="btn btn-secondary border border-info-subtle"
                    id="btn_borrow_book" type="button">View/Manage Book Status</button>
                  <button onclick="change_frame(4)" class="btn btn-secondary border border-info-subtle"
                    id="btn_return_book" type="button">New Stock</button>
                  <button onclick="change_frame(5)" class="btn btn-secondary border border-info-subtle"
                    id="btn_manage_book" type="button">Add New Book</button>
                  <button onclick="change_menu(0)" class="btn btn-secondary border border-info-subtle"
                    id="btn_dashboard" type="button">Back</button>
                </div>
              </div>
              <div id="manage_student">
                <div class="d-grid gap-2 each_menu">
                  <button onclick="change_frame(6)" class="btn btn-secondary border border-info-subtle"
                    id="btn_borrow_book" type="button">View/Manage Student</button>
                  <button onclick="change_frame(7)" class="btn btn-secondary border border-info-subtle"
                    id="btn_return_book" type="button">Add New Student</button>
                  <button onclick="change_menu(0)" class="btn btn-secondary border border-info-subtle"
                    id="btn_dashboard" type="button">Back</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <script type="text/javascript">
    $(document).ready(function () {
      function sendData($form) {
        let dataString = $form.serialize();
        return $.ajax({
          type: $form.attr('method'),
          url: $form.attr('action'),
          data: dataString
        });
      }

      $('#BORROW_BOOK').on('submit', function (e) {
        e.preventDefault();
        sendData($(this)).done(function (res) {
          console.log(alert(res));
          $('#BORROW_BOOK').trigger("reset");
        });
      });

      $('#RETURN_BOOK').on('submit', function (e) {
        e.preventDefault();
        sendData($(this)).done(function (res) {
          console.log(alert(res));
          $('#RETURN_BOOK').trigger("reset");
        });
      });

      // $('form').validate();
      $('#VIEW_BOOK').on('submit', function (e) {
        e.preventDefault();
        sendData($(this)).done(function (q) {
          var json = $.parseJSON(q);
          var total = parseInt(json['available']) + parseInt(json['borrowed']);
          $('#vmBookName').attr('placeholder', json['name']);
          $('#vmBookAuthor').attr('placeholder', json['author']);
          $('#vmTotalBook').html(total);
          $('#vmBookBorrowed').html(json['borrowed']);
          $('#vmBookAvail').html(json['available']);
        });
      });

      $('#VIEW_STUDENT').on('submit', function (e) {
        e.preventDefault();
        sendData($(this)).done(function (q) {
          var json = $.parseJSON(q);
          $('#vmStudentName').attr('placeholder', json['name']);
          $('#vmStudentCourse').attr('placeholder', json['course']);
          $('#vmStudentBranch').attr('placeholder', json['branch']);
          $('#vmStudentYear').attr('placeholder', json['year']);
          $('#vmStudentPhone').attr('placeholder', json['phone']);
          $('#vmStudentEmail').attr('placeholder', json['email']);
        });
      });

      $('#NEW_STOCK').on('submit', function (e) {
        e.preventDefault();
        sendData($(this)).done(function (res) {
          console.log(alert(res));
          $('#NEW_STOCK').trigger("reset");
        });
      });

      $('#ADD_BOOK').on('submit', function (e) {
        e.preventDefault();
        sendData($(this)).done(function (res) {
          console.log(alert(res));
          $('#ADD_BOOK').trigger("reset");
        });
      });

      $('#ADD_STUDENT').on('submit', function (e) {
        e.preventDefault();
        sendData($(this)).done(function (res) {
          console.log(alert(res));
          $('#ADD_STUDENT').trigger("reset");
        });
      });



      function sendGivenData($dataGiven) {
        return $.ajax({
          type: 'POST',
          url: '../bin/single_process.php',
          data: $dataGiven,
        });
      }

      $('#deleteBook').click(function (e) {
        e.preventDefault();
        var bookIdd = $('#vmBookId').val();
        sendGivenData({ motive: "DELETEBOOK", bookId: bookIdd }).done(function (res) {
          console.log(alert(res));
        });
      });

      $('#updateBook').click(function (e) {
        e.preventDefault();
        var bookIdd = $('#vmBookId').val();
        var bookName = $('#vmBookName').val();
        if (!bookName) {
          bookName = $('#vmBookName').attr('placeholder');
        }
        var bookAuthor = $('#vmBookAuthor').val()
        if (!bookAuthor) {
          bookAuthor = $('#vmBookAuthor').attr('placeholder');
        }
        sendGivenData({ motive: "UPDATEBOOK", vmBookName: bookName, vmBookAuthor: bookAuthor, bookId: bookIdd }).done(function (res) {
          console.log(alert(res));
          $('#UPDATE_BOOK').trigger("reset");
        });
      });

      $('#updateStudent').click(function (e) {
        e.preventDefault();
        var studentIdd = $('#vmStudentId').val();
        var studentName = $('#vmStudentName').val();
        if (!studentName) {
          studentName = $('#vmStudentName').attr('placeholder');
        }
        var studentCourse = $('#vmStudentCourse').val();
        if (!studentCourse) {
          studentCourse = $('#vmStudentCourse').attr('placeholder');
        }
        var studentBranch = $('#vmStudentBranch').val();
        if (!studentBranch) {
          studentBranch = $('#vmStudentBranch').attr('placeholder');
        }
        var studentYear = $('#vmStudentYear').val();
        if (!studentYear) {
          studentYear = $('#vmStudentYear').attr('placeholder');
        }
        var studentPhone = $('#vmStudentPhone').val();
        if (!studentPhone) {
          studentPhone = $('#vmStudentPhone').attr('placeholder');
        }
        var studentEmail = $('#vmStudentEmail').val();
        if (!studentEmail) {
          studentEmail = $('#vmStudentEmail').attr('placeholder');
        }
        sendGivenData({ motive: "UPDATESTUDENT", vmStudentName: studentName, vmStudentCourse: studentCourse, vmStudentBranch: studentBranch, vmStudentYear: studentYear, vmStudentPhone: studentPhone, vmStudentEmail: studentEmail, studentId: studentIdd }).done(function (res) {
          console.log(alert(res));
          $('#UPDATE_STUDENT').trigger("reset");
          $('#vmStudentName').attr('placeholder', '');
          $('#vmStudentCourse').attr('placeholder', '');
          $('#vmStudentBranch').attr('placeholder', '');
          $('#vmStudentYear').attr('placeholder', '');
          $('#vmStudentPhone').attr('placeholder', '');
          $('#vmStudentEmail').attr('placeholder', '');
        });
      });
    });

  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="main.js"></script>
</body>

</html>