<div class="left_col">
    <div class="right_block">
        <h2>xxx</h2>
        <div class="sections_content">
            {include file="common/list.tpl"}

            <script>
                section.setSortable();
                core.tableZebra($('.list .table_wrap>table'));
            </script>
        </div>
    </div>
</div>

<div class="right_col">
    <div class="right_block">
        <h2>xxx</h2>
        <div class="inner sections_inner">
            <ul class="sections_menu">
                {foreach from=$core->config->modules item=item}
                    {if $item.name == $smarty.get.section}
                        <li class="active"><b>{$item.title}</b></li>
                    {else}
                        <li><a href="/admin/sections?section={$item.name}">{$item.title}</a></li>
                    {/if}
                {/foreach}
            </ul>
        </div>
    </div>
</div>

<div class="cl"></div>



{*
<div class="sections_list_tools list_menu_buttons">
    <a class="button" href="{$main->new_item_link}" tabindex="1">
        <span>
            <img class="button_icon icon_action icon_add_instance" src="/admin/img/frames/e.gif" />
            <b>{$main->getText('sections', 'create_new_section')}</b>
        </span>
    </a>
    <div class="cl"></div>
</div>

<div class="sections_list">
    {assign var="sl_i" value=0}
    {foreach name="sections_list" from=$sections->getList() item=item}
        {$sl_i = $sl_i+1}
        <div class="item{if $sl_i == 3} r{elseif $sl_i == 2} c{else} l{/if}">
            <div class="colorer" style="background-color: #{$item.color};"></div>
            <div class="inner">
                <h2><a href="/admin/?option={$main->module_name}&suboption=content&id={$item.id}">{$item.name}</a></h2>
                <span class="count right">{$sections->getSectionItemsCount($item.id)}</span>
                <a class="left" href="/admin/?option={$main->module_name}&suboption=edit&id={$item.id}">{$main->getText('sections', 'edit')}</a>
                <a class="left" href="javascript:void(0)" onclick="confirmMessage('{$main->getText('sections', 'confirm_delete_message')}', '/admin/?option={$main->module_name}&suboption=list&action=delete&id={$item.id}')">{$main->getText('sections', 'delete')}</a>
                <div class="cl"></div>
            </div>
        </div>
        {if $smarty.foreach.sections_list.iteration is div by 3}
        <div class="cl"></div>
        {/if}
        {if $sl_i == 3}{$sl_i = 0}{/if}
    {/foreach}
    <div class="cl"></div>
</div>
*}