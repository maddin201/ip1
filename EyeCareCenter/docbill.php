<?php
session_start();
include("includes/header.php");
include("includes/conn.php");

$restest=mysqli_query($con, "SELECT * from test where test_id='$_GET[testi]'");
$retest= mysqli_fetch_array($restest);
$resapp=mysqli_query($con, "SELECT * from appointment where app_id='$retest[app_id]'");
$retapp= mysqli_fetch_array($resapp);
$resdoc=mysqli_query($con, "SELECT * from doctor where doc_id='$retapp[doc_id]'");
$retdoc= mysqli_fetch_array($resdoc);
$respat=mysqli_query($con, "SELECT * from patient where pat_id='$retapp[pat_id]'");
$retpat= mysqli_fetch_array($respat);

		if(isset($_POST['bill']))
		{
		
			$dt = date("Y-m-d");
			$sql="INSERT INTO doctor_bill (test_id, test_fee,consultation_fee,others,date,remarks)
			VALUES ('$_GET[testi]','$_POST[testfee]','$_POST[consultationfee]','$_POST[otherfee]','$dt','$_POST[remarks]')";
			
			if (!mysqli_query($con, $sql))
			{
			  die('Error: ' . mysqli_error());
			}
			
			if(mysqli_affected_rows() == 1 )
			{
				$billno = mysqli_insert_id();
				$rcsucc =  "<b><font color='#006600'>The Doctor's Bill Generated Successfully.</font></b>";
			}
		}


?>
    <script language="javascript" type="text/javascript">
        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;

          
        }
    </script>
<script>
function myFunc()
{
	var test= parseFloat(document.getElementById("testfee").value, 10);
	var consult= parseFloat(document.getElementById("consultationfee").value, 10);
			
	var other= parseFloat(document.getElementById("otherfee").value, 10);

	var sum= test+consult+other;
	
	document.getElementById("total").value= sum;	
}
</script>
    
    <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            	<?php 
				include("sidebar.php");
					patientrecords();	
				?>
            </div>
   		</div>
        <div id="content" class="float_r">
          <h2>Generate Doctor's Bill</h2>
          
        
         
         <script type="application/javascript" >
function validation()
{
	if(document.form1.testfee.value == "")
	{
		alert("Enter the Test Amount.");
		document.form1.testfee.focus();
		return false;
	}
	if(document.form1.consultationfee.value=="")
	{
		alert("Enter the Consultation Amount.");
		document.form1.consultationfee.focus();
		return false;
	}
	if(document.form1.remarks.value=="")
	{
		alert("Enter Remarks.");
		document.form1.remarks.focus();
		return false;
	}
}
</script>
         
          <form id="form1" name="form1" method="post" action="" onSubmit="return validation()">
            <input type="hidden" name="token" value="<?=$new_token;?>"/>  <p>
              <label for="fname2" class="left"> </label>
              <?php
