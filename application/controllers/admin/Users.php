<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('hotpanel');
        }
    }

    function index() {
        $data['body'] = 'user_list';        
        $data['reg_mod'] = $this->Musers->showuserRmod();
        $this->load->view('admin/template', $data);
    }

    /*
      function create() {
      if ($this->input->post('email')) {
      $this->form_validation->set_rules('email', 'Email', 'required');
      if ($this->form_validation->run() == TRUE) {
      if ($this->Musers->create() == FALSE) {
      $this->session->set_flashdata('error', 'Email ID Already Exist');
      redirect('admin/users', 'refresh');
      } else {
      if (!empty($_FILES['picture'])) {
      $id = $this->Musers->create();
      $config['file_name'] = $id;
      $config['upload_path'] = './assets/images/user_image/';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size'] = '60000';
      $this->upload->initialize($config);

      if (!$this->upload->do_upload("picture")) {
      $error = array('error' => $this->upload->display_errors());
      $this->session->set_flashdata('error', 'Something went wrong uploading picture');
      //print_r($error);
      } else {
      $filedata = $this->upload->data();
      //print_r($filedata);
      $this->Musers->addPicture($filedata['file_name'], $id);

      $con['image_library'] = 'gd2';
      $con['source_image'] = './assets/images/user_image/' . $filedata['file_name'];
      $con['new_image'] = './assets/images/user_image/thmubs/';
      $con['create_thumb'] = FALSE;
      $con['maintain_ratio'] = TRUE;
      //$con['thumb_marker'] = '_thumb';
      $con['width'] = 50;
      $con['height'] = 30;
      $this->load->library('image_lib', $con);
      $this->image_lib->resize();
      $this->session->set_flashdata('message', 'User Successfully Created');
      redirect('admin/users/', 'refresh');
      }
      } else {
      $this->Musers->create();
      $this->session->set_flashdata('message', 'User Successfully Created');
      redirect('admin/users', 'refresh');
      }
      }
      } else {
      $this->session->set_flashdata('error', 'Email is a Mendatory Field.');
      redirect('admin/users', 'refresh');
      }
      }
      }

     */

    function create() {
        if ($this->input->post('email')) {
            $this->form_validation->set_rules('email', 'Username', 'valid_email', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($this->form_validation->run() == TRUE) {
                if ($this->Musers->create() == 'EXIST') {
                    $this->session->set_flashdata('error', 'Email ID Already Exist');
                    redirect('admin/users', 'refresh');
                } else {
                    $this->Musers->create();
                    redirect('admin/users', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error', 'Please Enter a Valid Email ID');
            }
        }
    }

    function edit($id = 0) {
        if ($this->input->post('u_name')) {
            $this->Musers->user_update();
            $this->session->set_flashdata('message', 'User Updated');
            redirect('admin/users');
        } else {
            $data['body'] = "user_edit";
            $data['user'] = $this->Musers->userbyid($id);
            $this->load->view('admin/template', $data);
        }
    }

    function delete($id) {
        $this->Musers->delete($id);
        redirect('admin/users');
    }

    //Permission

    function permission($id) {
        $data['body'] = 'user_access_control';
        $data['control_list'] = $this->Musers->checkuserAccess($id);
        $data['menu'] = $this->Musers->getmenu();
        $this->load->view('admin/template', $data);
    }

    function add_permission() {
        $this->Musers->permission_add();
        $this->Musers->permissionAdmintable();
        redirect('admin/users', 'refresh');
    }

}