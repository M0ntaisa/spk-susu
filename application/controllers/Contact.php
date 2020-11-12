<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function index()
    {
        $data = array(
            'title'     =>  "Contact",
            'isi'       =>  "contact/list"
        );

        $this->load->view('layout/wrapper', $data, FALSE);
        
    }

}

/* End of file Contact.php */
