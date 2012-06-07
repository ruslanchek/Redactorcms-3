<?php /* Smarty version Smarty-3.1.7, created on 2012-04-20 15:32:03
         compiled from "Z:/home/loc/rdclite/templates\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:64644f8550085f9719-21869202%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '94e079fa161152a980e1df81813e9ee82f8a0b84' => 
    array (
      0 => 'Z:/home/loc/rdclite/templates\\main.tpl',
      1 => 1334908713,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '64644f8550085f9719-21869202',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f85500865477',
  'variables' => 
  array (
    'core' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f85500865477')) {function content_4f85500865477($_smarty_tpl) {?><h2>Main block</h2>
<div><?php echo $_smarty_tpl->tpl_vars['core']->value->drawBlock('main');?>
</div>

<h2>BLock 1</h2>
<div><?php echo $_smarty_tpl->tpl_vars['core']->value->drawBlock(1);?>
</div>

<h2>BLock 2</h2>
<div><?php echo $_smarty_tpl->tpl_vars['core']->value->drawBlock(2);?>
</div>

<h2>BLock 3</h2>
<div><?php echo $_smarty_tpl->tpl_vars['core']->value->drawBlock(3);?>
</div>

<h2>BLock 4</h2>
<div><?php echo $_smarty_tpl->tpl_vars['core']->value->drawBlock(4);?>
</div>

<h2>BLock 5</h2>
<div><?php echo $_smarty_tpl->tpl_vars['core']->value->drawBlock(5);?>
</div>
<?php }} ?>