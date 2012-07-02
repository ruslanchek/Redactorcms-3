<ul class="nav nav-pills">
    {foreach $core->getSubMenu($block->content_id, $core->page->data->id) as $item}
    <li {if $core->page->data->id == $item->id}class="active"{/if}>
        <a href="{$item->path}">{$item->name}</a>
    </li>
    {/foreach}
</ul>