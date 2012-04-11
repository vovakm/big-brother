<?php
UserInterface::normalTitle('Импортировать учетные записи из файла с разделителями');

if (!$_POST['do']) 
echo'
	<form name="import" action="" method="post" enctype="multipart/form-data" class="center normal">
		<fieldset>
			<legend>Загрузка базы учетных записей</legend><br/>
			<p><input name="filepath" type="file" value="" style="width:98%" title="Укажите текстовый файл" required></p><br/>
			<p><label>Укажите используемый разделитель</label><input name="separator" type="text" value="" style="width:120px" required></p><br/>
			<input name="do" style="width:150px; position: relative; left: 125px;"  type="submit" value="Отправить данные">
		</fieldset>
	</form>
';
else
{
	if ($_FILES['filepath']['error'] !== UPLOAD_ERR_OK)
			UserInterface::warningTitle('Файл не был загружен');
	elseif ($_POST['separator'] == '')
			UserInterface::warningTitle('Не указан разделитель');
	else
	{
		$flag = 0;
		$separator = $_POST['separator'];
		$whitelist = array(".txt", ".log");
		foreach ($whitelist as $item)
		if(preg_match("/$item\$/i", $_FILES['filepath']['name']))
			{$flag = 1;break;}
		if ($flag == 1)
		{
			//12134;Бодрова;Ксенія;Геннадіївна;06.12.1992;БО-118К;D:\Programming\Winter2007\Dekanat\Dekanat\Fotos\12400.jpg;
			/*
			 * 0 номер пропуска
			 * 1 Фамилия
			 * 2 Имя
			 * 3 Отчество
			 * 4 Дата рождения
			 * 5 Группа
			 * 6 Фотографи 
			 * */
			$file_arr = file($_FILES['filepath']['tmp_name']); 
			Control::parserCheckSecondaryTables($file_arr, $separator, 5, 'group');
			$localSamba = array();
			$sambaArr = (Database::getAllSambaGroups());
			foreach ($file_arr as $value)
			{ 
				$tmpArr = explode($separator, iconv("windows-1251","utf-8", $value));
				preg_match('/^([a-z]+).*/s', (Control::translateLine($tmpArr[5])), $m);
				if(!in_array($m[1], $localSamba))
					array_push($localSamba, $m[1]);
			}

			foreach ($localSamba as $value)
			{
				if (!in_array($value, $sambaArr))
					Database::addToSambaGroup($value, $value);
			}
			$specialUsername = array();
			$unknownErr = array(); 
			$dublicateUsername = array();
			$dublicatePassNum = array();
			$noPassNumber = array();
			$sambaArr = array_flip(Database::getAllSambaGroups());
			$stausesArr = array_flip(Database::getAllStatuses());
			$groupsArr = array_flip(Database::getAllUserGroups());
			$i = 0;
			$tt = array(' '=>'', '  '=>'', '   '=>'');
		foreach ($file_arr as $value)
			{
				$tmpArr = explode($separator, iconv("windows-1251","utf-8", $value));
				$adv = 0;
				if($tmpArr[0] != '')
				{
					if(Database::countSearchRows('accounts', 'number_pass', trim($tmpArr[0])) == 0)
					{
						$vch_login = Control::translateLine($tmpArr[1].'_'.substr($tmpArr[2], 0, 2).substr($tmpArr[3], 0, 2));
						if (Database::countSearchRows('accounts', 'login', $vch_login) != 0)
						{
							$vch_login = Control::translateLine($tmpArr[1].'_'.substr($tmpArr[2], 0, 6));
							$adv = 1;
						}
						if (Database::countSearchRows('accounts', 'login', $vch_login) == 0)
						{
							$litg = mb_strtolower(strtr($tmpArr[5], $tt),'utf-8');
							preg_match('/^([a-z]+).*/s', Control::translateLine($litg), $m);
							$int_samba = $sambaArr[$m[1]]; 
							$int_groupe = $groupsArr[trim($litg)];
							$int_stat = $stausesArr['студент'];
							$photo = explode('\\', $tmpArr[6]);
							$date = date_parse_from_format("d.m.Y", $tmpArr[4]);
							$d_bd = $date['year'].'-'.$date['month'].'-'.$date['day'];
							$qout = array("'''"=>"'","''''"=>"'","''"=>"'");
							$vch_name = htmlentities(strtr($tmpArr[1].' '.$tmpArr[2].' '.$tmpArr[3], $qout), ENT_QUOTES, 'UTF-8');
							if(1)
							{
								
								
								if(Database::addToAccounts(trim($tmpArr[0]), $int_stat, $int_samba, $int_groupe, '0', '0', 'Нет', 'Нормальный доступ', '1111111111211111', $vch_name, $vch_login, $tmpArr[0], end($photo), '3', '50000:75000:5000:7500', '', $d_bd, @date('Y-m-d H:i:s'), @date('Y-m-d H:i:s')))
								{
									$i++;
									if($adv == 1) array_push($specialUsername, $value);
								}
								else array_push($unknownErr, $value);
							}
						}
						else array_push($dublicateUsername, $value);
					}
					else array_push($dublicatePassNum, $value);
				}
				else array_push($noPassNumber, $value);
				
			}

			$specUser = fopen ("files/resImport/specialUsername.txt","w");
			$unkErr = fopen ("files/resImport/unknownError.txt","w");
			$dublic = fopen ("files/resImport/dublicateUsername.txt","w");
			$dubPass = fopen ("files/resImport/dublicatePassNumber.txt","w");
			$noPasNum = fopen ("files/resImport/noPassNumber.txt","w");
  			foreach ($specialUsername as $value) {
	  			fwrite($specUser, $value);
  			}
  			foreach ($unknownErr as $value) {
	  			fwrite($unkErr, $value);
  			}
  			foreach ($dublicateUsername as $value) {
  				fwrite($dublic, $value);
  			}
  			foreach ($dublicatePassNum as $value) {
  				fwrite($dubPass, $value);
  			}
			foreach ($noPassNumber as $value) {
  				fwrite($noPasNum, $value);
  			}
  			fclose ($specUser);
  			fclose ($unkErr);
  			fclose ($dublic);
  			fclose ($dubPass);
  			fclose ($noPasNum);

		UserInterface::warningTitle('Добавление завершено. Внесено учетных записей:'.$i);
		
		}
		else UserInterface::warningTitle('Только файлы *.txt или *.log');
	}
}
?>