<?php /* Smarty version Smarty-3.1.7, created on 2012-05-15 15:24:28
         compiled from "Z:/home/loc/rdclite/admin/templates\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:126154f5c5b57237dd5-02547425%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c06f354463092a1455dcda929e7dd69a435fef29' => 
    array (
      0 => 'Z:/home/loc/rdclite/admin/templates\\main.tpl',
      1 => 1337079754,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '126154f5c5b57237dd5-02547425',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f5c5b5747c73',
  'variables' => 
  array (
    'core' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f5c5b5747c73')) {function content_4f5c5b5747c73($_smarty_tpl) {?><!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['core']->value->module['title'];?>
</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" href="/admin/resources/bootsrtap/css/bootstrap.css" media="all" />
        <link rel="stylesheet" href="/admin/resources/plugins/fancybox/source/jquery.fancybox.css" media="all" />
        <link rel="stylesheet" href="/admin/resources/plugins/redactor/js/redactor/css/redactor.css" media="all" />
        <link rel="stylesheet" href="/admin/resources/plugins/iphone_checkboxes/style.css" media="all" />
        <link rel="stylesheet" href="/admin/resources/plugins/chosen/chosen.css" media="all" />
        <link rel="stylesheet" href="/admin/<?php echo $_smarty_tpl->tpl_vars['core']->value->module['name'];?>
/css/<?php echo $_smarty_tpl->tpl_vars['core']->value->module['name'];?>
.css" media="all" />

        <script src="/admin/resources/js/jquery.js"></script>
        <script src="/admin/resources/bootsrtap/js/bootstrap.min.js"></script>
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
        <script src="/admin/<?php echo $_smarty_tpl->tpl_vars['core']->value->module['name'];?>
/js/<?php echo $_smarty_tpl->tpl_vars['core']->value->module['name'];?>
.js"></script>

    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <a class="brand" href="/admin">Редактор</a>

                    <div class="nav-collapse">
                        <ul class="nav">
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['core']->value->main_menu; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                                <li <?php if ($_smarty_tpl->tpl_vars['item']->value['name']==$_smarty_tpl->tpl_vars['core']->value->module['name']){?>class="active"<?php }?>><a href="/admin/<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</a></li>
                            <?php } ?>
                            <li class="divider-vertical"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid main_content">
            <?php echo $_smarty_tpl->getSubTemplate ("modules/".($_smarty_tpl->tpl_vars['core']->value->module['name']).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


            <div class="clear"></div>
            <hr>
            &copy; 2012 Система управления сайтом &laquo;Редактор лайт&raquo;
        </div>
    </body>
</html><?php }} ?>