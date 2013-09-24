{$section = $core->sectionctrl->getList($block->module->name)}

{foreach $section->items as $item}
    <h2>{$item.name}</h2>

    {$item.announce}
    <hr>
{/foreach}

{include file='common/pagination.tpl' pagination = $section->pagination}