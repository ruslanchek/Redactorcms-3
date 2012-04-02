<div class="black_linen_container">
    <div class="header_block">
        <h1 class="header">
            {if $smarty.get.album > 0}
                {assign var="album_data" value=$core->getAlbumData($smarty.get.album)}
                <a href="/admin/gallery/">Галерея</a> &rarr;
                <span id="album_name_block">&laquo;{$album_data.name}&raquo;</span>
                <span id="album_name_edit">&laquo;<form action="javascript:void(0)"><input class="text_field_black" type="text" name="album_name" value="{$album_data.name}" /></form>&raquo;</span>
            {else}
                {assign var="images_count" value=$core->getImagesCount()}
                {assign var="albums_count" value=$core->getAlbumsCount()}
                В галерее <span class="num" id="gallery_total">{$images_count}</span> <span id="gallery_total_word">{$images_count|pluralform:array('изображение','изображения','изображений')}</span> и <span class="num">{$albums_count}</span> {$albums_count|pluralform:array('альбом','альбома','альбомов')}
            {/if}
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
        <input type="hidden" value="{$smarty.get.album}" id="album_id" />

        {if $smarty.get.album > 0}
            <div id="item_ejector"><span><i></i>Перетяните изображение сюда, чтобы извлечь его из текущего альбома</span></div>

            <div class="items_holder">
                {foreach $core->getImages($smarty.get.album) as $image}
                <div class="item{if $image.publish != 1} hidden{/if}" rel="{$image.id}" status="{if $image.publish == 1}1{else}0{/if}">
                    <span class="status"></span>
                    <i class="preview" style="background-image: url(/content/gallery/thumbnails/{$image.id}.{$image.extension})"></i>
                </div>
                {/foreach}
            </div>
        {else}
            <div class="albums_holder">
                {foreach $core->getAlbums() as $album}
                    {assign var="images_count" value=$core->getImagesCount($album.id)}
                    <div onclick="document.location.href='/admin/gallery?album={$album.id}'" title="{$album.name}" class="album_item{if $album.publish != 1} hidden{/if}" rel="{$album.id}" status="{if $album.publish == 1}1{else}0{/if}">
                        <span class="status"></span>
                        {foreach $core->getImages($album.id, 3) as $image}
                            <i class="preview" style="background-image: url(/content/gallery/thumbnails/{$image.id}.{$image.extension})"></i>
                        {/foreach}
                        {if $images_count > 3}
                        <span class="counter">{$images_count}</span>
                        {/if}
                    </div>
                {/foreach}
            </div>

            <div class="items_holder">
                {foreach $core->getImages() as $image}
                <div class="item{if $image.publish != 1} hidden{/if}" rel="{$image.id}" status="{if $image.publish == 1}1{else}0{/if}">
                    <span class="status"></span>
                    <i class="preview" style="background-image: url(/content/gallery/thumbnails/{$image.id}.{$image.extension})"></i>
                </div>
                {/foreach}
            </div>
        {/if}

        <div class="clear"></div>
    </div>
</div>