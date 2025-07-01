<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('hotpanel');
        }
        $this->load->model('admin/Mnews');
        $this->load->model('admin/Mtags');
        $this->load->model('admin/M_profile');
        $this->load->model('Model_pages');
        $this->load->model('Model_menu');
        $this->load->model('Model_menu');
        $this->load->model('File_model');
    }

    function index() {
        $data['title'] = 'News Section';
        $data['body'] = 'news/news_home';
        $data['menu'] = $this->Mmenu->getmenuActive();
        $data['allmenu'] = $this->Mmenu->getmenuall();
        $this->load->vars($data);
        $this->load->view('admin/template');
    }

    function slidernews() {
        $data['title'] = 'Arrange Slider News';
        $data['body'] = 'news/slider_news';
        $data['slidernews'] = $this->Mnews->SliderLeadNews();
        $this->load->vars($data);
        $this->load->view('admin/template');
    }

    // function orderupdate_slider() {
    //     $this->Mnews->SliderorderUpdate();
      // $this->session->set_flashdata('message', 'Successfully updated');
    //     redirect('./admin/news/slidernews/', 'refresh');
    // }


    function orderupdate_slider() {
        $news_id = $_POST['news_id'];
        $n_order = $_POST['n_order'];
        $this->Mnews->SliderorderUpdate();

        //$this->clear_all_cache();
        $this->session->set_flashdata('message', 'Successfully updated');
        redirect('./admin/news/slidernews/', 'refresh');
    }

    function add($cat_id) {
        if ($this->input->post()) {
            $m_type = $this->Mnews->GetCategory($cat_id);
            $this->form_validation->set_rules('n_head', 'News Head', 'required');
            $this->form_validation->set_rules('n_details', 'News Details', 'required');
            if ($this->form_validation->run() == TRUE) {
                $id = $this->Mnews->create($cat_id);
                $this->Mnews->updateOrderHr($id);
		
                $start_publishing = $this->Mnews->ReturnStartDate($id);

                $this->load->library('image_lib');
                //$config['file_name'] = $id;   
                // $config['upload_path'] = './assets/news_images/';

                if ($start_publishing != '') {

                    $img_dir = date('Y/m/d', strtotime($start_publishing));
                      $dir = './assets/news_images/' . $img_dir;
                      $dit_thumb = './assets/news_images/' . $img_dir . '/mob/';
                      $dit_mediam = './assets/news_images/' . $img_dir . '/thumbnails/';
                    if (is_dir($dir) == false) {
                        mkdir($dir, 0755, true);
                        mkdir($dit_thumb, 0755, true);
                        mkdir($dit_mediam, 0755, true);
                        // $target_Path1 = $d.$file_name2;
                        $config['upload_path'] = './assets/news_images/' . $img_dir;
                    } else {
                        $config['upload_path'] = $dir;
                    }
                } else {
                    $img_dir = date('Y/m/d');
                    $dir = './assets/news_images/' . $img_dir;
                    $dit_thumb = './assets/news_images/' . $img_dir . '/mob/';
                    $dit_mediam = './assets/news_images/' . $img_dir . '/thumbnails/';
                    if (is_dir($dir) == false) {
                        mkdir($dir, 0755, true);
                        mkdir($dit_thumb, 0755, true);
                        mkdir($dit_mediam, 0755, true);
                        $config['upload_path'] = './assets/news_images/' . $img_dir;
                    } else {
                        $config['upload_path'] = $dir;
                    }
                    // $config['upload_path'] = './assets/news_images/'.$img_dir;
                }

                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '1024*2';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload("picture")) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $filedata = $this->upload->data();
                    $this->Mnews->add_file($filedata['file_name'], $id);
                    $con['image_library'] = 'gd2';
                    $con['source_image'] = $dir . '/' . $filedata['file_name'];
                    $con['new_image'] = $dit_thumb;
                    $con['create_thumb'] = FALSE;
                    $con['maintain_ratio'] = TRUE;
                    $con['width'] = 174;
                    $con['height'] = 203;
                    // print_r($con);
                    // exit();
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

                    $this->File_model->create_file($id, $cat_id);                    
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
                    
                    $catNews = base_url() .'online/'.$m_type['m_bangla'];
                    $catsNews = base_url() .'online/'. $m_type['m_bangla'].'/';
                    //$ParentcatNews = base_url() . $m_type['m_bangla'].'/article';
                   // $ParentcatsNews = base_url() . $m_type['m_bangla'].'/article/';
        
                    DeleteCache(md5($catNews));
                    DeleteCache(md5($catsNews));
                    //DeleteCache(md5($ParentcatNews));
                   // DeleteCache(md5($ParentcatsNews));

                  
                    $this->session->set_flashdata('message', 'News Uploaded');
                    redirect('admin/news/add/' . $cat_id, 'refresh');
                }
                // $this->clear_all_cache();


                $this->File_model->create_file($id, $cat_id);
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
                
                $catNews = base_url() .'online/'.$m_type['m_bangla'];
                $catsNews = base_url() .'online/'. $m_type['m_bangla'].'/';
                //$ParentcatNews = base_url() . $m_type['m_bangla'].'/article';
                //$ParentcatsNews = base_url() . $m_type['m_bangla'].'/article/';
    
                DeleteCache(md5($catNews));
                DeleteCache(md5($catsNews));
                //DeleteCache(md5($ParentcatNews));
               // DeleteCache(md5($ParentcatsNews));
 

                $this->session->set_flashdata('message', 'News Uploaded without Image');
                redirect('admin/news/add/' . $cat_id, 'refresh');
            } else {
                
                $data['cat_name'] = $this->Mnews->get_cat_name($cat_id);
                $data['subcategory'] = $this->Mmenu->getSubmenus($cat_id);
                $data['writer_list'] = $this->M_profile->writer_list();
                $data['title'] = "Create News";
                $data['body'] = "news/news_add";
                $data['category_id'] = $cat_id;
                $this->load->vars($data);
                $this->load->view('admin/template');
            }
        } else {
            
            $data['cat_name'] = $this->Mnews->get_cat_name($cat_id);
            $data['subcategory'] = $this->Mmenu->getSubmenus($cat_id);
            $data['writer_list'] = $this->M_profile->writer_list();
            $data['title'] = "Create News";
            $data['body'] = "news/news_add";
            $data['category_id'] = $cat_id;
            $this->load->vars($data);
            $this->load->view('admin/template');
        }
    }

    function display($cat_id) {

        $data = array(
            'news' => $this->Mnews->get_news($cat_id),
            'title' => "News List",
            'cat_id' => $cat_id,
            'cat_name' => $this->Mnews->get_cat_name($cat_id),
            'body' => "news/news_list"
        );
        $this->load->view('admin/template', $data);
    }

    function new_display($cat_id, $nd) {

        $data = array(
            'news' => $this->Mnews->new_get_news($cat_id, $nd),
            'cat_id' => $cat_id
        );
        $this->load->view('admin/news/new_list', $data);
    }

    function edit($n_id = NULL, $cat_id = NULL) {
        if ($this->input->post()) {
            $this->Mnews->update($n_id, $cat_id);

            $this->db->select('n_date, n_category');
            $this->db->where('n_id', $n_id);
            $q = $this->db->get('news');
            // print $this->db->last_query();
            if ($q->num_rows() > 0) {
                $data = $q->row_array();
                //$cat_id = $data['n_category'];
            } else {
                $data = '';
            }

            $this->File_model->create_file($n_id, $cat_id);
            $this->File_model->common4all();
            $this->File_model->home1();
            $this->File_model->home2();


            $m_type = $this->Mnews->GetCategory($cat_id);
            $n_head = $this->Mnews->ReturnNewshead($n_id);
            //cache delete start
            //$this->db->cache_delete_all();
            $home = base_url();
            $home_page = 'https://www.revolution24.tv';
            $detailsNews = base_url() . $m_type['m_bangla'] . '/' . str_replace('-', '/', $data['n_date']) . '/' . $n_id;
            $detailNews = base_url() . $m_type['m_bangla'] . '/' . str_replace('-', '/', $data['n_date']) . '/' . $n_id.'/';
            DeleteCache(md5($home_page));
            // file_get_contents($home_page);
            $home_page = 'https://www.revolution24.tv/';
            DeleteCache(md5($home_page));
            $home_page = 'https://www.revolution24.tv/index.php';
            DeleteCache(md5($home_page));
            // file_get_contents($home_page);

            $catNews = base_url() .'online/'.$m_type['m_bangla'];
            $catsNews = base_url() .'online/'. $m_type['m_bangla'].'/';
            //$ParentcatNews = base_url() . $m_type['m_bangla'].'/article';
            //$ParentcatsNews = base_url() . $m_type['m_bangla'].'/article/';

            DeleteCache(md5($catNews));
            DeleteCache(md5($catsNews));
            //DeleteCache(md5($ParentcatNews));
           // DeleteCache(md5($ParentcatsNews));

            DeleteCache(md5($home));
            DeleteCache(md5($detailNews));
            DeleteCache(md5($detailsNews));
            //cache delete end


	    $start_publishing = $this->Mnews->ReturnStartDate($n_id);
			
            $this->load->library('image_lib');
            if ($start_publishing != '') {

                $img_dir = date('Y/m/d', strtotime($start_publishing));
                $dir = './assets/news_images/' . $img_dir;
                $dit_thumb = './assets/news_images/' . $img_dir . '/mob/';
                $dit_mediam = './assets/news_images/' . $img_dir . '/thumbnails/';
                if (is_dir($dir) == false) {
                    mkdir($dir, 0755, true);
                    mkdir($dit_thumb, 0755, true);
                    mkdir($dit_mediam, 0755, true);
                    // $target_Path1 = $d.$file_name2;
                    $config['upload_path'] = './assets/news_images/' . $img_dir;
                } else {
                    $config['upload_path'] = $dir;
                }
            } else {
                $img_dir = date('Y/m/d');
                $dir = './assets/news_images/' . $img_dir;
                $dit_thumb = './assets/news_images/' . $img_dir . '/mob/';
                $dit_mediam = './assets/news_images/' . $img_dir . '/thumbnails/';
                if (is_dir($dir) == false) {
                    mkdir($dir, 0755, true);
                    mkdir($dit_thumb, 0755, true);
                    mkdir($dit_mediam, 0755, true);
                    $config['upload_path'] = './assets/news_images/' . $img_dir;
                } else {
                    $config['upload_path'] = $dir;
                }
                // $config['upload_path'] = './assets/news_images/'.$img_dir;
            }

            // $config['upload_path'] = './assets/news_images/';
            $config['allowed_types'] = 'gif|jpg|png|swf|pdf';
            $config['max_size'] = '1024*6';
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("picture")) {
                $error = array('error' => $this->upload->display_errors());
                //print_r($error);
                //if (isset($error)) {
                //echo '<script>alert("Unknown File Type!!!")</script>';
                //$this->clear_all_cache();
                 $this->session->set_flashdata('message', 'Updated without Image');
                redirect('admin/news/display/' . $cat_id, 'refresh');
               
                //}
            } else {
                $filedata = $this->upload->data();
                $img = $this->Mnews->get_by_id($n_id);
				
				
                if ($img['main_image'] != '') {
                    $picture = $dir . '/' . $img['main_image'];
                    $picture_thumbs = $dit_thumb . '/' . $img['main_image'];
                    $picture_mediam = $dit_mediam . '/' . $img['main_image'];
                    @unlink($picture);
                    @unlink($picture_thumbs);
                    @unlink($picture_mediam);
                }


                $this->Mnews->update_file($filedata['file_name'], $n_id);
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
                //$this->clear_all_cache();
                $this->session->set_flashdata('message', 'News updated');

                $this->File_model->create_file($n_id, $cat_id);
                $this->File_model->common4all();
                $this->File_model->home1();
                $this->File_model->home2();
				
				
				//cache delete start   
                $home = base_url();
                $home_page = 'https://www.revolution24.tv';

                $detailsNews = base_url() . $m_type['m_bangla'] . '/' . str_replace('-', '/', $data['n_date']) . '/' . $n_id;
                $detailNews = base_url() . $m_type['m_bangla'] . '/' . str_replace('-', '/', $data['n_date']) . '/' . $n_id.'/';
                
                DeleteCache(md5($home_page));

                // file_get_contents($home_page);
                $home_page = 'https://www.revolution24.tv/index.php';
                DeleteCache(md5($home_page));
                $home_page = 'https://www.revolution24.tv/';
                DeleteCache(md5($home_page));
                // file_get_contents($home_page);
                $catNews = base_url() .'online/'.$m_type['m_bangla'];
                $catsNews = base_url() .'online/'. $m_type['m_bangla'].'/';
                //$ParentcatNews = base_url() . $m_type['m_bangla'].'/article';
                //$ParentcatsNews = base_url() . $m_type['m_bangla'].'/article/';
    
                DeleteCache(md5($catNews));
                DeleteCache(md5($catsNews));
                //DeleteCache(md5($ParentcatNews));
               // DeleteCache(md5($ParentcatsNews));

                DeleteCache(md5($home));
                DeleteCache(md5($detailNews));
                DeleteCache(md5($detailsNews));
                // //cache delete end
				
				

                redirect('admin/news/display/' . $cat_id, 'refresh');
            }
        } else {
            $data['menu'] = $this->Mmenu->getmenu();
            
            $data['edit_data'] = $this->Mnews->get_by_id($n_id);
            $data['cat_name'] = $this->Mnews->get_cat_name($cat_id);
            $data['subcategory'] = $this->Mmenu->getSubmenus($cat_id);
            $data['writer_list'] = $this->M_profile->writer_list();
            $data['title'] = "Edit News";
            $data['body'] = "news/news_edit";
            $data['category_id'] = $cat_id;
            $this->load->vars($data);
            $this->load->view('admin/template');
        }
    }

    function delete($n_id) {
        $this->db->where('n_id', $n_id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
        } else {            
            $data = '';
        }
        $m_type = $this->Mnews->GetCategory($data['n_category']);
        if($data != '')
        $this->Mnews->delete($n_id, $data);

        
        $this->File_model->del($n_id, $data['n_date']);
                
        $this->File_model->common4all();
        $this->File_model->home1();
        $this->File_model->home2();
        //cache delete start   
            $home = base_url();
            $home_page = 'https://www.revolution24.tv';

            $detailsNews = base_url() . $m_type['m_bangla'] . '/' . str_replace('-', '/', $data['n_date']) . '/' . $n_id;
            $detailNews = base_url() . $m_type['m_bangla'] . '/' . str_replace('-', '/', $data['n_date']) . '/' . $n_id.'/';
            
            DeleteCache(md5($home_page));
            
            $home_page = 'https://www.revolution24.tv/';
            DeleteCache(md5($home_page));

            // file_get_contents($home_page);
            $home_page = 'https://www.revolution24.tv/index.php';
            DeleteCache(md5($home_page));
            // file_get_contents($home_page);
            $catNews = base_url() .'online/'.$m_type['m_bangla'];
            $catsNews = base_url() .'online/'. $m_type['m_bangla'].'/';
            //$ParentcatNews = base_url() . $m_type['m_bangla'].'/article';
            //$ParentcatsNews = base_url() . $m_type['m_bangla'].'/article/';

            DeleteCache(md5($catNews));
            DeleteCache(md5($catsNews));
            //DeleteCache(md5($ParentcatNews));
           // DeleteCache(md5($ParentcatsNews));
            DeleteCache(md5($home));
            DeleteCache(md5($detailNews));
            DeleteCache(md5($detailsNews));
        // //cache delete end
        $this->session->set_flashdata('message', 'News deleted');
        redirect('admin/news', 'refresh');
    }
    
    
     function add_live($n_id){
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('n_details_live', 'News Details', 'required');
            if ($this->form_validation->run() == TRUE) {
                $id = $this->Mnews->create_live();
                //u_activity($activity='News Live Add', $type = 'News');
        

                // $this->clear_all_cache();
                $this->db->where('n_id', $n_id);
                $q = $this->db->get('news');
                if ($q->num_rows() > 0) {
                    $data = $q->row_array();
                } else {            
                    $data = '';
                }
                $m_type = $this->Mnews->GetCategory($data['n_category']);

                $this->File_model->common4all();
                $this->File_model->home1();
                $this->File_model->home2();

                //cache delete
                $home = base_url();
                DeleteCache(md5($home));
                $home_page = 'https://www.revolution24.tv';
                DeleteCache(md5($home_page));
                $home_page = 'https://www.revolution24.tv/';
                DeleteCache(md5($home_page));
                $home_page = 'https://www.revolution24.tv/index.php';
                DeleteCache(md5($home_page));
                
                $detailsNews = base_url() . $m_type['m_bangla'] . '/' . str_replace('-', '/', $data['n_date']) . '/' . $n_id;
                DeleteCache(md5($detailsNews));
                $detailNews = base_url() . $m_type['m_bangla'] . '/' . str_replace('-', '/', $data['n_date']) . '/' . $n_id.'/';
                DeleteCache(md5($detailNews));
                
                
                
                $catNews = base_url() . $m_type['m_bangla'];
                $catsNews = base_url() . $m_type['m_bangla'].'/';
                
                DeleteCache(md5($catNews));
                DeleteCache(md5($catsNews));

                $this->session->set_flashdata('message', 'News Updated');
                redirect('admin/news/add_live/'.$n_id, 'refresh');
            } else {
                $data['title'] = "Create News";
                $data['body'] = "news/news_live_add";
                $data['news_id'] = $n_id;
                $data['edit_data'] = $this->Mnews->get_by_id($n_id);
                $data['livelist'] = $this->Mnews->getLivenewsbyID($n_id);
                $this->load->vars($data);
                $this->load->view('admin/template');
            }
        } else {
            $data['title'] = "Create News";
            $data['body'] = "news/news_live_add";
            $data['news_id'] = $n_id;
            $data['edit_data'] = $this->Mnews->get_by_id($n_id);
            $data['livelist'] = $this->Mnews->getLivenewsbyID($n_id);
            $this->load->vars($data);
            $this->load->view('admin/template');
        }
    
    }
    
    
    function edit_live($n_id, $l_id = ''){
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('n_details_live', 'News Details', 'required');
            if ($this->form_validation->run() == TRUE) {
                $id = $this->Mnews->edit_live($l_id);
                //u_activity($activity='News Live Edit', $type = 'News');
        

                // $this->clear_all_cache();


                // $this->clear_all_cache();
                $this->db->where('n_id', $n_id);
                $q = $this->db->get('news');
                if ($q->num_rows() > 0) {
                    $data = $q->row_array();
                } else {            
                    $data = '';
                }
                $m_type = $this->Mnews->GetCategory($data['n_category']);

                $this->File_model->common4all();
                $this->File_model->home1();
                $this->File_model->home2();

                //cache delete
                $home = base_url();
                DeleteCache(md5($home));
                $home_page = 'https://www.revolution24.tv';
                DeleteCache(md5($home_page));
                $home_page = 'https://www.revolution24.tv/';
                DeleteCache(md5($home_page));
                $home_page = 'https://www.revolution24.tv/index.php';
                DeleteCache(md5($home_page));
                
                $detailsNews = base_url() . $m_type['m_bangla'] . '/' . str_replace('-', '/', $data['n_date']) . '/' . $n_id;
                DeleteCache(md5($detailsNews));
                $detailNews = base_url() . $m_type['m_bangla'] . '/' . str_replace('-', '/', $data['n_date']) . '/' . $n_id.'/';
                DeleteCache(md5($detailNews));
                
                $catNews = base_url() .'online/'.$m_type['m_bangla'];
                $catsNews = base_url() .'online/'. $m_type['m_bangla'].'/';
                //$ParentcatNews = base_url() . $m_type['m_bangla'].'/article';
                //$ParentcatsNews = base_url() . $m_type['m_bangla'].'/article/';
    
                DeleteCache(md5($catNews));
                DeleteCache(md5($catsNews));
                //DeleteCache(md5($ParentcatNews));
               // DeleteCache(md5($ParentcatsNews));
 

                $this->session->set_flashdata('message', 'News Updated');
                redirect('admin/news/add_live/'.$n_id, 'refresh');
            } else {
                $data['title'] = "Create News";
                $data['body'] = "news/news_live_edit";
                $data['news_id'] = $n_id;
                $data['edit_data'] = $this->Mnews->get_by_id($n_id);
                $data['live_data'] = $this->Mnews->get_live_by_id($l_id);
                $data['livelist'] = $this->Mnews->getLivenewsbyID($n_id);
                $this->load->vars($data);
                $this->load->view('admin/template');
            }
        } else {
            $data['title'] = "Create News";
            $data['body'] = "news/news_live_edit";
            $data['news_id'] = $n_id;
            $data['live_id'] = $l_id;
            $data['edit_data'] = $this->Mnews->get_by_id($n_id);
            $data['live_data'] = $this->Mnews->get_live_by_id($l_id);
            $data['livelist'] = $this->Mnews->getLivenewsbyID($n_id);
            $this->load->vars($data);
            $this->load->view('admin/template');
        }
    
    }
    
    
    function lndelete($id,$n_id) {
        $this->Mnews->lndelete($id);
        $this->session->set_flashdata('message', 'News deleted');
        redirect('admin/news/add_live/'.$n_id, 'refresh');
    }

    function clear_all_cache() {
        $CI = & get_instance();
        $path = $CI->config->item('');
        $cache_path = ($path == '') ? APPPATH . 'cache/' : $path;
        $handle = opendir($cache_path);
        while (($file = readdir($handle)) !== FALSE) {
            //Leave the directory protection alone
            if ($file != '.htaccess' && $file != 'index.html') {
                @unlink($cache_path . '/' . $file);
            }
        }
        closedir($handle);
    }

}
