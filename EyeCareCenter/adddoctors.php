<?php
session_start();
$resdoc="";

if(!isset($_SESSION["admin_id"]))
{
	header("Location: index.php");	
}
include("includes/header.php");
include("conn.php");
$dt = date("Y-m-d h:m:s");

$result = mysqli_query($con, "SELECT * FROM admin");
if(isset($_POST['submit']))
{
$docname = $_POST['dfname'] ." ".$_POST['dlname'];
$image = ($_POST['dfname'].$_POST['dlname']).'.jpg';
$filnme = $_FILES["file"]["name"];

move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$image);
		

$sql="INSERT INTO doctor (branch_id, doc_name, clinic_name, email_id, 
						phone, mobile, login_id,password,created_at,image)
VALUES
('$_POST[bname]','$docname','$_POST[cname]','$_POST[emailid]','$_POST[phone]','$_POST[mobile]','$_POST[loginid2]','$_POST[password]','$dt','$image');";
//echo $sql."<br>";
$resins = mysqli_query($con ,$sql);

if (!$resins)
  {
  die('Error: ' . mysqli_error());
  }
  else{
  
$resdoc = "<b><font color='#006600'> Doctor Record Added Successfully.</font></b>";
 }
 
}

if(isset($_GET['act']) and  $_GET['act']  =="delete")
{ 
	$resdel = mysqli_query($con,"DELETE FROM doctor where doc_id=$_GET[docid]");
	if($resdel)
	{
                $resdoc = "<b><font color='#006600'> Doctor Record Deleted Successfully.</font></b>";
		
			 
	}
	 
}  
$result = mysqli_query($con,"SELECT * FROM admin");

$resbranch = mysqli_query($con, "select * from branch");
 

?>
    
    <div id="tm_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
<?php
include("sidebar.php");
if($_SESSION["logtype"]=='Administrator')
{
		if($_GET['docside'] ==1)
	{
	docssidebar();
	}
	else
	{
		maintenancesidebar();
	}
}
else if($_SESSION["logtype"]=='Patient')
{
			patienthome();
}
else if($_SESSION["logtype"]=='Doctor')
{
	doctorhome();
}
			?>
            </div>
   		</div>
        <div id="content" class="float_r">
        <h1>Add New Doctor:</h1>
        <?php echo $resdoc; ?>
		<?php  $resdoc=""; ?>
        <script type="application/javascript" >
