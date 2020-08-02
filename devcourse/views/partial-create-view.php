<div class="wrap">
<?php
	if( current_user_can( 'edit_users' ) ) {
		
		// Generate a custom nonce value.
		$nds_add_meta_nonce = wp_create_nonce( 'nds_add_user_meta_form_nonce' ); 
		
		// Build the Form
?>				
		<h2><?php _e( get_admin_page_title(), 'dev_course' ); ?></h2>		
		<div class="nds_add_user_meta_form">
					
		<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" id="nds_add_user_meta_form" >			
			<input type="hidden" name="action" value="nds_form_response">
			<input type="hidden" name="nds_add_user_meta_nonce" value="<?php echo $nds_add_meta_nonce ?>" />			
			<div>
				<label for="course_title"> <?php _e('Course Title', 'dev_course'); ?> </label><br>
				<input id="course_title" required type="text" name="title" value="" placeholder="<?php _e('Course Title', 'dev_course');?>" /><br>
			</div>
			<div>
				<label for="course_title"> <?php _e('Course Permalink', 'dev_course'); ?> </label><br>
				<input id="course_name" required type="text" name="course_name" value="" placeholder="<?php _e('Course Permalink', 'dev_course');?>" /><br>
			</div>  
			<div>
				<label for="course_title"> <?php _e('Course Content', 'dev_course'); ?> </label><br>
				<?php wp_editor( '', 'content' ); ?> <br>
			</div>
			<div>
				<label for="course_title"> <?php _e('Course Venue', 'dev_course'); ?> </label><br>
				<input required type="text" name="venue" value="" placeholder="<?php _e('Course Venue', 'dev_course');?>" /><br>
			</div>
			<div>
				<label for="course_title"> <?php _e('Course Fee', 'dev_course'); ?> </label><br>
				<input required type="text" name="fee" value="" placeholder="<?php _e('Course Fee', 'dev_course');?>" /><br>
			</div>
			<div>
				<label for="course_title"> <?php _e('Course Currency', 'dev_course'); ?> </label><br>
				<input required type="text" name="currency" value="" placeholder="<?php _e('Course Currency', 'dev_course');?>" /><br>
			</div>
			<div>
				<label for="course_title"> <?php _e('Course Start Date', 'dev_course'); ?> </label><br>
				<input type="date" name="start_date" />
			</div>
			<div>
				<label for="course_title"> <?php _e('Course End Date', 'dev_course'); ?> </label><br>
				<input type="date" name="end_date" />
			</div>
			<div>
				<label for="course_title"> <?php _e('Featured Image', 'dev_course'); ?> </label><br>
				<input type="text" name="featured_image" id="featured_image" class="postbox" value="" placeholder="<?php _e('Featured Image', 'dev_course');?>" />
				<a href="#" class="upload_image_button button button-secondary"><?php _e('Upload Image'); ?></a>
			</div>
			<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Course"></p>
		</form>
		<br/><br/>
		<div id="nds_form_feedback"></div>
		<br/><br/>			
		</div>
	<?php    
	}
	else {  
	?>
		<p> <?php __("You are not authorized to perform this operation.", 'dev_course') ?> </p>
	<?php   
	}
	?>
	</div>