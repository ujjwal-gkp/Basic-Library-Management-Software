<?php
session_start();
$bookDatabase = $_SESSION["email"] . "-book";
$studentDatabase = $_SESSION["email"] . "-student";
require_once '../dbconnect.php';
$conn = dbconnect();
if ($conn) {
    // echo var_dump($_POST);
    if (isset($_POST["bStudentId"])) {
        $studentId = $_POST["bStudentId"];
        $bookId = $_POST["bBookId"];
        $sql = "SELECT `borrowed` FROM `$studentDatabase` WHERE id=$studentId;";
        $result = mysqli_query($conn, $sql);
        if($result){
            $djson = json_decode(mysqli_fetch_assoc($result)["borrowed"]);
            $djson[]=$bookId;
            $json = json_encode($djson);
            $sql = "UPDATE `$studentDatabase` SET `borrowed` = '$json' WHERE `$studentDatabase`.`id` = $studentId;";
            $result = mysqli_query($conn, $sql);
            $sql2 = "UPDATE `$bookDatabase` SET `available` = `available`-1, `borrowed` = `borrowed`+1 WHERE `$bookDatabase`.`id` = $bookId;";
            $result2 = mysqli_query($conn, $sql2);
            if ($result && $result2) {
                echo "Book Borrowed Successfully";
            }else{
                echo "Something Error While Book Borrow.";
            }
        }
    }elseif (isset($_POST["rStudentId"])) {
        $studentId = $_POST["rStudentId"];
        $bookId = $_POST["rBookId"];
        $sql = "SELECT `borrowed` FROM `$studentDatabase` WHERE id=$studentId;";
        $result = mysqli_query($conn, $sql);
        if($result){
            $djson = json_decode(mysqli_fetch_assoc($result)["borrowed"]);
            $idx = array_search($bookId, $djson);
            if ($idx != -1) unset($djson[$idx]);
            $json = json_encode($djson);
            $sql = "UPDATE `$studentDatabase` SET `borrowed` = '$json' WHERE `$studentDatabase`.`id` = $studentId;";
            $result = mysqli_query($conn, $sql);
            $sql2 = "UPDATE `$bookDatabase` SET `available` = `available`+1, `borrowed` = `borrowed`-1 WHERE `$bookDatabase`.`id` = $bookId;";
            $result2 = mysqli_query($conn, $sql2);
            if ($result && $result2) {
                echo "Book Returned Successfully";
            }else{
                echo "Something Error While Book Return.";
            }
        }
    }elseif (isset($_POST["vmBookId"])) {
        $bookId = $_POST["vmBookId"];
        $sql = "SELECT * FROM `$bookDatabase` WHERE id=$bookId;";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            echo json_encode($row);
        } else {
            echo "Got Error While Searching Book.";
        }
    } elseif (isset($_POST["aBookId"])) {
        $bookId = $_POST["aBookId"];
        $bookName = $_POST["aBookName"];
        $bookAuthor = $_POST["aBookAuthor"];
        $totalBook = $_POST["aTotalBook"];
        $sql = "INSERT INTO `$bookDatabase` (`id`, `name`, `author`, `available`, `borrowed`) VALUES ('$bookId','$bookName','$bookAuthor', '$totalBook','0');";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "Book Added Successfully";
        } else {
            echo "Error Adding Book";
        }
    } elseif(isset($_POST["nsBookId"])) {
        $bookId = $_POST["nsBookId"];
        $bookQty = $_POST["nsBookQty"];
        $sql = "UPDATE `$bookDatabase` SET available = available+$bookQty WHERE id = '$bookId';";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "Book Appended Successfully.";
        } else {
            echo "Got Error While Appending Book.";
        }
    } elseif(isset($_POST["vmStudentId"])) {
        $studentId = $_POST["vmStudentId"];
        $sql = "SELECT * FROM `$studentDatabase` WHERE id=$studentId;";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            echo json_encode($row);
        } else {
            echo "Got Error While Searching Student.";
        }
    } elseif(isset($_POST["asStudentId"])) {
        $studentId = $_POST["asStudentId"];
        $studentName = $_POST["asStudentName"];
        $studentCourse = $_POST["asStudentCourse"];
        $studentBranch = $_POST["asStudentBranch"];
        $studentYear = $_POST["asStudentYear"];
        $studentPhone = $_POST["asStudentPhone"];
        $studentEmail = $_POST["asStudentEmail"];
        $sql = "INSERT INTO `$studentDatabase` (`id`, `name`, `course`,`branch`, `year`, `borrowed`, `phone`, `email`) VALUES ('$studentId','$studentName','$studentCourse','$studentBranch','$studentYear','[]','$studentPhone','$studentEmail');";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "Student Added Successfully.";
        } else {
            echo "Got Error While Adding Student.";
        }
    }
}


?>
