<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Program_schedule extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('kitkat');
        }
        $this->load->model('admin/M_program');
    }

    function index() {
        $data['body'] = 'program_list';        
        $data['program_info'] = $this->M_program->program_list();
        $this->load->view('admin/template', $data);
    }

    function p_entry() {
        if ($this->input->post('name')) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $p_id = $this->M_program->p_entry();

                $config['file_name'] = $p_id;
                $config['upload_path'] = './assets/images/program_image/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                    
                } else {
                    $filedata = $this->upload->data();
                    //print_r($filedata);
                    $this->M_program->PaddPicture($filedata['file_name'], $p_id);

                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/program_image/' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/program_image/thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    //$con['thumb_marker'] = '_thumb';
                    $con['width'] = 80;
                    $con['height'] = 95;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                    $this->session->set_flashdata('message', 'New Profile Successfully Created');
                    redirect('admin/program_schedule/', 'refresh');
                }

                $this->session->set_flashdata('message', 'New Profile Successfully Created');
                redirect('admin/program_schedule/', 'refresh');
            } else {
                $data['body'] = 'program_list';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'program_list';
            $this->load->view('admin/template', $data);
        }
    }

    function p_edit_page($p_id) {
        $data['body'] = 'edit_programe';
        $data['p_info'] = $this->M_program->getPbyid($p_id);
        $this->load->view('admin/template', $data);
    }

    function p_update() {
        if ($this->input->post('name')) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $this->M_program->p_update();
                $p_id = $this->input->post('p_id');
                //print_r($col_id);

                $config['file_name'] = $p_id;
                $config['upload_path'] = './assets/images/program_image/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                } else {
                    $filedata = $this->upload->data();
                    //unlink image path
                    $img = $this->M_program->getPbyid($p_id);
                    if ($img['pro_pic'] != NULL) {
                        $picture = './assets/images/program_image/' . $img['pro_pic'];
                        $picture_thumbs = './assets/images/program_image/thmubs/' . $img['pro_pic'];
                        unlink($picture);
                        unlink($picture_thumbs);
                    }

                    //print_r($filedata);
                    $this->M_program->PaddPicture($filedata['file_name'], $p_id);

                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/program_image/' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/program_image/thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    //$con['thumb_marker'] = '_thumb';
                    $con['width'] = 50;
                    $con['height'] = 40;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                    $this->session->set_flashdata('message', 'Profile Info Successfully Updated');
                    redirect('admin/program_schedule/', 'refresh');
                }

                $this->session->set_flashdata('message', 'Profile Info Successfully Updated');
                redirect('admin/program_schedule/', 'refresh');
            } else {
                $data['body'] = 'program_list';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'program_list';
            $this->load->view('admin/template', $data);
        }
    }

    function p_delete($p_id) {
        $img = $this->M_program->getPbyid($p_id);
        if ($img['pro_pic'] != NULL) {
            $picture = './assets/images/program_image/' . $img['pro_pic'];
            $picture_thumbs = './assets/images/program_image/thmubs/' . $img['pro_pic'];
            unlink($picture);
            unlink($picture_thumbs);
        }

        $this->M_program->p_delete($p_id);
        $this->session->set_flashdata('message', 'Data Deleted');
        redirect('admin/program_schedule/');
    }



   
}
