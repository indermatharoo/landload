<?php
$DWS_TINYBROWSER_PATH = $this->config->item('UPLOAD_PATH');
$DWS_TINYBROWSER_URL = 'uploads/useruploads/';
?>
<script type="text/javascript">
var wysiwyg_elements = 'block_contents';
var TEMPLATE = '#block_template';
</script>
<?php
	global $DWS_MIN_JS_ARR, $DWS_JS_ARR, $DWS_MIN_CSS_ARR, $DWS_CSS_ARR;

	$DWS_MIN_CSS_ARR[] = 'css/page.css';
    //$DWS_MIN_CSS_ARR[] = 'js/jquery-ui/css/redmond/jquery-ui-1.8.17.custom.css';

    //$DWS_JS_ARR[] = 'js/jquery-ui/js/jquery-ui.min.js';
	$DWS_JS_ARR[] = 'js/tinymce/tiny_mce.js';
	$DWS_JS_ARR[] = "js/tinymce/plugins/tinybrowser/tb_tinymce.js.php?DWS_PATH=$DWS_TINYBROWSER_PATH&DWS_URL=$DWS_TINYBROWSER_URL";

	$DWS_JS_ARR[] = 'js/codemirror/lib/codemirror.js';
	$DWS_JS_ARR[] = 'js/codemirror/lib/util/formatting.js';
	$DWS_JS_ARR[] = 'js/codemirror/mode/css/css.js';
	$DWS_JS_ARR[] = 'js/codemirror/mode/xml/xml.js';
	$DWS_JS_ARR[] = 'js/codemirror/mode/javascript/javascript.js';
	$DWS_JS_ARR[] = 'js/codemirror/mode/htmlmixed/htmlmixed.js';
	$DWS_CSS_ARR[] = 'js/codemirror/lib/codemirror.css';
	
	$DWS_JS_ARR[] = 'js/site-editor.js';
	$DWS_JS_ARR[] = 'js/template.js';

?>
