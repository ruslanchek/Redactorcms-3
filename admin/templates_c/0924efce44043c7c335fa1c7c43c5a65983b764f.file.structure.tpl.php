<?php /* Smarty version Smarty-3.1.7, created on 2012-06-20 19:12:04
         compiled from "Z:/home/loc/rdclite/admin/templates\modules\structure.tpl" */ ?>
<?php /*%%SmartyHeaderCode:46294fd07edd2463c6-88885772%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0924efce44043c7c335fa1c7c43c5a65983b764f' => 
    array (
      0 => 'Z:/home/loc/rdclite/admin/templates\\modules\\structure.tpl',
      1 => 1340205072,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '46294fd07edd2463c6-88885772',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fd07edd24a5e',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fd07edd24a5e')) {function content_4fd07edd24a5e($_smarty_tpl) {?><h1 class="title selectable" id="item_name">Редактор узла</h1>
<div id="item_path_indicator"></div>

<div id="top_actions"></div>

<div class="cl"></div>

<div id="content-primary" class="left_col">
    <div class="clear"></div>
    <div id="form"><!-- Will be filld by JS (see structure.js) --></div>
</div>

<div id="content-secondary" class="right_col">
    <div class="right_block">
        <h2>Дерево узлов</h2>
        <div class="inner" id="tree"></div>
    </div>
</div>

<div class="cl"></div><?php }} ?>