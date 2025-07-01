<?php

class Model_details extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function banner_by_id($id) {

        $this->db->where('m_id', $id);
        $q = $this->db->get('menu');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        } else {
            return NULL;
        }
    }

    function banner_by_nid($id) {
        $this->db->where('n_id', $id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $this->db->where('m_id', $data['n_category']);
            $mn = $this->db->get('menu');
            $name = $mn->row_array();
            return $name;
        }
    }

    function child_menu($id) {
        $this->db->where('m_parent', $id);
        $this->db->where_not_in('m_parent', 0);
        $q = $this->db->get('menu');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            //print_r($data);
            return $data;
        } else {
            return NULL;
        }
    }

    function child_ids($id) {
        //$multi[0] = $id;
        $this->db->SELECT('m_id');
        $this->db->where('m_parent', $id);
        $this->db->where_not_in('m_parent', 0);
        $q = $this->db->get('menu');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            foreach ($data as $key => $value) {
                $multi[] = $value['m_id'];
                //print_r($multi);
                $this->db->SELECT('m_id');
                $this->db->where('m_parent', $value['m_id']);
                $q2 = $this->db->get('menu');
                if ($q2->num_rows() > 0) {
                    $data2 = $q2->result_array();
                    //$i = 1;
                    foreach ($data2 as $key => $value) {
                        $multi[] = $value['m_id'];
                        //$i++;
                    }
                }
            }
            $multi[] = $id;
            $all_mid = array_unique($multi);
            //print_r($all_mid);
            return $all_mid;
        } else {
            return NULL;
        }
    }

    function notice($id) {
        $this->db->limit(1);
        $this->db->where('sn_cat', $id);
        $this->db->where('sn_status', 1);
        $q = $this->db->get('sticky_notes');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        } else {
            return NULL;
        }
    }

    function details($id) {
        $this->db->limit(1);
        $this->db->where('n_id', $id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
//            print $this->db->last_query();
            return $data;
        }
    }

    function related_news_count($id) {
        $this->db->limit(1);
        $this->db->where('n_id', $id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            if ($data['related_tag_id'] != NULL) {
                $this->db->where('related_tag_id', $data['related_tag_id']);
                $query = $this->db->get('news');
                if ($query->num_rows() > 0) {
                    $related_news = $query->result_array();
                    return count($related_news);
                }
            }
        }
    }

    function related_news($id, $limit) {
        $this->db->limit(1);
        $this->db->where('n_id', $id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            if ($data['related_tag_id'] != "") {
                $rel = explode(',', $data['related_tag_id']);
                foreach ($rel as $v) {
                    //echo $v;
                    //echo $v['tags'];
                    $this->db->like('related_tag_id', $v);
                    $this->db->where('n_id !=', $id);
                    //$this->db->limit($limit);
                    $query = $this->db->get('news');
                    //print $this->db->last_query();
                }

                if ($query->num_rows() > 0) {
                    $related_news = $query->result_array();
                    return $related_news;
                }
                return NULL;
            }
        }
    }
    
    function previous($id, $n_category) {
        $this->db->limit(1);
        $this->db->where('n_category', $n_category);
        $this->db->where('n_id >', $id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        }
        return NULL;
    }

    function next($id, $n_category) {
        $this->db->limit(1);
        $this->db->order_by('n_id', 'desc');
        $this->db->where('n_category', $n_category);
        $this->db->where('n_id <', $id);
        $q = $this->db->get('news');
 //echo $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        }
        return NULL;
    }

    function getTagNews($tag_name){
        $this->db->where('tag_name', $tag_name);
        $query = $this->db->get('tag_topics');
        echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
            return $data;
        } else {
            $data = NULL;
        }
    }


    /* function related_news($id, $limit) {
      $this->db->limit(1);
      $this->db->where('n_id', $id);
      $q = $this->db->get('news');
      if ($q->num_rows() > 0) {
      $data = $q->row_array();
      $sql = 'SELECT * from news WHERE related_tag_id =' . $data['related_tag_id'] . ' ORDER BY n_id desc ' . $limit;
      $q = $this->db->query($sql);
      if ($q->num_rows() > 0) {
      $related_news = $q->result_array();
      return $related_news;
      }
      }
      } */

    function cat_news_head($id) {
        $this->db->where('n_category', $id);
        $this->db->order_by('n_id', 'desc');
        $this->db->limit(5);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $i = 0;
            foreach ($q->result_array()as $key => $val) {
                $j = count($val);
                if ($i == 0) {
                    if ($val['main_image'] != '') {
                        echo '<img src="' . base_url() . 'assets/news_images/'.str_replace('-','/',$val['n_date']).'/' . $val['main_image'] . '" width="230px" style="max-height:200px;padding-bottom:5px;float:left;" />';
                        echo '<ul style="float:left; width:50%;">';
                    } else {
                        echo '<img src="' . base_url() . 'assets/importent_images/db_fake_pic.jpg' . '" width="230px" style="max-height:200px; padding-bottom:5px;float:left;" />';
                        echo '<ul style="float:left; width:50%;">';
                    }
                }
                echo ' <a href="news/details/' . $val['n_id'] . '"><li style="padding:3px 0 3px 0;text-align:left;">' . splitText(strip_tags($val['n_head']), 100) . "..." . '</li></a>';
                $i = $i + 1;
                if ($i == $j) {
                    echo '</ul>';
                }
            }
        } else {
            return NULL;
        }
    }

    function more_news_count($id) {
        $this->db->where('n_id', $id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            if ($data['n_category'] == 50) {
                $this->db->where('profile_id', $data['profile_id']);
            } elseif ($data['n_category'] == 33) {
                $this->db->where('profile_id', $data['profile_id']);
            } else {
                $this->db->where('n_category', $data['n_category']);
            }
            $mr = $this->db->get('news');
            return $mr->num_rows();
        }
    }

    function more_items_news_count($id) {
        $this->db->where_in('n_category', $id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            return $q->num_rows();
        }
    }

    function one_item_news_count($id) {
        $this->db->where('n_category', $id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            return $q->num_rows();
        }
    }

    function more_name($id) {
        $this->db->where('n_id', $id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $this->db->where('m_id', $data['n_category']);
            $mn = $this->db->get('menu');
            $name = $mn->row_array();
            return $name;
        }
    }

    function columist_name($id) {
        $this->db->where('n_id', $id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $this->db->where('p_id', $data['profile_id']);
            $mn = $this->db->get('profiles');
            $name = $mn->row_array();
            return $name['p_name'];
        }
    }

    function item_name($id) {
        $this->db->where('m_id', $id);
        $q = $this->db->get('menu');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $bre[] = $data;
            $this->db->where('m_id', $data['m_parent']);
            $q1 = $this->db->get('menu');
            if ($q1->num_rows() > 0) {

                $data1 = $q1->row_array();
                $bre[] = $data1;


                $this->db->where('m_id', $data1['m_parent']);
                $q2 = $this->db->get('menu');

                if ($q2->num_rows() > 0) {
                    $data2 = $q2->row_array();
                    $bre[] = $data2;

                    return array_reverse($bre);
                }
                return array_reverse($bre);
            }
            return array_reverse($bre);
        }
        return NULL;
    }

    function more_news($id, $limit) {
        $this->db->limit(1);
        $this->db->where('n_id', $id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            if ($data['n_category'] == 50) {
                $sql = 'SELECT * from news WHERE profile_id =' . $data['profile_id'] . ' ORDER BY n_id desc ' . $limit;
            } elseif ($data['n_category'] == 33 OR $data['n_category'] == 76 OR $data['n_category'] == 237 OR $data['n_category'] == 238 OR $data['n_category'] == 239 OR $data['n_category'] == 240 OR $data['n_category'] == 241 OR $data['n_category'] == 243 OR $data['n_category'] == 244 OR $data['n_category'] == 245 OR $data['n_category'] == 246 OR $data['n_category'] == 247 OR $data['n_category'] == 248 OR $data['n_category'] == 249 OR $data['n_category'] == 250) {
                $sql = 'SELECT * from news WHERE profile_id =' . $data['profile_id'] . ' ORDER BY n_id desc ' . $limit;
                //echo $sql;
            } else {
                $sql = 'SELECT * from news WHERE n_category =' . $data['n_category'] . ' ORDER BY n_id desc ' . $limit;
            }
            $q = $this->db->query($sql);
            // print $this->db->last_query();
            if ($q->num_rows() > 0) {
                $more_news = $q->result_array();
                return $more_news;
            }
        }
    }

    function more_items_news($mid, $limit) {
        /* $sql = "SELECT * from news WHERE n_category IN (" .$mid. ") ORDER BY n_id desc " . $limit;
          echo $this->db->last_query();
          $q = $this->db->query($sql); */

        $this->db->order_by('n_id', 'desc');
        $this->db->where_in('n_category', $mid);
        $this->db->limit(12, $limit);
        $q = $this->db->get('news');
// echo $this->db->last_query();
        if ($q->num_rows() > 0) {
            return $q->result_array();
        }
    }

    function news_before($id) {
        $this->db->limit(1);
        $this->db->where('n_id >', $id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data['n_id'];
        }
        return NULL;
    }

    function news_after($id) {
        $this->db->limit(1);
        $this->db->order_by('n_id', 'desc');
        $this->db->where('n_id <', $id);
        $q = $this->db->get('news');
// echo $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data['n_id'];
        }
        return NULL;
    }

    function special_items($id) {
        $this->db->where('item_parent_id', $id);
        $this->db->order_by('item_order', 'asc');
        $q = $this->db->get('inner_menu_items');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        } else {
            return NULL;
        }
    }

    function important_links($id) {
        $this->db->where('il_menu', $id);
        $this->db->order_by('il_order', 'asc');
        $q = $this->db->get('important_links');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        } else {
            return NULL;
        }
    }

    ////Comments


    function comment_entry($id) {
        $this->db->where('u_id', $this->session->userdata('u_id'));
        $q = $this->db->get('user_login');
        if ($q->num_rows() > 0) {
            $val = $q->row_array();
        }
        $data = array(
            'news_id' => $id,
            'user_name' => $val['u_name'],
            'user_email' => $val['u_email'],
            'user_comments' => $_POST['comment'],
            'dt' => date('Y-m-d H:i:s')
        );
        $this->db->insert('comments', $data);
    }

    function comment_list($id) {
        $this->db->where('news_id', $id);
        $this->db->order_by('c_id', 'asc');
        $q = $this->db->get('comments');
        if ($q->num_rows() > 0) {
            echo ' <div class="span9 details pull-left visible-desktop" style="margin:0 0 20px 0;">
        <ol class="commentlist">';
            foreach ($q->result_array() as $row) {
                $this->db->where('u_email', $row['user_email']);
                $this->db->limit(1);
                $query = $this->db->get('user_login');
                if ($query->num_rows() > 0) {
                    $data = $query->row_array();
                } else {
                    $data = NULL;
                }

                echo '<div class="span12 details pull-right">';
                echo '<div style="width:60%; float:left; color : #024EA2; font-weight: bold;">';
                if ($data['u_pic_location'] != '') {
                    echo '<img src="' . base_url() . 'assets/images/user_image/thmubs/' . $data['u_pic_location'] . '" style="height:70px;" />';
                } else if ($data['u_sex'] == 'male') {
                    echo '<img src="' . base_url() . 'assets/images/user_image/male.png" />';
                } else {
                    echo '<img src=".assets/images/user_image/female.png" />';
                }
                echo $data['u_name'];
                echo '</div>';
                echo '<div style="float:right; width : 38%; margin-right:10px; text-align:right; padding-top:20px;">';
                echo $row['dt'];
                echo '</div>';
                echo '<div style="margin-left:70px; float:left;">';
                echo $row['user_comments'];
                echo '</div></div>';
            }
            echo '</ol></div>';
        }
    }

    ///Business Info
    function business_directory_cat($country) {
        $this->db->where('bus_country', $country);
        $this->db->order_by('bus_id', 'asc');
        $this->db->group_by('bus_city');
        $q = $this->db->get('business');
        if ($q->num_rows() > 0) {
            echo '<ul id="flexmenu2" class="flexdropdownmenu">';
            foreach ($q->result_array() as $row) {
                $this->db->where('place_id', $row['bus_city']);
                $q1 = $this->db->get('inner_menu_place');
                if ($q1->num_rows() > 0) {
                    foreach ($q1->result_array() as $rowcity) {
                        echo '<li><a href="#">' . $rowcity['place_name_bangla'] . '</a>';
                        $this->db->where('bus_city', $rowcity['place_id']);
                        $this->db->group_by('bus_type');
                        $this->db->from('business');
                        $this->db->join('business_type', 'business_type.bt_id = business.bus_type');
                        $q2 = $this->db->get();
                        if ($q2->num_rows() > 0) {
                            echo '<ul>';
                            foreach ($q2->result_array() as $rowbusiness) {
                                echo '<li><a href="./news/businesslist/' . $country . '/' . $rowbusiness['bus_type'] . '">' . $rowbusiness['bt_name_bangla'] . '</a>';
                            }
                            echo '</ul>';
                        }

                        echo '</li>';
                    }
                }
            }

            echo '</ul>';
        }
    }

    function get_all_business($country, $type) {
        $this->db->where('bus_country', $country);
        $this->db->where('bus_type', $type);
        $q = $this->db->get('business');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
            return $data;
        }
    }

    function businessName($country, $type, $limit) {
        $sql = 'SELECT * FROM business WHERE bus_country="' . $country . '" AND bus_type="' . $type . '" ORDER BY bus_name asc ' . $limit;
        $q = $this->db->query($sql);
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
    }

    function businessDetails($bus_id) {
        $this->db->where('bus_id', $bus_id);
        $q = $this->db->get('business');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        }
    }

    ///End Business Info
    ///Category Info
    function organization_directory_cat($country) {
        $this->db->where('org_country', $country);
        $this->db->order_by('org_id', 'asc');
        $this->db->group_by('org_city');
        $q = $this->db->get('organizations');
        if ($q->num_rows() > 0) {
            echo '<ul id="flexmenu1" class="flexdropdownmenu">';
            foreach ($q->result_array() as $row) {
                $this->db->where('place_id', $row['org_city']);
                $q1 = $this->db->get('inner_menu_place');
                if ($q1->num_rows() > 0) {
                    foreach ($q1->result_array() as $rowcity) {
                        echo '<li><a href="#">' . $rowcity['place_name_bangla'] . '</a>';
                        $this->db->where('org_city', $rowcity['place_id']);
                        $this->db->group_by('org_type');
                        $this->db->from('organizations');
                        $this->db->join('organization_category', 'organization_category.org_id = organizations.org_type');
                        $q2 = $this->db->get();
                        if ($q2->num_rows() > 0) {
                            echo '<ul>';
                            foreach ($q2->result_array() as $roworg) {
                                echo '<li><a href="./news/organizationlist/' . $country . '/' . $roworg['org_type'] . '">' . $roworg['org_cat'] . '</a>';
                            }
                            echo '</ul>';
                        }

                        echo '</li>';
                    }
                }
            }

            echo '</ul>';
        }
    }
    
     function get_all_organization($country, $type) {
        $this->db->where('org_country', $country);
        $this->db->where('org_type', $type);
        $q = $this->db->get('organizations');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
            return $data;
        }
    }

    function organizationName($country, $type, $limit) {
        $sql = 'SELECT * FROM organizations WHERE org_country="' . $country . '" AND org_type="' . $type . '" ORDER BY org_name asc ' . $limit;
        $q = $this->db->query($sql);
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
    }

    function organizationDetails($org_id) {
        $this->db->where('org_id', $org_id);
        $q = $this->db->get('organizations');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        }
    }

    ///End Category Info
}