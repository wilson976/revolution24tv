<?php

class Mevent_p extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllEvent() {
        $this->db->order_by('event_id', 'desc');
        $this->db->from('special_event');
        $this->db->join('menu', 'menu.m_id = special_event.event_category');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function eventbyID($event_id) {
        $this->db->where('event_id', $event_id);
        $this->db->from('special_event');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    ///Create Event
    function entry() {
        //$start_date = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
        $stdate = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
        if ($stdate != '1970-01-01 06:00:00') {
            $start_date = $stdate;
        } else {
            $start_date = date('Y-m-d H:i:s');
        }
        $end_date = date('Y-m-d H:i:s', strtotime($this->input->post('end_date')));
        $data = array(
            'event_name' => $this->input->post('event_name'),
            'event_category' => $this->input->post('event_category'),
            'event_status' => $this->input->post('event_status'),
            'start_date' => $start_date,
            'end_date' => $end_date
        );
        $this->db->insert('special_event', $data);
        print $this->db->last_query();
    }

    function edit() {
        //$start_date = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
        $stdate = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
        if ($stdate != '1970-01-01 06:00:00') {
            $start_date = $stdate;
        } else {
            $start_date = date('Y-m-d H:i:s');
        }
        $end_date = date('Y-m-d H:i:s', strtotime($this->input->post('end_date')));
        $data = array(
            'event_name' => $this->input->post('event_name'),
            'event_category' => $this->input->post('event_category'),
            'event_status' => $this->input->post('event_status'),
            'start_date' => $start_date,
            'end_date' => $end_date
        );
        $this->db->where('event_id', $this->input->post('event_id'));
        $this->db->update('special_event', $data);
    }

}
