<?php
session_start();
include("includes/header.php");
include("includes/conn.php");
$rowrec="";
$rcsucc = "";
if(isset($_POST['update']))
{

$bname=$_POST['bname'];
$name=$_POST['name'];
$ptype=$_POST['ptype'];
$ptype2 =$_POST['ptype2'];
$image =$_POST['image'];
$colorpick=trim($_POST['colorpick']);
$qty=$_POST['qty'];
$prodid = $_POST['prodid'];
$cost =$_POST['cost'];
$filename = $_FILES["file"]["name"];
	 
	if($filename == "")
	{
	$query=
	"UPDATE  products SET  
	branch_id =  '$bname',
	name = '$name',
	product_type = '$ptype', 
	sub_type = '$ptype2',
	image = '$image',
	color =  '$colorpick',
	cost =  '$cost',
	quantity =  '$qty' WHERE prod_id ='$prodid' ;";
	$rr = mysqli_query($con,$query);
	//echo $query;
	if($rr ){

  $rcsucc = "<b><font color='#006600'>Product Updated Successfully.</font></b>";
}
		 
	}
	else
	{
	move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$filename);
	$query =
	"UPDATE  products SET  
	branch_id =  '$bname',
	name = '$name',
	product_type = '$ptype', 
	sub_type = '$ptype2',
	image =  '$filename',
	color =  '$colorpick',
	cost =  '$cost',
	quantity =  '$qty' WHERE prod_id ='$prodid' ;";
	$rr = mysqli_query($con,$query);
	echo $query;
	if($rr ){

  $rcsucc = "<b><font color='#006600'>Product Updated Successfully.</font></b>";
}
}
}
//if(isset($_POST['token']) && $_POST['token'] == $_SESSION['token'])
{
		if(isset($_POST['add']) and $_GET['prodid']=="")
		{ 	
		$filename = $_FILES["file"]["name"];
		move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$filename);
		
		
		$sql="INSERT INTO products (branch_id, name, product_type, sub_type, image, color, cost, quantity)
		VALUES
		('$_POST[bname]','$_POST[name]','$_POST[ptype]','$_POST[ptype2]','$filename',trim('$_POST[colorpick]'),'$_POST[cost]','$_POST[qty]');";
		
		
		$res=mysqli_query($con,$sql);
		 //echo $sql;
		  
		  if($res) 
		  {
		  $rcsucc = "<b><font color='#006600'>Product Added Successfully.</font></b>";
				// echo $rcsucc ;
		  }
		  else
		  {
		   $rcsucc = "<b><font color='#FF0000'>Failed to Add Product.</font></b>";
				 //echo $rcsucc;
		 
		  }
		
		}
		unset($_SESSION['token']);
}

$new_token = md5(time() . rand(0,100));
$_SESSION['token'] = $new_token;

$resbranch = mysqli_query($con,"select * from branch");
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
        <h1>Add New Product:</h1>
		
		<?php  echo $rcsucc ;  ?>
        <p><a href="viewproducts.php">View Products</a></p>
        <script type="application/javascript" >
