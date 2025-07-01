<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Program_schedule extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('hotpanel');
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

                $this->load->library('image_lib');

                if ($this->input->post('p_date') != '') {
                    $img_dir = date('Y/m/d', strtotime($this->input->post('p_date')));
                    $dir = './assets/images/program_image/' . $img_dir;
                    $dit_thumb = './assets/images/program_image/' . $img_dir . '/mob/';
                    $dit_mediam = './assets/images/program_image/' . $img_dir . '/thumbnails/';
                    if (is_dir($dir) == false) {
                        mkdir($dir, 0755, true);
                        mkdir($dit_thumb, 0755, true);
                        mkdir($dit_mediam, 0755, true);
                        $config['upload_path'] = './assets/images/program_image/' . $img_dir;
                    } else {
                        $config['upload_path'] = $dir;
                    }
                } else {
                    $img_dir = date('Y/m/d');
                    $dir = './assets/images/program_image/' . $img_dir;
                    $dit_thumb = './assets/images/program_image/' . $img_dir . '/mob/';
                    $dit_mediam = './assets/images/program_image/' . $img_dir . '/thumbnails/';
                    if (is_dir($dir) == false) {
                        mkdir($dir, 0755, true);
                        mkdir($dit_thumb, 0755, true);
                        mkdir($dit_mediam, 0755, true);
                        $config['upload_path'] = './assets/images/program_image/' . $img_dir;
                    } else {
                        $config['upload_path'] = $dir;
                    }
                }

                $config['file_name'] = $p_id;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '1024*2';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $filedata = $this->upload->data();
                    $this->M_program->PaddPicture($filedata['file_name'], $p_id);
                    $con['image_library'] = 'gd2';
                    $con['source_image'] = $dir . '/' . $filedata['file_name'];
                    $con['new_image'] = $dit_thumb;
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    $con['width'] = 174;
                    $con['height'] = 203;
                    $this->image_lib->initialize($con);
                    $this->image_lib->resize();

                    $con2['image_library'] = 'gd2';
                    $con2['source_image'] = $dir . '/' . $filedata['file_name'];
                    $con2['new_image'] = $dit_mediam;
                    $con2['create_thumb'] = FALSE;
                    $con2['maintain_ratio'] = TRUE;
                    $con2['width'] = 420;
                    $con2['height'] = 295;
                    $this->image_lib->initialize($con2);
                    $this->image_lib->resize();

                $this->session->set_flashdata('message', 'New schedule Successfully Created');
                redirect('admin/program_schedule/', 'refresh');
            } 

                $this->session->set_flashdata('message', 'Uploaded without Image');
                redirect('admin/program_schedule/', 'refresh');
        } else {
            $data['body'] = 'program_list';
            $this->load->view('admin/template', $data);
        }
    }else {
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
				

                $this->load->library('image_lib');
				

            if ($this->input->post('p_date') != '') {
                $img_dir = date('Y/m/d', strtotime($this->input->post('p_date')));
                $dir = './assets/images/program_image/' . $img_dir;
                $dit_thumb = './assets/images/program_image/' . $img_dir . '/mob/';
                $dit_mediam = './assets/images/program_image/' . $img_dir . '/thumbnails/';
                if (is_dir($dir) == false) {
                    mkdir($dir, 0755, true);
                    mkdir($dit_thumb, 0755, true);
                    mkdir($dit_mediam, 0755, true);
                    // $target_Path1 = $d.$file_name2;
                    $config['upload_path'] = './assets/images/program_image/' . $img_dir;
                } else {
                    $config['upload_path'] = $dir;
                }
            } else {
                $img_dir = date('Y/m/d');
                $dir = './assets/images/program_image/' . $img_dir;
                $dit_thumb = './assets/images/program_image/' . $img_dir . '/mob/';
                $dit_mediam = './assets/images/program_image/' . $img_dir . '/thumbnails/';
                if (is_dir($dir) == false) {
                    mkdir($dir, 0755, true);
                    mkdir($dit_thumb, 0755, true);
                    mkdir($dit_mediam, 0755, true);
                    $config['upload_path'] = './assets/images/program_image/' . $img_dir;
                } else {
                    $config['upload_path'] = $dir;
                }
            }
			
			
			  $img = $this->M_program->getPbyid($p_id);
                if ($img['pro_pic'] != '') {
                    $picture = $dir . '/' . $img['pro_pic'];					
                    $picture_thumbs = $dit_thumb . '/' . $img['pro_pic'];
                    $picture_mediam = $dit_mediam . '/' . $img['pro_pic'];
                    @unlink($picture);
                    @unlink($picture_thumbs);
                    @unlink($picture_mediam);
                }

            $config['file_name'] = $p_id;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1024*6';
            $this->upload->initialize($config);			

            if (!$this->upload->do_upload("picture")) {
                $error = array('error' => $this->upload->display_errors());
                redirect('admin/program_schedule/', 'refresh');
                $this->session->set_flashdata('message', 'Updated without Image');
                //}
            } else {
                $filedata = $this->upload->data();
				
                


                $this->M_program->PictureNameUpdate($p_id);
                $con['image_library'] = 'gd2';
                $con['source_image'] = $dir . '/' . $filedata['file_name'];
                $con['new_image'] = $dit_thumb . '/';
                $con['create_thumb'] = FALSE;
                $con['maintain_ratio'] = TRUE;
                $con['width'] = 150;
                $con['height'] = 150;
                $this->image_lib->initialize($con);
                $this->image_lib->resize();

                $con2['image_library'] = 'gd2';
                $con2['source_image'] = $dir . '/' . $filedata['file_name'];
                $con2['new_image'] = $dit_mediam . '/';
                $con2['create_thumb'] = FALSE;
                $con2['maintain_ratio'] = TRUE;
                $con2['width'] = 420;
                $con2['height'] = 295;
                $this->image_lib->initialize($con2);
                $this->image_lib->resize();

                $this->session->set_flashdata('message', 'schedule Info Successfully Updated');
                redirect('admin/program_schedule/', 'refresh');
            } 
        } else {
            $data['body'] = 'program_list';
            $this->load->view('admin/template', $data);
        }
    }else {
            $data['body'] = 'program_list';
            $this->load->view('admin/template', $data);
        }
}

    function p_delete($p_id) {
        $img = $this->M_program->getPbyid($p_id);
         $this->load->library('image_lib');

            if ($img['pro_date'] != '') {

                $img_dir = date('Y/m/d', strtotime($img['pro_date']));
                $dir = './assets/images/program_image/' . $img_dir;
                $dit_thumb = './assets/images/program_image/' . $img_dir . '/mob/';
                $dit_mediam = './assets/images/program_image/' . $img_dir . '/thumbnails/';
                if (is_dir($dir) == false) {
                    mkdir($dir, 0755, true);
                    mkdir($dit_thumb, 0755, true);
                    mkdir($dit_mediam, 0755, true);
                    // $target_Path1 = $d.$file_name2;
                    $config['upload_path'] = './assets/images/program_image/' . $img_dir;
                } else {
                    $config['upload_path'] = $dir;
                }
            } else {
                $img_dir = date('Y/m/d');
                $dir = './assets/images/program_image/' . $img_dir;
                $dit_thumb = './assets/images/program_image/' . $img_dir . '/mob/';
                $dit_mediam = './assets/images/program_image/' . $img_dir . '/thumbnails/';
                if (is_dir($dir) == false) {
                    mkdir($dir, 0755, true);
                    mkdir($dit_thumb, 0755, true);
                    mkdir($dit_mediam, 0755, true);
                    $config['upload_path'] = './assets/images/program_image/' . $img_dir;
                } else {
                    $config['upload_path'] = $dir;
                }
            }

        // $img_dir = date('Y/m/d', strtotime($this->input->post('p_date')));
        $dir = './assets/images/program_image/' . $img_dir;
        $dit_thumb = './assets/images/program_image/' . $img_dir . '/mob/';
        $dit_mediam = './assets/images/program_image/' . $img_dir . '/thumbnails/';
        

        if ($img['pro_pic'] != '') {
            $picture = $dir . '/' . $img['pro_pic'];
            $picture_thumbs = $dit_thumb . '/' . $img['pro_pic'];
            $picture_mediam = $dit_mediam . '/' . $img['pro_pic'];
            @unlink($picture);
            @unlink($picture_thumbs);
            @unlink($picture_mediam);
        }
        

        $this->M_program->p_delete($p_id);
        $this->session->set_flashdata('message', 'Data Deleted');
        redirect('admin/program_schedule/');
    }



   
}
