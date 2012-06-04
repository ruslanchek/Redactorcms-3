<?php /* Smarty version Smarty-3.1.7, created on 2012-06-04 21:18:41
         compiled from "Z:/home/loc/rdclite/admin/templates\modules\structure.tpl" */ ?>
<?php /*%%SmartyHeaderCode:198284f5c5b574b9459-96068009%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0924efce44043c7c335fa1c7c43c5a65983b764f' => 
    array (
      0 => 'Z:/home/loc/rdclite/admin/templates\\modules\\structure.tpl',
      1 => 1338830320,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '198284f5c5b574b9459-96068009',
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
  'unifunc' => 'content_4f5c5b5767dd6',
  'variables' => 
  array (
    'data' => 0,
    'entry' => 0,
    'level' => 0,
    'core' => 0,
  ),
  'has_nocache_code' => 0,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f5c5b5767dd6')) {function content_4f5c5b5767dd6($_smarty_tpl) {?><div class="page-header">
    <h1 class="pull-left">Структура</h1>
    <div class="inner_tools pull-right"></div>
    <div class="clear"></div>
</div>

<div class="left_col">
    <div class="tree_holder">
        <?php if (!function_exists('smarty_template_function_menu')) {
    function smarty_template_function_menu($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['menu']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
        <ul>
            <?php  $_smarty_tpl->tpl_vars["entry"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["entry"]->_loop = false;
 $_smarty_tpl->tpl_vars["i"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["entry"]->key => $_smarty_tpl->tpl_vars["entry"]->value){
$_smarty_tpl->tpl_vars["entry"]->_loop = true;
 $_smarty_tpl->tpl_vars["i"]->value = $_smarty_tpl->tpl_vars["entry"]->key;
?>
                <?php if (is_array($_smarty_tpl->tpl_vars['entry']->value)){?>
                    <li>
                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['entry']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

                        <?php if (!empty($_smarty_tpl->tpl_vars['entry']->value['childrens'])){?>
                            <?php smarty_template_function_menu($_smarty_tpl,array('data'=>$_smarty_tpl->tpl_vars['entry']->value['childrens'],'level'=>$_smarty_tpl->tpl_vars['level']->value+1));?>

                        <?php }?>
                    </li>
                <?php }?>
            <?php } ?>
        </ul>
        <?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;}}?>


        <?php smarty_template_function_menu($_smarty_tpl,array('data'=>$_smarty_tpl->tpl_vars['core']->value->getBranchArray()));?>

    </div>
</div>

<script>
    $(function () {
        $(".tree_holder").jstree({ "plugins" : ["themes","html_data","ui"] });
    });
</script>

<div class="right_col">
    <div class="structure_item_content">
        <div id="form">

        </div>
    </div>
</div><?php }} ?>