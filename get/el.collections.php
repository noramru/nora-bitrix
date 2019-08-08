<?php

CModule::IncludeModule("fileman");

CMedialib::Init();

// получим все элементы коллекции с идентификатором 1

$arItems = CMedialibItem::GetList(array('arCollections' => array("0" => 2)));

print_r( $arItems );
