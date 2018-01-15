<?php
include("includes/header.php");
include("conn.php");
?>
    
    <div id="tm_middle" class="carousel">
    	<div class="panel">
				
				<div class="details_wrapper">
					
					<div class="details">
					
					                            
                           
						
					</div>
					
				</div>
				
				<div class="paging">
					<div id="numbers"></div>
					<a href="javascript:void(0);" class="previous" title="Previous" >Previous</a>
					<a href="javascript:void(0);" class="next" title="Next">Next</a>
				</div>
                				
				<a href="javascript:void(0);" class="play" title="Turn on autoplay">Play</a>
				<a href="javascript:void(0);" class="pause" title="Turn off autoplay">Pause</a>
				
			</div>
	
			<div class="backgrounds">
				
				<div class="item item_1">
					<img src="images/slider/1.jpg" alt="Slider 01" />
				</div>
				
				<div class="item item_2">
					<img src="images/slider/2.jpg" alt="Slider 02" />
				</div>
				
				<div class="item item_3">
					<img src="images/slider/3.jpg" alt="Slider 03" />
				</div>
                
				<div class="item item_4">
					<img src="images/slider/4.jpg" alt="Slider 04" />
				</div>
                
                                <div class="item item_5">
					<img src="images/slider/5.jpg" alt="Slider 05" />
				</div>
                
                                <div class="item item_6">
					<img src="images/slider/6.jpg" alt="Slider 06" />
				</div>
                
                                <div class="item item_7">
					<img src="images/slider/7.jpg" alt="Slider 07" />
				</div>
                
                                <!-- <div class="item item_8">
					<img src="images/slider/8.jpg" alt="Slider 08" />
				</div> -->
                
			</div>
    </div> 
    <?php

include("conn.php");

if( isset($_GET['testids']) && isset($_GET['brid']) )
{
	$sql="select * from products where  branch_id='$_GET[brid]'";
	$results = mysqli_query($con,$sql);	
}
else if(isset($_GET['type']))
{
 $sql1="select * from products where product_type='$_GET[type]' ";
$results = mysqli_query($con,$sql1);	
}
else
{
$results = mysqli_query($con, "select * from products");	
}
?>
    <div id="tm_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            	<?php
				include("sidebar.php");
				products1();
				//products($results);
				?>
            </div>
   		</div>
       <div id="tm_main">
   		<div id="sidebar" class="float_l">
        	<?php
			//include("cssidebar.php");
			?>
            
   		</div>
        <div id="content" class="float_r">
        	<h1>Products</h1>
            <?php
if(isset($_GET['type']))
{
$sql2="select * from products where product_type='$_GET[type]' ORDER BY prod_id DESC  LIMIT 0 , 9";
$results = mysqli_query($con,$sql2);	
}
else
{
$sql3="select * from products ORDER BY prod_id DESC  LIMIT 0 , 9";
$results = mysqli_query($con,$sql3 );	
}
			$i=0;
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
			
	     <a href="productdetail.php?proid=<?php echo $ros['prod_id']; ?>">
             <a href="productdetail.php?proid=<?php echo $ros['prod_id']; ?>">
             <a href="productdetail.php?proid=<?php echo $ros['prod_id']; ?>">
     <!--      <a href="productdetail.php?proid=<?php echo $ros['prod_id']; ?>"> -->
	
            <img src="<?php echo $img; ?>" alt="Image 02" height="150" width="200"/></a></a></a></a>
              <h3><?php echo "Name: ". $ros["name"]; ?></h3>
                <p class="product_price">$ <?php echo $ros["cost"]; ?></p>
                <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>" class="add_to_card">Product Detail</a>
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
              <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>" class="add_to_card">Product Detail</a>
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
                <p class="product_price">$ <?php echo $ros["cost"]; ?></p>
              <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>" class="add_to_card">Product Detail</a>
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