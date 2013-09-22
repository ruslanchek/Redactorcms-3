<?php /* Smarty version Smarty-3.1.7, created on 2012-06-28 18:51:14
         compiled from "Z:/home/loc/rdclite/admin/templates\modules\structure.tpl" */ ?>
<?php /*%%SmartyHeaderCode:46294fd07edd2463c6-88885772%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0924efce44043c7c335fa1c7c43c5a65983b764f' => 
    array (
      0 => 'Z:/home/loc/rdclite/admin/templates\\modules\\structure.tpl',
      1 => 1340895037,
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
<?php if ($_valid && !is_callable('content_4fd07edd24a5e')) {function content_4fd07edd24a5e($_smarty_tpl) {?><div class="left_col">
    <div class="content-block">
        <h2 id="primary_content_header">
            Редактор узла
            <a style="display: none" target="_blank" href="javascript:void(0)" class="action_button rubber right" id="item_path_indicator"></a>
            <div class="clear"></div>
        </h2>

        <div id="content-primary">
            <div id="form"><!-- Will be filld by JS (see structure.js) --></div>
        </div>
    </div>
</div>

<div id="content-secondary" class="right_col">
    <div class="content-block">
        <h2 id="secondary_content_header">
            <a id="add_item" style="display: none" href="javascript:void(0)" class="action_button left"><b class="plus" title="Добавить дочерний узел"></b></a>
            <a id="remove_item" style="display: none" href="javascript:void(0)" class="action_button left"><b class="minus" title="Удалить выбранный узел и все его дочерние узлы"></b></a>
            <div class="clear"></div>
        </h2>
        <div id="tree">
            <p class="no_items">Загрузка узлов...</p>
        </div>
    </div>
</div>

<div class="cl"></div><?php }} ?>