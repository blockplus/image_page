<!-- TinyMCE -->
<script type="text/javascript" src="<?php echo site_url('tinymce/jscripts/tiny_mce/tiny_mce.js'); ?>"></script>
<!-- <script type="text/javascript" src="/powerpaste2/dist/powerpaste/plugin.js"></script> -->
<script type="text/javascript">
    tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "paste,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage," +
                    "advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace," +
                    "print,contextmenu,directionality,fullscreen,noneditable,visualchars,nonbreaking," +
                    "xhtmlxtras,template,wordcount,advlist,visualblocks",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
        add_unload_trigger: false,

        theme_advanced_default_font_size : '10pt',
        theme_advanced_default_font_family : 'Verdana',
        theme_advanced_fonts : "Andale Mono=andale mono,monospace;Arial=arial,helvetica,sans-serif;Arial Black=arial black,sans-serif;Book Antiqua=book antiqua,palatino,serif;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier,monospace;Georgia=georgia,palatino,serif;Helvetica=helvetica,arial,sans-serif;Impact=impact,sans-serif;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco,monospace;Times New Roman=times new roman,times,serif;Trebuchet MS=trebuchet ms,geneva,sans-serif;Verdana=verdana,geneva,sans-serif;Webdings=webdings;Wingdings=wingdings,zapf dingbats",
        theme_advanced_font_sizes : '8pt,9pt,10pt,11pt,12pt,14pt,16pt,18pt,20pt,22pt,24pt,28pt,36pt',
        paste_retain_style_properties: 'font-size,font-family,color',
        paste_remove_styles_if_webkit: false,

        powerpaste_word_import: 'merge',
        powerpaste_html_import: 'clean',
        powerpaste_allow_local_images: false,

        // Example content CSS (should be your site CSS)
        // content_css : "css/content.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "lists/template_list.js",
        external_link_list_url : "lists/link_list.js",
        external_image_list_url : "lists/image_list.js",
        media_external_list_url : "lists/media_list.js",

        // Style formats
        style_formats : [
            {title : 'Bold text', inline : 'b'},
            {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
            {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
            {title : 'Example 1', inline : 'span', classes : 'example1'},
            {title : 'Example 2', inline : 'span', classes : 'example2'},
            {title : 'Table styles'},
            {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
        ],

        // Replace values for the template plugin
        template_replace_values : {
            username : "Some User",
            staffid : "991234"
        }
    });
</script>
<!-- /TinyMCE -->