<?php
session_start();
include("includes/header.php");
include("includes/conn.php");
?>

<?php
$resvar="";
if(isset($_POST['submit']))
{
$filnme = $_FILES["file"]["name"];
		
$image=$_POST['docname'].'.jpg';
move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$image);
	$res = mysqli_query($con, "UPDATE  doctor SET  branch_id = '$_POST[bname]',doc_name =  '$_POST[docname]',clinic_name =  '$_POST[cname]', 
	email_id =  '$_POST[emailid]',phone =  '$_POST[phone]',mobile =  '$_POST[mobile]',login_id =  '$_POST[loginid]',password =  '$_POST[password]', image='$image' WHERE  doc_id ='$_POST[docid]'");
	if($res)
	{
		$resvar = "<b><font color='#009900'>Doctor Record Updated Successfully.</font></b>";
	}
}
if(isset($_SESSION["doc_id"]))
{
		$resdocrec =  mysqli_query($con, "Select * from doctor where doc_id='$_SESSION[doc_id]'");
}
else
{
	$resdocrec =  mysqli_query($con, "Select * from doctor where doc_id='$_GET[docid]'");
}
	

$rowsdoc = mysqli_fetch_array($resdocrec);
$docid = $rowsdoc['doc_id'];
$brid = $rowsdoc['branch_id'];
$docname = $rowsdoc['doc_name'];
$clinicname= $rowsdoc['clinic_name'];
$emailid = $rowsdoc['email_id'];
$phone= $rowsdoc['phone'];
$mobile= $rowsdoc['mobile'];
$loginid= $rowsdoc['login_id'];
$password = $rowsdoc['password'];
$image = $rowsdoc['image'];
?>
    
    <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            	<?php
				include("sidebar.php");
				if($_SESSION["logtype"]=='Administrator')
{
	docssidebar();
}
else
{
	doctorhome();
}
				
			?>
            </div>
   		</div>
        <div id="content" class="float_r">
          <h1>Update Doctor Profile</h1>
          <p><?php echo $resvar; ?></p>
          <script type="application/javascript" >
