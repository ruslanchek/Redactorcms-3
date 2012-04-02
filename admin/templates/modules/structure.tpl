<div class="black_linen_container">
    <div class="structure">
        <div class="structure_left_col">
            <i class="vline"></i>
            <div class="tree_holder">
                <i id="active_tree_item_marker"></i>

                {function name=menu level=0}
                <ul {if $level > 0}id="branch_{$entry.id}"{else}id="branch_1" class="tree"{/if}>
                    {foreach from=$data item="entry" key="i"}
                        {if is_array($entry)}
                            <li id="leaf_{$entry.id}">
                                <i class="arrow"></i>
                                <a href="#{$entry.id}" class="{if $entry.publish == '1'}published{else}hidden{/if}">
                                    <i class="item_icon regular"></i>
                                    <span>{$entry.name|escape}</span>
                                </a>
                                {if !empty($entry.childrens)}
                                    {call name=menu data=$entry.childrens level=$level+1}
                                {/if}
                            </li>
                        {/if}
                    {/foreach}
                </ul>
                {/function}
            
                {call name=menu data=$core->getBranchArray()}
            </div>
        </div>

        <div class="structure_right_col">
            <div class="structure_item_content" style="opacity: 0">
                <div class="inner_tools"></div>
                <h1>Редактирование узла</h1>

                <div id="form"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>