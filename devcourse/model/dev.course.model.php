<?php
/**
*@package DevCoursePlugin
*/

class DevCourseModel {
	
	private function _wpdb() {
		global $wpdb;
		return $wpdb;
	}
	
	private function _table() {
		$tablename = 'dev_course';
		return $this->_wpdb()->prefix . $tablename;
	}
	
	public function setup() {
		$charset_collate = $this->_wpdb()->get_charset_collate();
		$table_name = $this->_table();
		
		$sql = "CREATE TABLE $table_name (
			course_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			course_title varchar(200) NOT NULL,
			course_name varchar(200) NOT NULL,
			course_content longtext,
			venue varchar(200),
			currency varchar(200),
			fee decimal(10, 2),
			course_image varchar(200),
			start_date DATETIME,
			end_date DATETIME,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			PRIMARY KEY  (course_id)
		) $charset_collate; ";
		
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );
		$success = empty( $this->_wpdb()->last_error );
		return $success;
	}
	
	private function _fetch_sql( $field , $value ) {
		$table_name = $this->_table();
		
		$sql = sprintf( "SELECT * FROM $table_name WHERE %s = %s", $field, $value);
		
		$results = $this->_wpdb()->get_row( $sql , ARRAY_A );

		return $results;
	}
	
	public function valid_check( $data ) {
		$table_name = $this->_table();
		
		$sql_where       = '';
		$sql_where_count = count( $data );
		$i               = 1;
		foreach ( $data as $key => $row ) {
			if ( $i < $sql_where_count ) {
				$sql_where .= "`$key` = '$row' and ";
			} else {
				$sql_where .= "`$key` = '$row'";
			}
			$i++;
		}
		$sql     = 'SELECT * FROM ' . $table_name . " WHERE $sql_where";
		$results = $this->_wpdb()->get_results( $sql , ARRAY_A);

		if ( count( $results ) != 0 ) {
			return array( 'status' => false, 'data' => $results );
		} else {
			return array( 'status' => true );
		}
	}
	
	public function save_entry($data) {
		$table_name = $this->_table();
		/*echo "<pre>";
		print_r($data);
		echo "</pre>";
		exit;*/
		$this->_wpdb()->insert( $table_name, $data );
		$result =  $this->_wpdb()->insert_id;
		//$wpdb->show_errors();
		return $result;
	}
	
	public function update_entry($data, $where) {
		$table_name = $this->_table();
		
		$this->_wpdb()->update( $table_name, $data, $where );
		//$this->_wpdb()->show_errors();
	}
	
	public function read_entry( $field, $value) {
		return $this->_fetch_sql( $field, $value );
	}
	
	public function delete_entry($where) {
		$table_name = $this->_table();
		$this->_wpdb()->delete( $table_name, $where );
	}
	
	public function fetch() {
		$table_name = $this->_table();
		$sql = " SELECT * FROM $table_name ORDER BY created_at ASC";
		return $this->_wpdb()->get_results($sql, ARRAY_A);
	}
}