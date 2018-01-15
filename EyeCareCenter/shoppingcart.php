<?php
session_start();
$_SESSION['proids']= array();
if(!isset($_SESSION["login"]))
{
header("Location: index.php");	
}
include("includes/header.php");
include("includes/conn.php");
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
<script type="application/javascript" >


/*
    var str1 = document.getElementById("Total3").value;
    var str2 = document.getElementById("loaddate").value;

    var dt1  = parseInt(str1.substring(0,2),10);
    var mon1 = parseInt(str1.substring(3,5),10);
    var yr1  = parseInt(str1.substring(6,10),10);
	alert(mon1);
    var dt2  = parseInt(str2.substring(0,2),10);
    var mon2 = parseInt(str2.substring(3,5),10);
    var yr2  = parseInt(str2.substring(6,10),10);
    var date1 = new Date(yr1, mon1, dt1);
    var date2 = new Date(yr2, mon2, dt2);
    
    if(date2 < date1)
    {
        alert("To date cannot be greater than from date");
        return false;
    }
    else
    {
        alert("Submitting ...");
        document.form1.submit();
    }
	var date = new Date("d-m-y");
   alert(date);
*/
function validation()
{	
var start = document.form1.Total3.value;
var end = document.form1.loaddate.value;

var stDate = new Date(start);
var enDate = new Date(end);
var compDate = enDate - stDate;
//alert("st"+stDate);
//alert("End "+enDate);
	if(compDate <= 0)
	{
	//return true;
	}
	else
	{
	alert("Please Enter the correct date ");
	return false;
	}
	
	
	if(document.form1.Total3.value == "")
	{
		alert("Please enter dispatch date");
		//alert(document.form1.Total3.value);
		return false;
	}
	return true;
}
</script>

<?php
$prost=1;

$testids=$_GET['testids'];
if($testids=="")
{
$testids=0;
}

if(isset($_POST['button']))
{
	$totals = $_POST['Total'];
	$payments = $_POST['Total2'];
	$dispdate = $_POST['Total3'];
	for($i=0; $i<count($_POST['proid']); $i++)
	{
		$prid =  $_POST['proid'][$i];
		
		$dt = date("Y-m-d");
		$db = date("Y-m-d", strtotime($dispdate));
		
		$adminid = 1;
		
		$sql="INSERT INTO orders (test_id,admin_id,prod_id,order_date,dispatch_date,total,payment,status) 
		VALUES ($testids,'$adminid','$prid','$dt','$db','$totals','$payments','Pending')";
				
			$res=mysqli_query($con, $sql);
//echo $sql;		
				if (!$res)
				{
				  die('Error: ' . mysqli_error());
				}
			$totals = 0;	
			$payments = 0;
	}
}
if(isset( $_GET['proid'])){
$countrec = count($_SESSION['proids']);
$countrec++;

$_SESSION['proid'][$countrec] = $_GET['proid'];
}
?>
    
    <div id="tm_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            	<?php
				include("sidebar.php");
				products(1);
				?>
            </div>
   		</div>
        <div id="content" class="float_r">
        	<h1>Shopping Cart</h1>
