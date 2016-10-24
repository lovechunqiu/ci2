<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    protected $_error_prefix = '';
    protected $_error_suffix = '';

    public function __construct($rules = array()) {
        parent::__construct($rules);
    }

    public function valid_mobile($str) {
        return (!preg_match("/^1[3-8][0-9]{9}$/", $str)) ? FALSE : TRUE;
    }

    public function captcha($str) {
        $session_id = $this->CI->session->userdata('session_id');
        $captcha = strtolower($this->CI->sktmemcached->get('captcha' . $session_id));
        $this->CI->sktmemcached->del('captcha' . $session_id);
        return strtolower($str) == $captcha;
    }

    public function valid_date($date) {
        return $date == date('Y-m-d', strtotime($date));
    }

    public function run($group = '', $clean = FALSE) {
        $result = parent::run($group);
        if ($clean) {
            $this->_field_data = array();
        }
        return $result;
    }
}

/* End of file MY_Form_validation.php */
/* Location: ./application/libraries/MY_Form_validation.php */
