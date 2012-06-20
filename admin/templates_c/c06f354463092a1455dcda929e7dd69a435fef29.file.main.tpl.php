<?php /* Smarty version Smarty-3.1.7, created on 2012-06-20 18:09:29
         compiled from "Z:/home/loc/rdclite/admin/templates\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:40444fd07edd159ad3-17617668%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c06f354463092a1455dcda929e7dd69a435fef29' => 
    array (
      0 => 'Z:/home/loc/rdclite/admin/templates\\main.tpl',
      1 => 1340201362,
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
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['core']->value->main_menu; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                        <?php if ($_smarty_tpl->tpl_vars['item']->value['name']==$_smarty_tpl->tpl_vars['core']->value->module['name']){?>
                            <li>
                                <span class="ml_sprite <?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
"></span>
                                <span class="menu_text_active"><span><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</span></span>
                            </li>
                        <?php }else{ ?>
                            <li>
                                <a class="ml_link" href="/admin/?option=<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
">
                                    <span class="ml_sprite <?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
"></span>
                                    <span class="menu_text_link"><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</span>
                                </a>
                            </li>
                        <?php }?>
                    <?php } ?>
                </ul>

                <div class="menu_shade"></div>

                <?php if ($_smarty_tpl->tpl_vars['core']->value->sub_menu){?>
                <ul class="main_menu_sublevel overall_padding">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['core']->value->sub_menu; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                        <?php if ($_smarty_tpl->tpl_vars['item']->value['active']){?>
                            <li class="active_sml"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</li>
                        <?php }else{ ?>
                            <li><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['path'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a></li>
                        <?php }?>
                    <?php } ?>
                </ul>
                <?php }?>
            </header>

            <div id="content" class="overall_padding">
                <?php echo $_smarty_tpl->getSubTemplate ("modules/".($_smarty_tpl->tpl_vars['core']->value->module['name']).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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
</html><?php }} ?>