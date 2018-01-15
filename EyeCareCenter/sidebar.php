<?php
if(!isset($_SESSION)){
    session_start();
}
$prost=1;
$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') 
                === FALSE ? 'http' : 'https';
$host     = $_SERVER['HTTP_HOST'];
$script   = $_SERVER['SCRIPT_NAME'];
$params   = $_SERVER['QUERY_STRING'];
$currentUrl = $protocol . '://' . $host . $script . '?' . $params;
			
 					function patienthome()
					{
?>
         	             <h3>Menu</h3>   
         <div class="content"> 
             <ul class="sidebar_list">
             <?php
			 if($_SESSION["logtype"] != "Patient")
			 {
			 ?>
             <li><a href="viewpatient.php">View Patient</a></li>
             <li><a href="viewappointment.php?chngepass=set">View Appointment</a></li>
            <?php
			 }
			 else
			 {
			 ?>
                        <li><a href="updatepatient.php">Update Profile</a></li>
                        <li><a href="chngpswrd.php">Change Password</a></li>
             <?php
			 }
			 ?>
             <li><a href="cancelappointment.php">Cancel Appointment</a></li>
             </ul>
         </div>
              <?php
				}
		
			function doctorhome()
				{
					// Doctors home
					//dochome.php
					//updatedoctor.php
					///chngpswrd.php
				?>
                        	<h3>Menu</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                        <li><a href="updatedoctor.php">Update Profile</a></li>
                        <li><a href="chngpswrd.php">Change Password</a></li>         
                    </ul>
                </div>
              <?php
				}
				
			function adminhome()
				{
				?>
             	<h3>Menu</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                        <li><a href="updateadmin.php">Update Profile</a></li>
                         <li><a href="chngpswrd.php">Change Password</a></li>
                        
                    </ul>
                </div>
              <?php
				}
				function guesthome()
				{
				?>
                        	<h3>Menu</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                        <li><a href="patienthome.php">Home</a></li>
                        <li><a href="updatepatient.php">Update Profile</a></li>
                        <li><a href="chngpswrd.php">Change Password</a></li>
                        <li><a href="">View Appointment Details</a></li>
                        <li><a href="#">View Test Results</a></li>
                        <li><a href="#">View Prescription Details</a></li>
                     
                    </ul>
                </div>
              <?php
			}			
				function patientsidebar()
				{
				?>
                        	<h3>Menu</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                     <li><a href="viewpatient.php">Patient Accounts</a></li>
                     <li><a href="viewappointment.php">View Appointment Details</a></li>
                      
                    </ul>
                </div>
              <?php
				}	
				
				function doctorsidebar()
				{
				?>
				<h3>Menu</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                        <li><a href="adddoctors.php">Add Doctor</a></li>
                        <li><a href="addpatient.php">Add Patient</a></li>
                        <li><a href="viewappointment.php">View Appointment Details</a></li>
                        <li><a href="chngpswrd.php">Change Password</a></li>
                        
                        <li><a href="#">View Bill Details</a></li>
                     <li><a href="#">View purchase details</a></li>
                    </ul>
                </div>
                 <?php
				}
			
                function maintenancesidebar()
				{
				?>
				<h3>Menu</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                        <li><a href="addbranch.php">Add Branch</a></li>
                        <li><a href="addnewadmin.php">Add Admin</a></li>
                        <li><a href="adddoctors.php">Add Doctor</a></li>
                        <li><a href="addpatient.php">Add Patient</a></li>
                        <li><a href="addproduct.php">Add Product</a></li>
                    </ul>
                </div>
                 <?php
				}
	
	  		function docssidebar()
				{
				?>
				<h3>Menu</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                        <li><a href="viewdoctor.php">View doctor</a></li>
                        <li><a href="adddoctors.php?docside=1">Add doctor</a></li>
                    </ul>
                </div>
                 <?php
				}
				//products sidebar code
                function products($ros)
				{

				?>
				<h3>Product Type</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                      <li><a href="products.php?proid=0">All products</a></li>
                        <li><a href="products.php?proid=<?php echo $ros["prod_id"]; ?>&testids=<?php echo $_GET['testids']; ?>&type=Frames">Glases</a></li>
                        <li><a href="products.php?proid=<?php echo $ros["prod_id"]; ?>&testids=<?php echo $_GET['testids']; ?>&type=Lens">Lenses</a></li>
                                                
   
                     
		
                  </ul>
                </div>
                 <?php
				}
 function products1()
				{

				?>
				<h3>Product Type</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                      <li><a href="products.php">All products</a></li>
						<li><a href="products.php?type=Glases">Glases</a></li>
                                                <li><a href="products.php?type=Lenses">Lenses</a></li>
                   <!--     <li><a href="products.php?proid=0&type=Contact Lens">Contact Lens</a></li> -->                       
   
                    
                  </ul>
                </div>
				<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Admin/Doctor</h3>   
                <div class="content"> 
				<a href="doclogin.php"><img src="images/adminlogin.jpg" width="222" height="167" /></a> </div>    
                   <h3>Patient</h3>   
                <div class="content"> 
				<a href="login.php"><img src="images/login.jpg" width="222" height="167" /></a>  
                         </div> 
                    
					</div>
                 <?php
				}
				
               


  				function patientrecords()
				{
				?>
				<h3>Petient records</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                        <li><a href="viewpatient.php">View patient</a></li>
                        <li><a href="addpatient.php">Add patient</a></li>
                        <li><a href="viewappointment.php">View appointments</a></li>
                  </ul>
                </div>
                 <?php
				}
			