<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>{$core->module.title}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" href="/admin/resources/bootstrap/css/bootstrap.min.css" media="all" />
        <link rel="stylesheet" href="/admin/resources/css/core.css" media="all" />
        <link rel="stylesheet" href="/admin/resources/css/style.css" media="all" />
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
        <div id="cc-launchbar">
    		<div class="wrapper">
    			<div class="inner">
    				<ul class="items">
                        {foreach $core->main_menu as $item}
    					<li><a href="/admin/{$item.name}" class="cc-launchbar-item home {if $item.name == $core->module.name}selected{/if}">
    						<span class="icon-selection"></span>
    						<span class="icon"><img src="/admin/{$item.name}/img/icons/section_big.png"></span>
    						<span class="title ellipsis">{$item.title}</span>
    					</a></li>
                        {/foreach}
    				</ul>
    			</div>
    		</div>
    	</div>

        <div id="header" class="chrome">
            <span class="header_start"></span>
            <ul class="buttonbar hierarchy">
                <li><a href="javascript:void(0)" class="ellipsis" id="main_menu_caller">Меню</a></li>
                <li><a href="/admin/structure" class="ellipsis">demo.redactorcms.ru</a></li>
                <li><a href="#" class="ellipsis">Руслан</a></li>
            </ul>
            <ul class="buttonbar actions">
                <li><a href="#" class="download" title="Download this file">Download</a></li>
                <li><a href="#" class="edit" title="Edit this page" onclick="">Edit</a></li>
                <li><a href="#" class="add" title="Create new content">Add</a></li>
                <li><a href="#" class="action" title="Take action on this page">Actions</a></li>
                <li><a href="#" class="login-logout authenticated" title="Log out (ruslan)">Log out</a></li>
                <li><input id="search" value="" title="Search" autocapitalize="off"><span class="searchfield_close_overlay"></span></li>
            </ul>
        </div>

        <div id="main" class="wrapchrome">
            <span class="main_start chrome"></span>
            <div id="content" class="wrapchrome">
                <div id="banner">
                    <span class="banner_start"></span>
                    <div class="left">
                        <div class="icon">
                            <a href="/admin/{$core->module.name}"><img src="/admin/{$core->module.name}/img/icons/section.png"></a>
                        </div>
                        <h1 class="title">
                            {$core->module.title}
                        </h1>
                    </div>
                    <div class="right">
                        <div class="links">
                            <ul id="inner_tools"></ul>
                        </div>
                    </div>
                    <span class="banner_end"></span>
                </div>

                {include file="modules/`$core->module.name`.tpl"}

                <div class="clear"></div>
            </div>
            <span class="main_end chrome"></span>
        </div>
    </body>
</html>