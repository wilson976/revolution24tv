<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banner extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('kitkat');
        }
        $this->load->model('File_model');
    }

    public function popup($id){
        $sql = $this->M_banner->getbannerbyid($id);
        switch ($sql['b_type']) {
            case 'image':
                echo "<img src='".base_url()."assets/images/banner//".$sql['b_location']."'>";
                break;
            case 'alter':
                if (isset($sql['b_location'])) {
                echo "<img src='".base_url()."assets/images/banner//".$sql['b_location']."'><br>";
                }
                
                break;
            default:
                echo $sql['b_code'];
                break;
        }
    }

    ///->banner Start

    function index() {
        $data['body'] = 'banner';
        $data['menu'] = $this->M_banner->parent_menu();
        $data['b_info'] = $this->M_banner->banner_list();
        $data['position'] = $this->M_banner->showpossition();
        $this->load->view('admin/template', $data);
    }

    function banner_entry() {
        if ($this->input->post('b_type')) {
            $this->form_validation->set_rules('b_name', 'Banner Name', 'required');
            if ($this->form_validation->run() == TRUE) {            
                $config['file_name'] = date('Ymdhis');
                $config['upload_path'] = './assets/images/banner//';
                $config['allowed_types'] = 'gif|jpg|png|swf';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                   
                    $this->session->set_flashdata('message', 'Unknown File Type');
                } else {
                    $b_id = $this->M_banner->banner_entry();
                    $filedata = $this->upload->data();
                    $this->M_banner->banneraddPicture($filedata['file_name'], $b_id);
                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/banner//' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/banner//thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    $con['width'] = 50;
                    $con['height'] = 40;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                }
                $this->File_model->common4all();
                $this->File_model->home1();
                $this->File_model->home2();
                //cache delete
                
                $home_page = 'https://www.revolution24.tv';
                DeleteCache(md5($home_page));
                
                $home_page = 'https://www.revolution24.tv/';
                DeleteCache(md5($home_page));
               
                $home_page = 'https://www.revolution24.tv/index.php';
                DeleteCache(md5($home_page));
              
                $home = base_url();
                DeleteCache(md5($home));
                
                $this->session->set_flashdata('message', 'Banner placed successfully');
                redirect('admin/banner/', 'refresh');
            } else {
                $data['body'] = 'banner';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'banner';
            $this->load->view('admin/template', $data);
        }
    }

    function linked_file($b_id) {
        $data['body'] = 'banner_linked_file';
        $data['banner'] = $this->M_banner->getbannerbyid($b_id);
        $this->load->view('admin/template', $data);
    }

    function linked_file_entry($b_id) {
        if (!empty($_FILES['picture'])) {
            //print_r($b_id);               
            $config['file_name'] = date('Ymdhis');
            $config['upload_path'] = './assets/images/banner//linked_file/';
            $config['allowed_types'] = 'pdf|gif|jpg|png';
            $config['max_size'] = '60000';
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("picture")) {
                $error = array('error' => $this->upload->display_errors());
                //print_r($error);
                if (isset($error)) {
                    echo '<script>alert("Unknown File Type!!!")</script>';
                }
                //$this->session->set_flashdata('message', 'Unknown File Type');
            } else {
                $filedata = $this->upload->data();
                $this->M_banner->banneraddPdf($filedata['file_name'], $b_id);
                //print_r($filedata);                               
            }
            $this->session->set_flashdata('message', 'Record Updated');
            redirect('admin/banner/', 'refresh');
        } else {
            $data['body'] = 'banner';
            $this->load->view('admin/template', $data);
        }
    }

    function banner_edit_page($b_id) {
        $data['body'] = 'edit_banner';
        $data['menu'] = $this->M_banner->parent_menu();
        $data['b_info'] = $this->M_banner->getbannerbyid($b_id);
        $data['position'] = $this->M_banner->showpossition();
        $this->load->view('admin/template', $data);
    }

    function banner_edit() {
        if ($this->input->post('b_name')) {
            $this->form_validation->set_rules('b_name', 'Name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $this->M_banner->banner_edit();
                $b_id = $this->input->post('b_id');
                //print_r($b_id);

                $config['file_name'] = $b_id;
                $config['upload_path'] = './assets/images/banner//';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '60000';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                } else {
                    $filedata = $this->upload->data();
                    //unlink image path
                    $img = $this->M_banner->getbannerbyid($b_id);
                    if ($img['b_location'] != NULL) {
                        $picture = './assets/images/banner//' . $img['b_location'];
                        $picture_thumbs = './assets/images/banner//thmubs/' . $img['b_location'];
                        unlink($picture);
                        unlink($picture_thumbs);
                    }

                    //print_r($filedata);
                    $this->M_banner->banneraddPicture($filedata['file_name'], $b_id);

                    $con['image_library'] = 'gd2';
                    $con['source_image'] = './assets/images/banner//' . $filedata['file_name'];
                    $con['new_image'] = './assets/images/banner//thmubs/';
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    //$con['thumb_marker'] = '_thumb';
                    $con['width'] = 50;
                    $con['height'] = 40;
                    $this->load->library('image_lib', $con);
                    $this->image_lib->resize();
                    $this->session->set_flashdata('message', 'Banner Information Updated');
                    redirect('admin/banner/', 'refresh');
                }
                $this->File_model->common4all();
                $this->File_model->home1();
                $this->File_model->home2();
                //cache delete
                
                $home_page = 'https://www.revolution24.tv';
                DeleteCache(md5($home_page));
                
                $home_page = 'https://www.revolution24.tv/';
                DeleteCache(md5($home_page));
               
                $home_page = 'https://www.revolution24.tv/index.php';
                DeleteCache(md5($home_page));
              

                $home = base_url();
                DeleteCache(md5($home));

                $this->session->set_flashdata('message', 'Banner Information Updated');
                redirect('admin/banner/', 'refresh');
            } else {
                $data['body'] = 'banner';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'banner';
            $this->load->view('admin/template', $data);
        }
    }

    function banner_delete($b_id) {
        $img = $this->M_banner->getbannerbyid($b_id);
        if ($img['b_location'] != NULL) {
            $picture = './assets/images/banner//' . $img['b_location'];
            $picture_thumbs = './assets/images/banner//thmubs/' . $img['b_location'];
            unlink($picture);
            unlink($picture_thumbs);
        }

        $this->M_banner->banner_delete($b_id);
       // $this->banner_generator();
        $this->File_model->common4all();
        $this->File_model->home1();
        $this->File_model->home2();
        //cache delete
        
        $home_page = 'https://www.revolution24.tv';
        DeleteCache(md5($home_page));
        
        $home_page = 'https://www.revolution24.tv/';
        DeleteCache(md5($home_page));
        
        $home_page = 'https://www.revolution24.tv/index.php';
        DeleteCache(md5($home_page));
        
        
        $home = base_url();
        DeleteCache(md5($home));
        
        $this->session->set_flashdata('message', 'Data Deleted');
        redirect('admin/banner/');
    }

    ///->banner End
}

