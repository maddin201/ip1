 <?php
 if(!isset($_SESSION)){
    session_start();
}
 $con = mysqli_connect("localhost","alharbir287","","alharbir287")
or die("Failed to connect to database " . mysqli_error());
 
 ?>