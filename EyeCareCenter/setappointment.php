<?php
session_start();
date_default_timezone_set('America/New_York');
//http://php.net/manual/en/timezones.europe.php
include("includes/header.php");
include("includes/conn.php");
$rcsucc="";
?>

<script type="text/javascript">
function showUser(str)
{

if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ajaxdoctors.php?q="+str,true);
xmlhttp.send();
}
</script>


<script>
function showHint(str)
{
	
if (str.length==0)
  { 
  document.getElementById("txtHint1").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint1").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ajaxappointment.php?q="+str,true);
xmlhttp.send();
}
</script>

<?php
$today=  date('Y-m-d');
$apd = isset($_POST['appdate'])? ($_POST['appdate']): $today;
$appdate1= date("Y-m-d", strtotime($apd));
//$dt1 = date("Y-m-d h:i:s");

$appid=(isset($_GET["appid"]))?$_GET["appid"]: $_SESSION['pat_id'];
$dt = date("Y-m-d");
 $rcsucc="";
$respat= mysqli_query($con, "Select * from appointment where pat_id='$appid' AND app_date='$appdate1' ");
$ctpat = mysqli_num_rows($respat);

if(isset($_POST['token']) && $_POST['token'] == $_SESSION['token'])
{
		if(isset($_POST['setapp']))
		{ 	
			if(isset($_SESSION['pat_id']))
			{
			$patid = $_SESSION['pat_id'];
			
			}
			else
			{
			$patid = $_GET['appid'];
			}


			
$appdate= date("Y-m-d", strtotime($_POST['appdate']));
$dt = date("Y-m-d h:i:s");

if($ctpat >= 1)
{
	$rcsucc = "<font color='#FF0000'>You Can't Take Appointment for Same Date.";
}
else
{
$bname=$_POST['bname'];
$docname=$_POST['docname'];
$appdate=$_POST['appdate'];
$apptime=$_POST['apptime'];

$sql="INSERT INTO appointment (branch_id, pat_id, doc_id, app_date,app_time,status,created_at)
VALUES
('$bname','$patid','$docname','$appdate','$apptime','pending','$dt');";

//echo $sql;
$res= mysqli_query($con, $sql);
	if (!$res)
	  {
	  die('Error: ' . mysqli_error());
	  }
	  
	 // if(mysqli_affected_rows() == 1)
	 // {
	 $rcsucc = "<font color='#009900'>Your Appointment Placed Successfully.";
	 // }
}
}

unset($_SESSION['token']);
}

$new_token = md5(time() . rand(0,100));
$_SESSION['token'] = $new_token;
$resbranch = mysqli_query($con, "select * from branch");

$resdoc= mysqli_query($con, "Select * from doctor");

?>
    
    <div id="tm_main">
      <div id="sidebar" class="float_l">
        <div class="sidebar_box">
           <?php
		include("sidebar.php");
		if($_SESSION["logtype"]=='Administrator')
		{
		patientrecords();
		}
		else if($_SESSION["logtype"]=='Doctor')
		{
		patientrecords();
		}
		else
		{
				patienthome();
		}
		?>
            </div>
   		</div>
        <div id="content" class="float_r">
        <h1>Book Your Appointment</h1>
        <div id="content_main">
        
        <script type="application/javascript" >
		
