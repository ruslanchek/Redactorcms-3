{foreach $block->module->data->items as $item}
    <h2>{$item.name}</h2>

    {$item.announce}
    <hr>
{/foreach}

{include file='common/pagination.tpl' pagination = $block->module->data->pagination}