function validation()
{
//Validation for Email ID
	em = document.form1.emailid.value;
		pos1 = em.indexOf("@")
		pos = em.indexOf(" ")
		pos2 = (pos1+1)
		server = em.substring(pos2);
		server_pos = server.lastIndexOf(".")
		reqtype = server.substring(server_pos+1)
		type_end = reqtype.substring(reqtype.length-1)
		//Email ID
//	    return false
	if(document.form1.docname.value == "")
	{
		alert("Enter Your Name.");
		document.form1.docname.focus();
		return false;
	}
	if(document.form1.password.value == "")
	{
		alert("Enter Password.");
		document.form1.password.focus();
		return false;
	}
	if(document.form1.password.value.length<8 || document.form1.password.value.length>15 )
	{
		alert("Minimum Charaters for Password are 8 and Maximum Characters are 15");
		document.form1.password.focus();

		return false;
	}
	if(document.form1.cpassword.value == "")
	{
		alert("Confirm the Password.");
		document.form1.cpassword.focus();
		return false;
	}
	if(document.form1.password.value != document.form1.cpassword.value)
	{
		alert("Passwords Do Not Match.");
		return false;
	}
	
	if(em == "")
	{
		document.form1.emailid.focus();
		alert("Email cannot be blank");
		return false;                
	}

	else if(em.length<8)
	{
		document.form1.emailid.focus();
		alert("Email length cannot be less than 8 characters");
		return false;  
	}
	else if(em.indexOf("@")==-1)
	{
		document.form1.emailid.focus();
		alert("The Email Address must contain '@' sign");
		return false;  
	}
	else if(pos1<1)
	{
		document.form1.emailid.focus();
		alert("Email address cannot start with '@' sign");
		return false;  
	}  
	else if(em.indexOf(".")==-1)
	{
		document.form1.emailid.focus();
		alert("The Email Address must contain '.' sign");
		return false;  
	}
	else if(pos!=-1)
	{
		document.form1.emailid.focus();
		alert("The Email Address cannot contain spaces");
		return false;  
	}
	else if(server.indexOf("@")!=-1)
	{
		document.form1.emailid.focus();
		alert("A valid Email must contain only one '@' sign");
		return false;  
	}
	else if(server.indexOf(".")==0)
	{
		document.form1.emailid.focus();
		alert("There should some text between '@' and '.' sign");
		return false;  
	} 
	else if(reqtype=="")
	{  
		document.form1.emailid.focus();
		alert("Email Id should end with character(like .com,.net,.org)");
		return false;  
	}
	else if(type_end.toUpperCase()<"A" || type_end.toUpperCase()>"Z")
	{
		document.form1.emailid.focus();
		alert("Email Id should not end with number or symbol");
		return false;  
	}
	
	if(document.form1.bname.value=="")
	{
		alert("Select Branch.");
		return false;
	}
	if(document.form1.cname.value == "")
	{
		alert("Enter Clinic Name");
		document.form1.cname.focus();
		return false;
	}
	if(document.form1.mobile.value == "")
	{
		alert("Enter The Mobile Number");
		document.form1.mobile.focus();
		return false;
	}
	if(document.form1.mobile.value.length < 5 || document.form1.mobile.value.length>11)
	{
		alert("Enter Proper Mobile Number");
		return false;
	}
	
}
</script>
          <form id="form1" name="form1" method="post" action=""  onsubmit="return validation()" enctype="multipart/form-data" >
          <p>
            <label for="fname" class="left"> </label>
            </p>
            <table width="595" border="0">
              <tr>
                <td width="118" height="40"><label for="docname" class="left">Doctor Name:</label></td>
                <td width="304"><label for="docname" class="left"></label>
               	  <input type="hidden" name="docid" value="<?php echo $docid ;?>"  />
                <input class="right" name="docname" type="text" id="docname" size="50" value="<?php echo $docname;?>"/></td>
              </tr>
              <tr>
                <td height="35"><label  class="left" for="loginid" >Login ID:</label></td>
                <td><input  class="right" name="loginid" type="text" id="loginid" readonly="readonly" size="50" value="<?php echo $loginid ;?>" /></td>
              </tr>
              <tr>
                <td height="39">Password:</td>
                <td><input name="password" type="password" class="right"  id="password" size="50" value="<?php echo $password ;?>"/></td>
              </tr>
              <tr>
                <td height="39">Confirm Password:</td>
                <td><input name="cpassword" type="password" class="right"  id="dob" size="50" value="<?php echo $password;?>" /></td>
              </tr>
              <tr>
                <td height="35">Email-ID:</td>
                <td><input name="emailid" type="text" class="right"  id="dob2" size="50" value="<?php echo $emailid ;?>" /></td>
              </tr>
              <tr>
                <td height="45"><label for="contact" class="left">Branch Name:</label></td>
                 <?php
           	$resdocreca =  mysqli_query($con, "Select * from branch");
			?>
                <td><select name="bname" id="bname">
                <?php
			while($rowsa = mysqli_fetch_array($resdocreca))
			{
				if($brid == $rowsa["branch_id"])
				{
				echo "<option value='$rowsa[branch_id]' selected='selected'>$rowsa[branch_name]</option>";
				}
				else
				{
				echo "<option value='$rowsa[branch_id]'>$rowsa[branch_name]</option>";	
				}
			}
			?>
                </select></td>
              </tr>
              <tr>
                <td height="45">Clinic Name</td>
                <td><input name="cname" type="text" class="right"  id="dob5" size="50" value="<?php echo $clinicname ;?>" /></td>
              </tr>
              <tr>
                <td height="45">Phone:</td>
                <td><input name="phone" type="text" class="right"  id="dob3" size="50" value="<?php echo $phone ;?>" /></td>
              </tr>
              <tr>
                <td height="45">Mobile:</td>
                <td><input name="mobile" type="text" class="right"  id="dob4" size="50" value="<?php echo $mobile ;?>" /></td>
              </tr>
         
			   <tr>
              <td height="32" valign="top">Image:</td>
              <td colspan="3"><label for="file"></label>
              <input type="file" name="file" id="file" />
              	<?php
				
				$image =  $rowsdoc['image'];
				 
				 
            if($image =="")
			  
			 	{
				$img = "noimage.jpg";
			 	}	
				else
				{
				$img = $image;
			 
				}
				?><br />
                <?php
			  if(isset($_GET['docid']))
			  {
			  ?>
                <img src="upload/<?php echo $img; ?>" alt="Image 02" height="100" width="120"/>
                <?php
			  }
			  
			?>
              </td>
            </tr>
			  <tr>
                <td height="35" colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Update" class="buttonabc"/></td>
              </tr>
            </table>
            <p>&nbsp; </p>
            <p>&nbsp;</p>
          </form>
          
          </form>
</div>
  </div>
        <div class="cleaner"></div>
    </div> 
    <?php
include("includes/footer.php");
?>