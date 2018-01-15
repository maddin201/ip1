<?php
ob_start();
include("includes/header.php");
include("includes/conn.php");
$results="";
$rcsucc="";
$t="All";
if( isset($_GET['testids']) && isset($_GET['brid']) )
{	
	$sql="select * from products where  branch_id='$_GET[brid]'";
	$results = mysqli_query($con, $sql);	
}
else if(isset($_GET['type']))
{
$t=$_GET['type'];
$sql="select * from products where product_type='$t'";
$results = mysqli_query($con, $sql);	
}
else
{
$sql="select * from products";
$results = mysqli_query($con,$sql);	
}
$n = mysqli_num_rows($results);
if($n == 0)
{
 $rcsucc = "<h3><font color='#FF00CC'> No Products in this category.</font></h3> ".
 '<input type="button" onClick="history.go(-1);" value="Go Back" />'	;
}
//$arr = mysqli_fetch_array($results);
//print_r($arr);
?>	
    <div id="tm_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            	<?php
				include("sidebar.php");
			products1();
				?>
            </div>
   		</div>
       <div id="R_main">
   		<div id="sidebar" class="float_l">
        	<?php
			//include("cssidebar.php");
			?>
            
   		</div>
        <div id="content" class="float_r">
        	<h1>Products <?php echo ":".$t; ?></h1>
			<?php echo  $rcsucc; ?>
            <?php
            
			$i=0;
			//while($ros = mysqli_fetch_array($results,MYSQLI_ASSOC))
			while($ros = mysqli_fetch_array($results))
			{
				if($ros['image']=="")
				{
				$img = "upload/noimage.jpg";
				}	
				else
				{
				$img = "upload/".$ros['image'];	
				}
	
				if($i==0)
				{	
				?>
            <div class="product_box">
		 
		 <?php	if(isset($_SESSION['logtype'])){?>
		 
			<a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>&testids=<?php echo $_GET['testids']; ?>">
       <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>&testids=<?php echo $_GET['testids']; ?>">
         <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>&testids=<?php echo $_GET['testids']; ?>">
         <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>&testids=<?php echo $_GET['testids']; ?>">
		<?php  } else {  ?>  
		 		<a href="productdetail.php">
            <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>">
            <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>">
            <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>">  
			<?php  } ?>
            <img src="<?php echo $img; ?>" alt="Image 02" height="150" width="200"/></a></a></a></a>
              <h3><?php echo "Name: ". $ros["name"]; ?></h3>
                <p class="product_price">$ <?php echo $ros["cost"]; ?></p>
             <?php
			 if(isset($_SESSION["logtype"]) and ($_SESSION["logtype"]=='Administrator' or $_SESSION["logtype"]=='Patient'))
			 {
			 ?>
                <a href="shoppingcart.php?proid=<?php echo $ros['prod_id']; ?>&testids=<?php echo $_GET['testids']; ?>" class="add_to_card">Order</a>
                 <?php
			 }
			 ?>
                <a href="productdetail.php?proid=<?php echo $ros['prod_id']; ?>&testids=<?php echo $_GET['testids']; ?>" class="detail">Product Detail</a>
            </div>       
            <?php
			$i=1;
				}
				else if($i==1)
				{
				?>
            <div class="product_box">
           	  <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>"><img src="<?php echo $img; ?>" alt="Image 02" height="150" width="200"/></a>
                <h3>Name : <?php echo $ros["name"]; ?></h3>
                <p class="product_price">$ <?php echo $ros["cost"]; ?></p>
                   <?php
			 if(isset($_SESSION["logtype"]) and  ($_SESSION["logtype"]=='Administrator' or $_SESSION["logtype"]=='Patient' ))
			 {
			 ?>
              <a href="shoppingcart.php?proid=<?php echo $ros['prod_id']; ?>&testids=<?php echo $_GET['testids']; ?>" class="add_to_card">Order</a>
              <?php
			 }
			 ?>
              <a href="productdetail.php?proid=<?php echo $ros['prod_id']; ?>&testids=<?php echo $_GET['testids']; ?>" class="detail">Product Detail</a>
            </div> 
            <?php
			$i=2;
				}
				else if($i==2)
				{
				?>       	
            <div class="product_box no_margin_right">
      <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>"><img src="<?php echo $img; ?>" alt="Image 02" height="150" width="200"/></a>
                <h3>Name : <?php echo $ros["name"]; ?></h3>
                <p class="product_price">$ <?php echo $ros["cost"]; ?></p>       <?php
			 if(isset($_SESSION["logtype"]) and ($_SESSION["logtype"]=='Administrator' or $_SESSION["logtype"]=='Patient'))
			 {
			 ?>
              <a href="shoppingcart.php?proid=<?php echo $ros["prod_id"]; ?>" class="add_to_card">Order</a>
              <?php
			 }
			  ?>
              
              <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>" class="detail">Product Detail</a>
            </div> 
            <?php
			$i=0;
				}
				?>    
            	<?php
			}
			?>
		 
		 
		 
      </div> 
        <div class="cleaner"></div>
    </div>
    <?php
include("includes/footer.php");
?>