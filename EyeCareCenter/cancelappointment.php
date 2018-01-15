<?php
session_start();
include("includes/header.php");
include("includes/conn.php");
$aprow = 0;
$aff="";
?>

<script type="text/JavaScript">
function confirmDelete()
{
	var agree=confirm("Are You Sure that You Want to Cancel This Appointment?");
	if(agree)
	return true;
	else
	return false;
}
</script>
<?php
$deli=0;
if(isset($_GET['canid'])){

$aprow = mysqli_query($con,"SELECT FROM appointment where app_id='$_GET[canid]'");

mysqli_query($con,"DELETE FROM appointment where app_id='$_GET[canid]'");
}
if(mysqli_affected_rows()==1)
{
	$deli =1;
	$delq = "Appointment ".$_GET['canid']." Deleted Successfully.";
}


$resultpat = mysqli_query($con,"SELECT * FROM patient where pat_id='$aprow[pat_id]'");
$rowpat = mysqli_fetch_array($resultpat);
?>
    
     <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            	<?php
				include("sidebar.php");
				patienthome();
				?>
            </div>
   		</div>
      <div id="content" class="faq float_r">
       <h2>Appointments Details:</h2>
       <table width="687" border="1">
           
        
              <?php 
			  if($deli == 1)
			  {
			  echo "<br>".$delq;
			  }
			  ?>
              </td>
              </td>
            </tr>
            <tr bgcolor="#FFFFCC">
              <td width="126">Appointment ID</td>
              <td width="99">Branch Name</td>
              <td width="121">Doctor Name</td>
              <td width="115">Date</td>
              <td width="122">Time</td>
              <td width="78">Action</td>
            </tr>
            
<?php

$retapp = mysqli_fetch_array($resultpat);
			 
if(isset($_SESSION['pat_id']))
{
$result = mysqli_query($con,"SELECT * FROM appointment where pat_id='$_SESSION[pat_id]' AND status='pending'");	
}
else
{
$result = mysqli_query($con,"SELECT * FROM appointment");		  
}
while($row = mysqli_fetch_array($result))
  {
	  $result1 = mysqli_query($con,"SELECT * FROM branch where branch_id='$row[branch_id]'");
			  $row1 = mysqli_fetch_array($result1);
		$resdoctor= mysqli_query($con,"SELECT * from doctor where doc_id='$row[doc_id]'");
			  $retdoctor= mysqli_fetch_array($resdoctor);	   
  echo "<tr>";
  echo "<td>" . $row['app_id'] . "</a></td>";
  echo "<td>" . $row1['branch_name'] . "</td>";
  echo "<td>" . $retdoctor['doc_name'] . "</td>";
  echo "<td>" . $row['app_date'] . "</td>";
  echo "<td>" . $row['app_time'] . "</td>";
  echo "<td> <a href='cancelappointment.php?canid=$row[app_id]' onClick='return confirmDelete();'>Cancel</a> </td>";
  echo "</tr>";
  }
  
?>
          </table>
 	</div> 
        <div class="cleaner"></div>
    </div> 
    <?php
include("includes/footer.php");
?>