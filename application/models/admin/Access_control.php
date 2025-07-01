<?php

class Access_control extends CI_Model {

    function __construct() {
        parent::__construct();
    }

	
	function ac($id) {
        $this->db->where('user_id', $id);
        $data = $this->db->get('access_control');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }
			
}
			
			