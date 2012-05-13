<div class="black_linen_container">
    {if $smarty.get.item_id}
        <div class="header_block">
            <h1 class="header">
                {$core->module.h1}
            </h1>
        </div>

        <div id="content_editor"></div>

        <script>
            section.editItem({$smarty.get.item_id}, '{$core->module.name}');
        </script>
    {else}
        <div class="header_block">
            <h1 class="header">
                {$core->module.h1}
            </h1>

            <div class="inner_tools">
                <a id="button_gallery_upload" href="javascript:void(0)" class="blue_button">Создать</a>
                <a id="button_gallery_edit" href="javascript:void(0)" class="gray_button">Настройка</a>
            </div>

            <div class="clear"></div>
        </div>

        {include file="common/list.tpl"}

        <script>
            section.setSortable();
            core.tableZebra($('.list .table_wrap>table'));
        </script>
    {/if}
</div>