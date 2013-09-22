'use strict';

var sections = {
    listHaveChecked: function(no_animation){
        var checkeds    = false,
            hiddens     = false,
            showeds     = false;

        $('.list .checkbox').each(function(){
            if($(this).is(':checked')){
                checkeds = true;

                if($(this).parent().parent().hasClass('publish')){
                    showeds = true;
                }

                if($(this).parent().parent().hasClass('hidden')){
                    hiddens = true;
                }
            }
        });

        if(no_animation){
           var speed = 0;
        }else{
           var speed = 120;
        }

        if(checkeds){
           if(showeds && !hiddens){
               $('.multiaction_button').not('[rel="show"]').show(speed);
               $('.multiaction_button[rel="show"]').hide(speed);

           }else if(!showeds && hiddens){
               $('.multiaction_button').not('[rel="hide"]').show(speed);
               $('.multiaction_button[rel="hide"]').hide(speed);

           }else{
               $('.multiaction_button').show(speed);
           }
        }else{
           $('.multiaction_button').hide(speed);
        }
    },

    setSortable: function(){
        $('.list .table_wrap>table').sortable({
            items       : 'tr:not(:first)',
            handle      : 'i.sortable_handler',
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

    init: function(){
        $('.list .checkbox').on('click', function(){
            sections.listHaveChecked();
        });

        $('#list_checkbox_master').on('click', function(){
            if($(this).is(':checked')){
                $('.list .checkbox').attr('checked', true);
            }else{
                $('.list .checkbox').attr('checked', false);
            }

            sections.listHaveChecked();
        });

        this.listHaveChecked(true);

        this.setSortable();
        core.tableZebra($('.list .table_wrap>table'));

        section.init();
    }
};

var section = {
    item_id: null,
    section: core.utilities.getParameterByName('section'),

    init: function(){
        $(window).on('hashchange', function(){
            section.getIdByHash();
        });

        this.getIdByHash();
    },

    getIdByHash: function(){
        this.item_id = null;

        var hash = document.location.hash,
            id = hash.substr(1, hash.length);

        if(id > 0){
            this.item_id = id;
            this.editItem(id, this.section);
        }
    },

    saveData: function(data){
        $.ajax({
            url: '/admin/sections/?ajax&action=saveData&section=' + this.section + '&item_id=' + this.item_id,
            type: 'post',
            data: data,
            beforeSend: function(){
                core.loading.setHeaderLoading($('#primary_content_header_edit'));
            },
            success: function(){
                setTimeout(function(){
                    core.loading.unsetHeaderLoading($('#primary_content_header_edit'));
                    core.form.formReady({status: true, message: 'Данные сохранены!'});
                }, 250);
            },
            error: function(){
                core.loading.unsetHeaderLoading($('#primary_content_header_edit'));
            }
        })
    },

    createEditor: function(data){
        var item_data = {};

        for(var i = 0, l = data.cols.length; i < l; i++){
            item_data[data.cols[i].name] = data.cols[i].value;
        }

        core.form.createForm({
            form_id             : 'edit_item_form',
            container_obj       : $('#content_editor'),
            data                : item_data,
            beforeSubmit        : function(){

            },
            submit              : function(data){
                section.saveData(data);
            }
        });

        var publish_col = $.grep(data.cols, function( n ) {
            return n.name == 'publish';
        });

        if(publish_col[0]){
            core.form.drawCheckboxInput(publish_col[0]);
        }

        var name_col = $.grep(data.cols, function( n ) {
            return n.name == 'name';
        });

        if(name_col[0]){
            core.form.drawTextInput(name_col[0]);
        }

        var other_cols = $.grep(data.cols, function( n ) {
            return n.name != 'name' && n.name != 'publish' && n.name != 'id';
        });

        if((name_col[0] || publish_col[0]) && other_cols.length > 0){
            core.form.drawSeparator();
        }

        for(var i = 0, l = other_cols.length; i < l; i++){
            switch(other_cols[i].type){
                case 'checkbox' : {
                    core.form.drawCheckboxInput(other_cols[i]);
                } break;

                case 'text' : {
                    core.form.drawTextInput(other_cols[i]);
                } break;

                case 'textarea' : {
                    core.form.drawTextarea(other_cols[i]);
                } break;

                case 'hidden' : {
                    core.form.drawHiddenInput(other_cols[i]);
                } break;
            }
        }
    },

    editItem: function(item_id, module_name){
        this.item_request = $.ajax({
            url: '/admin/sections/?ajax',
            type: 'get',
            data: {
                action: 'getItemFieldsAndData',
                item_id: item_id,
                section: module_name
            },
            dataType: 'json',
            beforeSend: function(){
                $('.edit-item').show();
                $('.section-list').hide();

                core.loading.setHeaderLoading($('#primary_content_header_edit'));
            },
            success: function(data){
                setTimeout(function(){
                    core.loading.unsetHeaderLoading($('#primary_content_header_edit'));
                }, 250);

                section.createEditor(data);
            }
        });
    }
};

$(function(){
    sections.init();
});