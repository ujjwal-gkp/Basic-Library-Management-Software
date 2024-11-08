<?php
session_start();
$bookDatabase = $_SESSION["email"] . "-book";
$studentDatabase = $_SESSION["email"] . "-student";
require_once '../dbconnect.php';
$conn = dbconnect();
if ($conn) {
    // if($_POST["motive"] == "UPDATEBOOK") { todo implement dashoard to show avail and total book in library
    //     $sql = "SELECT `available`, `borrowed` FROM `users` WHERE id=$studentId;";
    // }else
    if ($_POST["motive"] == "UPDATEBOOK") {
        $bookId = $_POST["bookId"];
        $bookName = $_POST["vmBookName"];
        $bookAuthor = $_POST["vmBookAuthor"];
        $sql = "UPDATE `$bookDatabase` SET `name` = '$bookName', `author` = '$bookAuthor' WHERE `$bookDatabase`.`id`=$bookId;";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "Book updated successfully";
        } else {
            echo "Error updating book";
        }
    } elseif ($_POST["motive"] == "UPDATESTUDENT") {
        $studentId = $_POST["studentId"];
        $studentName = $_POST["vmStudentName"];
        $studentCourse = $_POST["vmStudentCourse"];
        $studentBranch = $_POST["vmStudentBranch"];
        $studentYear = $_POST["vmStudentYear"];
        $studentPhone = $_POST["vmStudentPhone"];
        $studentEmail = $_POST["vmStudentEmail"];
        $sql = "UPDATE `$studentDatabase` SET `name` = '$studentName', `course` = '$studentCourse', `branch` = '$studentBranch', `year` = '$studentYear', `phone` = '$studentPhone', `email` = '$studentEmail' WHERE `$studentDatabase`.`id`=$studentId;";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "Student Deatils Updated Successfully.";
        } else {
            echo "Error Updating Student Details.";
        }
    }elseif ($_POST["motive"] == "DELETEBOOK") {
        $bookId = $_POST["bookId"];
        $sql = "DELETE FROM `$bookDatabase` WHERE id = '$bookId'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "Book deleted successfully";
        } else {
            echo "Error deleting book";
        }
    }
}
?>