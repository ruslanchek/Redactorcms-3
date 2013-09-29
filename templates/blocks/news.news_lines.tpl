<h3>Линейки новостей</h3>

<ul>
{foreach $block->module->data->items as $item}
    <li><h4><a href="{$item.path}">{$item.name}</a></h4></li>
{/foreach}
</ul>

