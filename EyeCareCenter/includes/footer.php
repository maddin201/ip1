<center>
    <div id="tm_footer">
    	<p>
			 <?php
				 if(isset($_SESSION["logtype"]) and $_SESSION["logtype"]=="Doctor")
				{
				?>
                 <a href="dochome.php"  >Doctor's Home</a>
              	<?php
				}
				else  if(isset($_SESSION["logtype"]) and $_SESSION["logtype"] =="Administrator")
				{
				?>
                 <a href="adminhome.php" >Admin's Home</a>
                  	<?php
				}
				else  if(isset($_SESSION["logtype"]) and $_SESSION["logtype"]=="Patient")
				{
				?>
                <a href="patienthome.php"  >Patient's Home</a>
              	<?php
				}
				else
				{
				?>
               <a href="index.php"  >Home</a>
                <?php
				}
				?> | <a href="products.php">Products</a> | <a href="about.php">About Us</a>| <a href="contact.php">Contact Us</a>| <a href="doclogin.php">
            Doctor/Admin Login</a>
		</p>

    	Copyright © 2017 Advanced Optical | Albany
</div>
</center>
</body>
</html>