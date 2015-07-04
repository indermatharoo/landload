tinyMCE.init({
	file_browser_callback : "tinyBrowser",
    mode : "exact",
    elements : wysiwyg_simple_elements,
    theme : "advanced",
    language : "en",
    apply_source_formatting : true,
    cleanup : true,
    verify_html : true,
    fix_list_elements : true,
    forced_root_block : 'p',
    inline_styles : true,
	fix_nesting : true,
    verify_css_classes : false,
    accessibility_warnings : false,
    entity_encoding : "raw",
    
    document_base_url : DWS_SITE_URL,
    relative_urls : true,
    
	//plugins : "inlinepopups,safari,fullscreen,visualchars,advlink,paste,contextmenu,table,advimage,advlink,media,contextmenu,xhtmlxtras,advlist",
    plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
	
	theme_advanced_buttons1 : "bold,|,italic,|,underline,|,justifyleft,|,justifycenter,|,justifyright,|,justifyfull,|,formatselect,fontsizeselect,|,pasteword,|,replace,|,bullist,|,numlist,|,blockquote,|,del,|,undo,|,redo",
	theme_advanced_buttons2 : "link,|,unlink,|,anchor,|,hr,|,removeformat,|,visualaid,|,sub,|,sup,|,charmap,|,code,|,ins,|,nonbreaking,|,insertdate,|,inserttime|,forecolor",
	
    
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    content_css : "templates/css/word.css",
    paste_use_dialog : true,
    theme_advanced_resizing : true,
    theme_advanced_resize_horizontal : false,
    paste_auto_cleanup_on_paste : true,
    paste_convert_headers_to_strong : false,
    paste_strip_class_attributes : "all",
    paste_remove_spans : false,
    paste_remove_styles : true,
    height : "300px",
    convert_fonts_to_spans: true
});