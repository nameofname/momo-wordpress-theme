<?php 
//If the form is submitted
if(isset($_POST['submitted'])) {

	//Check to see if the honeypot captcha field was filled in
	if(trim($_POST['checking']) !== '') {
		$captchaError = true;
	} else {
	
		//Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError =  __('You forgot to enter your name.', 'woothemes'); 
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$emailError = __('You forgot to enter your email address.', 'woothemes');
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = __('You entered an invalid email address.', 'woothemes');
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		//Check to make sure comments were entered	
		if(trim($_POST['comments']) === '') {
			$commentError = __('You forgot to enter your comments.', 'woothemes');
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
			
		//If there is no error, send the email
		if(!isset($hasError)) {
			
			$emailTo = get_option('woo_contactform_email'); 
			$subject = __('Contact Form Submission from ', 'woothemes').$name;
			$sendCopy = trim($_POST['sendCopy']);
			$body = __("Name: $name \n\nEmail: $email \n\nComments: $comments", 'woothemes');
			$headers = __('From: ', 'woothemes').get_bloginfo('title').' <'.$email.'>' . "\r\n" . __('Reply-To: ','woothemes') . $email;
			
			wp_mail($emailTo, $subject, $body, $headers);

			if($sendCopy == true) {
				$subject = __('You emailed ', 'woothemes').get_bloginfo('title');
				$headers = __('From: ','woothemes') . '<'.$emailTo.'>';
				wp_mail($email, $subject, $body, $headers);
			}

			$emailSent = true;

		}
	}
} ?>



<script type="text/javascript">
<!--//--><![CDATA[//><!--
jQuery(document).ready(function() {
	jQuery('form#contactForm').submit(function() {
		jQuery('form#contactForm .error').remove();
		var hasError = false;
		jQuery('.requiredField').each(function() {
			if(jQuery.trim(jQuery(this).val()) == '' || jQuery.trim(jQuery(this).val()) == 'Name') {
				var labelText = jQuery(this).next('label').text();
				jQuery(this).parent().append('<span class="error"><?php _e('You forgot to enter your', 'woothemes'); ?> '+labelText+'</span>');
				jQuery(this).addClass('inputError');
				hasError = true;
			} else if(jQuery(this).hasClass('email')) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
					var labelText = jQuery(this).next('label').text();
					jQuery(this).parent().append('<span class="error"><?php _e('You entered an invalid', 'woothemes'); ?> '+labelText+'</span>');
					jQuery(this).addClass('inputError');
					hasError = true;
				}
			}
		});
		if(!hasError) {
			var formInput = jQuery(this).serialize();
			jQuery.post(jQuery(this).attr('action'),formInput, function(data){
				jQuery('form#contactForm').slideUp("fast", function() {				   
					jQuery(this).before('<p class="tick"><?php _e('<strong>Thanks!</strong> Your email was successfully sent.', 'woothemes'); ?></p>');
				});
			});
		}
		
		return false;
		
	});
});
//-->!]]>
</script>
               
            <?php if(isset($emailSent) && $emailSent == true) { ?>
            
                <p class="info"><?php _e('Your email was successfully sent.', 'woothemes'); ?></p>
            
            <?php } else { ?>
                    
                        
                    <?php if(isset($hasError) || isset($captchaError) ) { ?>
                        <p class="alert"><?php _e('There was an error submitting the form.', 'woothemes'); ?></p>
                    <?php } ?>
                    
                    <?php if ( get_option('woo_contactform_email') == '' ) { ?>
                        <p class="alert"><?php _e('E-mail has not been setup properly. Please add your contact e-mail!', 'woothemes'); ?></p>
                    <?php } ?>
                    
                
                    <form action="<?php bloginfo('url'); ?>" id="contactForm" method="post">
                
                        <ol class="forms">
                            <li><input type="text" name="contactName" id="contactName" value="<?php _e('Name', 'woothemes'); ?>" class="txt requiredField" />
	                            <label for="contactName"><?php _e('Name', 'woothemes'); ?></label>
                                <?php if($nameError != '') { ?>
                                    <span class="error"><?php echo $nameError;?></span> 
                                <?php } ?>
                            </li>
                            
                            <li><input type="text" name="email" id="email" value="<?php _e('Email', 'woothemes'); ?>" class="txt requiredField email" />
                                <label for="email"><?php _e('Email', 'woothemes'); ?></label>
                                <?php if($emailError != '') { ?>
                                    <span class="error"><?php echo $emailError;?></span>
                                <?php } ?>
                            </li>
                            
                            <li class="textarea">
                                <textarea name="comments" id="commentsText" rows="20" cols="30" class="requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
                                <label for="commentsText"><?php _e('Message', 'woothemes'); ?></label>
                                <?php if($commentError != '') { ?>
                                    <span class="error"><?php echo $commentError;?></span> 
                                <?php } ?>
                            </li>
                            <li class="screenReader"><label for="checking" class="screenReader"><?php _e('If you want to submit this form, do not enter anything in this field', 'woothemes') ?></label><input type="text" name="checking" id="checking" class="screenReader" value="<?php if(isset($_POST['checking']))  echo $_POST['checking'];?>" /></li>
                            <li class="buttons"><input type="hidden" name="submitted" id="submitted" value="true" /><input class="submit button" type="submit" value="<?php _e('Submit', 'woothemes'); ?>" /></li>
                        </ol>
                    </form>
                
            <?php } ?>