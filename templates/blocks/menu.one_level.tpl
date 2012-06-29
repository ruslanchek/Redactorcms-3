<h5>menu.one_level.tpl</h5>

<pre>{$block|print_r}</pre>

{function name=menu level=0}
<ul data-level="{$level}">
    {foreach from=$data item="entry" key="i"}
        {if is_array($entry)}
            <li>
                <a href="{$entry.path}">{$entry.name}</a>
                {if !empty($entry.childrens)}
                    {call name=menu data=$entry.childrens level=$level+1}
                {/if}
            </li>
        {else}
            <li>
                {$entry.name}
            </li>
        {/if}
    {/foreach}
</ul>
{/function}

{call name=menu data=$core->getMenuTree()}