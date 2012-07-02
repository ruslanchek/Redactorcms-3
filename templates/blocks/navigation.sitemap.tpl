{function name=menu level=0}
<ul data-level="{$level}">
    {foreach from=$data item="item" key="i"}
        {if is_object($item)}
            <li>
                <a href="{$item->path}">{$item->name}</a>

                {if !empty($item->children)}
                    {call name=menu data=$item->children level=$level+1}
                {/if}
            </li>
        {else}
            <li>
                {$item->name}
            </li>
        {/if}
    {/foreach}
</ul>
{/function}

{call name=menu data=$core->getMenuTree(false, 0)}