function validation()
{
	//Validation for Email ID
	em = document.addoc.emailid.value;
		pos1 = em.indexOf("@")
		pos = em.indexOf(" ")
		pos2 = (pos1+1)
		server = em.substring(pos2);
		server_pos = server.lastIndexOf(".")
		reqtype = server.substring(server_pos+1)
		type_end = reqtype.substring(reqtype.length-1)
		//Email ID
	
	if(document.addoc.dfname.value == "")
	{
		alert("Enter First Name.");
		document.addoc.dfname.focus();
		return false;
	}
	if(document.addoc.dlname.value == "")
	{
		alert("Enter Last Name.");
		document.addoc.dlname.focus();
		return false;
	}
	if(document.addoc.cname.value == "")
	{
		alert("Enter the Clinic Name.");
		document.addoc.cname.focus();
		return false;
	}
	
	if(em == "")
	{
		document.addoc.emailid.focus();
		alert("Email cannot be blank");
		return false;                
	}

	else if(em.length<8)
	{
			document.addoc.emailid.focus();
			alert("Email length cannot be less than 8 characters");
			return false;  
	}
		else if(em.indexOf("@")==-1)
		{
			document.addoc.emailid.focus();
			alert("The Email Address must contain '@' sign");
			return false;  
		}
		else if(pos1<1)
		{
			document.addoc.emailid.focus();
			alert("Email address cannot start with '@' sign");
			return false;  
		}  
		else if(em.indexOf(".")==-1)
		{
			document.addoc.emailid.focus();
			alert("The Email Address must contain '.' sign");
			return false;  
		}
		else if(pos!=-1)
		{
			document.addoc.emailid.focus();

			alert("The Email Address cannot contain spaces");
			return false;  
		}
		else if(server.indexOf("@")!=-1)
		{
			document.addoc.emailid.focus();
			alert("A valid Email must contain only one '@' sign");
			return false;  
		}
		else if(server.indexOf(".")==0)
		{
			document.addoc.emailid.focus();
			alert("There should some text between '@' and '.' sign");
			return false;  
		} 
		else if(reqtype=="")
		{  
			document.addoc.emailid.focus();
			alert("Email Id should end with character(like .com,.net,.org)");
			return false;  
		}
		else if(type_end.toUpperCase()<"A" || type_end.toUpperCase()>"Z")
		{
			document.addoc.emailid.focus();
			alert("Email Id should not end with number or symbol");
			return false;  
		}
		
		if(document.addoc.loginid.value == "")
	{
		alert("Enter Login Id.");
		document.addoc.loginid.focus();
		return false;
	}
	if(document.addoc.password.value == "")
	{
		alert("Enter the Password.");
		document.addoc.password.focus();
		return false;
	}
	 if(document.addoc.password.value.length<8 || document.addoc.password.value.length>15 )
	{
		alert("minimum charaters for password is 8 and maximum character is 15");
		document.addoc.password.focus();

		return false;
	}
	if(document.addoc.cpassword.value == "")
	{
		alert("Conferm the Password.");
		document.addoc.cpassword.focus();
		return false;
	}
	if(document.addoc.password.value != document.addoc.cpassword.value)
	{
		alert("Password not matching...");
		return false;
	}
		
		if(document.addoc.mobile.value == "")
		{
			alert("Enter the Mobile Number.");
			document.addoc.mobile.focus();
			return false;
		}
		if(document.addoc.mobile.value.length < 10 || document.addoc.pno.mobile.length>11)
		{
			alert("Enter Proper Mobile Number.");
			document.addoc.mobile.focus();
			return false;
		}

	
}
</script>
        
        	<form id="addoc" name="addoc" method="post" action="" onsubmit="return validation()">
           	
           	  <table width="644" border="0">
           	    <tr>
           	      <td height="34"><strong>
           	        <label for="dfname" class="left">First Name:</label>
           	      </strong></td>
           	      <td><input name="dfname" class="right" type="text" id="dfname" size="50" /></td>
       	        </tr>
           	    <tr>
           	      <td height="33"><strong>
           	        <label class="left" for="doclname2">Last Name:</label>
           	      </strong></td>
           	      <td><input class="right" name="dlname" type="text" id="dlname" size="50" /></td>
       	        </tr>
           	    <tr>
           	      <td height="32"><strong>Clinic Name:</strong></td>
           	      <td><input name="cname" class="right" type="text" id="emailid2" size="50" /></td>
       	        </tr>
           	    <tr>
           	      <td height="33"><strong>
           	        <label for="password" class="left">Email-Id:</label>
           	      </strong></td>
           	      <td><input name="emailid" type="text" class="right" id="emailid" size="50" /></td>
       	        </tr>
           	    <tr>
           	      <td height="30"><strong>
           	        <label for="loginid2" class="left">Login-Id:</label>
         	        </strong></td>
           	      <td><input name="loginid2" type="text" class="right" id="loginid3" size="50" /></td>
       	        </tr>
           	    <tr>
           	      <td height="33"><strong>Password:</strong></td>
           	      <td><input name="password" type="password" class="right" id="emailid3" size="50" /></td>
       	        </tr>
           	    <tr>
           	      <td height="33"><strong>Confirm Password:</strong></td>
           	      <td><input name="cpassword" type="password" class="right" id="emailid4" size="50" /></td>
       	        </tr>
           	    <tr>
           	      <td height="33"><strong>
           	        <label for="Phone2" class="left">Phone (Optional):</label>
           	      </strong></td>
           	      <td><input name="phone" type="text" class="right" id="phone" size="50" /></td>
       	        </tr>
           	    <tr>
           	      <td height="33"><strong>
           	        <label for="Mobile2" class="left">Mobile No.:</label>
           	      </strong></td>
           	      <td><input name="mobile" class="right" type="text" id="Mobile" size="50" /></td>
       	        </tr>
                   <tr>
            <td height="45"><strong>Branch Name:</strong></td>
            <td><select name="bname" id="bname">
            <option value="">Select</option>
            <?php
			while($rows = mysqli_fetch_array($resbranch))
			{
				echo "<option value='$rows[branch_id]'>$rows[branch_name]</option>";
			}
			?>
                        </select>
            </td>
          </tr>
           	    <tr>
				
				  <tr>
              <td height="32" valign="top"><strong>Image:</strong></td>
              <td colspan="3"><label for="file"></label>
              <input type="file" name="file" id="file" />
              	
              </td>
            </tr>
				
           	      <td height="36" colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Create Doctor Account" /></td>
       	        </tr> </table>
           <p>&nbsp;</p>
         <tr>
            <td height="35" colspan="2">
			 <?php  echo $$resdoc1 ; ?>
			<table width="582" border="1">
              <tr>
                <td width="119">Doctor Name</td>
                <td width="104">Clinic Name</td>
                 <td width="100">Email</td>
                <td width="100">Branch Name</td>
				  <td width="100">Image</td>
                <td width="130">Action</td>
              </tr>  
              <?php
			  $result1 = mysqli_query($con, "SELECT * FROM doctor");
           	while($row1 = mysqli_fetch_array($result1))
  {
  echo "<tr>";
  echo "<td>" . $row1['doc_name'] . "</td>";
  echo "<td>" . $row1['clinic_name'] . "</td>";
  echo "<td>" . $row1['email_id'] . "</td>";
  $selbr= mysqli_query($con,"SELECT * FROM branch where branch_id = '$row1[branch_id]'");
  $recbr = mysqli_fetch_array($selbr);
  echo "<td>" . $recbr['branch_name'] . "</td>";
      echo "<td><img src='upload/" . $row1['image'] . "' height='30' width='30'</td>";
  echo "<td><a href='updatedoctor.php?docid=$row1[doc_id]'>Update</a> | <a href='adddoctors.php?docid=$row1[doc_id]&act=delete'>Delete</a></a></td>";
  echo "</tr>";
  }
?>
 			
				
				
       	      </table>
           	  <p>&nbsp;</p>
       	  </form>
</div> 
        <div class="cleaner"></div>
    </div>     
<?php
include("includes/footer.php");
?>