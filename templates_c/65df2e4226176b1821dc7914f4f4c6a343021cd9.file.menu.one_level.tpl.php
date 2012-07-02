<?php /* Smarty version Smarty-3.1.7, created on 2012-07-02 13:34:10
         compiled from "Z:/home/loc/rdclite/templates\blocks\menu.one_level.tpl" */ ?>
<?php /*%%SmartyHeaderCode:144644fcc9facf1d934-29259653%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '65df2e4226176b1821dc7914f4f4c6a343021cd9' => 
    array (
      0 => 'Z:/home/loc/rdclite/templates\\blocks\\menu.one_level.tpl',
      1 => 1341221635,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '144644fcc9facf1d934-29259653',
  'function' => 
  array (
    'menu' => 
    array (
      'parameter' => 
      array (
        'level' => 0,
      ),
      'compiled' => '',
    ),
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fcc9fad059fd',
  'variables' => 
  array (
    'block' => 0,
    'core' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fcc9fad059fd')) {function content_4fcc9fad059fd($_smarty_tpl) {?><ul class="nav nav-pills">
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['core']->value->getMenuInline($_smarty_tpl->tpl_vars['block']->value['content_id'],1); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['path'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a></li>
    <?php } ?>
</ul><?php }} ?>