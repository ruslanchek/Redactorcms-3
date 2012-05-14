<div class="list">
    <div class="table_wrap">
        <table class="table table-striped table-bordered table-condensed">
            <tr>
                {foreach $cols as $col}
                <th width="{$col.data.width}" class="ta{$col.data.align}">{$col.data.label}</th>
                {/foreach}
            </tr>

            {foreach $list as $item}
            <tr>
                {foreach from=$cols item=col key=col_iteration}
                <td class="ta{$col.data.align}">
                    {if $col_iteration == 0}<i class="sortable_hanler"></i>{/if}
                    {if $col.data.link}
                        <a href="?item_id={$item.id}">{$item[$col.name]}</a>
                    {else}
                        {$item[$col.name]}
                    {/if}
                </td>
                {/foreach}
            </tr>
            {/foreach}
        </table>
    </div>

    <div class="pager">
        <span>
            <a href="#" class="larr">&larr;</a>
            <a href="#">1</a>
            <b>2</b>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#" class="rarr">&rarr;</a>
            <div class="clear"></div>
        </span>
    </div>
</div>