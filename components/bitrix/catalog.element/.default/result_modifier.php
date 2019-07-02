<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();


// ['PROPERTIES']['PDF']['VALUE'][0]
$arResult['PDF_LIST']['TITLE'] = "Файлы для скачивания";
// Записываем массив
// $arResult['PROPERTIES']['PDF']['VALUE']; // Тут все данные.
$arResult['PDF_LIST']['ID'] = $arResult['PROPERTIES']['PDF']['VALUE'][0];
$arResult['PDF_LIST']['LINK'] = CFile::GetPath($arResult['PDF_LIST']['ID']);