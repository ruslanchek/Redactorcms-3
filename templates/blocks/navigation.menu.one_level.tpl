<ul class="nav nav-pills">
    {foreach $block->module->data as $item}
    <li {if $core->page->data->id == $item->id}class="active"{/if}>
        <a href="{$item->path}">{$item->name}</a>
    </li>
    {/foreach}
</ul>