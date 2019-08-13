<?php
/*
Выгрузка ТХ
 */

// БД NM
	$mysqli = new mysqli("127.0.0.1", "root", "", "nm_original");

	 // проверка соединения 
	if ($mysqli->connect_errno) {
	    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
	    exit();
	}

// `CaProCha`.`product_id`, `CatCatCha`.`name`, `CaProCha`.`value`, `CatCatCha`.`position`
	// Все характеристики.
$arr_prod_id = array(4,5,6,7,8,20,21,22,23,25,27,28,30,31,32,33,34,35,36,37,38,40,41,50,51,52,53,54,55,56,58,61,62,63,64,65,66,67,68,69,70,71,73,74,75,76,77,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,99,100,102,103,104,105,106,121,122,123,124,125,126,130,131,133,139,142,143,144,145,146,147,148,149,150,151,154,155,157,164,167,169,170,172,173,186,187,188,189,190,191,192,193,194,195,196,197,199,200,202,226,227,228,229,230,231,236,237,240,241,242,243,245,311,312,313,314,315,316,317,318,319,320,322,328,349,350,351,353,354,355,356,357,365,366,367,368,369,370,371,372,373,374,375,376,377,378,380,382,384,385,386,387,388,389,390,391,392,395,396,397,399,400,401,402,403,409,413,414,420,421,424,425,431,436,437,439,441,442,443,444,449,450,451,452,453,463,464,465,472,483,484,504,505,506,507,508,509,523,535,539,540,541,544,546,547,548,549,554,558,559,560,578,580,585,586,591,592,593,594,596,597,599,600,601,602,603,604,605,606,607,608,609,610,611,612,613,614,615,616,617,618,632,633,634,636,637,638,639,640,641,664,665,668,669,677,678,679,680,681,684,687,743,744,750,751,754,755,756,800,801,802,803,804,809,810,811,812,813,814,815,816,817,818,819,820,821,822,823,824,825,826,827,828,829,830,831,832,833,834,835,836,837,838,839,840,841,842,843,844,845,846,847,848,849,854,855,856,868,869,870,871,872,873,874,875,876,877,878,879,880,881,884,885,886,887,888,889,890,891,892,894,895,907,908,909,910,911,912,913,914,915,916,917,918,919,920,921,922,923,924,925,926,927,928,929,930,931,932,933,934,935,936,937,938,939,940,941,942,943,944,945,946,947,952,953,954,955,956,957,958,959,960,961,962,963,964,965,966,967,968,969,970,971,972,973,974,975,976,977,978,979,980,981,982,983,984,985,986,987,988,989,990,992,993,994,995,996,997,1000,1005,1006,1007,1008,1009,1010,1011,1012,1013,1018,1019,1020,1021,1022,1023,1024,1025,1026,1027,1028,1029,1030,1031,1032,1033,1034,1035,1036,1037,1038,1039,1040,1041,1042,1043,1044,1045,1046,1047,1048,1049,1050,1051,1052,1053,1054,1055,1056,1057,1058,1059,1060,1061,1062,1063,1064,1065,1066,1067,1068,1069,1070,1071,1072,1073,1074,1075,1076,1077,1078,1079,1080,1081,1082,1083,1086,1087,1088,1089,1091,1093,1096,1097,1098,1099,1100,1101,1102,1103,1104,1105,1106,1107,1108,1109,1110,1111,1112,1113,1114,1115,1116,1117,1118,1119,1120,1121,1122,1123,1124,1125,1126,1127,1128,1129,1130,1131,1132,1133,1134,1135,1136,1137,1138,1139,1140,1141,1142,1143,1144,1145,1146,1147,1148,1149,1150,1151,1152,1153,1154,1155,1156,1157,1158,1159,1160,1161,1162,1163,1164,1165,1166,1167,1168,1169,1170,1171,1172,1173,1174,1175,1176,1177,1178,1179,1180,1181,1182,1183,1184,1185,1186,1190,1191,1193,1195,1196,1197,1198,1199,1200,1201,1203,1204,1205,1208,1209,1210,1218,1219,1220);
echo "<pre>";

