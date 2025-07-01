<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('hotpanel');
        }
        $this->load->model('File_model');
    }

    //Default Load
    public function index() {
        $data['body'] = 'menu_list';
        $data['menu'] = $this->Mmenu->getmenualls();        
        $data['sub_menu'] = $this->Mmenu->getallSubmenu();     
        $data['menu_other'] = $this->Mmenu->getmenuothers();        
        $this->load->view('admin/template', $data);
    }

    public function create_menu_page() {
        $data['body'] = 'create_menu';
        $data['p_list'] = $this->Mmenu->getMenuall();
        $this->load->view('admin/template', $data);
    }

    public function menu_edit_page($m_id) {
        $data['body'] = 'edit_menu';
        $data['p_list'] = $this->Mmenu->getMenuall();
        $data['menu_info'] = $this->Mmenu->getmenubyid($m_id);
        $this->load->view('admin/template', $data);
    }

    function do_upload() {
        if ($this->input->post('m_name')) {
            $this->form_validation->set_rules('m_name', 'Category Name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $m_id = $this->Mmenu->entry();
                //print_r($m_id);

                $config['file_name'] = $m_id;
                $config['upload_path'] = './assets/images/menu_image/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                    // print_r($error);
                } else {
                    $filedata = $this->upload->data();
                    $this->Mmenu->addPicture($filedata['file_name'], $m_id);

                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/menu_image/' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/menu_image/thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    //$con['thumb_marker'] = '_thumb';
                    $con['width'] = 150;
                    $con['height'] = 90;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                    $this->session->set_flashdata('message', 'Category Saved Successfully');

                    //////creating menu file for rout /////
                    $this->File_model->RoutMenu();
                    $this->File_model->common4all();
                    
                    redirect('admin/menu/create_menu_page', 'refresh');
                }
                
                    //////creating menu file for rout /////
                    $this->File_model->RoutMenu();
                    $this->File_model->common4all();
                    

                $this->session->set_flashdata('message', 'Category Saved Successfully');
           
                redirect('admin/menu/create_menu_page', 'refresh');
            } else {
                $data['body'] = 'create_menu';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'create_menu';
            $this->load->view('admin/template', $data);
        }
    }

    public function edit() {
        if ($this->input->post('m_name')) {
            $this->form_validation->set_rules('m_name', 'Category Name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $this->Mmenu->edit();
                //print_r($this->input->post(m_id));
                $m_id = $this->input->post('m_id');
                $config['file_name'] = $m_id;
                // print_r($config['file_name']);
                $config['upload_path'] = './assets/images/menu_image/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                } else {
                    $filedata = $this->upload->data();
                    //unlink image path
                    $img = $this->Mmenu->getmenubyid($m_id);
                    if ($img['m_pic_location'] != NULL) {
                        $picture = './assets/images/menu_image/' . $img['m_pic_location'];
                        $picture_thumbs = './assets/images/menu_image/thmubs/' . $img['m_pic_location'];
                        unlink($picture);
                        unlink($picture_thumbs);
                    }

                    $this->Mmenu->addPicture($filedata['file_name'], $m_id);
                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/menu_image/' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/menu_image/thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    //$con['thumb_marker'] = '_thumb';
                    $con['width'] = 150;
                    $con['height'] = 90;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                    $this->session->set_flashdata('message', 'Category Successfully Updated'); 
                    //////creating menu file for rout /////
                    $this->File_model->RoutMenu();
                    $this->File_model->common4all();

                    redirect('admin/menu', 'refresh');
                }
                $this->session->set_flashdata('message', 'Category Successfully Updated');  
                //////creating menu file for rout /////
                    $this->File_model->RoutMenu();
                    $this->File_model->common4all();              
                redirect('admin/menu', 'refresh');
            } else {
                $data['body'] = 'create_menu';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'create_menu';
            $this->load->view('admin/template', $data);
        }
    }

    /////-->Display Menu Name Create


    function display_menu_create() {
        if ($this->input->post('x_name')) {
            $this->form_validation->set_rules('x_name', 'Display Menu Name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $this->Mmenu->display_meny_entry();
                //print_r($m_id);                      
                $this->session->set_flashdata('message', 'Display Menu Saved Successfully');
                redirect('admin/menu/display_menu_create', 'refresh');
            } else {
                $data['body'] = 'create_display_menu';
                $data['cat'] = $this->Mmenu->getMenuall();
                $data['for_sub_cat'] = $this->Mmenu->getForSubcat();
                $data['for_list'] = $this->Mmenu->getDisplayMenulist();
                $this->load->view('admin/template', $data);
                $this->session->set_flashdata('error', 'Problem Occured while saving Display Menu');
            }
        } else {
            $data['body'] = 'create_display_menu';
            $data['cat'] = $this->Mmenu->getMenuall();
            $data['for_sub_cat'] = $this->Mmenu->getForSubcat();
            $data['for_list'] = $this->Mmenu->getDisplayMenulist();
            //print_r($data['for_list']);
            $this->load->view('admin/template', $data);
        }
    }

    function display_menu_edit($x_id = 0) {
        if ($this->input->post('x_name')) {
            $this->form_validation->set_rules('x_name', 'Display Menu Name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $this->Mmenu->display_menu_edit();
                $this->session->set_flashdata('message', 'Update Successfull');
                redirect('admin/menu/display_menu_create', 'refresh');
            } else {
                $data['body'] = 'edit_display_menu';
                $data['menu_data'] = $this->Mmenu->getDisplayMenubyid($x_id);
                $data['cat'] = $this->Mmenu->getMenuall();
                $data['for_sub_cat'] = $this->Mmenu->getSubcatbyid();
                $this->load->view('admin/template', $data);
                $this->session->set_flashdata('error', 'Error Occured While Saving Data');
            }
        } else {
            $data['body'] = 'edit_display_menu';
            $data['menu_data'] = $this->Mmenu->getDisplayMenubyid($x_id);
            $data['cat'] = $this->Mmenu->getMenuall();
            $data['for_sub_cat'] = $this->Mmenu->getSubcatbyid($x_id);
            $this->load->view('admin/template', $data);
        }
    }

    function delete($id) {
        $this->Mmenu->delete_images($id);
        $img = $this->Mmenu->getmenubyid($id);
        if ($img['m_pic_location'] != NULL) {
            $picture = './assets/images/menu_image/' . $img['m_pic_location'];
            $picture_thumbs = './assets/images/menu_image/thmubs/' . $img['m_pic_location'];
            unlink($picture);
            unlink($picture_thumbs);
        }
        redirect('admin/menu', 'refresh');
    }

    function footer_menu_delete($m_id) {
        $this->Mmenu->footerMenuDel($m_id);
        $this->session->set_flashdata('message', 'Footer Menu Deleted');
        redirect('admin/menu', 'refresh');
    }

    /////-->
}
