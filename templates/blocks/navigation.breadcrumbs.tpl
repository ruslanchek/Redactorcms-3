<ol class="breadcrumb">
    {foreach $block->module->data as $item}
    <li{if $item.current} class="active"{/if}>
        {if $item.current}
            {$item.name}
        {else}
            <a href="{$item.path}">{$item.name}</a>
        {/if}
    </li>
    {/foreach}
</ol>