<?php
if ($active_menu == 'home' && config_item('saas_front_slider') == 1) {
    $this->load->view('frontcms/frontend/slider');
} else {
    $this->load->view('frontcms/frontend/page_header');
}

if (!empty($page_info)) {
    if ($active_menu == 'contact-us') {
        $this->load->view('frontcms/frontend/contact');
    } elseif ($active_menu == 'pricing') {
        $this->load->view('frontcms/frontend/pricing');
    } else {
        echo $page_info->description;
    }
}
