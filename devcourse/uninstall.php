<?php
/**
*@package DevCourse Plugin
*/

if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit();

global $wpdb;

$table_name = $wpdb->prefix . 'dev_course';

$wpdb->query( "DROP TABLE IF EXISTS $table_name" );