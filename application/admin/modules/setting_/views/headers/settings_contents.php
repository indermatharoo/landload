<script type="text/javascript">
	var wysiwyg_elements = 'default_content';
	var wysiwyg_theme = 'advanced';
</script>
<?php
	global $DWS_MIN_JS_ARR, $DWS_JS_ARR, $DWS_MIN_CSS_ARR, $DWS_CSS_ARR;
	$DWS_MIN_CSS_ARR[] = 'css/page.css';    
        
	$DWS_JS_ARR[] = 'js/tinymce/tiny_mce.js';
	$DWS_JS_ARR[] = 'js/tinymce/plugins/tinybrowser/tb_tinymce.js.php';
	$DWS_JS_ARR[] = 'js/site-editor.js';
	$DWS_MIN_JS_ARR[] = 'js/page.js';
?>