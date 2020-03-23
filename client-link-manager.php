<?php

$userId = 9; // ID пользователя

$userBy = "id";
$userOrder = "desc";

$userFilter = array(
    'ID' => $userId,
    'ACTIVE' => 'Y'
);

$userParams = array(
    'SELECT' => array('UF_MANAGER'),
    'NAV_PARAMS' => array(
        'nTopCount' => 1
    ),
);


echo '<pre>';
$filter = ["ID" => "9"];
$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter, $userParams); // выбираем пользователей
$is_filtered = $rsUsers->is_filtered; // отфильтрована ли выборка ?
while($rsUsers->NavNext(true, "f_")) :
    echo "[".$f_ID."] (".$f_LOGIN.") ".$f_NAME." ".$f_LAST_NAME." - ".$f_UF_MANAGER."<br>";	
endwhile;

$rsUser = CUser::GetByID(5);
$arUser = $rsUser->Fetch();
echo "<pre>"; print_r($arUser); echo "</pre>";
?>
