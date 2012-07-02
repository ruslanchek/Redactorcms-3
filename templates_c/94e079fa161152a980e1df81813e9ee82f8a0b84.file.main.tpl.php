<?php /* Smarty version Smarty-3.1.7, created on 2012-07-02 15:25:03
         compiled from "Z:/home/loc/rdclite/templates\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:64644f8550085f9719-21869202%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '94e079fa161152a980e1df81813e9ee82f8a0b84' => 
    array (
      0 => 'Z:/home/loc/rdclite/templates\\main.tpl',
      1 => 1341228302,
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
<?php if ($_valid && !is_callable('content_4f85500865477')) {function content_4f85500865477($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $_smarty_tpl->tpl_vars['core']->value->page->content->seo_title;?>
</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['core']->value->page->content->seo_keywords;?>
">
        <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['core']->value->page->content->seo_description;?>
">

        <link href="/templates/resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <style>
            body {
                padding-top: 60px;
            }
        </style>

        <link href="/templates/resources/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

        <script src="/templates/resources/js/jquery-1.7.min.js"></script>
        <script src="/templates/resources/bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="/">Demo</a>
                </div>
            </div>
        </div>

        <div class="container">

            <div class="thumbnail">
                <h4>Block 6</h4>
                <?php echo $_smarty_tpl->tpl_vars['core']->value->drawBlock(6);?>

            </div>

            <div class="page-header">
                <h1><?php echo $_smarty_tpl->tpl_vars['core']->value->page->content->seo_title;?>
</h1>
            </div>

            <div class="thumbnail">
                <h4>Block 7</h4>
                <?php echo $_smarty_tpl->tpl_vars['core']->value->drawBlock(7);?>

            </div>

            <div class="row">
                <div class="span3">
                    <div class="thumbnail">
                        <div class="caption">
                            <h4>Block 1</h4>
                            <div><?php echo $_smarty_tpl->tpl_vars['core']->value->drawBlock(1);?>
</div>
                        </div>
                    </div>

                    <br>

                    <div class="thumbnail">
                        <div class="caption">
                            <h4>Block 2</h4>
                            <div><?php echo $_smarty_tpl->tpl_vars['core']->value->drawBlock(2);?>
</div>
                        </div>
                    </div>

                    <br>
                </div>


                <div class="span6">
                    <div class="thumbnail">
                        <div class="caption">
                            <h4>Main block</h4>
                            <div><?php echo $_smarty_tpl->tpl_vars['core']->value->drawBlock('main');?>
</div>
                        </div>
                    </div>

                    <br>

                    <div class="thumbnail">
                        <div class="caption">
                            <h4>Block 3</h4>
                            <div><?php echo $_smarty_tpl->tpl_vars['core']->value->drawBlock('3');?>
</div>
                        </div>
                    </div>

                    <br>
                </div>


                <div class="span3">
                    <div class="thumbnail">
                        <div class="caption">
                            <h4>Block 4</h4>
                            <div><?php echo $_smarty_tpl->tpl_vars['core']->value->drawBlock(4);?>
</div>
                        </div>
                    </div>

                    <br>

                    <div class="thumbnail">
                        <div class="caption">
                            <h4>Block 5</h4>
                            <div><?php echo $_smarty_tpl->tpl_vars['core']->value->drawBlock(5);?>
</div>
                        </div>
                    </div>

                    <br>
                </div>
            </div>
            <pre>
                <?php echo print_r($_smarty_tpl->tpl_vars['core']->value->page);?>

            </pre>
        </div>
    </body>
</html>

<?php }} ?>