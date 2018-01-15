<?php
session_start();
include("includes/header.php");
include("includes/conn.php");
//$arr = $_POST['group2'];

//$arr = $_POST['group'];

$i=0;
$brquery ="";
/*print_r($arr);
foreach($arr as $value)
{
	if($brquery == "")
	{
	$brquery = "(". $brquery. " appointment.branch_id='".$value."' ";
	}
	else
	{
	$brquery = $brquery. " OR appointment.branch_id='".$value."'";
	}
}
$brquery = $brquery.")";
*/
//echo $brquery;
if(isset($_POST['search']))
{
	if($_POST['group2'] == "Patient Name")
	{
$bquery = "SELECT appointment.app_id,	appointment.branch_id, appointment.pat_id, appointment.doc_id, appointment.app_date, appointment.app_time, appointment.created_at, appointment.status 
FROM patient
INNER JOIN appointment ON patient.pat_id = appointment.pat_id
WHERE patient.pat_name LIKE  '%$_POST[lol]%'";
	$result = mysqli_query($con, $bquery);		
	}
	else if($_POST['group2'] == "Patient ID")
	{
	$bquery = "SELECT appointment.app_id,	appointment.branch_id, appointment.pat_id, appointment.doc_id, appointment.app_date, appointment.app_time, appointment.created_at, appointment.status FROM patient INNER JOIN appointment ON patient.pat_id = appointment.pat_id WHERE appointment.pat_id ='$_POST[lol]'";	
	$result = mysqli_query($con, $bquery);		
	}
	

}
else
{
	$result = mysqli_query($con, "SELECT * FROM appointment");
}
$resbranch = mysqli_query($con, "select * from branch");
?>
    
    <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>

	<?php
include("sidebar.php");
if($_SESSION["logtype"]=='Administrator')
{
		patienthome();
}
else if($_SESSION["logtype"]=='Doctor')
{
		patientrecords();
}
?>

            </div>
   		</div>
        <div id="content" class="float_r">
          <h2>View Appointments:
            </h2>
            <script type="application/javascript" >
function validation()
{
			if(document.form1.lol.value == "")
	{
		alert("Enter Search Field");
		document.form1.lol.focus();
		return false;
	}
		if(document.form1.group2.value == "")
	{
		alert("Select The Field by Which Search to be Made");
		document.form1.group2.focus();
		return false;
	}
	
}
</script>
            <form id="form1" name="form1" method="post" action="" onSubmit="return validation()" >
     


            <p>
              <label for="lol">Search
                <input type="text" name="lol" id="lol" />
              </label>
              <label for="group2">By</label>
<select name="group2" id="group2">
				<option value="">Select</option>
                <option value="Patient ID">Patient ID</option>
                <option value="Patient Name">Patient Name</option>
                
</select>
              <input type="submit" name="search" id="search" value="Search" />
            </p>
            <table width="640" border="1">
<tr>
  <td width="82" height="42">Appointment No.</td>
                <td width="96">Doctor Name</td>
                <td width="132">Patient Name</td>
                <td width="166">Appointment Date/ Time</td>
                <td width="130">Status</td>
          </tr>
              <?php

           	while($row = mysqli_fetch_array($result))
  {	
  $retpat =mysqli_query($con, "SELECT * FROM patient WHERE pat_id= '$row[pat_id]'");
  $patrec = mysqli_fetch_array($retpat);
	$retdoc =mysqli_query($con, "SELECT * FROM doctor WHERE doc_id= '$row[doc_id]'");
  $docrec = mysqli_fetch_array($retdoc);

  echo "<tr>";
  echo "<td>" . $row['app_id'] . "</td>";
  echo "<td>" . $docrec['doc_name'] . "</td>";
  echo "<td>" . $patrec['pat_name'] . "</td>";
  echo "<td>" . $row['app_date']. " ". $row['app_time'] . "</td>";
   echo "<td>";

   if($row['status'] == "pending")
   {
	   echo "Pending | <a href='test.php?appid=$row[app_id]'>Update</a>";
   }
   else
   {
	   	$rettests =mysqli_query($con, "SELECT * FROM test WHERE app_id= '$row[app_id]'");
  $rectests = mysqli_fetch_array($rettests);
  
	   echo "Done";
//	   | <a href='products.php?appid=$row[app_id]&patid=$row[pat_id]&testids=$rectests[test_id]'>Order specs</a>";
   }
  
 echo "  </td>";
  echo "</tr>";
  }
?>
          </table>
             <input type="button" onClick="history.go(-1);" value="Go Back" />
          </form>
     

  </div>
        <div class="cleaner"></div>
    </div> 
    <?php
include("includes/footer.php");
?>
</div>