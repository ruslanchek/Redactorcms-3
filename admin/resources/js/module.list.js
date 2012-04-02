var list = {
    options: {

    },

    binds: function(){

    },

    setSortable: function(){
        $('.list table').sortable({
            items       : 'tr:not(:first)',
            handle      : 'i.sortable_hanler',
            revert      : false,
            tolerance   : 'intersect',
            placeholder : 'highlight',
            stop        : function(){
                core.tableZebra($('.list>table'));
            },
            start       : function(even, ui){
                $('.list>table .highlight').append(ui.helper.html());
            },
            sort        : function() {
                core.tableZebra($('.list>table'));
            }
        });
    },

    init: function(){
        this.setSortable();
        core.tableZebra($('.list>table'));
    }
};

$(function(){
    list.init();
});