if(isset($_POST['bill']))
{
	
	
	echo $rcsucc;
	?>
<h4><a href='#' onclick="javascript:printDiv('printablediv')" >Print Bill and Prescription Details.</a></h4>
    <div id="printablediv" style="width: 100%;">
   
    <table width="547">
              <tr>
                <td colspan="4" align="center"><p><strong>ADVANCED OPTICAL - EYE CARE CENTER - ALBANY, NY</strong></p></td>
              </tr>
              <tr>
                <td><strong>Test ID:</strong></td>
                <td><?php echo $_GET['testi'];?></td>
                <td><strong>Date:</strong></td>
                <td><?php echo date("d-m-Y"); ?></td>
              </tr>
              <tr>
                <td width="136"><strong>
                  <label for="patname">Patient Name:</label>
                </strong></td>
                <td width="150"><?php echo $_POST['patname']; ?></td>
                <td width="104"><strong>Doctor Name:</strong></td>
                <td width="139"><?php echo $_POST['docname']; ?></td>
              </tr>
             
              <tr>
                <td><strong>Test Fee:</strong></td>
                <td colspan="3"><label for="testfee"></label>
                $ <?php echo $_POST['testfee']; ?></td>
              </tr>
              <tr>
                <td><strong>Consultation Fee:</strong></td>
                <td colspan="3">$ <?php echo $_POST['consultationfee']; ?></td>
              </tr>
              <tr>
                <td><strong>Other Fee:</strong></td>
                <td colspan="3">$ <?php echo $_POST['otherfee']; ?></td>
              </tr>
              <tr>
                <td><strong>Total</strong></td>
                <td colspan="3">$ <?php echo $_POST['total']; ?></td>
              </tr>
              <tr>
                <td><strong>Remarks:</strong></td>
                <td colspan="3"><?php echo $_POST['remarks']; ?></td>
              </tr>
            </table>
    <br />
            
                    <table width="686" border="1">
          <tr bgcolor="#FFFFCC">
            <td colspan="6" align="center">Prescription details</td>
          </tr>
       
          <tr>
            <td width="144"><strong>Medicine Name</strong></td>
            <td width="133"><strong>Mg</strong></td>
            <td width="60"><strong>Dosage</strong></td>
            <td width="123"><strong>Number Of Days</strong></td>
          </tr>
          <tr>
<?php
$respat = mysqli_query($con, "SELECT * FROM appointment where pat_id='$_GET[pat_id]'");
$recpat = mysqli_fetch_array($respat);

$restest = mysqli_query($con, "SELECT * FROM test where app_id='$recpat[app_id]'");
$rettest = mysqli_fetch_array($restest);

			  $res = mysqli_query($con, "SELECT * FROM prescription where test_id='$_GET[testi]'");
			  
			  $retpres = mysqli_fetch_array($res);
			  $nod= unserialize($retpres['no_of_days']);
			  $medname = unserialize($retpres['medicines']);
			  $mg = unserialize($retpres['mg']);
			  $dosage = unserialize($retpres['dosage']);
			  $remarks = $retpres['remarks'];
			 // echo "<td>" . $retpres['test_id'] . "</td>";
     for($k=0; $k<count($nod); $k++)
  {
	  /*for($j=1;$j<=$k;$j++)
	  {
		  echo "<td>"  .    "</td>";
	  }*/
  echo " <tr><td>" . $medname[$k] . "</td>";
  echo "<td>" . $mg[$k] . "</td>";
  echo "<td>" . $dosage[$k] . "</td>";
  echo "<td>" . $nod[$k] . "</td>";

  echo "</tr>";
  }
  
?>
 <tr>
        <td colspan="4">&nbsp;<strong>Remarks:</strong><br />
        &nbsp;<?php echo $remarks; ?></td>
          </tr>
</table>
<br /><br />
<p align="right"><strong>Doctor's signature</strong></p>

 </div>
<?php
}
else
{
?>      
            </p>
            <table width="547" border="0">
              <tr>
                <td colspan="4" align="center"><p>ADVANCED OPTICAL - EYE CARE CENTER - ALBANY, NY</p></td>
              </tr>
              <tr>
                <td colspan="3">Test ID:<?php echo $_GET['testi'];?></td>
                <td>Date:<?php echo date("d-m-Y"); ?></td>
              </tr>
              <tr>
                <td width="133"><label for="patname">Patient Name:</label></td>
                <td width="149"><input name="patname" type="text" id="patname" value="<?php echo $retpat['pat_name']?>" readonly="readonly"/></td>
                <td width="103">Doctor Name:</td>
                <td width="144"><label for="docname"></label>
                <input name="docname" type="text" id="patname2" value="<?php echo $retdoc['doc_name']?>" readonly="readonly"/></td>
              </tr>
             
              <tr>
                <td>Test Fee:</td>
                <td colspan="3"><label for="testfee"></label>
                <input name="testfee" type="text" id="testfee" onchange="myFunc()" value="0"/></td>
              </tr>
              <tr>
                <td>Consultation Fee:</td>
                <td colspan="3"><input name="consultationfee" type="text" id="consultationfee" onchange="myFunc()" value="0"/></td>
              </tr>
              <tr>
                <td>Other Fee:</td>
                <td colspan="3"><input name="otherfee" type="text" id="otherfee" onchange="myFunc()" value="0" /></td>
              </tr>
              <tr>
                <td><strong>Total</strong></td>
                <td colspan="3"><input name="total" type="text" id="total" value="0" readonly="readonly" /></td>
              </tr>
              <tr>
                <td>Remarks:</td>
                <td colspan="3"><label for="remarks"></label>
                  <textarea name="remarks" id="remarks" cols="45" rows="5"></textarea></td>
              </tr>
              <tr>
                <td colspan="4" align="center"><input type="submit" name="bill" id="bill" value="Generate Bill" /></td>
              </tr>
            </table>
            <p>&nbsp;</p>
             <?php
}
?>
          </form>
</div>
  </div>
        <div class="cleaner"></div>
    </div> 
    <?php
include("includes/footer.php");
?>