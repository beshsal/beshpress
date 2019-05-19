<?php
$errors = array();

if (isset($_POST["submit"])) :
	// Retrieve and sanitize values submitted from the form.
	$first_name = sanitize_text_field($_POST["first_name"]);
	$last_name  = sanitize_text_field($_POST["last_name"]);
	$phone      = trim($_POST["phone"]);
	$email      = $_POST["email"]; // sanitize_email($_POST["email"]);
	$message    = stripslashes(sanitize_text_field($_POST["message"]));

	// Get the admin's email.
	$to = get_option('admin_email'); // beshsaleh@gmail.com

	// The subject line content
	$subject = $first_name . ' ' . $last_name . ' sent a message from BeshPress';

	if (empty($first_name)) {
		$errors["first_name"] = "First name required";
	}

	if (!empty($email)) {
		if (!is_email($email)) {
			$errors["email"] = "Invalid email";
		} else {
			$email = sanitize_email($_POST["email"]);
		}
	} else {
		$errors["email"] = "Email required";
	}

	if (!empty($phone)) {	  
	  $digits = preg_match_all( "/[0-9]/", $phone);
	  if ($digits == 10) {
	    $validphone = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $phone);
	  }    
	  // If $validphone is false
	  if (!isset($validphone)) {
	    $errors["phone"] = "Invalid phone number";
	  } else {
	    $phone = $validphone;
	  }
	}

	// The body message
	if (!empty($message)) {
		$message .= "<br>The above message was received.";
		$message .= "<br>Sender's name: {$first_name} {$last_name}";
		$message .= "<br>Sender's phone: {$phone}";
		$message .= "<br>Sender's email: {$email}";
	} else {
		$errors["message"] = "Message required";
	}

	if ($errors) {
		$errCount = count($errors);
		if ($errCount > 1) $errStr = " " . $errCount . " issues "; else $errStr = " issue ";
		$notification = "<p class='error-notification' role='alert'>Please correct the" . $errStr . "indicated below.</p>";
	}

	if (!isset($notification)) {
		if (wp_mail( $to, $subject, $message )) {
			$send_status = '<div class="success-notification" role="alert">
							        <h1 class="alert-heading text-center">Message Sent!</h1>
							        <hr>
							        <p class="mb-0">Thank you for your message. <br>We will get back to you shortly.</p>
						          </div>';
		} else {
			$send_status = "<h3>Sorry. There was an error in submitting your message. Please try again later.</h3>";
		}
	}
endif;
?>

<?php get_header(); ?>

<!-- Page Heading/Breadcrumb -->
<div class="container">
	<?php
	  $curPostType = esc_html(get_post_type_object(get_post_type())->labels->singular_name);
	?>
	<h1 class="page-heading mt-4 mb-3 text-center animated fadeIn"><?php echo $curPostType; ?></h1>
	<?php get_template_part('breadcrumb'); ?>
</div>

<?php $contact = new WP_Query(array('post_type' => 'contact', 'posts_per_page' => 1)); ?>

<?php while ($contact->have_posts()) : $contact->the_post();
	$title     = get_the_title();
	$street    = get_post_meta($post->ID, 'street_field', true);
  $street2   = get_post_meta($post->ID, 'street2_field', true);
  $city      = get_post_meta($post->ID, 'city_field', true);
  $state     = get_post_meta($post->ID, 'state_field', true);
  $zip       = get_post_meta($post->ID, 'zip_field', true);
  $tel       = get_post_meta($post->ID, 'phone_field', true);
  $emailAdd  = get_post_meta($post->ID, 'email_field', true);
  $startTime = get_post_meta($post->ID, 'start_time_field', true);
  $endTime   = get_post_meta($post->ID, 'end_time_field', true);
  $startDay  = get_post_meta($post->ID, 'start_day_field', true);
  $endDay    = get_post_meta($post->ID, 'end_day_field', true);  
?>
<?php endwhile; wp_reset_postdata(); ?>

