<?
// Я запустил в командной строке в админке
if (CModule::IncludeModule("iblock")):

	$ids = [];

	$arSelect = Array();
	$arFilter = Array("IBLOCK_ID"=>IntVal(5), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>3281), $arSelect);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		//print_r($arFields);
		$ids[] = ($arFields['ID']); // Оно!
	}

//print_r( $ids );
$VALUES = [];
$weight = [];
foreach($ids as $value) {

	$PRODUCT_IBLOCK_ID = 5;
	$PRODUCT_ID = $value;
	$db_props = CIBlockElement::GetProperty($PRODUCT_IBLOCK_ID, $PRODUCT_ID, array("sort" => "asc"), Array());
	    while ($ob = $db_props->GetNext())
	    {
				$VALUES[] = $ob['VALUE'];
	    }
	$weight[$PRODUCT_ID] = $VALUES[17];// Оно!!

}
//print_r($weight);

endif;


if (CModule::IncludeModule("catalog")):

foreach($weight as $key => $value) {
	$PRODUCT_ID = $key; // id товара

	//echo 'Код: ', $key ,  ' вес ' . $value , '       ';
	$arFields = array('WEIGHT' => $value);// зарезервированное количество
	CCatalogProduct::Update($PRODUCT_ID, $arFields);

}


endif;
