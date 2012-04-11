<?php /* Smarty version Smarty-3.1.7, created on 2012-04-11 15:25:59
         compiled from "Z:/home/loc/rdclite/admin/templates\modules\structure.tpl" */ ?>
<?php /*%%SmartyHeaderCode:198284f5c5b574b9459-96068009%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0924efce44043c7c335fa1c7c43c5a65983b764f' => 
    array (
      0 => 'Z:/home/loc/rdclite/admin/templates\\modules\\structure.tpl',
      1 => 1334143503,
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
    'level' => 0,
    'entry' => 0,
    'data' => 0,
    'core' => 0,
  ),
  'has_nocache_code' => 0,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f5c5b5767dd6')) {function content_4f5c5b5767dd6($_smarty_tpl) {?><div class="black_linen_container">
    <div class="structure">
        <div class="structure_left_col">
            <i class="vline"></i>
            <div class="tree_holder">
                <i id="active_tree_item_marker"></i>

                <?php if (!function_exists('smarty_template_function_menu')) {
    function smarty_template_function_menu($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['menu']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
                <ul <?php if ($_smarty_tpl->tpl_vars['level']->value>0){?>id="branch_<?php echo $_smarty_tpl->tpl_vars['entry']->value['id'];?>
"<?php }else{ ?>id="branch_1" class="tree"<?php }?>>
                    <?php  $_smarty_tpl->tpl_vars["entry"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["entry"]->_loop = false;
 $_smarty_tpl->tpl_vars["i"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["entry"]->key => $_smarty_tpl->tpl_vars["entry"]->value){
$_smarty_tpl->tpl_vars["entry"]->_loop = true;
 $_smarty_tpl->tpl_vars["i"]->value = $_smarty_tpl->tpl_vars["entry"]->key;
?>
                        <?php if (is_array($_smarty_tpl->tpl_vars['entry']->value)){?>
                            <li id="leaf_<?php echo $_smarty_tpl->tpl_vars['entry']->value['id'];?>
">
                                <i class="arrow"></i>
                                <a href="#<?php echo $_smarty_tpl->tpl_vars['entry']->value['id'];?>
" class="<?php if ($_smarty_tpl->tpl_vars['entry']->value['publish']=='1'){?>published<?php }else{ ?>hidden<?php }?>">
                                    <i class="item_icon <?php echo $_smarty_tpl->tpl_vars['core']->value->getBranchClass($_smarty_tpl->tpl_vars['entry']->value['main_block']);?>
"></i>
                                    <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['entry']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                                </a>
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

        <div class="structure_right_col">
            <div class="structure_item_content" style="opacity: 0">
                <div class="inner_tools"></div>
                <h1>Редактирование узла</h1>

                <div id="form"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div><?php }} ?>