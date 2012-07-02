<?php /* Smarty version Smarty-3.1.7, created on 2012-07-02 13:36:13
         compiled from "Z:/home/loc/rdclite/templates\blocks\menu.multi_level.tpl" */ ?>
<?php /*%%SmartyHeaderCode:139594f88504bd49031-07426130%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '75a38606539b54c7bf84fd9cf8d7616d20c6c72a' => 
    array (
      0 => 'Z:/home/loc/rdclite/templates\\blocks\\menu.multi_level.tpl',
      1 => 1341221727,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139594f88504bd49031-07426130',
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
  'unifunc' => 'content_4f88504bd9bd7',
  'variables' => 
  array (
    'block' => 0,
    'level' => 0,
    'data' => 0,
    'entry' => 0,
    'core' => 0,
  ),
  'has_nocache_code' => 0,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f88504bd9bd7')) {function content_4f88504bd9bd7($_smarty_tpl) {?><h5><?php echo $_smarty_tpl->tpl_vars['block']->value['mode_template'];?>
</h5>

<pre><?php echo print_r($_smarty_tpl->tpl_vars['block']->value);?>
</pre>

<?php if (!function_exists('smarty_template_function_menu')) {
    function smarty_template_function_menu($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['menu']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
<ul data-level="<?php echo $_smarty_tpl->tpl_vars['level']->value;?>
">
    <?php  $_smarty_tpl->tpl_vars["entry"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["entry"]->_loop = false;
 $_smarty_tpl->tpl_vars["i"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["entry"]->key => $_smarty_tpl->tpl_vars["entry"]->value){
$_smarty_tpl->tpl_vars["entry"]->_loop = true;
 $_smarty_tpl->tpl_vars["i"]->value = $_smarty_tpl->tpl_vars["entry"]->key;
?>
        <?php if (is_array($_smarty_tpl->tpl_vars['entry']->value)){?>
            <li>
                <?php if ($_smarty_tpl->tpl_vars['core']->value->dta->id==$_smarty_tpl->tpl_vars['entry']->value['id']){?>
                    <b><?php echo $_smarty_tpl->tpl_vars['entry']->value['name'];?>
</b>
                <?php }else{ ?>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['entry']->value['path'];?>
"><?php echo $_smarty_tpl->tpl_vars['entry']->value['name'];?>
</a>
                <?php }?>

                <?php if (!empty($_smarty_tpl->tpl_vars['entry']->value['children'])){?>
                    <?php smarty_template_function_menu($_smarty_tpl,array('data'=>$_smarty_tpl->tpl_vars['entry']->value['children'],'level'=>$_smarty_tpl->tpl_vars['level']->value+1));?>

                <?php }?>
            </li>
        <?php }else{ ?>
            <li>
                <?php echo $_smarty_tpl->tpl_vars['entry']->value['name'];?>

            </li>
        <?php }?>
    <?php } ?>
</ul>
<?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;}}?>


<?php smarty_template_function_menu($_smarty_tpl,array('data'=>$_smarty_tpl->tpl_vars['core']->value->getMenuTree($_smarty_tpl->tpl_vars['block']->value['content_id'],1)));?>
<?php }} ?>