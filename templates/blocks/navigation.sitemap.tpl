{function name=sitemap level=0}
<ul data-level="{$level}">
    {foreach from=$data item="item" key="i"}
        {if is_object($item)}
            <li>
                <a href="{$item->path}">{$item->name}</a>

                {if !empty($item->children)}
                    {call name=sitemap data=$item->children level=$level+1}
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

{call name=sitemap data=$block->module->data}