<?php

if ($this->session->userdata['type'] == 10) {
    // For Super Admin
    ?>
    <li><a class="ajax-link" href="admin/dashboard"><i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>
    <li><a class="ajax-link" href="admin/menu"><i class="icon-th"></i><span class="hidden-tablet"> Menu Module</span></a></li>    
    <li><a class="ajax-link" href="admin/news"><i class="icon-th-list"></i><span class="hidden-tablet"> News Module</span></a></li>
    <li><a class="ajax-link" href="admin//sort_news"><i class="icon-th-list"></i><span class="hidden-tablet"> News Sorting</span></a></li>    
    <!--<li><a class="ajax-link" href="admin/dashboard/pool_list"><i class="icon-eye-open"></i><span class="hidden-tablet"> Poll Module</span></a></li>-->    
    <li><a class="ajax-link" href="admin/dashboard/scroll_list"><i class="icon-list-alt"></i><span class="hidden-tablet"> Breaking News / Headlines Module</span></a></li>
    <li><a class="ajax-link" href="admin/banner/"><i class="icon-picture"></i><span class="hidden-tablet"> Banner Module</span></a></li>
    <li><a class="ajax-link" href="admin/photo_gallery/"><i class="icon-camera"></i><span class="hidden-tablet"> Photo Gallery</span></a></li>
    <li><a class="ajax-link" href="admin/video_gallery/"><i class="icon-camera"></i><span class="hidden-tablet"> Video Gallery</span></a></li>
    <!--<li><a class="ajax-link" href="admin/profile/"><i class="icon-leaf"></i><span class="hidden-tablet"> Writers Profile</span></a></li>  -->             
    <li><a class="ajax-link" href="admin/users"><i class=" icon-user"></i><span class="hidden-tablet"> User Module</span></a></li>
    <!--<li><a class="ajax-link" href="admin/special_event"><i class="icon-th"></i><span class="hidden-tablet"> Special Event</span></a></li>
    <li><a class="ajax-link" href="admin/tag_topics/tag_entry"><i class="icon-th"></i><span class="hidden-tablet"> Tag Topics</span></a></li>-->
    <?php
} 
    ?>
	
	



<!--<li><a class="ajax-link" href="admin/text_module"><i class="icon-th"></i><span class="hidden-tablet"> Miscellaneous</span></a></li>-->
