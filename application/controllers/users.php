<?php

/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends BB_Controller
{

    var $login_rules = array(array('field' => 'login', 'rules' => 'required'), array('field' => 'password', 'rules' => 'required'),);

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('translit_helper');
        $this->load->helper('messages_helper');
        $this->load->model('Users_model');
    }

    public function index()
    {
        echo '42';
    }

    public function logout()
    {
        if ($this->input->get('uid'))
        {
            $this->session->unset_userdata('userData');
            $this->session->sess_destroy();
        }
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }

    public function login()
    {
        //Проверяем соответствуют ли введенные пользователем данные правилам валидации
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->login_rules);
        if ($this->form_validation->run() == FALSE) //validation error. login and password fields are required
        {
            echo json_encode(array('success' => FALSE, 'errors' => array('reason' => printMessage('errorLoginValidation'))));
        }
        else
        {
            $this->load->model('Authorization_model');

            $auth_result = $this->Authorization_model->authorization($this->input->post('login'), hash('sha512', $this->input->post('password')));

            if ($auth_result)
            {
                $this->session->set_userdata(array('userData' => $auth_result));
                echo json_encode(array('success' => TRUE, 'redirect' => base_url()));
            }
            else
            {
                echo json_encode(array('success' => FALSE, 'errors' => array('reason' => printMessage('accessToDatabaseDeny'))));
            }
        }
    }

    public function getUserData()
    {
        if ($this->input->post('action') == 'getUserData' && intval($this->input->post('uid')))
        {
            $user = $this->Users_model->getUserById(intval($this->input->post('uid')));
            echo json_encode(array('success' => TRUE, 'totalCount' => 1, 'user' => $user[0]));
        }
    }


    public function generateLogin()
    {
        if ($this->input->post('f_name') && $this->input->post('l_name') && $this->input->post('m_name'))
        {
            $last = $this->input->post('l_name');
            $first = $this->input->post('f_name');
            $middle = $this->input->post('m_name');
            $login = translit(mb_strtolower($last));
            $login .= '_';
            $login .= translit(mb_strtolower(substr($first, 0, 2)));
            $login .= translit(mb_strtolower(substr($middle, 0, 2)));
            echo json_encode(array('success' => FALSE, 'login' => $login));
            exit;
        }
        else
        {
            echo json_encode(array('success' => FALSE, 'login' => ''));
            exit;
        }
    }

    public function pic($uid)
    {
        $uid = intval($uid);
        if ($uid > 0)
        {
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

    public function findSambaGroup()
    {

        $this->load->model('Usergroup_model');
        if (intval($this->input->post('usergroupid')))
        {
            $usergroupInfo = $this->Usergroup_model->getById(intval($this->input->post('usergroupid')));
            if ($usergroupInfo !== FALSE) {
                echo json_encode(array('success' => TRUE, 'sambaId' => $usergroupInfo['id_sambagroup_usergroup']));
            }
            else
            {
                echo json_encode(array('success' => FALSE, 'sambaId' => ''));
            }
        }
    }

    public function userUpdate()
    {
        $data = array();

        //if we get user ID - its UPDATE data
        //if ID is empty value - we need to create a new user record in our DB
        if (intval($_REQUEST['id']) > 0) $id_account = intval($_REQUEST['id']); //find - int
        if (intval($_REQUEST['pass_num']) > 0)
        {
            $data['number_pass_account'] = $_REQUEST['pass_num'];
        } //edit - int
        else
        {
            $this->sendErrorText(printMessage('e_pass_num'));
        }
        $data['id_status_account'] = $_REQUEST['status_name']; //edit -int
        $data['id_sambagroup_account'] = $_REQUEST['samba_group']; //edit -int
        $data['id_usergroup_account'] = $_REQUEST['user_group']; //edit -int
        $data['deleted_account'] = ''; //edit -bool
        //		$data['in_samba_account'] = $_REQUEST['login']; //system - no editable - bool
        $data['blocked_account'] = $_REQUEST['block']; //edit - bool
        $data['internet_lock_account'] = $_REQUEST['internet_lock']; //edit -bool
        //TODO(Vladimir Kopot): access_to_database_account - сделать разграничение прав доступа по каждому возможному полю
        $data['access_to_database_account'] = ''; //edit - bool
        $data['last_name_account'] = $_REQUEST['l_name']; //edit - str
        $data['first_name_account'] = $_REQUEST['f_name']; //edit - str
        $data['middle_name_account'] = $_REQUEST['m_name']; //edit - str
        $data['login_account'] = $_REQUEST['login']; //edit - str
        if (isset($_REQUEST['password'])) //edit - hash/SHA512 - str
        {
            $data['password_account'] = hash('sha512', $_REQUEST['password']);
        }
        else if ($_REQUEST['id'] == '') $data['password_account'] = hash('sha512', $data['number_pass_account']);
        if ($_REQUEST['delete_image'] != 1)
        {
            //edit - base64 - BLOB
            if (isset($_FILES['new_photo']) && strlen($_FILES['new_photo']['tmp_name']) > 0)
            {

                if ($_FILES['new_photo']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['new_photo']['tmp_name'])) $image = file_get_contents($_FILES['new_photo']['tmp_name']);
                //				$fname = $_FILES['new_photo']['tmp_name'];
                //				$file = fopen($fname, "r");
                //				$image = fread($file, filesize($fname));
                //				fclose($file);
                $data['picture_account'] = ($image);
            }
        }
        else
        {
            $data['picture_account'] = '';
        } //edit  - BLOB
        $data['shell_account'] = $_REQUEST['shell_name']; //edit - enum - str
        $data['quota_account'] = ''; //edit - str
        $data['account_note_account'] = ''; //edit - str

        if ($_REQUEST['id'] == '')
        {
            //create account
            $data['birthday_date_account'] = '0000-00-00'; //edit - date
            $data['create_date_account'] = date('Y-m-d H:i:s'); //system - no editable - date time
        }
        else
        {

        }
        $data['update_date_account'] = date('Y-m-d H:i:s'); //system - no editable - date time


        if (intval($_REQUEST['id']) > 0)
        {
            if ($this->Users_model->editUser($data, $id_account))
            {
                //редактируем существующего пользователя.
                //вносим изменения в самбу
                echo json_encode(array('success' => TRUE,));
            }
        }
        else
        {
            if ($this->Users_model->createUser($data))
            {
                //создаем в самбе пользователя
                echo json_encode(array('success' => TRUE,));
            }
        }


    }

    private function sendErrorText($msg)
    {
        echo json_encode(array('success' => FALSE, 'msg' => $msg));
        exit;
    }

}

/* End of file users.php */
/* Location: ./application/controllers/users.php */
