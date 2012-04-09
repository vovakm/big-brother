<?php

/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */

class Authorization_model extends CI_Model
{



	public function authorization($login, $password)
	{
		$query = $this->db->query(
		'SELECT * FROM
			`ci_statuses`
			LEFT JOIN `myci`.`ci_accounts` ON `ci_statuses`.`id_status` = `ci_accounts`.`id_status` 
			LEFT JOIN `myci`.`ci_sambagroups` ON `ci_accounts`.`id_samba_group` = `ci_sambagroups`.`id_samba_group` 
			LEFT JOIN `myci`.`ci_usergroups` ON `ci_accounts`.`id_user_group` = `ci_usergroups`.`id_user_group` 
			WHERE 
				`login` = \'' . trim(($login)) . '\' AND 
				`password` = \'' . md5($password . $this->config->item('encryption_key')) . '\' AND 
				`deleted` = 0 AND
				`access_to_database` != \'0000000000000000\'
			LIMIT 1'
		);
		return $query->row();
		
	}

}

