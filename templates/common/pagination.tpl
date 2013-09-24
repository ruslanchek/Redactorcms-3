{if $pagination->total_pages > 1}
    <div class="pager">
        {if $pagination->prev_page}
            <a href="{$core->utils->getParamstring('page')}page={$pagination->prev_page}">Предыдущая</a>
        {/if}

        {foreach from=$pagination->pages item=page}
            {if $page->current == true && $page->num}
                <b>{$page->name}</b>
            {elseif $page->num}
                <a href="{$core->utils->getParamstring('page')}page={$page->num}">{$page->name}</a>
            {else}
                <a>{$page->name}</a>
            {/if}
        {/foreach}

        {if $pagination->next_page}
            <a href="{$core->utils->getParamstring('page')}page={$pagination->next_page}">Следующая</a>
        {/if}
    </div>
{/if}