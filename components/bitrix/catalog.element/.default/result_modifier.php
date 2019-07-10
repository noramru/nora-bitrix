<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

/*
	Выводим PDF для скачивания.
	Надо ещё отметить в свойствах поля "Выводить поле для описания значения" и будет брать название из названия в библиотеке
 */
$is_list = count( $arResult['PROPERTIES']['PDF']['VALUE'] );

if ( is_array( $arResult['PROPERTIES']['PDF']['VALUE'] ) ) { // Проверяем на наличие в PDF у карточки.
	
	$arResult['PDF_LIST']['TITLE'] = "Файлы для скачивания:"; // Заголовок  и размер пока тут. Потом в параметры засунуть.
	$h = 'h5'; // Тип заголовка
	$arResult['PDF_LIST']['SSL'] = (CMain::IsHTTPS()) ? "https://" : "http://";
	$arResult['PDF_LIST']['SITE_SERVER_NAME'] = SITE_SERVER_NAME;
	$pdf_icon = '<i class="fa fa-file-pdf-o size" aria-hidden="true"></i> ';
	$arResult['PDF_LIST']['ITEMS'] = NULL;

 	for ($i=0; $i < $is_list; $i++) { 
		$arResult['PDF_LIST'][$i]['ID'] = $arResult['PROPERTIES']['PDF']['VALUE'][$i];
		$arResult['PDF_LIST'][$i]['LINK'] = $arResult['PDF_LIST']['SSL'].$arResult['PDF_LIST']['SITE_SERVER_NAME'].CFile::GetPath($arResult['PDF_LIST'][$i]['ID']);
		$arResult['PDF_LIST'][$i]['DESCRIPTION'] = $arResult['PROPERTIES']['PDF']['DESCRIPTION'][$i];

		$arResult['PDF_LIST']['ITEMS'] = $arResult['PDF_LIST']['ITEMS'] . '<li>' . $pdf_icon . '<a href="' . $arResult["PDF_LIST"][$i]["LINK"] . '" target="_blank" download="' . $arResult['PDF_LIST'][$i]['DESCRIPTION'] . ' - ' . $arResult['NAME'] . '">' . $arResult['PDF_LIST'][$i]['DESCRIPTION'] . '</a></li>';
	}
	$arResult['PDF_LIST']['ITEMS'] = '<'.$h.'>' . $arResult['PDF_LIST']['TITLE'] . '</'.$h.'><ul class="pdf_listing">' . $arResult['PDF_LIST']['ITEMS'] . '</ul>';
}else{
	$arResult['PDF_LIST'] = NULL;
}


/*
	Дополняем содержимое галереи схемой и комплектацией.
	Нужен заголовок и картинка.
 */
$arResult['PRODUCT_IMG']['SCHEMA'] = $arResult['PROPERTIES']['PRODUCT_SCHEMA'];
$arResult['PRODUCT_IMG']['PACK'] = $arResult['PROPERTIES']['PRODUCT_PACK'];