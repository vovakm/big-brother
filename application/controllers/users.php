<?php

/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Users extends CI_Controller
{

	var $login_rules = array(array('field' => 'login', 'rules' =>
	'required'), array('field' => 'password', 'rules' => 'required'),);

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo '42';
	}

	public function logout()
	{
		$this->session->unset_userdata('userData');
		redirect(base_url(), 'refresh');
	}

	public function login()
	{
		//Проверяем соответствуют ли введенные пользователем данные правилам валидации		
		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->login_rules);
		if ($this->form_validation->run() == FALSE) //validation error. login and password fields are required
			echo json_encode(array('status' => 'no', 'errorMsg' => printMessage('errorLoginValidation')));
		else
		{
			$this->load->model('Authorization_model');

			$auth_result = $this->Authorization_model->authorization(
				$this->input->post('login'), $this->input->post('password')
			);

			if ($auth_result)
			{
				$this->session->set_userdata(array(
					'userData' => $auth_result
				));
				echo json_encode(array('status' => 'ok', 'redirect' => base_url()));
			}
			else
				echo json_encode(array('status' => 'no', 'errorMsg' => printMessage('accessToDatabaseDeny')));
		}
	}

	public function getUserData()
	{
		if ($this->input->post('action') == 'getUserData' && intval($this->input->post('uid')))
		{
			$this->load->model('Users_model');
			$user = $this->Users_model->getUserById(intval($this->input->post('uid')));
			echo json_encode(array(
				'success' => TRUE,
				'totalCount' => 1,
				'user' => $user[0]
			));
		}
	}

	public function pic($uid)
	{
		$uid = intval($uid);
		if ($uid > 0)
		{
			$this->load->model('Users_model');
			$image = $this->Users_model->showPhoto($uid);
			if ($image === FALSE || $image == '' || strlen($image) < 10)
			{
				$fname = 'images/system/user_no_photo.png';
				$file = fopen($fname, "r");
				$image = (fread($file, filesize($fname)));
				fclose($file);
			}
			header("Content-type: image/*");
			echo $image;
		}
	}

    public function userUpdate()
    {
//            print_r($_REQUEST);
        $data = array();
        $data['id'] = intval($_REQUEST['id']);
        $data['login'] = $_REQUEST['login'];

        echo json_encode(array(
            'success' => TRUE,
            $data
        ));
    }

}

/* End of file users.php */
/* Location: ./application/controllers/users.php */
