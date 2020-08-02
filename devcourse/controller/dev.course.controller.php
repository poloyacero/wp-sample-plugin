<?php
/**
*@package DevCoursePlugin
*/

require_once( PLUGIN_DIR . 'model/dev.course.model.php' );
require_once( PLUGIN_DIR . 'views/dev.course.view.php' );

class DevCourseController {
	
	private $db;
	private $plugin_name = 'dev_course';
	
	public function __construct($model) {
		$this->db = $model;
	}
	
	public function store() {
		$data = array(
			'course_title' => $_POST['title'],
			'course_name' => str_replace( ' ', '-', strtolower( $_POST['course_name'] ) ),
			'course_content' => $_POST['content'],
			'venue' => $_POST['venue'],
			'currency' => $_POST['currency'],
			'fee' => $_POST['fee'],
			'course_image' => $_POST['featured_image'],
			'start_date' => $_POST['start_date'],
			'end_date' => $_POST['end_date'],
		);
		
		$check = array(
			'course_name' => $data['course_name']
		);
		
		$valid = $this->db->valid_check($check);
		
		if($valid['status']) {
			$id = $this->db->save_entry($data);
		}else{
			$this->db->update_entry($data, array('course_id' => $valid['data'][0]['course_id']));
			
			$id = $valid['data'][0]['course_id'];
		}
		
		
		$admin_notice = "success";
		$url = 'new_dev_course&action=edit&dev_course=' . $id;

		$this->custom_redirect( $admin_notice, $url );
		exit;
	}
	
	public function edit() {
		if(isset($_GET['action']) && $_GET['action'] == 'edit') {
			if(isset($_GET[$this->plugin_name])){
				$id = $_GET[$this->plugin_name];
			}
			$data = $this->db->read_entry('course_id', $id);

			include_once( PLUGIN_DIR . 'views/partial-single-view.php' );
		}else {
			include_once( PLUGIN_DIR . 'views/partial-create-view.php' );
		}
	}
	
	public function index() {
		$tablelist = new DevCourseView();
		$tablelist->prepare_items();
		include_once( PLUGIN_DIR . 'views/partial-index-view.php' );
	}
	
	public function custom_redirect( $admin_notice, $url ) {
		if(!$url){
			$url = admin_url('admin.php?page='. 'dev_course' );
		}
		
		$url = admin_url('admin.php?page='. $url );
		
		wp_redirect( esc_url_raw( add_query_arg( 
			array(
					'nds_admin_add_notice' => $admin_notice,
					'nds_response' => $response,
				),
			$url
		) ) );
	}
	
	public function setup_db() {
		$this->db->setup();
	}

}