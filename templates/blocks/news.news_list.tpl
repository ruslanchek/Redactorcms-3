{foreach $block->module->data->items as $item}
    <h2><a href="{$item.path}">{$item.name}</a></h2>

    {$item.announce}
    <hr>
{/foreach}

{include file='common/pagination.tpl' pagination = $block->module->data->pagination}