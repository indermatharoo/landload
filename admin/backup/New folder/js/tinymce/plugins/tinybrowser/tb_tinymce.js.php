<?php
session_start();

$_SESSION['DWS_TINYBROWSER_PATH'] = isset($_GET['DWS_PATH'])?$_GET['DWS_PATH']:'';
$_SESSION['DWS_TINYBROWSER_URL'] = isset($_GET['DWS_URL'])?$_GET['DWS_URL']:'';

require_once("config_tinybrowser.php");

$tbpath = pathinfo($_SERVER['SCRIPT_NAME']);
$tbmain = $tbpath['dirname'].'/tinybrowser.php';
?>

 function tinyBrowser (field_name, url, type, win) {

    /* If you work with sessions in PHP and your client doesn't accept cookies you might need to carry
       the session name and session ID in the request string (can look like this: "?PHPSESSID=88p0n70s9dsknra96qhuk6etm5").
       These lines of code extract the necessary parameters and add them back to the filebrowser URL again. */

    var cmsURL = "<?php echo $tbmain; ?>";    // script URL - use an absolute path!
    if (cmsURL.indexOf("?") < 0) {
        //add the type as the only query parameter
        cmsURL = cmsURL + "?type=" + type;
    }
    else {
        //add the type as an additional query parameter
        // (PHP session ID is now included if there is one at all)
        cmsURL = cmsURL + "&type=" + type;
    }

    tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Tiny Browser',
        width : <?php echo $_SESSION['tinybrowser']['window']['width']; ?>,
        height : <?php echo $_SESSION['tinybrowser']['window']['height']; ?>,
        resizable : "yes",
		  scrollbars : "yes",
        inline : "yes",  // This parameter only has an effect if you use the inlinepopups plugin!
        close_previous : "no"
    }, {
        window : win,
        input : field_name
    });
    return false;
  }