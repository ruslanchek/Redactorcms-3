<div class="page-header">
    <h1 class="pull-left">Структура</h1>
    <div class="inner_tools pull-right"></div>
    <div class="clear"></div>
</div>

<div class="left_col">
    <div class="tree_holder">
        {*function name=menu level=0}
        <ul>
            {foreach from=$data item="entry" key="i"}
                {if is_array($entry)}
                    <li>
                        <a href="#">{$entry.name|escape}</a>
                        {if !empty($entry.childrens)}
                            {call name=menu data=$entry.childrens level=$level+1}
                        {/if}
                    </li>
                {/if}
            {/foreach}
        </ul>
        {/function}

        {call name=menu data=$core->getBranchArray()*}
    </div>
</div>

<div class="right_col">
    <div class="structure_item_content">
        <div id="form">

        </div>
    </div>
</div>