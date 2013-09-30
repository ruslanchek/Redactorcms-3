'use strict';

var sections = {
    section: core.utilities.getParameterByName('section'),

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

    publishToggleItemRow: function($o){
        var val = '';

        if($o.data('publish') == '1'){
            val = '0';
        }else{
            val = '1';
        }

        sections.updateCell($o.data('id'), 'publish', val, function(data){
            $o.data('publish', val);

            if(val == '1'){
                $('.list table tr[row_id="' + data.id + '"]').removeClass('hidden');
                $o.find('b').addClass('show').removeClass('hide');
            }else{
                $('.list table tr[row_id="' + data.id + '"]').addClass('hidden');
                $o.find('b').addClass('hide').removeClass('show');
            }
        });
    },

    deleteItemRow: function(id){
        if(!confirm('Удалить запись?')){
            return;
        }

        $.ajax({
            url: '/admin/sections/?ajax',
            type: 'get',
            data: {
                action: 'deleteItemRow',
                section: this.section,
                item_id: id
            },
            beforeSend: function(){
                core.loading.setHeaderLoading($('#primary_content_header_list'));
            },
            success: function(){
                setTimeout(function(){
                    core.loading.unsetHeaderLoading($('#primary_content_header_list'));

                    if($('.list table tr:not(:first):not(:last)').length <= 0){
                        $('.sections_content').html('<p class="no_items">Раздел пуст, чтобы начать заполнение &mdash; <a href="#" class="list_action_create">cоздайте объект</a></p>');
                        sections.binds();
                    }else{
                        $('.list table tr[row_id="' + id + '"]').remove();
                        core.tableZebra($('.list .table_wrap>table'));
                    }

                }, 250);
            },
            error: function(){
                core.loading.unsetHeaderLoading($('#primary_content_header_list'));
            }
        })
    },

    updateCell: function(id, key, val, callback){
        $.ajax({
            url: '/admin/sections/?ajax&section=' + this.section + '&action=updateCell&item_id=' + id,
            type: 'post',
            data: {
                key: key,
                val: val
            },
            beforeSend: function(){
                core.loading.setHeaderLoading($('#primary_content_header_list'));
            },
            success: function(data){
                setTimeout(function(){
                    core.loading.unsetHeaderLoading($('#primary_content_header_list'));
                }, 250);

                if(callback){
                    callback(data);
                }
            },
            error: function(){
                core.loading.unsetHeaderLoading($('#primary_content_header_list'));
            }
        })
    },

    binds: function(){
        $('.list .checkbox').off('click').on('click', function(){
            sections.listHaveChecked();
        });

        $('.close_editor').off('click').on('click', function(){
            document.location.hash = '/admin/sections/?section=' + this.section;
        });

        $('#list_checkbox_master').off('click').on('click', function(){
            if($(this).is(':checked')){
                $('.list .checkbox').attr('checked', true);
            }else{
                $('.list .checkbox').attr('checked', false);
            }

            sections.listHaveChecked();
        });

        $('.list_action_publish').off('click').on('click', function(e){
            sections.publishToggleItemRow($(this));
            e.preventDefault();
        });

        $('.list_action_delete').off('click').on('click', function(e){
            sections.deleteItemRow($(this).data('id'));
            e.preventDefault();
        });

        $('.list_action_create').off('click').on('click', function(e){
            section.getDataset(function(data){
                section.create_mode = true;
                section.createEditor(data);
            });
            e.preventDefault();
        });
    },

    init: function(){
        this.binds();
        this.listHaveChecked(true);
        this.setSortable();

        core.tableZebra($('.list .table_wrap>table'));
        section.init();
    }
};

