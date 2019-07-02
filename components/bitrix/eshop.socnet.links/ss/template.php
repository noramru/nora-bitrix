<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);

if (is_array($arResult["SOCSERV"]) && !empty($arResult["SOCSERV"]))
{
?>
<div class="bx-socialsidebar">
	<div class="bx-socialsidebar-group">
		<?
			if ($arParams['TARGET_BLANK']) {
				$target_blank = 'target="_blank" ';
			}else{
				$target_blank = "";
			}
		?>
		<ul>
			<?foreach($arResult["SOCSERV"] as $socserv):?>
			<li><a class="<?=htmlspecialcharsbx($socserv["CLASS"])?> bx-socialsidebar-icon" <?=$target_blank?>href="<?=htmlspecialcharsbx($socserv["LINK"])?>"></a></li>
			<?endforeach?>
		</ul>
	</div>
</div>
<?
}
?>