<h5>{$block.mode_template}</h5>

<pre>{$block|print_r}</pre>

{function name=menu level=0}
<ul data-level="{$level}">
    {foreach from=$data item="item" key="i"}
        {if is_array($item)}
            <li>
                {if $core->page->data->id == $item.id}
                    <b>{$item.name}</b>
                {else}
                    <a href="{$item.path}">{$item.name}</a>
                {/if}

                {if !empty($item.children)}
                    {call name=menu data=$item.children level=$level+1}
                {/if}
            </li>
        {else}
            <li>
                {$item.name}
            </li>
        {/if}
    {/foreach}
</ul>
{/function}

{call name=menu data=$core->getMenuTree($block.content_id, 1)}