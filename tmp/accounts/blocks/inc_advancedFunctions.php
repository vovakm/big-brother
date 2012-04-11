<?php if ($_SESSION['user']['access_to_database'] == '2222222222222222') 
{
echo'<div class="titleMsg">Дополнительные модули</div><ul>
	<li><p><a href="index.php?e=advanced&v=importFromFile">Импортировать учетные записи из файла с разделителями</a></p></li>
  	<li><p><a href="index.php?e=advanced&v=importFromFilewBase">Импортировать учетные записи из файла с разделителями (список записей системы wBase)</a></p></li>
	</ul><hr>';

	switch ($_GET['v'])
	{
		case 'importFromFile':	
					if (is_file('blocks/advanced_variant/inc_importFromFile.php')) include_once('blocks/advanced_variant/inc_importFromFile.php');
					else UserInterface::warningTitle('Операция не может быть выполнена. Данного блока не существует');
					break;
		case 'importFromFilewBase':
					if (is_file('blocks/advanced_variant/inc_importFromFilewBase.php')) include_once('blocks/advanced_variant/inc_importFromFilewBase.php');
					else UserInterface::warningTitle('Операция не может быть выполнена. Данного блока не существует');
					break;
	
	}
}
else echo 'noo';
?>