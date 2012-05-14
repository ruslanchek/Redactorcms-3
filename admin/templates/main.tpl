<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>{$core->module.title}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" href="/admin/resources/css/style.css" media="all" />
        <link rel="stylesheet" href="/admin/resources/plugins/fancybox/source/jquery.fancybox.css" media="all" />
        <link rel="stylesheet" href="/admin/resources/plugins/redactor/js/redactor/css/redactor.css" media="all" />
        <link rel="stylesheet" href="/admin/resources/plugins/iphone_checkboxes/style.css" media="all" />
        <link rel="stylesheet" href="/admin/resources/plugins/chosen/chosen.css" media="all" />
        <link rel="stylesheet" href="/admin/{$core->module.name}/css/{$core->module.name}.css" media="all" />

        <script src="/admin/resources/js/jquery.js"></script>
        <script src="/admin/resources/js/jquery.cookie.js"></script>
        <script src="/admin/resources/js/jquery-ui-1.8.16.custom.min.js"></script>
        <script src="/admin/resources/plugins/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
        <script src="/admin/resources/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
        <script src="/admin/resources/plugins/redactor/js/redactor/redactor.js"></script>
        <script src="/admin/resources/plugins/iphone_checkboxes/iphone-style-checkboxes.js"></script>
        <script src="/admin/resources/plugins/chosen/chosen.jquery.js"></script>

        <script src="/admin/resources/plugins/upload/js/vendor/jquery.ui.widget.js"></script>
        <script src="/admin/resources/plugins/upload/js/jquery.iframe-transport.js"></script>
        <script src="/admin/resources/plugins/upload/js/jquery.fileupload.js"></script>

        <script src="/admin/resources/js/core.js"></script>
        <script src="/admin/resources/js/section.js"></script>
        <script src="/admin/{$core->module.name}/js/{$core->module.name}.js"></script>

    </head>
    <body>
        <div id="wrapper">
            <div id="header">

            </div>

            <div id="content">
                <ul class="menu">
                    {foreach $core->main_menu as $item}
                        {if $item.name == $core->module.name}
                            <li><b>{$item.title}<i></i></b></li>
                        {else}
                            <li><a href="/admin/{$item.name}">{$item.title}</a></li>
                        {/if}
                    {/foreach}
                </ul>

                {include file="modules/`$core->module.name`.tpl"}
            </div>
        </div>

        <div id="footer">
            <div class="footer_inner">
                &copy; 2012 Система управления сайтом «Редактор лайт»
            </div>
        </div>
    </body>
</html>