function validation()
{
	if(document.adprod.ptype.value == "")
	{
		alert("Select Product Type.");
		document.adprod.ptype.focus();
		return false;
	}
	if(document.adprod.ptype2.value == "")
	{
		alert("Select Sub Type.");
		document.adprod.ptype2.focus();
		return false;
	}
	if(document.adprod.name.value == "")
	{
		alert("Enter Product Name.");
		document.adprod.name.focus();
		return false;
	}
	if(document.adprod.cost.value == "")
	{
		alert("Enter The Cost.");
		document.adprod.cost.focus();
		return false;
	}
		if(document.adprod.bname.value == "")
	{
		alert("Select Branch.");
		document.adprod.bname.focus();
		return false;
	}
	if(document.adprod.qty.value == "")
	{
		alert("Enter The Quantity.");
		document.adprod.qty.focus();
		return false;
	}

}
</script>
        
        <form action="" method="post" enctype="multipart/form-data" name="adprod" id="adprod" onsubmit="return validation()">
          <table width="644" border="0">
            <tr>
              <td width="139" height="34"><strong>Product Type:</strong></td>
              
            
                <td width="163">
                <script>
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
xmlhttp.open("GET","ajaxproducttype.php?q="+str,true);
xmlhttp.send();
}
</script>
  <?php

			  	
	if(isset($_GET['prodid'])){	
  			$resultquery = mysqli_query($con,"SELECT * FROM  products where prod_id='$_GET[prodid]'");
			$rowrec = mysqli_fetch_array($resultquery);
			//print_r($rowrec);
//echo mysqli_num_rows($resultquery);
}
			
				$arrcont = array("Lenses","Glases");
				
				?>
                <select name="ptype" id="ptype" onchange="showUser(this.value)">
                <option value="">Select</option>
                  <?php
				 foreach($arrcont as $value)
				 {
					 if($rowrec["product_type"] == $value)
					 {
					 echo "<option value='$value' selected>$value</option>";
					 }
					 else
					 {
					 echo "<option value='$value'>$value</option>";
					 }
				 }
				 ?>
                </select></td>
                <td width="128"><strong>Sub Type:</strong></td>
                <td width="196"><div id="txtHint"><select name="ptype2" id="ptype2">
                 <option value="">Select</option>
                  <?php
				   echo "<option value='$rowrec[sub_type]'>$rowrec[sub_type]</option>";
				  ?>
                </select></div></td>
				 
            </tr>
            <tr>
              <td height="34"><strong>
                <label for="name" class="left">Name:</label>
              </strong></td>
              <td colspan="3">
              <input name="name" class="right" type="text" id="name" size="50" value="<?php  echo (isset($rowrec['name']))? $rowrec['name']: ""; ?>" />
              </td>
            </tr>
            <tr>
              <td height="33"><strong>
                <label class="left" for="doclname2">Color:</label>
              </strong></td>
              <td colspan="3"><script type="text/javascript" src="jscolor.js"></script>
				   <input name="colorpick" class="color" value="
                     <?php
			  	if(isset($_GET['prodid']))
			  	{
					echo $rowrec['color'];
				}
				else
				{					
					echo 'FFFFFF';
				}
				?>">
			</td>
            </tr>
            <tr>
              <td height="30"><strong>
                <label for="loginid2" class="left">Cost:</label>
              </strong></td>
              <td colspan="3"><input name="cost" type="text" class="right" id="cost" size="50" value="<?php  echo (isset($rowrec['cost']))? $rowrec['cost']: ""; ?>" /></td>
            </tr>
            <tr>
              <td height="31"><strong>
                <label for="password2" class="left">Branch Name:</label>
              </strong></td>
              <td colspan="3">
                <select name="bname" id="bname">
            <option value="">Select</option>
            <?php
			while($rows = mysqli_fetch_array($resbranch))
			{
				if($rows[branch_id]==$rowrec[branch_id])
				{
				echo "<option value='$rows[branch_id]' selected>$rows[branch_name]</option>";
				}
				else
				{
				echo "<option value='$rows[branch_id]'>$rows[branch_name]</option>";
				}
			}
			?>
                        </select></td>
            </tr>
            <tr>
              <td height="42"><strong>
                <label class="left" for="cpassword2">Quantity:</label>
              </strong></td>
              <td colspan="3"><input name="qty" class="right" type="text" id="qty" size="10" value="<?php  echo (isset($rowrec['quantity']))? $rowrec['quantity']: ""; ?>"/></td>
            </tr>
            <tr>
              <td height="32" valign="top"><strong>Image:</strong></td>
              <td colspan="3"><label for="file"></label>
              <input type="file" name="file" id="file" />
              	<?php
				
				$img =   $rowrec['image'];
				  
				 
            if($img =="")
			  
			 	{
				$img = "noimage.jpg";
			 	}	
				
				?><br />
                <?php
			  if(isset($_GET['prodid']))
			  {
			  ?>
                <img src="<?php echo "upload/".$img; ?>" alt="Image 02" height="100" width="120"/>
                <?php
			  }
			  
			?>
              </td>
            </tr>
            <tr>
              <td height="36" colspan="4" align="center"><p>
              <?php
			  if(isset($_GET['prodid']))
			  {
			  ?>
              <br />
			  <input type="hidden" name="image" id="image" value="<?php echo $img; ?>" />
              	<input type="hidden" name="prodid" id="prodid" value="<?php echo $_GET[prodid]; ?>" />
                <input type="submit" name="update" id="update" value="Update Product" class="submit_btn float_l"  />
                <?php
				}
				else
				{					
				?>
				 	<input type="hidden" name="prodid" id="prodid" value="" />
<input type="submit" name="add" id="add" value="Add Product" class="submit_btn float_l" />
                <?php
				}
				?>
              </p></td>
            </tr>
          </table>
          <p>&nbsp;</p>

        </form>
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