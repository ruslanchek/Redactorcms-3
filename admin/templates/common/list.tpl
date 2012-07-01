<div class="list">
    <div class="table_wrap">
        <table>
            <tr>
                {foreach $cols as $col}
                    {if $col.data.name == 'publish'}

                    {else}
                        <th width="{$col.data.width}" class="ta{$col.data.align}">{$col.data.label}</th>
                    {/if}
                {/foreach}
                <th></th>
            </tr>

            {foreach $list as $item}
            <tr>
                {foreach from=$cols item=col key=col_iteration}
                    {if $col.name == 'publish'}
                    {else}
                        <td class="ta{$col.data.align}">
                            {if $col_iteration == 0}<i class="sortable_hanler"></i>{/if}
                            {if $col.data.link}
                                <a href="?item_id={$item.id}">{$item[$col.name]}</a>
                            {else}
                                {$item[$col.name]}
                            {/if}
                        </td>
                    {/if}
                {/foreach}
                <td><input type="checkbox"></td>
            </tr>
            {/foreach}
        </table>
    </div>

    <div class="pager">
        <span>
            <a href="#" class="larr">&larr;</a>
            <b>1</b>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#" class="rarr">&rarr;</a>
            <div class="clear"></div>
        </span>
    </div>
</div>