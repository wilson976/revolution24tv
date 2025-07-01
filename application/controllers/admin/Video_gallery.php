<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Video_gallery extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
         $this->load->model("admin/M_video_gallery");
        if (!isset($loggedin) or $loggedin == '') {
            redirect('hotpanel');
        }
        $this->load->model('File_model');
    }

    //--> Video Module Start
    public function index() {
        $data['body'] = 'video_list';
        // $data['video'] = $this->M_video_gallery->video_list();
        $data['cat_list_browse'] = $this->M_video_gallery->video_category_browse();
        $data['submenu'] = $this->M_video_gallery->getCategory();
        $this->load->view('admin/template', $data);
    }

    public function video_category() {
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('cat_name', 'Category Name', 'required|is_unique[video_gallery_cat.cat_name]');
            if ($this->form_validation->run() == TRUE) {
               
                $v_id = $this->M_video_gallery->cat_entry();
                // print_r($v_id); exit;

                $this->session->set_flashdata('message', 'Category Created Successfully');
                redirect('admin/video_gallery/video_category', 'refresh');
            } else {
                
                $data['body'] = 'video_category';
                $data['video'] = $this->M_video_gallery->video_list();
                $data['parent_cat_list'] = $this->M_video_gallery->parent_cat_list();
                $data['cat_list'] = $this->M_video_gallery->cat_list();
                $data['subcat_list'] = $this->M_video_gallery->subcat_list();
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'video_category';
            $data['video'] = $this->M_video_gallery->video_list();
            $data['parent_cat_list'] = $this->M_video_gallery->parent_cat_list();
            $data['cat_list'] = $this->M_video_gallery->cat_list();
            $data['subcat_list'] = $this->M_video_gallery->subcat_list();
            $this->load->view('admin/template', $data);
        }
    }

    public function edit_v_category($id = '') {
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('cat_name', 'Category Name', 'required');
            if ($this->form_validation->run() == TRUE) {
               
                $this->M_video_gallery->cat_update();
                // print_r($v_id); exit;

                $this->session->set_flashdata('message', 'Category Created Successfully');
                redirect('admin/video_gallery/video_category', 'refresh');
            } else {
                $data['body'] = 'video_category_edit';
                $data['cat'] = $this->M_video_gallery->get_cat_byID($id);
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'video_category_edit';
                $data['cat'] = $this->M_video_gallery->get_cat_byID($id);
            $this->load->view('admin/template', $data);
        }
    }

    function video_entry() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('link', 'YouTube Link', 'required');
            if ($this->form_validation->run() == TRUE) {
               
                $v_id = $this->M_video_gallery->video_entry();
                 $this->M_video_gallery->updatevideo($v_id);
                //print_r($v_id);
                $dir = date('Y/m/d');

                if($this->input->post("picture")!=''){
                    $config['file_name'] = $v_id;
                    $config['upload_path'] = './assets/images/video_gallery/'.$dir;
                    if(!file_exists($config['upload_path'])){
                        mkdir($config['upload_path'], 0755, true);
                    }
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '60000';
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload("picture")) {
                        $error = array('error' => $this->upload->display_errors());
                        print_r($error);
                        $this->session->set_flashdata('message', 'Unknown file Selected');
                    } else {
                        $filedata = $this->upload->data();
                        //print_r($filedata);
                        $this->M_video_gallery->addPicture($filedata['file_name'], $v_id);

                        $con['image_library'] = 'gd2';
                        $con['source_image'] = './assets/images/video_gallery/'  .$dir.'/'. $filedata['file_name'];
                        $con['new_image'] = './assets/images/video_gallery/'.$dir.'/thmubs/';
                        
                        if(!file_exists($con['new_image'])){
                            mkdir($con['new_image'], 0755, true);
                        }
                        $con['create_thumb'] = FALSE;
                        $con['maintain_ratio'] = TRUE;
                        //$con['thumb_marker'] = '_thumb';
                        $con['width'] = 160;
                        $con['height'] = 115;
                        $this->load->library('image_lib', $con);
                        $this->image_lib->resize();

                        $this->File_model->home1();
                        $this->File_model->home2();
                        $home_page = 'https://www.revolution24.tv';
                        DeleteCache(md5($home_page));
                        
                        $home_page = 'https://www.revolution24.tv/';
                        DeleteCache(md5($home_page));
                       
                        $home_page = 'https://www.revolution24.tv/index.php';
                        DeleteCache(md5($home_page));
                        
                        $this->session->set_flashdata('message', 'Video Upload Successfull');
                        redirect('admin/video_gallery/', 'refresh');
                    }
                }

                $this->File_model->home1();
                $this->File_model->home2();
                $this->session->set_flashdata('message', 'Video Upload Successfull');
                redirect('admin/video_gallery/', 'refresh');
            } else {
                $data['body'] = 'video_list';
                $this->load->view('admin/template', $data);
            }
        } else {
            $data['body'] = 'video_list';
            $this->load->view('admin/template', $data);
        }
    }
     function video_edit_page($v_id) {
        $data['body'] = 'video_edit';
        $data['video'] = $this->M_video_gallery->video_edit_page($v_id);
        $data['submenu'] = $this->M_video_gallery->getCategory();
        $this->load->view('admin/template', $data);
    }

    function video_edit($v_id) {

        $dir = date('Y/m/d');
        $config['file_name'] = $v_id;
        $config['upload_path'] = './assets/images/video_gallery/'.$dir;
        if(!file_exists($config['upload_path'])){
            mkdir($config['upload_path'], 0755, true);
        }
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '60000';
        $this->upload->initialize($config);

        if ($this->upload->do_upload("picture")) {
            
            $filedata = $this->upload->data();
            //print_r($filedata);

            $this->M_video_gallery->addPicture($filedata['file_name'], $v_id);

            $con['image_library'] = 'gd2';
            $con['source_image'] = './assets/images/video_gallery/'  .$dir.'/'. $filedata['file_name'];
            $con['new_image'] = './assets/images/video_gallery/'.$dir.'/thmubs/';
            
            if(!file_exists($con['new_image'])){
                mkdir($con['new_image'], 0755, true);
            }
            $con['create_thumb'] = FALSE;
            $con['maintain_ratio'] = TRUE;
            //$con['thumb_marker'] = '_thumb';
            $con['width'] = 160;
            $con['height'] = 115;
            $this->load->library('image_lib', $con);
            $this->image_lib->resize();
        }

        $img = $_POST['old_img'];
        if (isset($filedata['file_name'])) {
        $img = $filedata['file_name'];
        }

        $this->M_video_gallery->video_update($img);

        $this->File_model->home1();
        $this->File_model->home2();
        $home_page = 'https://www.revolution24.tv';
        DeleteCache(md5($home_page));
        
        $home_page = 'https://www.revolution24.tv/';
        DeleteCache(md5($home_page));
       
        $home_page = 'https://www.revolution24.tv/index.php';
        DeleteCache(md5($home_page));

        $this->session->set_flashdata('message', 'video Information Successfully Updated');
        redirect('admin/video_gallery/');
    }

      function video_sort() {
        $data['title'] = 'Arrange Video';
        $data['body'] = 'video_sort';
        $data['videonews'] = $this->M_video_gallery->video_sortlist();
        $this->File_model->home1();
        $this->File_model->home2();
        $home_page = 'https://www.revolution24.tv';
        DeleteCache(md5($home_page));
        
        $home_page = 'https://www.revolution24.tv/';
        DeleteCache(md5($home_page));
       
        $home_page = 'https://www.revolution24.tv/index.php';
        DeleteCache(md5($home_page));
        $this->load->vars($data);
        $this->load->view('admin/template');
    }

    

      function video_delete($v_id) {
        $this->M_video_gallery->video_delete($v_id);

        $this->File_model->home1();
        $this->File_model->home2();
        $home_page = 'https://www.revolution24.tv';
        DeleteCache(md5($home_page));
        
        $home_page = 'https://www.revolution24.tv/';
        DeleteCache(md5($home_page));
       
        $home_page = 'https://www.revolution24.tv/index.php';
        DeleteCache(md5($home_page));
         $this->session->set_flashdata('message', 'video Deleted');
         redirect('admin/video_gallery/', 'refresh');

      }


    function orderupdate_vedio(){
        $this->M_video_gallery->OrderUpdate();

        $this->File_model->home1();
        $this->File_model->home2();
        $this->session->set_flashdata('message', 'Successfully Updated');

        redirect('admin/video_gallery/', 'refresh');
    }

    function video_SubCat_entry() {
        $this->M_video_gallery->video_SubCat_entry();
        $this->session->set_flashdata('message', 'Category Saved Successfully');
        redirect('admin/video_gallery/video_category');
    }

    function video_cat_edit($id) {
        $data['body'] = 'video_cat_edit';
        $data['parent_cat_list'] = $this->M_video_gallery->parent_cat_list();
        $data['cat'] = $this->M_video_gallery->video_cat_edit($id);
        $this->load->view('admin/template', $data);
    }

    function cat_edit() {
        $this->M_video_gallery->cat_edit();
        $this->session->set_flashdata('message', 'Category Successfully Updated');
        redirect('admin/video_gallery/video_category');
    }

    function video_cat_delete($id) {
        $this->M_video_gallery->video_cat_delete($id);
        $this->session->set_flashdata('message', 'Category Deleted');
        redirect('admin/video_gallery/video_category');
    }

    

    public function video_editdeletelist($v_category) {
        $data['body'] = 'video_editdelete';
        $data['video'] = $this->M_video_gallery->video_catwise($v_category);
        $data['cat'] = $this->M_video_gallery->catbyid($v_category);
        $this->load->view('admin/template', $data);
    }
}
