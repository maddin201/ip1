
<?php


header("Cache-Control: post-check=1,pre-check=2");

header("Cache-Control: no-cache, must-revalidate");

header("Pragma: no-cache");

header("Content-type: text/xml");


echo "<root>";  
 
$tid =$_GET["tid"];
// $_GET["tid"];
//echo $tid;

$DBConnect = mysqli_connect("localhost", "rentalas304", "", "rentalas304") Or die("<error>no database</error></root>");

$query =  "SELECT * FROM BASEBALL WHERE TEAMID = '$tid'";

$QueryResult = mysqli_query($DBConnect,$query)

     Or die("<error>Unable to execute the query " .

            "Error code " . mysqli_errno($DBConnect) .

            " : " . mysqli_error($DBConnect) . "</error></root>");

$Row = mysqli_fetch_row($QueryResult);

if ($Row)

{

  echo "<TEAM_ID>" . $Row[0] . "</TEAM_ID>";

  echo "<TEAM_NAME>" . $Row[1] . "</TEAM_NAME>";

  echo "<TEAM_CITY>" . $Row[2] . "</TEAM_CITY>";

}

echo "</root>";


mysqli_close($DBConnect);

?>