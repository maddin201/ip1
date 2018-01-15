<?php
ob_start();
include("includes/header.php");
include("includes/conn.php");
$results="";
$ros = array();
$sql="select * from doctor";
$results = mysqli_query($con,$sql);	

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
        	<h1>Our Doctors</h1>
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
		<?php	/*if(isset($_SESSION['logtype'])){?>
			<a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>&testids=<?php echo $_GET['testids']; ?>">
       <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>&testids=<?php echo $_GET['testids']; ?>">
         <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>&testids=<?php echo $_GET['testids']; ?>">
         <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>&testids=<?php echo $_GET['testids']; ?>">
		<?php } else {  */?>
		 		<a href="viewdoctor.php">
            <a href='doctorprofile.php?docid=<?php echo $ros["doc_id"]; ?>'>
            <a href='doctorprofile.php?docid=<?php echo $ros["doc_id"]; ?>'>
            <a href='doctorprofile.php?docid=<?php echo $ros["doc_id"]; ?>'>  
			<?php //} ?>
            <img src="<?php echo $img; ?>" alt="Image 02" height="150" width="150"/></a></a></a></a>
              <h3><?php echo "Name: ". $ros["doc_name"]; ?></h3>
               
             <?php
			 if(isset($_SESSION["logtype"]) and $_SESSION["logtype"]=='Administrator')
			 {
			 ?>
               
                 <?php
			 }
			 ?>
                <a href="doctorprofile.php?docid=<?php echo $ros['doc_id'];  ?>" class="detail">View Profile</a>
            </div>       
            <?php
			$i=1;
				}
				else if($i==1)
				{
				?>
            <div class="product_box">
           	  <a href="doctorprofile.php?docid=<?php echo $ros['doc_id']; ?>"><img src="upload/<?php echo $ros['image'] ?>" alt="Image 02" height="150" width="150"/></a>
                <h3>Name : <?php echo $ros["doc_name"]; ?></h3>
             
                   <?php
			 if(isset($_SESSION["logtype"]) and  $_SESSION["logtype"]=='Administrator')
			 {
			 ?>
        
              <?php
			 }
			 ?>
              <a href="doctorprofile.php?docid=<?php echo $ros['doc_id']; ?>" <img src="upload/<?php echo $img; ?>" alt="Image 02" height='150' width='150'  class="detail">View Profile</a>
            </div> 
            <?php
			$i=2;
				}
				else if($i==2)
				{
				?>       	
            <div class="product_box no_margin_right">
    
	 <img src="<?php echo $img; ?>" alt="Image 02" height="150" width="150"/></a>
                <h3>Name : <?php echo $ros["doc_name"]; ?></h3>
                     <?php
			 if(isset($_SESSION["logtype"]) and $_SESSION["logtype"]=='Administrator')
			 {
			 ?>
                <a href="doctorprofile.php?docid=<?php echo $ros['doc_id']; ?>" class="detail">View Profile</a> <?php
			 }
			  ?>
              
              <a href="doctorprofile.php?docid=<?php echo $ros['doc_id']; ?>" class="detail">View Profile</a>
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