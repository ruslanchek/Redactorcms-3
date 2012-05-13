'use strict';

var section = {
    setSortable: function(){
        $('.list .table_wrap>table').sortable({
            items       : 'tr:not(:first)',
            handle      : 'i.sortable_hanler',
            revert      : false,
            tolerance   : 'intersect',
            placeholder : 'highlight',
            stop        : function(){
                core.tableZebra($('.list .table_wrap>table'));
                $('body').css({
                    cursor: ''
                });
            },
            start       : function(even, ui){
                $('.list .table_wrap>table').find('.highlight').append(ui.helper.html());
                $('body').css({
                    cursor: 'move'
                });
            },
            sort        : function() {
                core.tableZebra($('.list .table_wrap>table'));
            }
        });
    },

    editItem: function(item_id, module_name){
        this.item_request = $.ajax({
            url: '/admin/'+module_name+'/?ajax',
            type: 'get',
            data: {
                action: 'getItemFieldsAndData',
                item_id: item_id
            },
            dataType: 'json',
            beforeSend: function(){

            },
            success: function(data){
                var item_data = {};

                for(var i = 0, l = data.cols.length; i < l; i++){
                    item_data[data.cols[i].name] = data.cols[i].value;
                };

                core.form.createForm({
                    form_id             : 'edit_item_form',
                    container_obj       : $('#content_editor'),
                    data                : item_data,
                    beforeSubmit        : function(){

                    },
                    submit              : function(data){
                        alert('ss')
                    }
                });

                for(var i = 0, l = data.cols.length; i < l; i++){
                    var item = data.cols[i];

                    switch(item.type){
                        case 'text' : {
                            core.form.drawTextInput({
                                label       : item.label,
                                name        : item.name,
                                validate    : item.validate
                            });
                        }; break;

                        case 'hidden' : {
                            core.form.drawHiddenInput({
                                name        : item.name
                            });
                        }; break;

                        case 'checkbox' : {
                            core.form.drawCheckboxInput({
                                label       : item.label,
                                name        : item.name
                            });
                        }; break;
                    };
                };
            }
        });
    }
};