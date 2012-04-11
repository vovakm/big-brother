<?php
UserInterface::normalTitle('Импортировать учетные записи из файла с разделителями (список записей системы wBase)');
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
			/*
			 * парсинг по структуре
			 * 
			 * 0  неопределенное поле
			 * 1  признак удаления
			 * 2  юзернейм
			 * 3  ФИО
			 * 4  самбагруппа
			 * 5  язык
			 * 6  shell
			 * 7  0:0:0:0:0 уровень доступа к базе
			 * 8  блокировка
			 * 9  0:0:0:0 квота
			 * 10 статус
			 * 11 учебная группа
			 * 12 номер пропуска спереди
			 */
			
    		$file_arr = file($_FILES['filepath']['tmp_name']); 
    		//Получаем список пользователей самбы. с добавлением в БД
			Control::parserCheckSecondaryTables($file_arr, $separator, 4, 'samba');
			//Получаем список статусов (студ, проп, лиц). с добавлением в БД
			Control::parserCheckSecondaryTables($file_arr, $separator, 10, 'status');
			//Получаем список групп(КСиС-116). с добавлением в БД
			Control::parserCheckSecondaryTables($file_arr, $separator, 11, 'group');
			
			$sambaArr = array_flip(Database::getAllSambaGroups());
			$stausesArr = array_flip(Database::getAllStatuses());
			$groupsArr = array_flip(Database::getAllUserGroups());
			
			$unknownErr = array();
			$noPassNumber = array();
			$dublicateUsername = array();
			$deleted = array();

			$i = 0;
			$tt = array(' '=>'', '  '=>'', '   '=>'');
			foreach ($file_arr as $value)
			{
				$tmp = explode($separator, iconv("windows-1251","utf-8", $value));
				if ($tmp[1] != 'delete')
					if (Database::countSearchRows('accounts', 'login', $tmp[2]) == 0)
						if ((preg_replace('/^0+/', '', trim($tmp[12])) != '') || (trim($tmp[4]) == 'wheel') || (trim($tmp[4]) == 'teachers'))
						{
							if ($tmp[8] == 'False') $int_block = 2; else $int_block = 1;
							if ($tmp[7] == '1023:1023:1023:1023:1023')	$vch_access_to_db = '2222222222222222';
								elseif ($tmp[7] == '0:0:0:0:0') 			$vch_access_to_db = '0000000000000000';
								else  $vch_access_to_db = '1111111111211111';
								
							if(trim($tmp[10]) != '') $int_stat = $stausesArr[mb_strtolower(strtr($tmp[10], $tt),'utf-8')]; else $int_stat = 1;
							if(trim($tmp[4]) != '') $int_samba = $sambaArr[trim($tmp[4])]; else $int_samba = 1;
							if(trim($tmp[11]) != '') $int_groupe = $groupsArr[mb_strtolower(strtr($tmp[11], $tt),'utf-8')]; else $int_groupe = 1;	
							
							if (1)//правильность выполнения скрипта
							{
								if(Database::addToAccounts(trim($tmp[12]), $int_stat, $int_samba,$int_groupe, '0', '0', $int_block,'2', $vch_access_to_db, $tmp[3],	$tmp[2], $tmp[12], '',$tmp[6], $tmp[9], '','', @date('Y-m-d H:i:s'), @date('Y-m-d H:i:s')))
									$i++;
								else array_push($unknownErr, $value);
								//insert
							}
						}
						else array_push($noPassNumber, $value);
												
					else array_push($dublicateUsername, $value);
					
				else array_push($deleted, $value);
					
					
			}
			$unkErr = fopen ("files/reswBase/unknownError.txt","w");
			$noPasNum = fopen ("files/reswBase/noPassNumber.txt","w");
			$dublic = fopen ("files/reswBase/dublicateUsername.txt","w");
			$del = fopen ("files/reswBase/deleted.txt","w");
  			foreach ($unknownErr as $value) {
	  			fwrite($unkErr, $value);
  			}
  			foreach ($noPassNumber as $value) {
	  			fwrite($noPasNum, $value);
  			}
  			foreach ($dublicateUsername as $value) {
  				fwrite($dublic, $value);
  			}
  			foreach ($deleted as $value) {
  				fwrite($del, $value);
  			}

  			fclose ($unkErr);
  			fclose ($noPasNum);
  			fclose ($dublic);
  			fclose ($del);
						
		UserInterface::warningTitle('Добавление завершено. Внесено учетных записей:'.$i);
		
		}
		else UserInterface::warningTitle('Только файлы *.txt или *.log');
	}
}
?>