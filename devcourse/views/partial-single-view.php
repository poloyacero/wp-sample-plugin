<div class="wrap">
<?php
	if( current_user_can( 'edit_users' ) ) {
		
		// Generate a custom nonce value.
		$nds_add_meta_nonce = wp_create_nonce( 'nds_add_user_meta_form_nonce' ); 
		
		// Build the Form
?>				
		<h2><?php _e( 'Edit Course', 'dev_course' ); ?></h2>		
		<div class="nds_add_user_meta_form">
					
		<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" id="nds_add_user_meta_form" >			
			<input type="hidden" name="action" value="nds_form_response">
			<input type="hidden" name="nds_add_user_meta_nonce" value="<?php echo $nds_add_meta_nonce ?>" />			
			<div>
				<label for="course_title"> <?php _e('Course Title', 'dev_course'); ?> </label><br>
				<input required type="text" name="title" value="<?php echo $data['course_title'] ?>" placeholder="<?php _e('Course Title', 'dev_course');?>" /><br>
			</div>
			<div>
				<label for="course_title"> <?php _e('Course Permalink', 'dev_course'); ?> </label><br>
				<input required type="text" name="course_name" value="<?php echo $data['course_name'] ?>" placeholder="<?php _e('Course Permalink', 'dev_course');?>" /><br>
			</div>  
			<div>
				<label for="course_title"> <?php _e('Course Content', 'dev_course'); ?> </label><br>
				<?php wp_editor( $data['course_content'], 'content' ); ?> <br>
			</div>
			<div>
				<label for="course_title"> <?php _e('Course Venue', 'dev_course'); ?> </label><br>
				<input required type="text" name="venue" value="<?php echo $data['venue'] ?>" placeholder="<?php _e('Course Venue', 'dev_course');?>" /><br>
			</div>
			<div>
				<label for="course_title"> <?php _e('Course Fee', 'dev_course'); ?> </label><br>
				<input required type="text" name="fee" value="<?php echo $data['fee'] ?>" placeholder="<?php _e('Course Fee', 'dev_course');?>" /><br>
			</div>
			<div>
				<label for="course_title"> <?php _e('Course Currency', 'dev_course'); ?> </label><br>
				<input required type="text" name="currency" value="<?php echo $data['currency'] ?>" placeholder="<?php _e('Course Currency', 'dev_course');?>" /><br>
			</div>
			<div>
				<label for="start_date"> <?php _e('Course Start Date', 'dev_course'); ?> </label><br>
				<input type="date" value="<?php echo date('Y-m-d',strtotime($data['start_date'])); ?>" name="start_date" />
			</div>
			<div>
				<label for="end_date"> <?php _e('Course End Date', 'dev_course'); ?> </label><br>
				<input type="date" value="<?php echo date('Y-m-d',strtotime($data['end_date'])); ?>" name="end_date" />
			</div>
			<div>
				</br>
				<?php
				if($data['course_image']) { ?>
					<img src="<?php echo $data['course_image'] ?>" style="width:200px;height:200px"/>
				<?php
				}
				?>
				</br>
				<label for="course_title"> <?php _e('Featured Image', 'dev_course'); ?> </label><br>
				<input type="text" name="featured_image" id="featured_image" class="postbox" value="<?php echo $data['course_image'] ?>" placeholder="<?php _e('Featured Image', 'dev_course');?>" />
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