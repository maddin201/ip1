





<?php
 $DBConnect = mysqli_connect("localhost", "rentalas304", "", "rentalas304")or die("Failed to connect to database " . mysqli_error());
 

if (!$DBConnect)

{

  echo "<P>Database not available";

}
 

else{

$TEAM_ID   =   $_POST["TEAM_ID"];
$TEAM_NAME   =   $_POST["TEAM_NAME"];
$TEAM_CITY   =   $_POST["TEAM_CITY"];


$SQLstring  ="INSERT INTO BASEBALL(TEAMID,TEAMNAME,TEAMCITY) VALUES ($TEAM_ID,'$TEAM_NAME', '$TEAM_CITY')";


//echo $SQLstring;
$QueryResult = mysqli_query($DBConnect,$SQLstring);
echo "Record Added..!!";

mysqli_close($DBConnect);
}


?>