<?php
session_start();
include("includes/header.php");
include("includes/conn.php");
$dt = date("Y-m-d");
?>
    <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            <?php
			include("sidebar.php");
			doctorhome();
			?>
            </div>
   		</div>
        <div id="content" class="float_r">
   
  <h4><strong> Doctor's Appointments Details:</strong></h4>
  <table width="689" border="2">
<tr bgcolor="#CCCCCC"> 
  <td width="98" height="42" align="center">Appointment No.</td>
                <td width="132" align="center">Doctor Name</td>
                <td width="129" align="center">Patient Name</td>
                <td width="166" align="center">Appointment <br />
                Date / Time</td>
                <td width="130" align="center">Status</td>
          </tr>
<?php
$result = mysqli_query($con, "SELECT * FROM appointment WHERE app_date>='$dt' AND branch_id='$_SESSION[branch_id]'");
  while($row = mysqli_fetch_array($result))
  {	
  $retpat =mysqli_query($con, "SELECT * FROM patient WHERE pat_id= '$row[pat_id]'");
  $patrec = mysqli_fetch_array($retpat);
	$retdoc =mysqli_query($con, "SELECT * FROM doctor WHERE doc_id= '$row[doc_id]'");
  $docrec = mysqli_fetch_array($retdoc);

  echo "<tr>";
  echo "<td align='center'> &nbsp;" . $row['app_id'] . "</td>";
  echo "<td> &nbsp;" . $docrec['doc_name'] . "</td>";
  echo "<td> &nbsp;" . $patrec['pat_name'] . "</td>";
  echo "<td> &nbsp;" . $row['app_date']. " ". $row['app_time'] . "</td>";
   echo "<td align='center'>";

   if($row['status'] == "pending")
   {
	   echo "Pending | <br> <a href='test.php?appid=$row[app_id]'>Update</a>";
   }
   else
   {
	   	$rettests =mysqli_query($con, "SELECT * FROM test WHERE app_id= '$row[app_id]'");
  $rectests = mysqli_fetch_array($rettests);
  
	   echo "Done <br>";
 		if($_SESSION["logtype"] == "Administrator")
		{
		echo "<a href='products.php?appid=$row[app_id]&patid=$row[pat_id]&testids=$rectests[test_id]'>Order specs</a>";
		}
 
   }
  
 echo "  </td>";
  echo "</tr>";
  }
?>
          </table>
          
      </div>

        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    <?php
include("includes/footer.php");
?>
  </div>