<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>{$core->module.title}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" href="/admin/resources/bootstrap/css/bootstrap.min.css" media="all" />
        <link rel="stylesheet" href="/admin/resources/css/core.css" media="all" />
        <link rel="stylesheet" href="/admin/resources/plugins/fancybox/source/jquery.fancybox.css" media="all" />
        <link rel="stylesheet" href="/admin/resources/plugins/redactor/js/redactor/css/redactor.css" media="all" />
        <link rel="stylesheet" href="/admin/resources/plugins/chosen/chosen.css" media="all" />
        <link rel="stylesheet" href="/admin/{$core->module.name}/css/{$core->module.name}.css" media="all" />
        <script src="/admin/resources/js/jquery.js"></script>

        <script src="/admin/resources/js/jquery.cookie.js"></script>
        <script src="/admin/resources/bootstrap/js/bootstrap.min.js"></script>
        <script src="/admin/resources/js/jquery-ui-1.8.16.custom.min.js"></script>
        <script src="/admin/resources/plugins/jstree/jquery.jstree.js"></script>
        <script src="/admin/resources/plugins/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
        <script src="/admin/resources/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
        <script src="/admin/resources/plugins/redactor/js/redactor/redactor.js"></script>
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
            <header id="header">
                <div class="top overall_padding">
                    <a href="/admin/" title="" class="logo"></a>
                    <div class="arrow a1"></div>
                    <div class="options">
                        <a class="site" href="/" title="">demo.redactorcms.ru</a>
                        <div class="arrow a2"></div>

                        <span class="secure" title="1: 1"></span>

                        <span class="item">
                            <a href="/admin/?option=personal&suboption=settings" title="Руслан">Руслан</a> (admin)
                        </span>

                        <div class="arrow a2"></div>

                        <span class="item">
                            <a href="/admin/?option=personal&suboption=settings" title="Руслан">Сменить пароль</a>
                        </span>
                    </div>

                    <div class="options_r">
                        <span class="item">
                            <a class="exit" href="javascript:void(0)">Выйти</a>
                        </span>
                    </div>
                </div>

                <ul class="main_menu">
                    {foreach $core->main_menu as $item}
                        {if $item.name == $core->module.name}
                            <li>
                                <span class="ml_sprite {$item.name}"></span>
                                <span class="menu_text_active"><span>{$item.title}</span></span>
                            </li>
                        {else}
                            <li>
                                <a class="ml_link" href="/admin/{$item.name}">
                                    <span class="ml_sprite {$item.name}"></span>
                                    <span class="menu_text_link">{$item.title}</span>
                                </a>
                            </li>
                        {/if}
                    {/foreach}
                </ul>

                <div class="menu_shade"></div>

                {if $core->sub_menu}
                <ul class="main_menu_sublevel overall_padding">
                    {foreach from=$core->sub_menu item=item}
                        {if $item.active}
                            <li class="active_sml">{$item.name}</li>
                        {else}
                            <li><a href="{$item.path}">{$item.name}</a></li>
                        {/if}
                    {/foreach}
                </ul>
                {/if}
            </header>

            <div id="content" class="overall_padding">
                {include file="modules/`$core->module.name`.tpl"}
            </div>
        </div>

        <footer id="footer">
            <div class="overall_padding">
                <div class="copy">
                    <div class="left">
                        &copy; 2008&ndash;2012. Редактор CMS
                    </div>
                    <div class="right">
                        Версия 3.0
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>