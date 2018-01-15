<?php
include("includes/header.php");
include("includes/conn.php");
$rcsucc="";
?>
<script type="text/javascript">

function deleteImage(x){
    //var conf = confirm("Are you sure you want to delete this loan type?");
	
    if(confirm("Are You Sure You Want to Delete This Patient Record?") == true)
	{
         alert("The Patient's Record Deleted Successfully.");
    }
	else
	{
 return false;
	}
}
</script>
<?php
if(isset($_POST['search']))
{
	if($_POST['group'] == "Patient Name")
	{
	$result = mysqli_query($con,"SELECT * FROM  patient WHERE  pat_name LIKE  '%$_POST[patname]%'");
	}
	else if($_POST['group'] == "Patient ID")
	{
	$result = mysqli_query($con, "SELECT * FROM  patient WHERE pat_id=  '$_POST[patname]'");		
	}
	else if($_POST['group'] == "Contact No")
	{
	$result = mysqli_query($con, "SELECT * FROM  patient WHERE contact=  '$_POST[patname]'");		
	}
}
else if(isset($_GET['act']) and $_GET['act'] =='delete')

{
	mysqli_query($con, "DELETE FROM patient where pat_id='$_GET[patid]'");
		header("Location: viewpatient.php");
}
else
{
	$result = mysqli_query($con, "SELECT * FROM patient");
}
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
          <h2>View All Patients:</h2>
           <script type="application/javascript" >
function validation()
{
	if(document.form1.patname.value == "")
	{
		alert("Enter Search Field");
		document.form1.patname.focus();
		return false;
	}
		if(document.form1.group.value == "")
	{
		alert("Select The Field by Which Search to be Made");
		document.form1.group.focus();
		return false;
	}
			
}
</script>
          
          <form id="form1" name="form1" method="post" action="" onSubmit="return validation()">
          <p><?php 
			  if(isset($_GET['delid']) and $_GET['delid'] == "set")
		  		{
				  $rcsucc = "<b><font color='#FF0000'>The Patient's Record Deleted Successfully.</font>";
			  	}
		  echo $rcsucc; ?></p>
          <label for="fname" class="left"> </label>
              <label for="patname">Search</label>
            <input type="text" name="patname" id="patname" />
            <label for="group">By</label>
<select name="group" id="group">
 <option value="">Select</option>
  <option value="Patient ID">Patient ID</option>
  <option value="Patient Name">Patient Name</option>
  <option value="Contact No">Patient Contact No</option>
</select>
            
            <input name="search" type="submit" id="search" value="Search" />
          </p>
            <table width="621" border="1">
          <tr bgcolor="#FFFFCC">
                <td width="133"><strong>Patient Name</strong></td>
                <td width="64"><strong>Gender</strong></td>
                <td width="52"><strong>Contact No.</strong></td>
                <td width="128"><strong>Set Appointment</strong></td>
                               <td width="99"><strong>Update</strong></td>
                <td width="105"><strong>Delete</strong></td>

          </tr>
              <?php
           	while($row = mysqli_fetch_array($result))
  {
  	echo "<tr>";
  	echo "<td>" . $row['pat_name'] . "</td>";
  	echo "<td>" . $row['gender'] . "</td>";
  	echo "<td>" . $row['contact'] . "</td>";
    echo "<td><a href='setappointment.php?appid=$row[pat_id]'>Click Here</a></td>";
	echo "<td><a href='updatepatient.php?patid=$row[pat_id]&act=update'>Update</a></td>";
	echo "<td><a href='viewpatient.php?patid=$row[pat_id]&act=delete' onClick='return deleteImage()'>Delete</a></td>";
	echo "</tr>";
  }
?>
            </table>
            <p>&nbsp;</p>
			 <input type="button" onClick="history.go(-1);" value="Go Back" />
          </form>
          
          </form>
</div>
      </div>
        <div class="cleaner"></div>
    </div>
    <?php
include("includes/footer.php");
?>