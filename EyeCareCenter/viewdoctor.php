<?php
include("includes/header.php");
include("includes/conn.php");
if(isset($_POST['search']))
{
	if($_POST['group'] == "Name")
	{
	$resultd = mysqli_query($con, "SELECT * FROM  doctor WHERE  doc_name LIKE  '%$_POST[docname]%'");
	}
	else if($_POST['group'] == "Doctor ID")
	{
	$resultd = mysqli_query($con, "SELECT * FROM  doctor WHERE doc_id LIKE '$_POST[docname]'");		
	}
	else if($_POST['group'] == "Mobile No")
	{
	$resultd = mysqli_query($con, "SELECT * FROM  doctor WHERE mobile LIKE '$_POST[docname]'");		
	}
}
else if(isset($_GET['act']) and $_GET['act'] =="delete")
{ 
	mysqli_query($con, "DELETE FROM doctor where doc_id='$_GET[docid]'");
	if(mysqli_affected_rows() == 1 )
	{
		$rcsucc = "Doctor Record Deleted Successfully.";
	}
}

{
	$resultd = mysqli_query($con, "SELECT * FROM doctor");
}

$resbranch = mysqli_query($con, "select * from branch");
?>
    
    <div id="tm_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            	  	<?php
		  
				include("sidebar.php");
	
if($_SESSION["logtype"]=='Administrator')
{
	docssidebar();
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
          <h2>View Doctors:</h2>
          <p><? echo $rcsucc;?></p>
          
          <script type="application/javascript" >
function validation()
{
	if(document.form1.docname.value == "")
	{
		alert("Enter Search Field");
		document.form1.docname.focus();
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
            <p>
              <label for="fname" class="left"> </label>
              <label for="docname">Search</label>
              <input type="hidden" name="docid" value="<?php echo $docid ;?>"  />
            <input type="text" name="docname" id="docname" />
            <label for="group">By</label>
<select name="group" id="group">
  <option value="">Select</option>
  <option value="Doctor ID">Doctor ID</option>
  <option value="Name">Name</option>
  <option value="Mobile No">Mobile No</option>
</select>
            Search
            <input type="submit" name="search" id="search" value="Search" />
            </p>
            <table width="650" border="1">
          <tr>
                <td width="120">Doctor Name</td>
                <td width="100">Branch Name</td>
                <td width="140">Clinic Name</td>
                <td width="100">Mobile No</td>
				 <td width="65">Image</td>
                <td width="126">Action</td>
          </tr>
              <?php
           	while($row = mysqli_fetch_array($resultd))
  {
  echo "<tr>";
  echo "<td>" . $row['doc_name'] . "</td>";
  $selbr= mysqli_query($con, "SELECT * FROM branch where branch_id = '$row[branch_id]'");
  $recbr = mysqli_fetch_array($selbr);
  echo "<td>" . $recbr['branch_name'] . "</td>";
  echo "<td>" . $row['clinic_name'] . "</td>";
  echo "<td>" . $row['mobile'] . "</td>";
    echo "<td><img src='upload/$row[image]' width='30' height='30'></td>";
  echo "<td><a href='updatedoctor.php?docid=$row[doc_id]'>Update</a> |  <a href='adddoctors.php?docid=$row[doc_id]&act=delete'>Delete</a></a></td>";
  echo "</tr>";
  }
  
?>
            </table>
            <p>&nbsp;</p>
          </form>
          
          </form>
</div>
 
        <div class="cleaner"></div>
    </div> 
    <?php
include("includes/footer.php");
?>
 </div>