<main>	
	<!-- Contact Form & Details -->
	<section id="contact" class="page-section container animated fadeIn"> 
		<div class="text-center"> 
		<?php 
		if (isset($send_status)) echo $send_status; elseif (isset($notification)) echo $notification;
		 ?> 
		</div>   
		<div class="row">
			<!-- Form Column -->
			<div class="col-lg-8 mb-4">
				<h3><?php echo $title; ?></h3>
				<form name="sendMessage" id="contactForm" novalidate method="post" action="">
					<p class="reqd-fields-indicator"><strong>Required fields</strong> <span class="reqd">*</span></p>
					<div class="row">						
						<div class="col-md-6 control-group form-group">
							<div class="controls">
								<label>First Name: <span class="reqd">*</span><?php if (isset($errors["first_name"])) { ?>
									<span class="error">
									<?php echo $errors["first_name"]; ?>
									</span><?php } ?></label>
								<input name="first_name" type="text" class="form-control" id="first-name" required placeholder="Enter your first name" value="<?php echo (isset($first_name) ? esc_attr($first_name) : ''); ?>">
								<p class="help-block"></p>
							</div>
						</div>						
						<div class="col-md-6 control-group form-group">
							<div class="controls">
								<label>Last Name:</label>
								<input name="last_name" type="text" class="form-control" id="last-name" required placeholder="Enter your last name" value="<?php echo (isset($last_name) ? esc_attr($last_name) : ''); ?>">
								<p class="help-block"></p>
							</div>
						</div>						
						<div class="col-md-6 control-group form-group">
							<div class="controls">
								<label>Phone Number: <?php if (isset($errors["phone"])) { ?><span class="error"><?php echo $errors["phone"]; ?></span><?php } ?></label>
								<input name="phone" type="tel" class="form-control" id="phone" required placeholder="Enter your phone number" value="<?php echo (isset($phone) ? esc_attr($phone) : ''); ?>">
							</div>
						</div>						
						<div class="col-md-6 control-group form-group">
							<div class="controls">
								<label>Email Address: <span class="reqd">*</span> <?php if (isset($errors["email"])) { ?>
									<span class="error">
										<?php echo $errors["email"]; ?>										
									</span><?php } ?></label>
								<input name="email" type="email" class="form-control" id="email" required placeholder="Enter your email address" value="<?php echo (isset($email) ? esc_attr($email) : ''); ?>">
							</div>
						</div>						
						<div class="col-sm-12 control-group form-group">
							<div class="controls">
								<label>Message: <span class="reqd">*</span> <?php if (isset($errors["message"])) { ?>
									<span class="error">
										<?php echo $errors["message"]; ?>											
									</span><?php } ?></label>
								<textarea name="message" rows="7" cols="100" class="form-control" id="message" required placeholder="Enter your message" maxlength="999" style="resize:none"><?php echo (isset($_POST['message']) ? stripslashes(esc_textarea($_POST['message'])) : ''); ?></textarea>
							</div>
						</div>					
						<!-- For success/fail messages -->
						<div id="success"></div>					
						<div class="col-sm-12 control-group form-group">
						<button name="submit" type="submit" class="btn btn-primary" id="sendMessageButton">Send Message</button>
						</div>
					</div>
				</form>
			</div>
			<!-- Contact Details Column -->
			<div class="col-lg-4 mb-4">

				<h3>Contact Details</h3>
				<p>
					<?php
					$address = "";
					if (!empty($street)) $address = $street;
					if (!empty($street) && !empty($street2)) $address .= ", <br>" . $street2;
					if (!empty($street) && !empty($city)) $address .= " <br>" . $city;
					elseif (empty($street) && !empty($city)) $address .= $city;
					if (!empty($city) && !empty($state)) $address .= ", " . $state;
					elseif (empty($city) && !empty($state)) $address .= $state;
					if (!empty($state) && !empty($zip)) $address .= " " . $zip;

					echo $address;
					?>
					<br>
				</p>
				<?php if (!empty($tel)) { ?>
				<p>				
				<abbr title="Phone">P</abbr>: <?php echo $tel; ?>				
				</p>
				<?php } ?>
				<?php if (!empty($emailAdd)) { ?>
				<p>
				<abbr title="Email">E</abbr>:
				<a href="mailto:<?php echo $emailAdd; ?>"><?php echo $emailAdd; ?></a>
				</p>
				<?php } ?>
				<p>
				<?php if (!empty($startDay) && !empty($endDay) || !empty($startTime) && !empty($endTime)) : ?>
					<abbr title="Hours">H</abbr>: 
					<?php if (!empty($startDay) && !empty($endDay)) echo "{$startDay} - {$endDay}, ";
					if (!empty($startTime) && !empty($endTime)) echo date("g:i a", strtotime($startTime)) . " to " . date("g:i a", strtotime($endTime));
				endif;
				?>
				</p>
			</div>
		</div>
	</section>
	<!-- Map -->
	<?php if (get_theme_mod('google_map', 1)) : ?>
		<?php get_template_part('template-parts/content', "map"); ?>
	<?php endif; ?>

</main>

<?php get_footer(); ?>