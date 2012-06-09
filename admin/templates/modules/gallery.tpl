<div class="black_linen_container">
    <div class="header_block">
        <h1 class="header">
            {if $smarty.get.album > 0}
                {assign var="album_data" value=$core->getAlbumData($smarty.get.album)}
                <div id="album_name_block">{$album_data.name}</div>
                <div id="album_name_edit"><form action="javascript:void(0)">Название альбома<input type="text" name="album_name" value="{$album_data.name}" /></form></div>
            {else}
                {assign var="images_count" value=$core->getImagesCount()}
                {assign var="albums_count" value=$core->getAlbumsCount()}
                <div id="album_name_block">
                    В галерее <span class="num" id="gallery_total">{$images_count}</span> <span id="gallery_total_word">{$images_count|pluralform:array('изображение','изображения','изображений')}</span> и <span class="num">{$albums_count}</span> {$albums_count|pluralform:array('альбом','альбома','альбомов')}
                </div>
            {/if}
        </h1>

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
                            <i class="preview" style="background-image: url(/content/gallery/micros/{$image.id}.{$image.extension})"></i>
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