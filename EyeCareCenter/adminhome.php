<?php
session_start();
include("includes/header.php");
include("includes/conn.php");
$resrec1 ="";
if(isset($_GET['prodid']))
{
$dt= date("Y-m-d");
mysqli_query($con, "UPDATE orders SET dispatch_date='$dt',payment='$_GET[balamt]', status='Delivered' where order_id='$_GET[prodid]'");
$resrec = "Order Status Updated Successfully.<br>";
$resrec1 =$resrec."<a href='billingreport.php?prodid=$_GET[prodid]&balamt=$_GET[balamt]&advpaid=$_GET[advpaid]'target='_blank'>Print The Billing Report</a>";
}
?>
    
    <div id="tm_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>				
			<?php
				include("sidebar.php");
				adminhome();
			?>
            </div>
   		</div>
        <div id="content" class="float_r">
          <h2>The Orders:</h2>
          <p><?php echo $resrec1; ?></p>
          <table width="682" border="1">
            <tr>
              <th width="80" scope="col">Order No.</th>
              <th width="189" scope="col">Product Detail</th>
              <th width="100" scope="col">Order Date</th>
              <th width="228" scope="col">Payment Details</th>
              <th width="51" scope="col">Status</th>
            </tr>
            <?php
			$dt= date("Y-m-d");
$resorders =  mysqli_query($con, "SELECT * FROM  orders WHERE  status='Pending' AND payment >='1'");

			while($recrows = mysqli_fetch_array($resorders))
			{	
			$resorders1 =  mysqli_query($con, "SELECT * FROM  products WHERE  prod_id =  '$recrows[prod_id]'");
			$recrows1 = mysqli_fetch_array($resorders1);	
										
           echo " <tr>
              <td>&nbsp;$recrows[order_id]</td>
              <td>";
			  $restorders2 =  mysqli_query($con, "SELECT * FROM orders where test_id ='$recrows[test_id]'");
			  		while($recrows2 = mysqli_fetch_array($restorders2))
					{
						 $restorders3 =  mysqli_query($con, "SELECT * FROM products where prod_id ='$recrows2[prod_id]'");
			  				while($recrows3 = mysqli_fetch_array($restorders3))
							{
							echo "&nbsp;".$recrows3['name']. "<br>";
							}
					}
				 /* &nbsp; Product ID: $recrows1[prod_id]<br>
				  &nbsp; Name: $recrows1[name]<br>	
				 &nbsp; Product type: $recrows1[product_type]<br>
				 &nbsp; Sub type: $recrows1[sub_type]<br>				  		  
				 */
			  echo "</td>
              <td> $recrows[order_date]</td>
              <td> Total: $ $recrows[total]<br>
			    paid : $ $recrows[payment]<br>";
			 echo "Total Paid : $ ". $balamt = $recrows['total'];
			  echo "</td>  <td align='center'>&nbsp;
			  $recrows[status]
			  <a href='adminhome.php?prodid=$recrows[order_id]&balamt=$balamt&advpaid=$recrows[payment]'>Delivered</a>	
			  </td></tr>";
            }
            ?>
          </table>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>

    
  </div>
        <div class="cleaner"></div>
    </div> 
    <?php
include("includes/footer.php");
?>
  </div>