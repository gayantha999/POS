<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function is_logged_in() {
	$CI = &get_instance();
	return $CI->session->userdata('user_id') ? TRUE : FALSE;
}
