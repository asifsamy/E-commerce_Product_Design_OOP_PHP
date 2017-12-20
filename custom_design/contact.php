<?php include 'inc/header.php';?>

<?php

   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sendmsg'])) {
         $sendsms = $msg->userMessage($_POST);
      }

?>

<!--Header End-->
<div id="mainBody">
<div class="container">
	<hr class="soften">
	<h1>Visit us</h1>
	<hr class="soften"/>	
	<div class="row">
		<div class="span4">
		<h4>Contact Details</h4>
		<p>	137 (Nevel House, 5th Floor),<br/> Shantinogor, Dhaka-1217
			<br/><br/>
			info@customdesign.com<br/>
			﻿Tel 123-456-6780<br/>
			Fax 123-456-5679<br/>
			web:www.customdesign.com
		</p>		
		</div>
			
		<div class="span4">
		<h4>Opening Hours</h4>
			<h5> Monday - Friday</h5>
			<p>09:00am - 09:00pm<br/><br/></p>
			<h5>Saturday</h5>
			<p>09:00am - 07:00pm<br/><br/></p>
			<h5>Sunday</h5>
			<p>12:30pm - 06:00pm<br/><br/></p>
		</div>
		<div class="span4">
			<?php
		       if (isset($sendsms)) {
		   	      echo $sendsms;
		       }
		    ?>
		<h4>Email Us</h4>
		<form class="form-horizontal" action="" method="POST">
        <fieldset>
          <div class="control-group">
           
              <input type="text" placeholder="name" name="name" class="input-xlarge" required />
           
          </div>
		   <div class="control-group">
           
              <input type="email" placeholder="email" name="email" class="input-xlarge" required/>
           
          </div>
		   <div class="control-group">
           
              <input type="text" placeholder="subject" name="subject" class="input-xlarge" required/>
          
          </div>
          <div class="control-group">
              <textarea rows="3" id="textarea" name="body" class="input-xlarge" required></textarea>
           
          </div>

            <button class="btn btn-large" name="sendmsg" type="submit">Send Messages</button>

        </fieldset>
      </form>
		</div>
	</div>
	<div class="row">
	<div class="span12">
	<iframe style="width:100%; height:300; border: 0px" scrolling="no" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14608.691681155144!2d90.4089002!3d23.7412123!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa997e486d85620d7!2z4Kah4KeH4Ka44KeN4KaV4Kaf4KaqIOCmhuCmh-Cmn-Cmvw!5e0!3m2!1sbn!2s!4v1503326617669"></iframe><br />
	<small><a href="https://www.google.co.uk/maps/place/Desktop+IT/@23.7399577,90.4115454,17z/data=!3m1!4b1!4m5!3m4!1s0x3755b8606cc7fc0d:0xf0c9c4eeb53171c3!8m2!3d23.7399528!4d90.4137341?hl=en" style="color:#0000FF;text-align:left">View Larger Map</a></small>
	</div>
	</div>
</div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
	<?php include 'inc/footer.php';?>