<form method="post" action="" name="form1" id="form1" onSubmit="return validation()" >
			<?php
           		if(isset($_POST['submit']))
			   {
			   echo "Order placed successfully..";
				}
			   else
			   {
		   ?>
           <?php
		  if(isset($_POST['button']))
{
	echo "<h3>Product ordered successfully... </h3>";
	?>
     <div id="printablediv" style="width: 100%;">
    <?php
	$costs="";
		for($i=0; $i<count($_POST['proid']); $i++)
		{
		?>	
       
        <table width="680px" cellspacing="0" cellpadding="5">
                   	  	<tr bgcolor="#ddd">
                        	<th width="153" align="left">Product name </th> 

                       	  	<th colspan="2" align="center">Product type</th> 
                        	<th width="120" align="right">Total </th> 
                       	</tr>
<?php

$arr = $_SESSION['proid'];
$resultrecs = array_unique($arr);

//$arr = array('nice_item', 'remove_me', 'another_liked_item', 'remove_me_also');
if(isset($_GET['proids']))
{
$resultrecs = array_diff($resultrecs, array(''));
$resultrecs = array_diff($resultrecs, array($_GET['proids']));
}
//print_r($resultrecs);

foreach($resultrecs as $arr)
{
	 	$num = $resultrecs[1];
		$resultrec = mysqli_query($con, "SELECT * FROM products where prod_id='$arr'");
		$arrprod = mysqli_fetch_array($resultrec);
		$kn = $i +1;


		
?>                   
							
<tr>
<td>
<?php 
echo $arrprod['name']; 
?>
</td> 
		
									<td colspan="2" align="center">&nbsp;<?php echo $arrprod['product_type']; ?><?php echo $arrprod['sub_type']; ?></td>
									<td align="right">
									<?php
									$costs = $costs + $arrprod['cost'];
									echo $arrprod['cost']; 
									?> </td>
		  </tr>
								
<?php

		$proid[$i] = $_SESSION['proid'];
}
?>
                        <tr>
                          <td align="left"  height="30"  >&nbsp;</td>
                          <td  height="30" colspan="2" align="right"  ><label for="Total"></label>
Total : </td>
                          <td colspan="2" align="right" style="background:#ddd; font-weight:bold">
                        <?php echo $_POST['Total']; ?></td>
                        </tr>
                        <tr>
                          <td align="left"  height="30"  >&nbsp;</td>
                          <td  height="30" colspan="2" align="right"  > Payment : </td>
                          <td colspan="2" align="right" style="background:#ddd; font-weight:bold">
                          $ <?php echo $_POST["Total2"]; ?>                            </td>
                        </tr>
                        <tr>
                          <td align="left"  height="30"  >&nbsp;</td>
                          <td  height="30" colspan="2" align="right"  >Dispatch date: </td>
                          <td colspan="2" align="right" style="background:#ddd; font-weight:bold">
					<?php echo $_POST["Total3"]; ?>  
                          </td>
                        </tr>
                        <tr>
                          <td align="left"  height="30"  >&nbsp;</td>
                          <td  height="30" colspan="2" align="right"  >&nbsp;</td>
                          <td colspan="2" align="right" style="background:#ddd; font-weight:bold">
                          <?php
						 $dt = date("d-M-Y");
						  ?>
                          </td>
                        </tr>
					</table>
		<?php	
	}
	?>    
    <br />    <br />
    <p align="right"><strong>Signature</strong></p>
    
    </div>
    <a href='#' onclick="javascript:printDiv('printablediv')" >Print purchase report..</a>

    <?php
	unset($_SESSION['proid']);
	
}
else
{
			?>
        	<table width="680px" cellspacing="0" cellpadding="5">
                   	  	<tr bgcolor="#ddd">
                        	<th width="220" align="left">Image </th> 
                        	<th width="148" align="left">Product info</th> 
                       	  	<th width="66" colspan="2" align="center">Product type</th> 
                        	<th width="60" align="right">Total </th> 
                        	<th width="90"> </th>
                      	</tr>
<?php
$arr = $_SESSION['proid'];
$resultrecs = array_unique($arr);

//$arr = array('nice_item', 'remove_me', 'another_liked_item', 'remove_me_also');
if(isset($_GET['proids']))
{
$resultrecs = array_diff($resultrecs, array(''));
$resultrecs = array_diff($resultrecs, array($_GET['proids']));
}
//print_r($resultrecs);
$i=1;
$costs=0;
foreach($resultrecs as $arr)
{
	 	$num = $resultrecs[1];
		$resultrec = mysqli_query($con, "SELECT * FROM products where prod_id='$arr'");
		$arrprod = mysqli_fetch_array($resultrec);
		$kn = $i +1;


		
?>                   
							
<tr>
<td>
<input type="hidden" value="<?php echo $arrprod['prod_id']; ?>"  name="proid[]" id="proid[]" />
<img src="upload/<?php echo $arrprod['image']; ?>" width="204" height="135" /></td> 
									<td><?php echo $arrprod['name']; ?></td> 
									<td colspan="2" align="center">&nbsp;<?php echo $arrprod['product_type']; ?><?php echo $arrprod['sub_type']; ?></td>
									<td align="right">
									<?php
									$costs = $costs + $arrprod['cost'];
									echo $arrprod['cost']; 
									?> </td>
									<td align="center"> <a href="shoppingcart.php?proids=<?php echo $arrprod['prod_id']; ?>">Remove</a> </td>
</tr>
								
<?php

		$proid[$i] = $_SESSION['proid'][$i];
}
?>
                        <tr>
                          <td align="left"  height="30px"  >&nbsp;</td>
                          <td  height="30px" colspan="2" align="right"  ><label for="Total"></label>
Total : </td>
                          <td colspan="3" align="right" style="background:#ddd; font-weight:bold">
                           $<input type="text" name="Total" id="Total" value="<?php echo $costs; ?>"/></td>
                        </tr>
                        <tr>
                          <td align="left"  height="30px"  >&nbsp;</td>
                          <td  height="30px" colspan="2" align="right"  > Payment : </td>
                          <td colspan="3" align="right" style="background:#ddd; font-weight:bold">
                          $<input type="text" name="Total2" id="Total2" />
                            </td>
                        </tr>
                        <tr>
                          <td align="left"  height="30px"  >&nbsp;</td>
                          <td  height="30px" colspan="2" align="right"  >Dispatch date: </td>
                          <td colspan="3" align="right" style="background:#ddd; font-weight:bold">
						<script language="javascript" type="text/javascript" src="datetimepicker.js">
                        </script>
						<input type="Text" id="Total3" name="Total3" maxlength="25" size="25" />
                        <a href="javascript:NewCal('Total3','ddmmmyyyy',false,24)">
                        <img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>
                          </td>
                        </tr>
                        <tr>
                          <td align="left"  height="30px"  >&nbsp;</td>
                          <td  height="30px" colspan="2" align="right"  >&nbsp;</td>
                          <td colspan="3" align="right" style="background:#ddd; font-weight:bold">
                          <?php
						 $dt = date("d-M-Y")
						  ?>
                          <input type="hidden" id="loaddate" name="loaddate" maxlength="25" size="25" value="<?php echo $dt; ?>"/>
                          <input type="submit" name="button" id="button" value="Order" />
                          </td>
                        </tr>
					</table>
                    <?php
}
?>
                    </form>
                    <?php
			   }
			   ?>
          <div style="float:right; width: 215px; margin-top: 20px;">
                    
				
                    	
          </div>
            
        </div> 
        <div class="cleaner"></div>
    </div> 
    <?php
include("includes/footer.php");
?>