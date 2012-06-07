<?php

/*
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */


class BB_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kuwait');
        $udata = $this->session->userdata('userData');
        if (!is_array($udata) || $udata['access_to_database'] < 0 || $udata['id'] < 0)
        {
            if (current_url() !== '/login' && current_url() !== '/users/login') redirect('/login', 'location', 301);
        }

    }
}