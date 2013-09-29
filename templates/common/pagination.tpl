{if $pagination->total_pages > 1}
<ul class="pagination">
    {if $pagination->prev_page}
        <li><a href="{$core->utils->getParamstring('page')}page={$pagination->prev_page}">Предыдущая</a></li>
    {/if}

    {foreach from=$pagination->pages item=page}
        {if $page->current == true && $page->num}
            <li class="active"><a href="{$core->utils->getParamstring('page')}page={$page->num}">{$page->name}</a></li>
        {elseif $page->num}
            <li><a href="{$core->utils->getParamstring('page')}page={$page->num}">{$page->name}</a></li>
        {else}
            <li class="disabled"><a>{$page->name}</a></li>
        {/if}
    {/foreach}

    {if $pagination->next_page}
        <li><a href="{$core->utils->getParamstring('page')}page={$pagination->next_page}">Следующая</a></li>
    {/if}
</ul>
{/if}