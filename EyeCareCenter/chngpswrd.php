<?php
session_start();
$msgpass = "";
include("includes/header.php");
include("includes/conn.php");

if(isset($_POST["submit"]))
{
		if($_SESSION["logtype"]== "Patient" || $_POST["user"]== "Patient")
		{
			$res = mysqli_query($con, "UPDATE patient SET password='$_POST[nwpswrd]' WHERE email_id ='$_POST[loginid]' and password='$_POST[oldpswrd]'");
			if($res)
			{
				$msgpass="<b><font color='#009900'>Your Password Updated Successfully.</font></b>";
			}
			else
			{
				$msgpass ="<b><font color='#FF0000'>Failed to Change The Password.</font></b>";
			}
		}
		else if($_POST["user"]== "Administrator")
		{
			$resa = mysqli_query($con, "UPDATE admin SET password='$_POST[nwpswrd]' WHERE login_id ='$_POST[loginid]' and password='$_POST[oldpswrd]'");
			if($resa)
			{
				$msgpass="<b><font color='#009900'>Your Password Changed Successfully.</font></b>";
			}
			else
			{
				$msgpass ="<b><font color='#FF0000'>Failed to Change The Password.</font></b>";
			}
		}
		else
		{
			$resd = mysqli_query($con, "UPDATE doctor SET password='$_POST[password]' WHERE login_id ='$_POST[loginid]' and password='$_POST[oldpswrd]'");
			if($resd)
			{
				$msgpass="<b><font color='#009900'>Your Password Changed Successfully.</font></b>";
			}
			else
			{
				$msgpass ="<b><font color='#FF0000'>Failed to Change The Password.</font></b>";
			}
		}
}

?>
  <div id="tm_main">
	  <div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            	<?php
		  
				include("sidebar.php");


if($_SESSION["logtype"]=='Administrator')
{
	adminhome();
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
          <h2>Change Your Account Password </h2>
          <script type="application/javascript" >
function validation()
{
	if(document.form1.user.value == "")
	{
		alert("Select User Type");
		document.form1.user.focus();
		return false;
	}
	if(document.form1.loginid.value=="")
	{
		alert("Enter Email/Login ID");
		document.form1.loginid.focus();
		return false;
	}
	if(document.form1.oldpswrd.value=="")
	{
		alert("Enter Old Password");
		document.form1.oldpswrd.focus();
		return false;
	}
	if(document.form1.nwpswrd.value=="")
	{
		alert("Enter New Password");
		document.form1.nwpswrd.focus();
		return false;
	}
	if(document.form1.nwpswrd.value.length<8 || document.form1.nwpswrd.value.length>15 )
	{
		alert("Minimum charaters for password is 8 and Maximum character is 15");
		document.form1.nwpswrd.focus();

		return false;
	}
	if(document.form1.cpswrd.value=="")
	{
		alert("Confirm The New Password");
		document.form1.cpswrd.focus();
		return false;
	}
	if(document.form1.nwpswrd.value != document.form1.cpswrd.value)
	{
		alert("Passwords Do Not Match.");
		return false;
	}
	
}
</script>
          
          <form id="form1" name="form1" method="post" action="" onSubmit="return validation()">
          <table width="458" height="241" border="0">
          <tr>
  <td colspan="2">&nbsp;<?php echo $msgpass; ?></td>
  </tr>
<?php
if($_SESSION["logtype"]=='Administrator')
{
?>

<tr>

                <td width="99">User Type</td>
                <td width="349"><label for="user"></label>
                  <select name="user" id="user">
                  <option value="">Select</option>
                    <option value="Patient">Patient</option>
                    <option value="Doctor">Doctor</option>
                    <option value="Administrator">Administrator</option>
          </select></td>
              </tr>
              <?php
			  }
			  else
              {
				    echo "<input type='hidden' name='user' is='user' value='Patient'>";
              }
			  ?>
              <tr>
                <td><label  class="left" for="loginid2" >Login/Email Id</label></td>
                <td>
<?php
if($_SESSION["logtype"]=='Administrator')
{
	?>
 <input  class="right" name="loginid" type="text" id="loginid" size="50" value="<?php echo $_SESSION['login'] ?>" />
 <?php
}
elseif($_SESSION["logtype"]=='Doctor')
{
	?>
	 <input  class="right" name="loginid" type="text" id="loginid" size="50" value="<?php echo $_SESSION['login'] ?>" readonly="readonly" />
<?php
}
else
{
?><input  class="right" name="loginid" type="text" id="loginid" size="50" readonly="readonly" value="<?php echo $_SESSION['email_id'] ?>" />
  
 <?php
}
?>
 </td>
              </tr>
              <tr>
                <td height="40"><label for="oldpswrd" class="left">Old Password</label></td>
                <td><input name="oldpswrd" class="right" type="password" id="oldpswrd" size="50" /></td>
              </tr>
              <tr>
                <td>New Password</td>
                <td><input name="nwpswrd" class="right" type="password" id="nwpswrd" size="50" /></td>
              </tr>
              <tr>
                <td height="40"><label for="cpswrd" class="left">Confirm  Password</label></td>
                <td><input name="cpswrd" class="right" type="password" id="cpswrd" size="50" /></td>
              </tr>
              <tr>
                <td height="27" colspan="2" align="center" valign="top"><input type="submit" name="submit" id="submit" value="Change password" class="buttonabc"/></td>
              </tr>
            </table>
            <p>&nbsp;</p>
            <p><br />
              <br />
              <br />
              <br />
              <br />
              <br />
              <br />
              <br />
              <center>
              </center>
            </p>
          </form>
          <h1>&nbsp;</h1>
<div id="content_main">
            <p>
              <center>
              </center>
            </p>
     
      </div>
      </div>
        <div class="cleaner"></div>
    </div>
    <?php
include("includes/footer.php");
?>