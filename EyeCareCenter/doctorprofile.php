<?php
$prost = 1;
include("includes/header.php");
include("conn.php");
$docid  =  $_GET['docid'];
$sql="SELECT * FROM doctor where doc_id=$docid";
//echo $sql;



$resultrec = mysqli_query($con, $sql);
$arrdoc = mysqli_fetch_array($resultrec);


			
$doc_id = $arrdoc['doc_id'];
$branch_id = $arrdoc['branch_id'];
$branchres = mysqli_query($con, "select * from branch where branch_id='$branch_id'");
$branchrec = mysqli_fetch_array($branchres);


$docname = $arrdoc['doc_name'];
$docimg = $arrdoc['image'];

				if($docimg=="")
				{
				$img = "upload/noimage.jpg";
				}	
				else
				{
				$img = "upload/".$docimg;	
				}
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
        
 <div id="content" class="float_r">
        	
            <h1><?php echo $docname; ?></h1>
            <div class="content_half float_l">
      
			<a  href="upload/"><img src="<?php echo $img; ?>" alt="Image 01" height="300" width="300" />
		 
            </div>
            <div class="content_half float_r">
				<table>
                    <tr>
                        <td height="30" width="160">Name</td>
                        <td>&nbsp;<?php echo $docname; ?></td>
                    </tr>
					<tr>
                    	<td height="30">Clinic:</td>
                        <td><?php echo $arrdoc['clinic_name']; ?></td>
                    </tr>
                    <tr>
                    	<td height="30">Branch:</td>
                        <td><?php echo $branchrec['branch_name']; ?></td>
                    </tr>
                                  
                    
                </table> 
<input type="button" onClick="history.go(-1);" value="Go Back" />				
                <div class="cleaner h20"></div>
		
			</div>
            <div class="cleaner h30"></div>
            
            <div class="cleaner h50"></div>
 
            
      </div> 
        <div class="cleaner"></div>
    </div>
    <?php
include("includes/footer.php");
?>