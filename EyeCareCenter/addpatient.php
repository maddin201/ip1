<?php
session_start();
$rcsucc="";
include("includes/header.php");
include("includes/conn.php");
//if(!isset($_SESSION["admin_id"]))
{
//	header("Location: index.php");	
}
 
if(isset($_POST['submit']))
{	
$dt=date("Y-m-d");
			$appdate= date("Y-m-d", strtotime($_POST['appdate']));
			
$sql="INSERT INTO patient (pat_name,dob,gender,address,contact,created_at)
VALUES
('$_POST[fname] $_POST[lname]','$_POST[dob]','$_POST[gender]',
'$_POST[address]','$_POST[contact]','$dt');";
//echo $sql;
$res=mysqli_query($con,$sql);
if (!$res)
  {
  die('Error: ' . mysqli_error());
  }
  
 if ($res)
  {
 $rcsucc = "<font  color='#009900' >Patient Record Added Successfully.";
  }
  else
  {
	   $rcsucc = "Failed to Add The Patient Record.";

  }
}
?>
    
    <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            
   
<?php
include("sidebar.php");
	
	if($_SESSION["logtype"]=='Administrator')
	{
		maintenancesidebar();
	}
else if($_SESSION["logtype"]=='Doctor')
{
	patientrecords();
}
			?>
            </div>
   		</div>
        <div id="content" class="float_r">
          <h2>Add New Patient:</h2>
          <p> <?php echo $rcsucc; ?></p>
          
          <script type="application/javascript" >
function validation()
{
	if(document.adpat.fname.value == "")
	{
		alert("Enter The First name.");
		document.adpat.fname.focus();
		return false;
	}
	if(document.adpat.lname.value == "")
	{
		alert("Enter The Last Name.");
		document.adpat.lname.focus();
		return false;
	}
	if(document.adpat.dob.value == "")
	{
		alert("Enter Date Of Birth.");
		document.adpat.dob.focus();
		return false;
	}
	if(document.adpat.address.value == "")
	{
		alert("Enter The Address.");
		document.adpat.address.focus();
		return false;
	}
	if(document.adpat.contact.value == "")
	{
		alert("Enter The Contact Number.");
		document.adpat.contact.focus();
		return false;
	}
	if(document.adpat.contact.value.length < 10 || document.adpat.contact.value.length>11)
	{
		alert("Enter Proper Contact Number.");
		return false;
	}
	
}
</script>
          
          <form id="adpat" name="adpat" method="post" action="" onsubmit="return validation()">
            <p>
              <label for="fname" class="left"> </label>
            </p>
            <table width="589" height="373" border="0">
              <tr>
                <td width="122">First Name:</td>
                <td width="457"><input class="right" name="fname" type="text" id="fname" size="50" /></td>
              </tr>
              <tr>
                <td>Last Name:</td>
                <td><input  class="right" name="lname" type="text" id="lname" size="50" /></td>
              </tr>
              <tr>
                <td><label for="dob" class="left">Gender:</label>
                <label></label></td>
                <td><label>
                  <input type="radio" name="gender" value="Male" id="gender_0" />
                  Male
  <input type="radio" name="gender" value="Female" id="gender_1" />
                Female</label></td>
              </tr>
              <tr>
                <td><label for="dob" class="left">Date Of Birth:</label></td>
                <td><input name="dob" type="text" class="right"  id="dob" size="50" /><script language="javascript" type="text/javascript" src="datetimepicker.js">
</script>


<a href="javascript:NewCal('dob','ddmmmyyyy',false,24)">
<img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>
                
                </td>
              </tr>
              <tr>
                <td height="120" valign="top">Address:</td>
                <td><textarea class="right" name="address" cols="45" rows="5" wrap="physical" id="address"></textarea></td>
              </tr>
              <tr>
                <td height="44">Contact No.</td>
                <td><input name="contact" type="text" class="right" id="contact" size="50" /></td>
              </tr>
              <tr>
                <td colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Add Patient's Details" class="buttonabc"/></td>
              </tr>
            </table>
            <p>
              <label for="address" class="left"><br />
              </label>
            </p>
          </form>
          <h1>&nbsp;</h1>
<div id="content_main"><form id="form1" name="form1" method="post" action="">
            <p>
              <center>
              </center>
            </p>
      </form>
      </div>
      </div>
        <div class="cleaner"></div>
    </div> 
    <?php
include("includes/footer.php");
?>