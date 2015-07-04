<?php

$DWS_TINYBROWSER_PATH = $this->config->item('UPLOAD_PATH') . 'main_site';
$DWS_TINYBROWSER_URL = 'uploads/main_site/useruploads/';
?>
<script type="text/javascript">
    var wysiwyg_elements = 'answer';
    var wysiwyg_theme = 'advanced';
    var TEMPLATE = '#page_template';
</script>
<?php
global $DWS_MIN_JS_ARR, $DWS_JS_ARR, $DWS_MIN_CSS_ARR;

$DWS_JS_ARR[] = 'js/tinymce/tiny_mce.js';
$DWS_JS_ARR[] = "js/tinymce/plugins/tinybrowser/tb_tinymce.js.php?DWS_PATH=$DWS_TINYBROWSER_PATH&DWS_URL=$DWS_TINYBROWSER_URL";
$DWS_JS_ARR[] = 'js/site-editor.js';
?>