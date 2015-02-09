<?php
class msPluginCommon
 {
function greyBoxPlugin()
{
$ajs=PLUGIN_FOLDER.BROWSER_SEPERATOR.'greybox/'.'AJS.js';
$AJS_fx=PLUGIN_FOLDER.BROWSER_SEPERATOR.'greybox/'.'AJS_fx.js';
$gb_scripts=PLUGIN_FOLDER.BROWSER_SEPERATOR.'greybox/'.'gb_scripts.js';
$root=PLUGIN_FOLDER.BROWSER_SEPERATOR.'greybox/';
?>
<script type="text/javascript">
    var GB_ROOT_DIR = <?php echo $root; ?>;
</script>
 	<script type="text/javascript" src="<?php echo $ajs; ?>" /></script>
    <script type="text/javascript" src="<?php echo $AJS_fx; ?>" /></script>
    <script type="text/javascript" src="<?php echo $gb_scripts; ?>" /></script>
<?php
}

 }
 ?>