$arr = array();
$brr = array();
$crr = array();
$arr_name = array();


$alfa = 0;
for ($i = 0; $i < count($arr_prod_id); $i++) {
	$query = "SELECT `CaProCha`.`product_id`, `CatCatCha`.`name`, `CaProCha`.`value`, `CatCatCha`.`position`
	FROM `catalog_products_chars` AS CaProCha
	LEFT JOIN
		`catalog_category_chars` AS CatCatCha
	ON
		CatCatCha.`id` = CaProCha.`char_id`
	LEFT JOIN 
		`catalog_product_colors` AS CaProCol
	ON 
		CaProCol.`id` = CaProCha.`value`
	RIGHT JOIN 
		`catalog_category_chars` As NameColor
	ON
		NameColor.`id` = CaProCha.`char_id`
	WHERE CaProCha.`product_id` = '" . $arr_prod_id[$i] . "'
	AND `show_on_product` = 1
	GROUP BY CatCatCha.`id`
	ORDER BY `CaProCha`.`product_id` ASC";

	$result = $mysqli->query($query);

	if ($result) {
		$row = $result->fetch_object();
		// print_r( $row );

		while ($row = $result->fetch_object()) {

			$product_id = $row->product_id; $name = $row->name; $value = $row->value; $position = $row->position;
			++$alfa;
							
			// $arr_name[] = json_decode(json_encode($row), true);
			$arr_name[] = array('product_id' => $product_id, 'name' => $name, 'value' => $value, 'position' => $position);

			if ( in_array($name, $arr) ) {
				//	Убираем копии
				echo "copy";
			}else{
				// echo $name;
				// print_r($arr);
				$arr[] = array( $name );
			}
		}		
	}
	$result->close();

}

// Группировка характеристик по карточкам. Начало.

$id_arr = array();
$last_arr = array();

foreach ($arr_name as $key => $value) {
	if ( !in_array( $value['product_id'], $id_arr ) ) {
		$id_arr[] = $value['product_id'];
		$key = array_search($value['product_id'], $id_arr);
		$last_arr[ $key ]  = array($value['product_id'], array($value['name'], $value['value'], $value['position']) );
	}
}
// Группировка характеристик по карточкам. Конец.
// print_r( $last_arr );

// Группировка характеристик по карточкам. Начало.

$id_arr = array();
$last_arr = array();

foreach ($arr_name as $key => $value) {
	if ( !in_array( $value['name'], $id_arr ) ) {
		$id_arr[] = $value['name'];
		$key = array_search($value['name'], $id_arr);
		// Вытащить вложенный массив, добавить переменную и засунить обратно.
		$last_arr[ $key ]  = array( $value['name'] );
		
		array_push( $last_arr[ $key ], array() );
		$arr = $last_arr[ $key ][1];

		// print_r( $arr );

		if ( !in_array($x, $arr) ) {
			$arr[] = $x;
			$last_arr[ $key ][1] = $arr;
			print_r($last_arr[ $key ][1]);
			// echo $x , "not is<br>";
		}else{
			// echo "is<br>";
		}

		// echo is_array($last_arr[ $key ]);
		// print_r($last_arr[ $key ][1]);
		// print_r($value['value']);
		// echo "<br>";

/*		echo is_array($value['value']);
		if ( !in_array( $value['value'], $last_arr[ $key ][1] ) ) {
			// echo "is it <br>";
		}else{
			// echo "not is it <br>";
		}
*/		// $t_arr = $last_arr[ $key ][1];
		// echo $last_arr[ $key ][1] , "<br>";
// echo gettype( $t_arr );

			// array_push($t_arr, $value['value']);
		// $last_arr[ $key ]  = array($value['name'], $t_arr );
	}
}
// Группировка характеристик по карточкам. Конец.

// print_r( $last_arr[3][1] );
// print_r( $last_arr );


	echo "</pre>";
