<ul class="breadcrumb">
    {foreach $core->getBreadCrumbs($core->page->data->id) as $item}
    <li>
        {if $item.current}{$item.name}{else}<a href="{$item.path}">{$item.name}</a> <span class="divider">/</span>{/if}
    </li>
    {/foreach}
</ul>