<div class="list">
    <div class="table_wrap">
        <table>
            <tr>
                <th class="ta_center"><input id="list_checkbox_master" type="checkbox" /></th>
                {foreach $cols as $col}
                <th width="{$col.data.width}" class="ta_{$col.data.align} sortable">
                    {if $col.name == 'publish'}
                        <a href="javascript:void(0)" class="action_button mini"><b class="hide" title="Скрыть"></b></a>
                    {else}
                        {$col.data.label}
                    {/if}
                </th>
                {/foreach}
                <th></th>
                <th></th>
            </tr>

            {foreach $list as $item}
            <tr row_id="{$item.id}" class="{if $item.publish == '1'}publish{else}hidden{/if}">
                <td class="ta_center"><input class="checkbox" type="checkbox" /></td>
                {foreach from=$cols item=col key=col_iteration}
                <td class="ta_{$col.data.align}">
                    {if $col.name == 'publish'}
                        {if $item['publish'] == '1'}
                            <a href="javascript:void(0)" class="action_button mini"><b class="hide" title="Скрыть"></b></a>
                        {else}
                            <a href="javascript:void(0)" class="action_button mini"><b class="show" title="Опубликовать"></b></a>
                        {/if}
                    {else}
                        {if $col.data.link}
                            <a href="#{$item.id}">{$item[$col.name]}</a>
                        {else}
                            {$item[$col.name]}
                        {/if}
                    {/if}
                </td>
                {/foreach}
                <td><a href="#" class="action_button mini list_action_delete" data-id="{$item.id}"><b class="minus" title="Удалить"></b></a></td>
                <td><i class="sortable_handler"></i></td>
            </tr>
            {/foreach}
        </table>
    </div>
</div>

<div class="pager">
    <div class="pager_span">
        <a href="#" class="larr">&larr;</a>
        <a href="#">1</a>
        <b>2</b>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#" class="rarr">&rarr;</a>
        <div class="clear"></div>
    </div>
</div>