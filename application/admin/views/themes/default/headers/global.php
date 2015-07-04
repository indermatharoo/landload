<script type="text/javascript">
    var DWS_BASE_URL = "<?php echo cms_base_url(); ?>";
    var DWS_SITE_URL = "<?php echo $this->config->item('site_url'); ?>";
</script>
<script src="<?php echo $this->config->item('base_url');; ?>js/jquery-1.10.2.min.js"></script>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">


<?php
global $DWS_MIN_JS_ARR, $DWS_JS_ARR, $DWS_MIN_CSS_ARR;
$DWS_MIN_CSS_ARR[] = 'css/bootstrap.css';
$DWS_MIN_CSS_ARR[] = 'css/bootstrap-multiselect.css';
$DWS_MIN_CSS_ARR[] = 'css/font-awesome.css';
$DWS_MIN_CSS_ARR[] = 'css/AdminLTE.min.css';
$DWS_MIN_CSS_ARR[] = 'css/style.css';
$DWS_MIN_CSS_ARR[] = 'css/daterangepicker/daterangepicker-bs3.css';


array_unshift($DWS_MIN_JS_ARR, 'js/jquery-1.10.2.min.js');
$DWS_MIN_JS_ARR[] = 'js/bootstrap.min.js';
$DWS_MIN_JS_ARR[] = 'js/bootstrap-multiselect.js';
$DWS_MIN_JS_ARR[] = 'js/daterangepicker/daterangepicker.js';
$DWS_MIN_JS_ARR[] = 'js/app.js';
$DWS_MIN_JS_ARR[] = 'js/editor.js';
$DWS_MIN_JS_ARR[] = 'js/bootbox.js';
$DWS_MIN_JS_ARR[] = 'js/bPopup.js';
//$DWS_MIN_JS_ARR[] = 'js/editor/tinymc' . 'e/tinymce.dev.js';
//$DWS_MIN_JS_ARR[] = 'js/editor/tinymce/plugins/table/plugin.dev.js';
//$DWS_MIN_JS_ARR[] = 'js/editor/tinymce/plugins/paste/plugin.dev.js';
//$DWS_MIN_JS_ARR[] = 'js/editor/tinymce/plugins/spellchecker/plugin.dev.js';
//$DWS_MIN_JS_ARR[] = 'js/editor/tinymce.setting.js';
$DWS_MIN_JS_ARR[] = 'js/html5lightbox/html5lightbox.js';

//$DWS_MIN_JS_ARR[] = 'js/commonEditor.js';
?>

 