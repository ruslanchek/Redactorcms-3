{if $smarty.get.item_id}
    <div class="page-header">
        <h1 class="header">
            {$core->module.h1}
        </h1>
    </div>

    <div id="content_editor"></div>

    <script>
        section.editItem({$smarty.get.item_id}, '{$core->module.name}');
    </script>
{else}
    <div class="page-header">
        <h1 class="header pull-left">
            {$core->module.h1}
        </h1>

        <div class="inner_tools pull-right">
            <a id="button_gallery_upload" href="javascript:void(0)" class="btn btn-info">Создать</a>
            <a id="button_gallery_edit" href="javascript:void(0)" class="btn">Настройка</a>
        </div>

        <div class="clear"></div>
    </div>

    {include file="common/list.tpl"}

    <script>
        section.setSortable();
        core.tableZebra($('.list .table_wrap>table'));
    </script>
{/if}