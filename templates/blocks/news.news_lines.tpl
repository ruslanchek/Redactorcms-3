<h3>Линейки новостей</h3>

<ul>
{foreach $block->module->data->items as $item}
    <li><h4>{$item.name}</h4></li>
{/foreach}
</ul>