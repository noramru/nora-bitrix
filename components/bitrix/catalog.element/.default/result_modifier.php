<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

// Записываем массив
$is_list = count($arResult['PROPERTIES']['PDF']['VALUE'] );
if ( $is_list > 0 ) { // Проверяем на наличие в PDF у карточки.
	
	$arResult['PDF_LIST']['TITLE'] = "Файлы для скачивания"; // Заголовок пока тут. Потом в параметры засунуть.
	$arResult['PDF_LIST']['SSL'] = (CMain::IsHTTPS()) ? "https://" : "http://";
	$arResult['PDF_LIST']['SITE_SERVER_NAME'] = SITE_SERVER_NAME;
	$pdf_icon = '<i class="far fa-file-pdf"></i>';
	$arResult['PDF_LIST']['ITEMS'] = NULL;

	for ($i=0; $i < $is_list; $i++) { 
		$arResult['PDF_LIST'][$i]['ID'] = $arResult['PROPERTIES']['PDF']['VALUE'][$i];
		$arResult['PDF_LIST'][$i]['LINK'] = $arResult['PDF_LIST']['SSL'].$arResult['PDF_LIST']['SITE_SERVER_NAME'].CFile::GetPath($arResult['PDF_LIST'][$i]['ID']);
		$arResult['PDF_LIST'][$i]['DESCRIPTION'] = $arResult['PROPERTIES']['PDF']['DESCRIPTION'][$i];

		$arResult['PDF_LIST']['ITEMS'] = $arResult['PDF_LIST']['ITEMS'] . '<li>' . $pdf_icon . '<a href="' . $arResult["PDF_LIST"][$i]["LINK"] . '" target="_blank" download="' . $arResult['PDF_LIST'][$i]['DESCRIPTION'] . ' - ' . $arResult['NAME'] . '">' . $arResult['PDF_LIST'][$i]['DESCRIPTION'] . '</a></li>';
	}
	$arResult['PDF_LIST']['ITEMS'] = '<h5>' . $arResult['PDF_LIST']['TITLE'] . '</h5><ul class="psd_listing">' . $arResult['PDF_LIST']['ITEMS'] . '</ul>';
}else{
	$arResult['PDF_LIST'] = NULL;
}

// ['PROPERTIES']['PDF']['VALUE'][0]
// $arResult['PROPERTIES']['PDF']['VALUE']; // Тут все данные.
	// $arResult['PDF_LIST']['ID'] = $arResult['PROPERTIES']['PDF']['VALUE'][0];
	// $arResult['PDF_LIST']['LINK'] = CFile::GetPath($arResult['PDF_LIST']['ID']);

// $arResult['PDF_LIST']['NAME'] = CFile::GetFileArray($arResult['PDF_LIST']['ID']);
	// $arResult['PDF_LIST']['NAME'] = count( $arResult['PROPERTIES']['PDF']['VALUE'] );