function validation()
{
	
var start = document.form1.appdate.value;
var end = document.form1.loaddate.value;

var stDate = new Date(start);
var enDate = new Date(end);
var compDate = enDate - stDate;
//alert(stDate);

birthday = new Date(start);
weekday = birthday.getDay();

	if(compDate <= 0)
	{
	//return true;
	}
	else
	{
	alert("Please Enter The Correct Date ");
	return false;
	}
	if(weekday == 0)
	{
		alert("You Can't Take an Appointment on Sunday");
		return false;
	}
	
	if(document.form1.bname.value == "")
	{
		alert("Select Branch");
		document.form1.bname.focus();
		return false;
	}
	if(document.form1.docname.value=="")
	{
		alert("Select Doctor Name");
		document.form1.docname.focus();
		return false;
	}
	if(document.form1.appdate.value=="")
	{
		alert("Select Appointment Date");
		document.form1.appdate.focus();
		return false;
	}

}
</script>
        
        <?php


		if($rcsucc != "")
		{
			echo $rcsucc; 
		}
		else
		{
			?>
          <form id="form1" name="form1" method="post" action="" onsubmit="return validation()"> <input type="hidden" name="token" value="<?=$new_token;?>"/> 
            <p>&nbsp;</p>
            <table width="644" border="0">
              <?php
              if($_SESSION["logtype"] =="Administrator" || 	$_SESSION["logtype"] =="Doctor")
			  {
			  ?>
			  <tr>
                <td>&nbsp;Patient ID</td>
                <td height="34">&nbsp;<?php echo $_GET['appid']; ?></td>
              </tr>
              <?php
			  }
			  ?>
              <tr>
                <td width="186">Select Branch:</td>
                <td height="34">
                  <select name="bname" id="bname" onchange="showUser(this.value)">
                  <option value="">Select</option>
                              <?php
			while($rows = mysqli_fetch_array($resbranch))
			{
				echo "<option value='$rows[branch_id]'>$rows[branch_name]</option>";
			}
			?>

                </select></td>
              </tr>
              <tr>
                <td>Doctor's Name:</td>
                <td height="33">
               <div id="txtHint">
                <select name="docname" id="docname">
                <option value="">Select</option>
                <?php
				
				while($rowsa = mysqli_fetch_array($resdoc))
				{
					echo "<option value='$rowsa[doc_id]'>$rowsa[doc_name]</option>";
				}
				?>
                </select>
                </div>
                </td>
              </tr>
<tr>
<td>Appointment Date:</td>
<td height="30">
 <?php
$dt = date("d-M-Y");
?>
<input type="hidden" id="loaddate" name="loaddate" maxlength="25" size="25" value="<?php echo $dt; ?>"/>
                          
<script type="text/javascript" src="datetimepicker.js"></script>
<input type="text" id="appdate" name="appdate" maxlength="25" size="25" onmouseover="showHint(this.value)">
<a href="javascript:NewCal('appdate','ddmmmyyyy',false,24)"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>
</td>
</tr>
  
<tr>
                 <td height="102" colspan="3" align="center" valign="top">
       <div id="txtHint1">
     <table width="644" border="0">
    <tr>
      <td width="222" height="102" align="center" valign="top"><p>
        <label>
          <input type="radio" name="apptime" value="5:00PM" id="apptime" />
          5:00PM</label>
        <br />
        <label>
          <input type="radio" name="apptime" value="5:15PM" id="apptime" />
          5:15PM</label>
        <br />
        <label>
          <input type="radio" name="apptime" value="5:30PM" id="apptime" />
          5:30PM</label>
        <br />
        <label>
          <input type="radio" name="apptime" value="5:45PM" id="apptime" />
          5:45PM</label>
        <br />
      </p></td>
      <td height="102" colspan="2" align="center" valign="top"><label>
        <input type="radio" name="apptime" value="6:00PM" id="apptime" />
        6:00PM</label>
        <br />
        <label>
          <input type="radio" name="apptime" value="6:15PM" id="apptime" />
          6:15PM</label>
        <br />
        <label>
          <input type="radio" name="apptime" value="6:30PM" id="apptime" />
          6:30PM</label>
        <br />
        <label>
          <input type="radio" name="apptime" value="6:45PM" id="apptime" />
          6:45PM</label></td>
      <td width="191" align="center" valign="top"><label>
        <input type="radio" name="apptime" value="7:00PM" id="apptime" />
        7:00PM</label>
        <br />
        <label>
          <input type="radio" name="apptime" value="7:15PM" id="apptime" />
          7:15PM</label>
        <br />
        <label>
          <input type="radio" name="apptime" value="7:30PM" id="apptime" />
          7:30PM</label>
        <br />
        <label>
          <input type="radio" name="apptime" value="7:45PM" id="apptime" />
          7:45PM</label></td>
    </tr>
</table>
</div>
</td>
              </tr>
           
              <tr>
                <td height="29" colspan="3" align="center" valign="top"><input type="submit" name="setapp" id="setapp" value="Book" /></td>
              </tr>
            </table>
            <?php
		}
		?>
            <p>&nbsp;</p>
          <p>&nbsp;</p></form>
          <p>&nbsp;</p>
        </div>
        
</div> 
        <div class="cleaner"></div>
    </div>
    <?php
include("includes/footer.php");
?>