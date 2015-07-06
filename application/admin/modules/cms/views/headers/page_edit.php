<?php
$DWS_TINYBROWSER_PATH = $this->config->item('UPLOAD_PATH') . 'main_site';
$DWS_TINYBROWSER_URL = 'upload/main_site/useruploads/';
?>
<script type="text/javascript">
	var wysiwyg_elements = 'contents';
	var wysiwyg_theme = 'advanced';
    var TEMPLATE = '#page_template';
	var DWS_TAB = <?php echo $tab; ?>;
	var DWS_PAGE_ID = <?php echo $page_details['page_id']; ?>
</script>
<?php
global $DWS_MIN_JS_ARR, $DWS_JS_ARR, $DWS_MIN_CSS_ARR;
	$DWS_MIN_CSS_ARR[] = 'css/page.css';    
	$DWS_MIN_CSS_ARR[] = 'css/menutree.css';
	$DWS_MIN_CSS_ARR[] = 'js/colorbox/skin_4/colorbox.css';

	$DWS_JS_ARR[] = 'js/tinymce/tiny_mce.js';
	$DWS_JS_ARR[] = "js/tinymce/plugins/tinybrowser/tb_tinymce.js.php?DWS_PATH=$DWS_TINYBROWSER_PATH&DWS_URL=$DWS_TINYBROWSER_URL";
	$DWS_JS_ARR[] = 'js/colorbox/jquery.colorbox.js';
	
	$DWS_JS_ARR[] = 'js/site-editor.js';
	

	//$DWS_MIN_JS_ARR[] = 'js/jquery.ui.nestedSortable.js';
	//$DWS_MIN_JS_ARR[] = 'js/website/widgets.js';
	//$DWS_MIN_JS_ARR[] = 'js/website/video_overlay.js';
?>