<ol class="breadcrumb">
    {foreach $core->getBreadCrumbs($core->page->data->id) as $item}
    <li{if $item.current} class="active"{/if}>
        {if $item.current}
            {$item.name}
        {else}
            <a href="{$item.path}">{$item.name}</a>
        {/if}
    </li>
    {/foreach}
</ol>