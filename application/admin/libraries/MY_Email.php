<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Email extends CI_Email {

	function __construct() {
		parent::__construct();
	}

	public function set_header($header, $value) {
		$this->_set_header($header, $value);
	}

	protected function _send_with_sendmail() {
		$return_path = $this->_headers['From'];
		if (isset($this->_headers['Return-Path'])) {
			$return_path = $this->_headers['Return-Path'];
		}
		
		$fp = @popen($this->mailpath . " -oi -f " . $this->clean_email($this->_headers['From']) . " -t", 'w');

		if ($fp === FALSE OR $fp === NULL) {
			// server probably has popen disabled, so nothing we can do to get a verbose error.
			return FALSE;
		}

		fputs($fp, $this->_header_str);
		fputs($fp, $this->_finalbody);

		$status = pclose($fp);

		if (version_compare(PHP_VERSION, '4.2.3') == -1) {
			$status = $status >> 8 & 0xFF;
		}

		if ($status != 0) {
			$this->_set_error_message('lang:email_exit_status', $status);
			$this->_set_error_message('lang:email_no_socket');
			return FALSE;
		}

		return TRUE;
	}

	protected function _send_with_mail() {
		$return_path = $this->_headers['From'];
		if (isset($this->_headers['Return-Path'])) {
			$return_path = $this->_headers['Return-Path'];
		}

		if ($this->_safe_mode == TRUE) {
			if (!mail($this->_recipients, $this->_subject, $this->_finalbody, $this->_header_str)) {
				return FALSE;
			} else {
				return TRUE;
			}
		} else {
			// most documentation of sendmail using the "-f" flag lacks a space after it, however
			// we've encountered servers that seem to require it to be in place.

			if (!mail($this->_recipients, $this->_subject, $this->_finalbody, $this->_header_str, "-f " . $this->clean_email($this->_headers['From']))) {
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}

}

?>