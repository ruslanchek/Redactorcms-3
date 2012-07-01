<?php /* Smarty version Smarty-3.1.7, created on 2012-07-01 10:53:52
         compiled from "Z:/home/loc/rdclite/admin/templates\modules\gallery.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6694f5c5b59a615f0-21798287%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '26ef470720196888caf6ddcb58b20a8fe4f4a325' => 
    array (
      0 => 'Z:/home/loc/rdclite/admin/templates\\modules\\gallery.tpl',
      1 => 1341124882,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6694f5c5b59a615f0-21798287',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f5c5b59c43ba',
  'variables' => 
  array (
    'core' => 0,
    'album_data' => 0,
    'images_count' => 0,
    'albums_count' => 0,
    'image' => 0,
    'album' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f5c5b59c43ba')) {function content_4f5c5b59c43ba($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_pluralform')) include 'Z:\\home\\loc\\rdclite\\smarty\\plugins\\modifier.pluralform.php';
?><div class="black_linen_container">
    <div class="header_block">
        <h1 class="header">
            <?php if ($_GET['album']>0){?>
                <?php $_smarty_tpl->tpl_vars["album_data"] = new Smarty_variable($_smarty_tpl->tpl_vars['core']->value->getAlbumData($_GET['album']), null, 0);?>
                <a href="/admin/gallery/">Галерея</a> &rarr;
                <span id="album_name_block">&laquo;<?php echo $_smarty_tpl->tpl_vars['album_data']->value['name'];?>
&raquo;</span>
                <span id="album_name_edit">&laquo;<form action="javascript:void(0)"><input class="text_field_black" type="text" name="album_name" value="<?php echo $_smarty_tpl->tpl_vars['album_data']->value['name'];?>
" /></form>&raquo;</span>
            <?php }else{ ?>
                <?php $_smarty_tpl->tpl_vars["images_count"] = new Smarty_variable($_smarty_tpl->tpl_vars['core']->value->getImagesCount(), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["albums_count"] = new Smarty_variable($_smarty_tpl->tpl_vars['core']->value->getAlbumsCount(), null, 0);?>
                В галерее <span class="num" id="gallery_total"><?php echo $_smarty_tpl->tpl_vars['images_count']->value;?>
</span> <span id="gallery_total_word"><?php echo smarty_modifier_pluralform($_smarty_tpl->tpl_vars['images_count']->value,array('изображение','изображения','изображений'));?>
</span> и <span class="num"><?php echo $_smarty_tpl->tpl_vars['albums_count']->value;?>
</span> <?php echo smarty_modifier_pluralform($_smarty_tpl->tpl_vars['albums_count']->value,array('альбом','альбома','альбомов'));?>

            <?php }?>
        </h1>

        <div class="inner_tools">
            <a id="button_gallery_delete_all" style="display: none" href="javascript:void(0)" class="red_button">Удалить все</a>
            <a id="button_gallery_new_album" href="javascript:void(0)" class="blue_button">Создать альбом</a>
            <a id="button_gallery_upload" href="javascript:void(0)" class="blue_button">Загрузить</a>
            <a id="button_gallery_edit_ok" style="display: none" href="javascript:void(0)" class="gray_button">Готово</a>
            <a id="button_gallery_edit" href="javascript:void(0)" class="gray_button">Редактировать</a>
        </div>

        <div class="clear"></div>
    </div>

    <input id="fileupload" type="file" name="files[]" multiple>

    <div class="gallery_pics">
        <input type="hidden" value="<?php echo $_GET['album'];?>
" id="album_id" />

        <?php if ($_GET['album']>0){?>
            <div id="item_ejector"><span><i></i>Перетяните изображение сюда, чтобы извлечь его из текущего альбома</span></div>

            <div class="items_holder">
                <?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['core']->value->getImages($_GET['album']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
$_smarty_tpl->tpl_vars['image']->_loop = true;
?>
                <div class="item<?php if ($_smarty_tpl->tpl_vars['image']->value['publish']!=1){?> hidden<?php }?>" rel="<?php echo $_smarty_tpl->tpl_vars['image']->value['id'];?>
" status="<?php if ($_smarty_tpl->tpl_vars['image']->value['publish']==1){?>1<?php }else{ ?>0<?php }?>">
                    <span class="status"></span>
                    <i class="preview" style="background-image: url(/content/gallery/thumbnails/<?php echo $_smarty_tpl->tpl_vars['image']->value['id'];?>
.<?php echo $_smarty_tpl->tpl_vars['image']->value['extension'];?>
)"></i>
                </div>
                <?php } ?>
            </div>
        <?php }else{ ?>
            <div class="albums_holder">
                <?php  $_smarty_tpl->tpl_vars['album'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['album']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['core']->value->getAlbums(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['album']->key => $_smarty_tpl->tpl_vars['album']->value){
$_smarty_tpl->tpl_vars['album']->_loop = true;
?>
                    <?php $_smarty_tpl->tpl_vars["images_count"] = new Smarty_variable($_smarty_tpl->tpl_vars['core']->value->getImagesCount($_smarty_tpl->tpl_vars['album']->value['id']), null, 0);?>
                    <div onclick="document.location.href='/admin/gallery?album=<?php echo $_smarty_tpl->tpl_vars['album']->value['id'];?>
'" title="<?php echo $_smarty_tpl->tpl_vars['album']->value['name'];?>
" class="album_item<?php if ($_smarty_tpl->tpl_vars['album']->value['publish']!=1){?> hidden<?php }?>" rel="<?php echo $_smarty_tpl->tpl_vars['album']->value['id'];?>
" status="<?php if ($_smarty_tpl->tpl_vars['album']->value['publish']==1){?>1<?php }else{ ?>0<?php }?>">
                        <span class="status"></span>
                        <?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['core']->value->getImages($_smarty_tpl->tpl_vars['album']->value['id'],3); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
$_smarty_tpl->tpl_vars['image']->_loop = true;
?>
                            <i class="preview" style="background-image: url(/content/gallery/thumbnails/<?php echo $_smarty_tpl->tpl_vars['image']->value['id'];?>
.<?php echo $_smarty_tpl->tpl_vars['image']->value['extension'];?>
)"></i>
                        <?php } ?>
                        <?php if ($_smarty_tpl->tpl_vars['images_count']->value>3){?>
                        <span class="counter"><?php echo $_smarty_tpl->tpl_vars['images_count']->value;?>
</span>
                        <?php }?>
                    </div>
                <?php } ?>
            </div>

            <div class="items_holder">
                <?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['core']->value->getImages(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
$_smarty_tpl->tpl_vars['image']->_loop = true;
?>
                <div class="item<?php if ($_smarty_tpl->tpl_vars['image']->value['publish']!=1){?> hidden<?php }?>" rel="<?php echo $_smarty_tpl->tpl_vars['image']->value['id'];?>
" status="<?php if ($_smarty_tpl->tpl_vars['image']->value['publish']==1){?>1<?php }else{ ?>0<?php }?>">
                    <span class="status"></span>
                    <i class="preview" style="background-image: url(/content/gallery/thumbnails/<?php echo $_smarty_tpl->tpl_vars['image']->value['id'];?>
.<?php echo $_smarty_tpl->tpl_vars['image']->value['extension'];?>
)"></i>
                </div>
                <?php } ?>
            </div>
        <?php }?>

        <div class="clear"></div>
    </div>
</div><?php }} ?>