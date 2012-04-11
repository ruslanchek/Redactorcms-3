'use strict';

var pages = {
    table: null,

    setSortable: function(){
        this.table.sortable({
            items       : 'tr:not(:first)',
            handle      : 'i.sortable_hanler',
            revert      : false,
            tolerance   : 'intersect',
            placeholder : 'highlight',
            stop        : function(){
                core.tableZebra(pages.table);
                $('body').css({
                    cursor: ''
                });
            },
            start       : function(even, ui){
                pages.table.find('.highlight').append(ui.helper.html());
                $('body').css({
                    cursor: 'move'
                });
            },
            sort        : function() {
                core.tableZebra(pages.table);
            }
        });
    },

    init: function(table){
        this.table = table;

        this.setSortable();
        core.tableZebra(this.table);
    }
};

$(function(){
    pages.init($('.list .table_wrap>table'));
});