<?php /* Smarty version Smarty-3.1.7, created on 2012-06-08 16:14:40
         compiled from "Z:/home/loc/rdclite/admin/templates\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:40444fd07edd159ad3-17617668%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c06f354463092a1455dcda929e7dd69a435fef29' => 
    array (
      0 => 'Z:/home/loc/rdclite/admin/templates\\main.tpl',
      1 => 1339157680,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '40444fd07edd159ad3-17617668',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fd07edd21497',
  'variables' => 
  array (
    'core' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fd07edd21497')) {function content_4fd07edd21497($_smarty_tpl) {?><!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['core']->value->module['title'];?>
</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" href="/admin/resources/bootstrap/css/bootstrap.min.css" media="all" />
        <link rel="stylesheet" href="/admin/resources/css/core.css" media="all" />
        <link rel="stylesheet" href="/admin/resources/css/style.css" media="all" />
        <link rel="stylesheet" href="/admin/resources/plugins/fancybox/source/jquery.fancybox.css" media="all" />
        <link rel="stylesheet" href="/admin/resources/plugins/redactor/js/redactor/css/redactor.css" media="all" />
        <link rel="stylesheet" href="/admin/resources/plugins/chosen/chosen.css" media="all" />
        <link rel="stylesheet" href="/admin/<?php echo $_smarty_tpl->tpl_vars['core']->value->module['name'];?>
/css/<?php echo $_smarty_tpl->tpl_vars['core']->value->module['name'];?>
.css" media="all" />
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
        <script src="/admin/<?php echo $_smarty_tpl->tpl_vars['core']->value->module['name'];?>
/js/<?php echo $_smarty_tpl->tpl_vars['core']->value->module['name'];?>
.js"></script>
    </head>
    <body>
        <div id="cc-launchbar">
    		<div class="wrapper">
    			<div class="inner">
    				<ul class="items">
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['core']->value->main_menu; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
    					<li><a href="/admin/<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
" class="cc-launchbar-item home <?php if ($_smarty_tpl->tpl_vars['item']->value['name']==$_smarty_tpl->tpl_vars['core']->value->module['name']){?>selected<?php }?>">
    						<span class="icon-selection"></span>
    						<span class="icon"><img src="/admin/<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
/img/icons/section_big.png"></span>
    						<span class="title ellipsis"><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</span>
    					</a></li>
                        <?php } ?>
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
                            <a href="/admin/<?php echo $_smarty_tpl->tpl_vars['core']->value->module['name'];?>
"><img src="/admin/<?php echo $_smarty_tpl->tpl_vars['core']->value->module['name'];?>
/img/icons/section.png"></a>
                        </div>
                        <h1 class="title">
                            <?php echo $_smarty_tpl->tpl_vars['core']->value->module['title'];?>

                        </h1>
                    </div>
                    <div class="right">
                        <div class="links">
                            <ul id="inner_tools"></ul>
                        </div>
                    </div>
                    <span class="banner_end"></span>
                </div>

                <?php echo $_smarty_tpl->getSubTemplate ("modules/".($_smarty_tpl->tpl_vars['core']->value->module['name']).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


                <div class="clear"></div>
            </div>
            <span class="main_end chrome"></span>
        </div>
    </body>
</html><?php }} ?>