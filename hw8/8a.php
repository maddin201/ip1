<html>
<head>   

<title>homework 8a   </title>
<style type="text/css">
	table {
  width: 60%;
  align: center; 
  border: 1px solid #C98ADE;
  border-collapse: separate;
  border-spacing: 10px;
  bordercolor : #C98ADE;
  
 }
td {
  padding: 10px;
  background-color :  #F5F7B5;
  
}

th {
  padding: 10px;
  background-color :  #C98ADE;
}
</style>
</head>
<body>

<?php

 $DBConnect = mysqli_connect("localhost", "rentalas304", "", "rentalas304")or die("Failed to connect to database " . mysqli_error());
    // mysql_connect("host", "user", "password");
    if (! $DBConnect)

 

{

  echo "<P>Database not available";

}
 

$SQLstring = "SELECT * FROM BASEBALL";

$QueryResult = mysqli_query($DBConnect, $SQLstring);
echo "<center><br /><br /><br /><br /><br />";



echo "<TABLE>";


  echo "<tr><th>TEAMID</th><th>TEAMNAME</th><th>TEAMCITY</th></tr>";




while ($Row = mysqli_fetch_assoc($QueryResult))

{

  echo "<tr><td>{$Row['TEAMID']}</td>";

  echo "<td>{$Row['TEAMNAME']}</td>";

  echo "<td>{$Row['TEAMCITY']}</td></tr>";

}

echo "</TABLE>";
echo "</center>";
mysqli_close($DBConnect);

?>

</body>
</html>