var section = {
    item_id: null,
    create_mode: false,
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
            this.create_mode = false;

            this.getItemData(id, function(data){
                section.createEditor(data);

                if(section.just_created === true){
                    core.form.formReady({status: true, message: 'Объект успешно создан, id: ' + id});
                    section.just_created = false;
                }
            });
        }else{
            section.destroyEditor();
        }
    },

    saveData: function(data){
        var action = '',
            item_id = '';

        if(this.create_mode === true){
            action = 'create';
        }else{
            action = 'saveData';
            item_id = '&item_id=' + this.item_id;
        }

        for(var i = 0, l = data.length; i < l; i++){
            if(data[i].type == 'separator'){
                delete data[i];
            }
        }

        $.ajax({
            url: '/admin/sections/?ajax&action=' + action + '&section=' + this.section + item_id,
            type: 'post',
            data: data,
            dataType: 'json',
            beforeSend: function(){
                core.loading.setHeaderLoading($('#primary_content_header_edit'));
            },
            success: function(data){
                if(section.create_mode === true && data.id > 0){
                    section.just_created = true;
                    document.location.hash = '#' + data.id;
                }else{
                    setTimeout(function(){
                        core.loading.unsetHeaderLoading($('#primary_content_header_edit'));
                        core.form.formReady({status: true, message: 'Данные сохранены!'});
                    }, 250);
                }
            },
            error: function(){
                core.loading.unsetHeaderLoading($('#primary_content_header_edit'));
            }
        })
    },

    destroyEditor: function(){
        $('.edit-item').hide();
        $('.section-list').show();
    },

    createEditor: function(data){
        $('.edit-item').show();
        $('.section-list').hide();

        var item_data = {}, unique_item_id = '';

        for(var i = 0, l = data.cols.length; i < l; i++){
            item_data[data.cols[i].name] = data.cols[i].value;
        }

        core.form.createForm({
            form_id             : 'edit_item_form',
            container_obj       : $('#content_editor'),
            data                : item_data,
            cols                : data.cols,
            process_autofills   : true,
            beforeSubmit        : function(){

            },
            submit              : function(data){
                section.saveData(data);
            }
        });

        if(this.create_mode === false){
            unique_item_id = '&item_id=' + this.item_id;
        }

        //Implement validate unique ajax params
        $.each(data.cols, function(key, val){
            if(val.validate && val.validate.length > 0){
                $.each(val.validate, function(key1, val1){
                    if(val1.method == 'unique'){
                        val1.params = {
                            url : '/admin/sections/?ajax&section=' + section.section + '&action=checkUniqueRow' + unique_item_id,
                            data: {
                                colname: val.name
                            }
                        };
                    }
                });
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

        /*
        // Это раньше добавляло сепаратор автоматом после названия
        if((name_col[0] || publish_col[0]) && other_cols.length > 0){
            core.form.drawSeparator();
        }
        */

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

                case 'select' : {
                    other_cols[i].options = other_cols[i].options.data;
                    core.form.drawSelectInput(other_cols[i]);
                } break;

                case 'hidden' : {
                    core.form.drawHiddenInput(other_cols[i]);
                } break;

                case 'separator' : {
                    core.form.drawSeparator();
                } break;
            }
        }
    },

    getDataset: function(callback){
        this.item_request = $.ajax({
            url: '/admin/sections/?ajax',
            type: 'get',
            data: {
                action: 'getDataset',
                section: this.section
            },
            dataType: 'json',
            beforeSend: function(){
                core.loading.setHeaderLoading($('#primary_content_header_edit'));
            },
            success: function(data){
                setTimeout(function(){
                    core.loading.unsetHeaderLoading($('#primary_content_header_edit'));
                }, 250);

                if(callback){
                    callback(data);
                }
            }
        });
    },

    getItemData: function(item_id, callback){
        this.item_request = $.ajax({
            url: '/admin/sections/?ajax',
            type: 'get',
            data: {
                action: 'getDataset',
                item_id: item_id,
                section: this.section
            },
            dataType: 'json',
            beforeSend: function(){
                core.loading.setHeaderLoading($('#primary_content_header_edit'));
            },
            success: function(data){
                setTimeout(function(){
                    core.loading.unsetHeaderLoading($('#primary_content_header_edit'));
                }, 250);

                if(callback){
                    callback(data);
                }
            }
        });
    }
};

$(function(){
    sections.init();
});