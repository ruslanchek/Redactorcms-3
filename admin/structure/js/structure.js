'use strict';

var structure = {
    options: {
        cookie_options: {
            path: '/',
            expires: 365
        }
    },

    //Расширяем фунционал создания формы для блоков раздела
    blocksInput: {
        blocks_count: 0,

        getblockModule: function(module_id){
            for(var i = 0, l = this.modules.length; i < l; i++){
                if(this.modules[i].id == module_id){
                    return this.modules[i];
                };
            };
        },

        getblockModuleMode: function(module_id, mode_id){
            var module = this.getblockModule(module_id);

            for(var i = 0, l = module.modes.length; i < l; i++){
                if(module.modes[i].id == mode_id){
                    return module.modes[i];
                };
            };
        },

        getBlockData: function(id){
            for(var i = 0, l = this.blocks_obj.length; i < l; i++){
                if(this.blocks_obj[i].id == id){
                    var block = this.blocks_obj[i];
                };
            };

            return block;
        },

        setData: function(){
            $('#hidden_blocks').val(encodeURI(JSON.stringify(this.blocks_obj)));
            $('#hidden_main_block').val(encodeURI(JSON.stringify(this.main_block_obj)));
        },

        drawSelectModule: function(module){
            var options = new String(),
                selected;

            for(var i = 0, l = this.modules.length; i < l; i++){
                if(this.modules[i].id == module){
                    selected = 'selected="selected"';
                }else{
                    selected = '';
                };

                options += '<option autocomplete="off" '+selected+' value="'+this.modules[i].id+'">'+this.modules[i].title+'</option>';
            };

            var html = '<select id="select_block_module">' + options + '</select>';

            $('#select_block_module_placeholder').html(html);
            $('select#select_block_module').chosen();

            $('#select_block_module').on('change', function(){
                structure.blocksInput.drawSelectModuleMode(     $(this).val(), 1);
                structure.blocksInput.drawSelectContentId(      $(this).val(), 1, '');
                structure.blocksInput.drawSelectModuleTemplate( $(this).val(), 1);
                structure.blocksInput.drawSelectMenuParentId(   $(this).val(), 1);
                structure.blocksInput.drawOptions(              $(this).val(), 1);
            });
        },

        drawOptions: function(module, module_mode){
            var module_mode = this.getblockModuleMode(module, module_mode),
                options_html = '';

            if(module_mode.options && module_mode.options.length > 0){
                for(var i = 0, l = module_mode.options.length; i < l; i++){
                    options_html += '<div class="item_block">' +
                                        '<label class="label" class="control-label" for="block_option_'+module_mode.options[i].name+'">'+module_mode.options[i].title+'</label>' +
                                        '<div class="controls" id="block_option_'+module_mode.options[i].name+'_placeholder">' +
                                            '<input data-name="'+module_mode.options[i].name+'" class="text" type="text" value="'+this.getBlockOptionParam(this.current_block_id, module_mode.options[i].name)+'">' +
                                        '</div>' +
                                    '</div>';
                };

                $('#block_options').show().html(options_html);
            }else{
                $('#block_options').hide().html('');
            };
        },

        drawSelectMenuParentId: function(module, module_mode, menu_parent_id){
            if(module == 2 && (module_mode == 1 || module_mode == 2)){
                $('#select_block_menu_parent_id_placeholder').parent().show();

                this.block_menu_parents_request = $.ajax({
                    url         : '/admin/structure/?ajax&action=get_all_structure_items',
                    type        : 'GET',
                    dataType    : 'json',
                    beforeSend  : function(){
                        if(this.block_menu_parents_request){
                            this.block_menu_parents_request.abort();
                        };

                        $('#select_block_menu_parent_id_placeholder').html('').parent().show();
                        core.loading.setLoadingToElementByAppend('drawSelectSelectMenu', $('#select_block_menu_parent_id_placeholder'), true);
                    },
                    success     : function(result){
                        core.loading.unsetLoading('drawSelectSelectMenu');

                        if(result != null){
                            if(result.length > 0){
                                var options = '', selected;

                                for(var i = 0, l = result.length; i < l; i++){
                                    if(result[i].id == menu_parent_id || (!menu_parent_id && result[i].id == core.form.options.data.pid)){
                                        selected = 'selected="selected"';
                                    }else{
                                        selected = '';
                                    };

                                    options += '<option '+selected+' value="'+result[i].id+'">'+result[i].name+'</option>';
                                };

                                var html = '<select id="select_block_menu_parent_id">' + options + '</select>';

                                $('#select_block_menu_parent_id_placeholder').html(html);
                                $('select#select_block_menu_parent_id').chosen();
                                $('#select_block_menu_parent_id_placeholder').parent().show();
                            }else{
                                $('#select_block_menu_parent_id_placeholder').html('<em class="gray">Нет объектов</em>');
                                $('#select_block_menu_parent_id_placeholder').parent().show();
                            };
                        }else{
                            $('#select_block_menu_parent_id_placeholder').parent().hide();
                        };
                    }
                });
            }else{
                $('#select_block_menu_parent_id_placeholder').parent().hide();
            };
        },

        drawSelectModuleMode: function(module, module_mode){
            var options = new String(),
                selected,
                module = this.getblockModule(module);

            for(var i = 0, l = module.modes.length; i < l; i++){
                if(module.modes[i].id == module_mode){
                    selected = 'selected="selected"';
                }else{
                    selected = '';
                };

                options += '<option autocomplete="off" '+selected+' value="'+module.modes[i].id+'">'+module.modes[i].title+'</option>';
            };

            var html = '<select id="select_block_module_mode">' + options + '</select>';

            $('#select_block_module_mode_placeholder').html(html);
            $('select#select_block_module_mode').chosen();

            $('#select_block_module_mode').on('change', function(){
                structure.blocksInput.drawSelectContentId(      $('#select_block_module').val(), $(this).val(), '');
                structure.blocksInput.drawSelectModuleTemplate( $('#select_block_module').val(), $(this).val());
                structure.blocksInput.drawSelectMenuParentId(   $('#select_block_module').val(), $(this).val());
                structure.blocksInput.drawOptions(              $('#select_block_module').val(), $(this).val());
            });
        },

        drawSelectModuleTemplate: function(module, module_mode, mode_template){
            var module_mode = this.getblockModuleMode(module, module_mode),
                default_template = module_mode.template,
                options = new String(),
                selected;

            if(!mode_template){
                selected = 'selected="selected"';
            }else{
                selected = '';
            };

            options += '<option autocomplete="off" '+selected+' value="'+default_template+'">Стандартный &mdash; '+default_template+'</option>';

            selected = '';

            for(var i = 0, l = this.blocks_templates.length; i < l; i++){
                if(default_template != this.blocks_templates[i]){
                    if(mode_template == this.blocks_templates[i]){
                        selected = 'selected="selected"';
                    }else{
                        selected = '';
                    };

                    options += '<option autocomplete="off" '+selected+' value="'+this.blocks_templates[i]+'">'+this.blocks_templates[i]+'</option>';
                };
            };

            var html = '<select id="select_block_mode_template">' + options + '</select>';

            $('#select_block_mode_template_placeholder').html(html);
            $('select#select_block_mode_template').chosen();
        },

        drawSelectContentId: function(module, module_mode, content_id){
            var module_mode = this.getblockModuleMode(module, module_mode),
                options = new String(),
                html = new String(),
                selected;

            if(module_mode.action !== false){
                this.block_content_items_request = $.ajax({
                    url         : '/admin/structure/?ajax&action=get_content_items',
                    data        : {
                        module_action: module_mode.action
                    },
                    type        : 'GET',
                    dataType    : 'json',
                    beforeSend  : function(){
                        if(this.block_content_items_request){
                            this.block_content_items_request.abort();
                        };

                        $('#select_block_content_id_placeholder').html('').parent().show();
                        core.loading.setLoadingToElementByAppend('drawSelectContentId', $('#select_block_content_id_placeholder'), true);
                        $('#select_block_content_id_placeholder').prev().text(module_mode.c_id_label);
                    },
                    success     : function(result){
                        core.loading.unsetLoading('drawSelectContentId');

                        switch(module_mode.action){
                            /* case 'get_albums' : {
                                for(var i = 0, l = result.length; i < l; i++){
                                    if(result[i].id == content_id){
                                        selected = ' selected';
                                    }else{
                                        selected = '';
                                    };

                                    options += '<div class="item'+selected+'" value="'+result[i].id+'">'+result[i].name+'</div>';
                                };

                                html += '<input type="hidden" id="select_block_content_id" value="'+content_id+'" />' +
                                        '<div class="content_id_albums">' +
                                            options +
                                            '<div class="clear"></div>' +
                                        '</div>';

                                $('#select_block_content_id_placeholder').html(html);
                            }; break; */

                            default : {
                                if(result != null){
                                    if(result.length > 0){
                                        for(var i = 0, l = result.length; i < l; i++){
                                            if(result[i].id == content_id){
                                                selected = 'selected="selected"';
                                            }else{
                                                selected = '';
                                            };

                                            options += '<option '+selected+' value="'+result[i].id+'">'+result[i].name+'</option>';
                                        };

                                        html = '<select id="select_block_content_id">' + options + '</select>';

                                        $('#select_block_content_id_placeholder').html(html);
                                        $('select#select_block_content_id').chosen();
                                        $('#select_block_content_id_placeholder').parent().show();
                                    }else{
                                        $('#select_block_content_id_placeholder').html('<em class="gray">Нет объектов</em>');
                                        $('#select_block_content_id_placeholder').parent().show();
                                    };
                                }else{
                                    $('#select_block_content_id_placeholder').parent().hide();
                                };
                            }; break;
                        };
                    }
                });
            }else{
                $('#select_block_content_id_placeholder').parent().hide();
            };
        },

        setBlocksCount: function(value){
            var count = 0;

            for(var i = 0, l = structure.templates.length; i < l; i++){
                if(structure.templates[i].id == value){
                    count = structure.templates[i].blocks;
                };
            };

            this.blocks_count = parseInt(count);
        },

        createBlocksEtalon: function(){
            var blocks_etalon = [];

            for(var i = 1, l = this.blocks_count+1; i < l; i++){
                blocks_etalon.push({
                    id: i
                });
            };

            return blocks_etalon;
        },

        drawBlocks: function(){
            //Create main block
            var module              = this.getblockModule(this.main_block_obj.module),
                module_mode         = this.getblockModuleMode(this.main_block_obj.module, this.main_block_obj.module_mode),
                blocks_html         = '';

            blocks_html +=  '<div class="item main_block button" rel="main" data-mode_template="' + this.main_block_obj.mode_template + '">' +
                                '<span class="num">♛</span>' +
                                '<span class="module_name">' + module.title + '</span>' +
                                '<span class="module_mode">' + module_mode.title + '</span>' +
                            '</div>';

            //Create oher blocks
            /*for(var i = 0, l = this.blocks_obj.length; i < l; i++){
                var module          = this.getblockModule(this.blocks_obj[i].module),
                    module_mode     = this.getblockModuleMode(this.blocks_obj[i].module, this.blocks_obj[i].module_mode);

                blocks_html +=  '<div class="item btn" rel="' + this.blocks_obj[i].id + '" data-mode_template="' + this.blocks_obj[i].mode_template + '">' +
                                    '<span class="num">' + this.blocks_obj[i].id + '</span>' +
                                    '<span class="module_name">' + module.title + '</span>' +
                                    '<span class="module_mode">' + module_mode.title + '</span>' +
                                '</div>';
            };*/

            var blocks_etalon = this.createBlocksEtalon();

            for(var i = 0, l = blocks_etalon.length; i < l; i++){
                var id,
                    template,
                    block_module,
                    block_module_mode,
                    present = false,
                    block = null,
                    block_class;

                for(var i2 = 0, l2 = this.blocks_obj.length; i2 < l2; i2++){
                    if(this.blocks_obj[i2].id == blocks_etalon[i].id){
                        present = true;
                        block = this.blocks_obj[i2];
                    };
                };

                if(block){
                    var module          = this.getblockModule(block.module),
                        module_mode     = this.getblockModuleMode(block.module, block.module_mode);

                    id                  = blocks_etalon[i].id;
                    block_module        = module.title;
                    block_module_mode   = module_mode.title;
                    template            = block.mode_template;
                    block_class         = 'btn-info';
                }else{
                    id                  = blocks_etalon[i].id;
                    block_module        = 'Пустой блок';
                    block_module_mode   = '';
                    block_class         = 'empty_block';
                };

                blocks_html +=  '<div class="item button '+block_class+'" rel="'+id+'" data-id="'+id+'" data-mode_template="' + template + '">' +
                                    '<span class="num">' + blocks_etalon[i].id + '</span>' +
                                    '<span class="module_name">' + block_module + '</span>' +
                                    '<span class="module_mode">' + block_module_mode + '</span>' +
                                '</div>';
            };


            /*blocks_html +=   '<div class="item btn" rel="new">' +
                                '<span class="num plus">+</span>' +
                                '<span class="module_name">Добавить блок</span>' +
                                '<span class="module_mode"></span>' +
                            '</div>' +
                            '<div class="clear"></div>';*/

            blocks_html = blocks_html + '<div class="clear"></div>';

            $('#blocks').html(blocks_html);
        },

        deleteBlock: function($o){
            var new_obj = [];

            for(var i = 0, l = this.blocks_obj.length; i < l; i++){
                if(this.blocks_obj[i].id != $o.data('id')){
                    var new_o = this.blocks_obj[i];
                    new_obj.push(new_o);
                };
            };

            this.blocks_obj = new_obj;

            $o
                .removeClass('btn-info')
                .addClass('empty_block')
                .find('.module_name')
                .text('Пустой блок');

            $o
                .find('.module_mode')
                .text('');

            this.setData();
        },

        editBlock: function($item_obj){
            var block_id = $item_obj.attr('rel'),
                mode_template = $item_obj.data('mode_template'),
                header,
                module,
                module_mode,
                content_id,
                menu_parent_id,
                options;

            if($item_obj.hasClass('empty_block')){
                block_id = 'empty';
            };

            switch(block_id){
                case 'main' : {
                    header          = 'Настройка основного блока';
                    module          = this.main_block_obj.module;
                    module_mode     = this.main_block_obj.module_mode;
                    content_id      = this.main_block_obj.content_id;
                    menu_parent_id  = this.main_block_obj.menu_parent_id;
                    options         = this.main_block_obj.options;
                }; break;

                case 'new' : {
                    header          = 'Новый блок №' + (this.blocks_obj.length+1);
                    module          = 1;
                    module_mode     = 1;
                    content_id      = 0;
                    menu_parent_id  = 1;
                    options         = [];
                }; break;

                case 'empty' : {
                    header          = 'Настройка пустого блока №'+$item_obj.data('id');
                    module          = 1;
                    module_mode     = 1;
                    content_id      = 0;
                    menu_parent_id  = 1;
                    block_id        = $item_obj.data('id');
                    options         = [];
                }; break;

                default : {
                    var block_data  = this.getBlockData(block_id);
                    header          = 'Настройка блока №'+block_id;
                    module          = block_data.module;
                    module_mode     = block_data.module_mode;
                    content_id      = block_data.content_id;
                    menu_parent_id  = block_data.menu_parent_id;
                    options         = block_data.options;

                    var aftershow = function(){
                        $('.dialog .buttons').prepend('<input type="button" class="button delete_block_button right" value="Сбросить">');

                        $('.delete_block_button').off('click').on('click', function(){
                            structure.blocksInput.deleteBlock($item_obj);
                            core.modal.closeDialog();
                        });
                    };
                }; break;
            };

            var content =   '<div class="form">' +
                                '<form>' +
                                    '<fieldset>' +
                                        '<div class="item_block">' +
                                            '<label class="label" for="select_block_module">Модуль</label>' +
                                            '<div class="controls" id="select_block_module_placeholder"></div>' +
                                        '</div>' +

                                        '<div class="item_block">' +
                                            '<label class="label" for="select_block_module_mode">Режим</label>' +
                                            '<div class="controls" id="select_block_module_mode_placeholder"></div>' +
                                        '</div>' +

                                        '<div class="item_block">' +
                                            '<label class="label" for="select_block_mode_template">Шаблон</label>' +
                                            '<div class="controls" id="select_block_mode_template_placeholder"></div>' +
                                        '</div>' +

                                        '<div class="item_block">' +
                                            '<label class="label" class="control-label" for="select_block_content_id">Контент-юнит</label>' +
                                            '<div class="controls" id="select_block_content_id_placeholder"></div>' +
                                        '</div>' +

                                        '<div style="display: none" class="item_block">' +
                                            '<label class="label" class="control-label" for="select_block_menu_parent_id">Родительский узел</label>' +
                                            '<div class="controls" id="select_block_menu_parent_id_placeholder"></div>' +
                                            '<input type="hidden" id="select_block_options">' +
                                        '</div>' +

                                        '<div id="block_options" style="display: none"></div>' +
                                    '</fieldset>' +
                                '</form>' +
                            '</div>';

            core.modal.showDialog({
                content: content,
                header: header,
                width: 550,
                action: function(){
                    structure.blocksInput.getAndSetBlockParams(block_id);
                }
            });

            if(aftershow){
                aftershow();
            };

            this.current_block_id = block_id;

            this.drawSelectModule(module);
            this.drawSelectModuleMode(module, module_mode);
            this.drawSelectModuleTemplate(module, module_mode, mode_template);
            this.drawSelectContentId(module, module_mode, content_id);
            this.drawSelectMenuParentId(module, module_mode, menu_parent_id);
            this.drawOptions(module, module_mode);
        },

        getBlockOptionParam: function(block_id, option_name){
            if(block_id == 'main'){
                if(this.main_block_obj.options){
                    for(var i = 0, l = this.main_block_obj.options.length; i < l; i++){
                        if(option_name == this.main_block_obj.options[i].name){
                            return this.main_block_obj.options[i].value;
                        };
                    };
                };
            }else{
                for(var i = 0, l = this.blocks_obj.length; i < l; i++){
                    if(this.blocks_obj[i].id == block_id){
                        if(this.blocks_obj[i].options){
                            for(var i2 = 0, l = this.blocks_obj[i].options.length; i2 < l; i2++){
                                if(this.blocks_obj[i].options[i2].name == option_name){
                                    return this.blocks_obj[i].options[i2].value;
                                };
                            };
                        };
                    };
                };
            };
        },

        getBlockOptions: function(){
            var options = [];

            $('#block_options input').each(function(){
                options.push({
                    name: $(this).data('name'),
                    value: $(this).val()
                });
            });

            return options;
        },

        getAndSetBlockParams: function(block_id){
            var block_data,
                new_block = false;

            if(block_id == 'main'){
                this.main_block_obj.module          = parseInt($('#select_block_module').val());
                this.main_block_obj.module_mode     = parseInt($('#select_block_module_mode').val());
                this.main_block_obj.mode_template   = $('#select_block_mode_template').val();
                this.main_block_obj.content_id      = parseInt($('#select_block_content_id').val());
                this.main_block_obj.menu_parent_id  = parseInt($('#select_block_menu_parent_id').val());
                this.main_block_obj.options         = this.getBlockOptions();

                block_data = this.main_block_obj;

                var module      = this.getblockModule(block_data.module),
                    module_mode = this.getblockModuleMode(block_data.module, block_data.module_mode);

                $block_item = $('#blocks .item[rel="main"]');
                $block_item.find('span.module_name').html(module.title);
                $block_item.find('span.module_mode').html(module_mode.title);
                $block_item.data('mode_template', $('#select_block_mode_template').val());

                $('#hidden_main_block').val(encodeURIComponent(JSON.stringify(this.main_block_obj)));
            }else{
                if(block_id == 'new'){
                    block_id     = structure.blocksInput.blocks_obj.length + 1;

                    new_block    = true;

                    this.blocks_obj.push({
                        id              : block_id,
                        module          : parseInt($('#select_block_module').val()),
                        module_mode     : parseInt($('#select_block_module_mode').val()),
                        mode_template   : $('#select_block_mode_template').val(),
                        content_id      : parseInt($('#select_block_content_id').val()),
                        menu_parent_id  : parseInt($('#select_block_menu_parent_id').val()),
                        options         : this.getBlockOptions()
                    });
                };

                for(var i = 0, l = this.blocks_obj.length; i < l; i++){
                    if(this.blocks_obj[i].id == block_id){
                        this.blocks_obj[i].module           = parseInt($('#select_block_module').val());
                        this.blocks_obj[i].module_mode      = parseInt($('#select_block_module_mode').val());
                        this.blocks_obj[i].mode_template    = $('#select_block_mode_template').val();
                        this.blocks_obj[i].content_id       = parseInt($('#select_block_content_id').val());
                        this.blocks_obj[i].menu_parent_id   = parseInt($('#select_block_menu_parent_id').val());
                        this.blocks_obj[i].options          = this.getBlockOptions();

                        block_data = this.blocks_obj[i];
                        break;
                    };
                };

                if($('#blocks .item[rel="'+block_id+'"]').hasClass('empty_block')){
                    block_data = {
                        id              : block_id,
                        module          : parseInt($('#select_block_module').val()),
                        module_mode     : parseInt($('#select_block_module_mode').val()),
                        mode_template   : $('#select_block_mode_template').val(),
                        content_id      : parseInt($('#select_block_content_id').val()),
                        menu_parent_id  : parseInt($('#select_block_menu_parent_id').val()),
                        options         : this.getBlockOptions()
                    };

                    this.blocks_obj.push(block_data);
                };

                var module      = this.getblockModule(block_data.module),
                    module_mode = this.getblockModuleMode(block_data.module, block_data.module_mode);

                if(new_block){
                    var new_block_html =    '<div class="btn item popup_effect" rel="' + block_id + '" data-mode_template="'+$('#select_block_mode_template').val()+'">' +
                                                '<span class="num">' + block_id + '</span>' +
                                                '<span class="module_name">' + module.title + '</span>' +
                                                '<span class="module_mode">' + module_mode.title + '</span>' +
                                            '</div>';

                    $('#blocks .item[rel="new"]').before(new_block_html);
                }else{
                    var $block_item  = $('#blocks .item[rel="'+block_id+'"]');

                    $block_item.removeClass('empty_block').addClass('btn-info');
                    $block_item.find('span.module_name').html(module.title);
                    $block_item.find('span.module_mode').html(module_mode.title);
                    $block_item.data('mode_template', $('#select_block_mode_template').val());
                };

                $('#hidden_blocks').val(encodeURIComponent(JSON.stringify(this.blocks_obj)));
            };
        },

        init: function(){
            this.modules            =   core.form.options.modules;
            this.blocks_templates   =   core.form.options.blocks_templates;

            var blocks_value        =   core.form.options.data.blocks,
                main_block_value    =   core.form.options.data.main_block,
                html                =   '<div class="item_block">' +
                                            '<label class="label">Блоки</label>' +
                                            '<div class="controls">' +
                                                '<div id="blocks" class="input_holder blocks"></div>' +
                                            '</div>' +
                                        '</div>'+
                                        '<input type="hidden" id="hidden_blocks" name="blocks" value="'+encodeURIComponent(blocks_value)+'" />' +
                                        '<input type="hidden" id="hidden_main_block" name="main_block" value="'+encodeURIComponent(main_block_value)+'" />';

            this.blocks_obj         = $.parseJSON(blocks_value);
            this.main_block_obj     = $.parseJSON(main_block_value);

            core.form.options.container_obj.find('form#'+core.form.options.form_id).find('.form_items').append(html);

            this.setBlocksCount(core.form.options.data.template_id);
            this.drawBlocks();

            $('#blocks .item').live('click', function(){
                structure.blocksInput.editBlock($(this));
            });
        }
    },

    getIdFromHash: function(){
        var id = window.location.hash.substr(1, window.location.hash.length);
        return parseInt(id);
    },

    openItemByHash: function(){
        if(window.location.hash){
            var id = this.getIdFromHash();

            if(id > 0){
                this.openStructureItem(id);

                if(id > 1){
                    $('#add_item, #remove_item').show(120);
                }else{
                    $('#add_item').show(120);
                    $('#remove_item').hide(200);
                };
            }else{
                $('#add_item, #remove_item').hide(120);
            };
        }else{
            var html = '<p class="no_items">Выберите узел структуры, чтобы его отредактировать, либо создайте новый</з>';
            $('#form').html(html);
            $('#item_path_indicator').fadeOut(100)
        };
    },

    addItem: function(){
        if(structure.current_node_id > 0){
            this.add_item_request = $.ajax({
                url         : '/admin/structure/?ajax&action=add_child',
                data        : {
                    id      : structure.current_node_id
                },
                type        : 'GET',
                beforeSend  : function(){
                    if(structure.add_item_request != null){
                        structure.add_item_request.abort();
                    };

                    core.loading.setHeaderLoading($('#secondary_content_header'));
                },
                success     : function(result){
                    setTimeout(function(){
                        core.loading.unsetHeaderLoading($('#secondary_content_header'));

                        var $tree = $('#tree'),
                            parent_node = $tree.tree('getNodeById', structure.current_node_id);

                        $tree.tree('appendNode', {
                            id: result,
                            label: 'Узел ' + result + ' (новый)'
                        }, parent_node);

                        $tree.tree('selectNode', $tree.tree('getNodeById', result), true);

                        document.location.hash = result;
                    }, 250);
                }
            });
        };
    },

    delItem: function(id){
        if(structure.current_node_id > 0){
            this.del_item_request = $.ajax({
                url         : '/admin/structure/?ajax&action=del_child',
                data        : {
                    id      : id
                },
                type        : 'GET',
                beforeSend  : function(){
                    if(structure.del_item_request != null){
                        structure.del_item_request.abort();
                    };

                    core.loading.setHeaderLoading($('#secondary_content_header'));
                },
                success     : function(result){
                    setTimeout(function(){
                        core.loading.unsetHeaderLoading($('#secondary_content_header'));

                        var $tree = $('#tree'),
                            node = $tree.tree('getNodeById', id);

                        $tree.tree('removeNode', node);

                        document.location.hash = '';

                        $('#add_item, #remove_item').hide(120);
                        $('#active_tree_item_marker').remove();
                    }, 250);
                }
            });
        };
    },

    binds: function(){
        $('#add_item').on('click', function(){
            structure.addItem();
        });

        $('#remove_item').on('click', function(){
            if(confirm('Удалить узел и все его дочерние узлы?')){
                structure.delItem(structure.current_node_id);
            };
        });

        $(window).on('hashchange', function(){
            structure.openItemByHash();
        });
    },

    saveItemData: function(data){
        this.save_item_request = $.ajax({
            url         : '/admin/structure/?ajax&action=set_node_data',
            type        : 'POST',
            data        : data,
            dataType    : 'json',
            beforeSend  : function(){
                if(structure.save_item_request != null){
                    structure.save_item_request.abort();
                };

                core.loading.setHeaderLoading($('#primary_content_header'));
            },
            success     : function(result){
                setTimeout(function(){
                    core.loading.unsetHeaderLoading($('#primary_content_header'));
                    core.form.formReady({status: true, message: 'Данные сохранены!'});
                }, 250);

                var status_class,
                    module_icon_class,
                    main_block_data = JSON.parse(result.main_block);

                for(var i = 0, l = structure.blocksInput.modules.length; i < l; i++){
                    if(main_block_data.module == structure.blocksInput.modules[i].id){
                        module_icon_class = structure.blocksInput.modules[i].class;
                    };
                };

                if(result.publish == '1'){
                    status_class = 'published';
                }else{
                    status_class = 'hidden';
                };

                var $tree = $('#tree'),
                    node = $tree.tree('getNodeById', data.id);

                $(node.element).find('span:first').text(data.name);

                $('#item_path_indicator').attr('href', result.path).html(result.path);
            }
        });
    },

    createEditItemForm: function(data){
        this.templates = data.templates;

        core.form.createForm({
            form_id             : 'edit_item_form',
            container_obj       : $('#form'),
            data                : data.node_data,
            modules             : data.modules,
            blocks_templates    : data.blocks_templates,
            beforeSubmit        : function(){
                structure.resizeing();
            },
            submit              : function(data){
                structure.saveItemData(data);
            }
        });

        $('#item_path_indicator').attr('href', data.node_data.path).html(data.node_data.path).fadeIn();

        core.form.drawHiddenInput({
            name    : 'id'
        });

        core.form.drawCheckboxInput({
            label   : 'Активен',
            name    : 'publish'
        });

        core.form.drawTextInput({
            label       : 'Название',
            name        : 'name',
            validate    : [
                {
                    method  : 'required',
                    message : 'Заполните название'
                }
            ]
        });

        if(data.node_data.id > 1 && data.node_data.pid > 0){
            core.form.drawTextInput({
                label       : 'Путь',
                name        : 'part',
                validate    : [
                    {
                        method  : 'required',
                        message : 'Заполните путь'
                    },
                    {
                        method  : 'ajax',
                        message : 'Такой путь уже существует в текущей ветке',
                        params  : {
                            url : '/admin/structure/?ajax&action=check_part_ajax',
                            data: {
                                action  : 'check_part_ajax',
                                id      : data.node_data.id,
                                pid     : data.node_data.pid
                            }
                        }
                    }
                ]
            });
        };

        core.form.drawSelectInput({
            label       : 'Меню',
            name        : 'menu_id',
            options     : data.menues
        });

        core.form.drawSelectInput({
            label       : 'Шаблон',
            name        : 'template_id',
            options     : data.templates,
            validate    : [
                {
                    method  : 'required',
                    message : 'Выберите шаблон'
                }
            ]
        });

        $('#select_template_id').on('change', function(){
            structure.blocksInput.setBlocksCount($(this).val());
            structure.blocksInput.drawBlocks();
        });

        core.form.drawTextInput({
            label       : 'Титул',
            name        : 'seo_title'
        });

        core.form.drawTextarea({
            label       : 'Ключевые слова',
            name        : 'seo_keywords'
        });

        core.form.drawTextarea({
            label       : 'Описание',
            name        : 'seo_description'
        });

        this.blocksInput.init();
    },

    openStructureItem: function(id){
        if(structure.current_node_id != id){
            var $tree = $('#tree'),
                node = $tree.tree('getNodeById', id);

            if(node){
                $tree.tree('selectNode', node, true);
                structure.setMarkerToActivePosition($(node.element), 0);
            };

            if(structure.item_request != null){
                structure.item_request.abort();
                core.loading.unsetHeaderLoading($('#primary_content_header'));
            };

            $('#content-primary').animate({
                opacity: 0
            }, {
                duration: 500,
                specialEasing: {
                    opacity : 'easeInExpo'
                },
                complete: function(){
                    structure.item_request = $.ajax({
                        url: '/admin/structure/?ajax',
                        type: 'get',
                        data: {
                            action: 'get_node_data',
                            id: id
                        },
                        dataType: 'json',
                        beforeSend: function(){
                            core.loading.setHeaderLoading($('#primary_content_header'));
                            structure.resizeing();
                            $('#item_path_indicator').fadeOut(100)
                        },
                        success: function(data){
                            setTimeout(function(){
                                core.loading.unsetHeaderLoading($('#primary_content_header'));

                                if(data.node_data != null){
                                    structure.createEditItemForm(data);
                                    structure.resizeing();
                                    $('#item_path_indicator').fadeIn(100);
                                }else{
                                    $('#form').html('<p class="no_items">Узла с ID '+id+' не существует. Выберите другой или создайте новый узел.</p>');
                                    $('#item_name').html('Редактор узла');
                                };

                                $('#content-primary').animate({
                                    opacity: 1
                                }, {
                                    duration: 500,
                                    specialEasing: {
                                        opacity : 'easeOutExpo'
                                    }
                                });
                            }, 250);
                        }
                    });

                    structure.current_node_id = id;
                }
            });
        };
    },

    setMarkerToActivePosition: function(o, speed){
        var tree_active_item = null;

        if(o){
            tree_active_item = o;
        }else if($('#tree .selected').length > 0){
            tree_active_item = $('#tree li.selected');
        };

        if(tree_active_item != null){
            tree_active_item.addClass('active');

            var maker   = $('#active_tree_item_marker'),
                top     = tree_active_item.offset().top - $('#tree').offset().top + 1,
                height  = tree_active_item.find('>div').height() + 10;

            if(tree_active_item.find('>div').offset().top + tree_active_item.find('>div').height() + 12 == $("#tree").offset().top + $("#tree").height()){
                maker.addClass('last');
            }else{
                maker.removeClass('last');
            };

            maker.css({
                top     : top,
                height  : height
            });

            maker.animate({
                top     : top,
                height  : height,
                opacity : 1
            }, {
                duration: speed,
                specialEasing: {
                    top     : 'easeInOutExpo',
                    height  : 'easeInOutExpo',
                    opacity : 'easeInOutExpo'
                }
            });
        };
    },

    drawTree: function(){
        $.ajax({
            url         : '/admin/structure/?ajax&action=get_tree',
            type        : 'GET',
            dataType    : 'json',
            beforeSend  : function(){
                core.loading.setHeaderLoading($('#secondary_content_header'));
            },
            success     : function(result){
                setTimeout(function(){
                    core.loading.unsetHeaderLoading($('#secondary_content_header'));

                    var $tree = $('#tree').tree({
                        data        : result,
                        saveState   : true,
                        dragAndDrop : true,
                        selectable  : true
                    });

                    $tree.bind('tree.click', function(event) {
                        var node = event.node;

                        document.location.hash = node.id;

                        if($('#active_tree_item_marker').length == 0){
                            $tree.append('<div id="active_tree_item_marker"></div>');
                        };

                        structure.setMarkerToActivePosition($(node.element), 0);

                        return true;
                    });

                    $('#tree .toggler').on('click', function(){
                        if(!$(this).hasClass('closed') && $(this).parent().parent().find('.selected').length > 0){
                            $('#active_tree_item_marker').remove();
                            $tree.tree('selectNode', null, true);
                            document.location.hash = '';
                        };
                    });

                    if(structure.getIdFromHash() > 0){
                        var node = $tree.tree('getNodeById', structure.getIdFromHash());
                        $tree.tree('selectNode', node, true);

                        if($('#active_tree_item_marker').length == 0){
                            $tree.append('<div id="active_tree_item_marker"></div>');
                        };

                        structure.setMarkerToActivePosition($(node.element), 0);
                    }else{
                        $tree.tree('selectNode', null, true);
                    };

                    $tree.append('<div id="hover_marker"></div>');

                    $('#tree li>div').hover(function(){
                        $('#hover_marker').show();

                        var maker   = $('#hover_marker'),
                            top     = $(this).offset().top - $('#tree').offset().top + 2,
                            height  = $(this).height() + 10;

                        if($(this).offset().top + $(this).height() + 12 == $("#tree").offset().top + $("#tree").height()){
                            maker.addClass('last');
                        }else{
                            maker.removeClass('last');
                        };

                        maker.css({
                            top     : top,
                            height  : height
                        });

                    }, function(){
                        $('#hover_marker').hide();
                    });

                }, 250);
            }
        });
    },

    init: function(){
        core.preloadImages([
            '/admin/resources/img/bg/popup.png',
            '/admin/resources/img/icons/micro_spinner.gif'
        ]);

        this.binds();
        this.resizeing();
        this.openItemByHash();
        this.drawTree();
    },

    resizeing: function(){

    }
};

$(function(){
    structure.init();

    $(window).on('resize', function(){
        structure.resizeing();
    });

    $(window).on('resize', function(){
        structure.resizeing();
    });
});