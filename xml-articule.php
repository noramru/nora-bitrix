<?php
/*
	Нужно:
		название
		цвет по русски
		сортировка в пределах
		ссылка на картинку
		данные
		привязка к карточке
	
 */
// БД NM
	$mysqli = new mysqli("127.0.0.1", "root", "", "nm_original");
	 // проверка соединения 
	if ($mysqli->connect_errno) {
	    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
	    exit();
	}
	// Все новости.
	$result = $mysqli->query("SELECT * FROM `prices_art` WHERE `prod_id` > 0 ORDER BY `prices_art`.`prod_id` ASC");
	if($result){
	    while ($row = $result->fetch_object()){
	        $art_data[] = $row;
	    }
	    $result->close();
	    $mysqli->next_result();
	}

$news_arr = array();
$sub_arr = array();
$i = 1;
	// echo "<pre>";
foreach ($art_data as $key => $value) {
	// print_r($value);
	foreach ($value as $key => $value2) {
		if ($key != 'articule')
			$sub_arr[$key] = $value2;
	}
	$news_arr[] = array('articule' => $value->articule, 'data' => $sub_arr );
}
	// print_r($news_arr);	
	// echo "</pre>";


$xml = new SimpleXMLElement('<xml/>');
$xml->addAttribute('encoding','UTF-8');

$groups = $xml->addChild('Артикулы'); // Основная группа

foreach ($news_arr as $key => $value) {

	$new = $groups->addChild('Артикул');
	$new->addChild('Ид',$key + 1);
	$new->addChild('КодПроизводителя',$value['articule']);
	$new->addChild('Наименование',$value['articule']);
	$new->addChild('БитриксТеги','');
	$new->addChild('Группы','');
	$new->addChild('Картинка','');	
		// $properties = $new->addChild('ЗначенияСвойств','');
		// 	$property = $properties->addChild('ЗначенияСвойства','');
		// 		$property->addChild('Ид','CML2_ACTIVE');
		// 		$property->addChild('Значение','true');
		// 	$property = $properties->addChild('ЗначенияСвойства','');
		// 		$property->addChild('Ид','CML2_CODE');
		// 		$property->addChild('Значение',$value['url']);
		// 	$property = $properties->addChild('ЗначенияСвойства','');
		// 		$property->addChild('Ид','CML2_SORT');
		// 		$property->addChild('Значение','500');
		// 	$property = $properties->addChild('ЗначенияСвойства','');
		// 		$property->addChild('Ид','CML2_ACTIVE_FROM');
		// 		$property->addChild('Значение',$value['date']);
		// 	$property = $properties->addChild('ЗначенияСвойства','');
		// 		$property->addChild('Ид','CML2_ACTIVE_TO');
		// 		$property->addChild('Значение','');
		// 	$property = $properties->addChild('ЗначенияСвойства','');
		// 		$property->addChild('Ид','CML2_PREVIEW_TEXT');
		// 		$property->addChild('Значение', htmlspecialchars( $value['prev_text']) );
		// 		$property->addChild('Тип','html');
		// 	$property = $properties->addChild('ЗначенияСвойства','');
		// 		$property->addChild('Ид','CML2_DETAIL_TEXT');
		// 		$property->addChild('Значение', htmlspecialchars( $value['full_test']) );
		// 		$property->addChild('Тип','html');
		// 	$property = $properties->addChild('ЗначенияСвойства','');
		// 		$property->addChild('Ид','CML2_PREVIEW_PICTURE');
		// 		$property->addChild('Значение','news_files/iblock/13b/13b5d2b26699284673f30e2e822f3863.jpg');
		// 	$property = $properties->addChild('ЗначенияСвойства','');
		// 		$property->addChild('Ид','171');
		// 		$property->addChild('Значение','');
	

}

Header('Content-type: text/xml');
print($xml->asXML());
