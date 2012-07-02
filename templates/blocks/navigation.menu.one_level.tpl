<ul class="nav nav-pills">
    {foreach $core->getMenuInline($block.content_id, 1) as $item}
    <li {if $core->page->data->id == $item.id}class="active"{/if}>
        <a href="{$item.path}">{$item.name}</a>
    </li>
    {/foreach}
</ul>