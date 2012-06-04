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

                options += '<option autocomplete="off" '+selected+' value="'+this.modules[i].id+'">'+this.modules[i].name+'</option>';
            };

            var html = '<select id="select_block_module">' + options + '</select>';

            $('#select_block_module_placeholder').html(html);
            $('select#select_block_module').chosen();

            $('#select_block_module').on('change', function(){
                structure.blocksInput.drawSelectModuleMode($(this).val(), 1);
                structure.blocksInput.drawSelectContentId($(this).val(), 1, '');
                structure.blocksInput.drawSelectModuleTemplate($(this).val(), 1);
            });
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

                options += '<option autocomplete="off" '+selected+' value="'+module.modes[i].id+'">'+module.modes[i].name+'</option>';
            };

            var html = '<select id="select_block_module_mode">' + options + '</select>';

            $('#select_block_module_mode_placeholder').html(html);
            $('select#select_block_module_mode').chosen();

            $('#select_block_module_mode').on('change', function(){
                structure.blocksInput.drawSelectContentId($('#select_block_module').val(), $(this).val(), '');
                structure.blocksInput.drawSelectModuleTemplate($('#select_block_module').val(), $(this).val());
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
                $.ajax({
                    url         : '/admin/structure/?ajax&action='+module_mode.action,
                    type        : 'GET',
                    dataType    : 'json',
                    beforeSend  : function(){
                        $('#select_block_content_id_placeholder').html('').parent().show();
                        core.loading.setLoadingToElementByAppend('drawSelectContentId', $('#select_block_content_id_placeholder'), true);
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

            blocks_html +=  '<div class="item main_block btn btn-inverse" rel="main" data-mode_template="' + this.main_block_obj.mode_template + '">' +
                                '<span class="num">♛</span>' +
                                '<span class="module_name">' + module.name + '</span>' +
                                '<span class="module_mode">' + module_mode.name + '</span>' +
                            '</div>';

            //Create oher blocks
            /*for(var i = 0, l = this.blocks_obj.length; i < l; i++){
                var module          = this.getblockModule(this.blocks_obj[i].module),
                    module_mode     = this.getblockModuleMode(this.blocks_obj[i].module, this.blocks_obj[i].module_mode);

                blocks_html +=  '<div class="item btn" rel="' + this.blocks_obj[i].id + '" data-mode_template="' + this.blocks_obj[i].mode_template + '">' +
                                    '<span class="num">' + this.blocks_obj[i].id + '</span>' +
                                    '<span class="module_name">' + module.name + '</span>' +
                                    '<span class="module_mode">' + module_mode.name + '</span>' +
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
                        console.log(this.blocks_obj[i2])
                    };
                };

                if(block){
                    var module          = this.getblockModule(block.module),
                        module_mode     = this.getblockModuleMode(block.module, block.module_mode);

                    id                  = blocks_etalon[i].id;
                    block_module        = module.name;
                    block_module_mode   = module_mode.name;
                    template            = block.mode_template;
                    block_class         = 'btn-info';
                }else{
                    id                  = blocks_etalon[i].id;
                    block_module        = 'Пустой блок';
                    block_module_mode   = '';
                    block_class         = 'empty_block';
                };

                blocks_html +=  '<div class="item btn '+block_class+'" rel="'+id+'" data-id="'+id+'" data-mode_template="' + template + '">' +
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
                content_id;

            if($item_obj.hasClass('empty_block')){
                block_id = 'empty';
            };

            switch(block_id){
                case 'main' : {
                    header = 'Настройка основного блока';
                    module = this.main_block_obj.module;
                    module_mode = this.main_block_obj.module_mode;
                    content_id  = this.main_block_obj.content_id;
                }; break;

                case 'new' : {
                    header = 'Новый блок №' + (this.blocks_obj.length+1);
                    module = 1;
                    module_mode = 1;
                    content_id  = 0;
                }; break;

                case 'empty' : {
                    header = 'Настройка пустого блока №'+$item_obj.data('id');
                    module = 1;
                    module_mode = 1;
                    content_id  = 0;
                    block_id = $item_obj.data('id');
                }; break;

                default : {
                    var block_data = this.getBlockData(block_id);
                    header = 'Настройка блока №'+block_id;
                    module = block_data.module;
                    module_mode = block_data.module_mode;
                    content_id  = block_data.content_id;

                    var aftershow = function(){
                        $('.modal-footer').append('<input type="button" class="btn btn-danger delete_block_button" value="Сбросить">');

                        $('.delete_block_button').off('click').on('click', function(){
                            structure.blocksInput.deleteBlock($item_obj);
                            core.modal.closeDialog();
                        });
                    };
                }; break;
            };

            var content =   '<form class="form-horizontal">' +
                                '<fieldset>' +
                                    '<div class="control-group">' +
                                        '<label class="control-label" for="select_block_module">Модуль</label>' +
                                        '<div class="controls" id="select_block_module_placeholder"></div>' +
                                    '</div>' +

                                    '<div class="control-group">' +
                                        '<label class="control-label" for="select_block_module_mode">Режим</label>' +
                                        '<div class="controls" id="select_block_module_mode_placeholder"></div>' +
                                    '</div>' +

                                    '<div class="control-group">' +
                                        '<label class="control-label" for="select_block_mode_template">Шаблон</label>' +
                                        '<div class="controls" id="select_block_mode_template_placeholder"></div>' +
                                    '</div>' +

                                    '<div class="control-group">' +
                                        '<label class="control-label" for="select_block_content_id">Контент-юнит</label>' +
                                        '<div class="controls" id="select_block_content_id_placeholder"></div>' +
                                    '</div>' +
                                '</fieldset>' +
                            '</form>';

            core.modal.showDialog({
                content: content,
                header: header,
                width: 500,
                action: function(){
                    structure.blocksInput.getAndSetBlockParams(block_id);
                }
            });

            if(aftershow){
                aftershow();
            };

            this.drawSelectModule(module);
            this.drawSelectModuleMode(module, module_mode);
            this.drawSelectModuleTemplate(module, module_mode, mode_template);
            this.drawSelectContentId(module, module_mode, content_id);
        },

        getAndSetBlockParams: function(block_id){
            var block_data,
                new_block = false;

            if(block_id == 'main'){
                this.main_block_obj.module          = parseInt($('#select_block_module').val());
                this.main_block_obj.module_mode     = parseInt($('#select_block_module_mode').val());
                this.main_block_obj.mode_template   = $('#select_block_mode_template').val();
                this.main_block_obj.content_id      = parseInt($('#select_block_content_id').val());

                block_data = this.main_block_obj;

                var module      = this.getblockModule(block_data.module),
                    module_mode = this.getblockModuleMode(block_data.module, block_data.module_mode);

                $block_item = $('#blocks .item[rel="main"]');
                $block_item.find('span.module_name').html(module.name);
                $block_item.find('span.module_mode').html(module_mode.name);
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
                        content_id      : parseInt($('#select_block_content_id').val())
                    });
                };

                for(var i = 0, l = this.blocks_obj.length; i < l; i++){
                    if(this.blocks_obj[i].id == block_id){
                        this.blocks_obj[i].module           = parseInt($('#select_block_module').val());
                        this.blocks_obj[i].module_mode      = parseInt($('#select_block_module_mode').val());
                        this.blocks_obj[i].mode_template    = $('#select_block_mode_template').val();
                        this.blocks_obj[i].content_id       = parseInt($('#select_block_content_id').val());

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
                        content_id      : parseInt($('#select_block_content_id').val())
                    };

                    this.blocks_obj.push(block_data);
                };

                var module      = this.getblockModule(block_data.module),
                    module_mode = this.getblockModuleMode(block_data.module, block_data.module_mode);

                if(new_block){
                    var new_block_html =    '<div class="btn item popup_effect" rel="' + block_id + '" data-mode_template="'+$('#select_block_mode_template').val()+'">' +
                                                '<span class="num">' + block_id + '</span>' +
                                                '<span class="module_name">' + module.name + '</span>' +
                                                '<span class="module_mode">' + module_mode.name + '</span>' +
                                            '</div>';

                    $('#blocks .item[rel="new"]').before(new_block_html);
                }else{
                    var $block_item  = $('#blocks .item[rel="'+block_id+'"]');

                    $block_item.removeClass('empty_block').addClass('btn-info');
                    $block_item.find('span.module_name').html(module.name);
                    $block_item.find('span.module_mode').html(module_mode.name);
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
                html                =   '<div class="control-group">' +
                                            '<label class="control-label">Блоки</label>' +
                                            '<div class="controls">' +
                                                '<div id="blocks" class="input_holder thumbnail blocks"></div><div class="clear"></div>' +
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

    openItemByHash: function(){
        if(window.location.hash){
            var id = window.location.hash.substr(1, window.location.hash.length);
            id = parseInt(id);

            if(id > 0){
                this.openStructureItem(id);
            };
        };
    },

    binds: function(){
        $('.tree li i.arrow').on('click', function(){
            structure.expandCollapseStructureItem($(this));
        });

        $(window).on('hashchange', function(){
            structure.openItemByHash();
        });
    },

    showHideMarker: function(){
        if($('.tree li.active a').is(':visible')){
            $('#active_tree_item_marker').fadeIn(100);
        }else{
            $('#active_tree_item_marker').fadeOut(100);
        };
    },

    saveBranchesConditions: function(){
        var conditions = new Object();

        $('.tree_holder').find('ul').each(function(){
            conditions[$(this).attr('id')] = ($(this).hasClass('closed'))? '0': '1';
        });

        core.storage.setJSON('tree_branches_conditions', conditions);
    },

    readBranchesConditions: function(){
        var conditions = core.storage.getJSON('tree_branches_conditions');

        if(conditions == null){
            this.saveBranchesConditions();
            this.readBranchesConditions();
        }else{
            $('.tree_holder').find('ul').each(function(){
                if(conditions[$(this).attr('id')] != null){
                    if(conditions[$(this).attr('id')] == '0'){
                        $(this).addClass('closed').prev().prev().addClass('closed');
                    }else{
                        $(this).prev().prev().addClass('opened');
                    };
                };
            });
        };
    },

    expandCollapseStructureItem: function(obj){
        var sub = obj.next().next();

        if(obj.hasClass('opened')){
            obj.removeClass('opened').addClass('closed');

            sub.slideUp(100, function(){
                structure.setMarkerToActivePosition(0);
                sub.addClass('closed');
                structure.saveBranchesConditions();
                structure.resizeing();
            });

        }else if(obj.hasClass('closed')){
            obj.removeClass('closed').addClass('opened');

            sub.slideDown(100, function(){
                structure.setMarkerToActivePosition(0);
                sub.removeClass('closed');
                structure.saveBranchesConditions();
                structure.resizeing();
            });
        };
    },

    saveItemData: function(data){
        this.save_item_request = $.ajax({
            url         : '/admin/structure/?ajax&action=set_node_data',
            type        : 'POST',
            data        : data,
            dataType    : 'json',
            beforeSend  : function(){
                core.loading.setLoadingWithNotify('saveItemData', false, 'Сохранение');

                if(structure.save_item_request != null){
                    structure.save_item_request.abort();
                };
            },
            success     : function(result){
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

                $('#leaf_' + data.id + '>a>span').html(data.name);
                $('#leaf_' + data.id + '>a').removeClass('published').removeClass('hidden').addClass(status_class);
                $('#leaf_' + data.id + '>a i.item_icon').attr('class', 'item_icon ' + module_icon_class);

                $('#current_path').attr('href', result.path).html(result.path);
                $('#text_part').val(result.part);

                structure.setMarkerToActivePosition();

                setTimeout(function(){
                    core.loading.unsetLoading('saveItemData');
                }, 200);
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

        var html =  '<a title="Открыть узел в новом окне" target="_blank" href="'+data.node_data.path+'" class="label label-info">' +
                        '<i class="new_window"></i>' +
                        '<span id="current_path">'+data.node_data.path+'</span>' +
                    '</a>';

        $('.inner_tools').html(html);

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

        this.blocksInput.init();
    },

    openStructureItem: function(leaf_id){
        $('.tree li.active').removeClass('active');

        var parent = $('li#leaf_'+leaf_id);

        $('.arrow_hider').remove();
        parent.parent().parent().find('>i.arrow').after('<div class="arrow_hider"></div>');

        parent.addClass('active');
        this.setMarkerToActivePosition(150);

        if(this.current_leaf_opened != leaf_id){
            if(structure.item_request != null){
                structure.item_request.abort();
                core.loading.unsetLoading('openStructureItem');
            };

            $('.structure_item_content').animate({
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
                            id: leaf_id
                        },
                        dataType: 'json',
                        beforeSend: function(){
                            core.loading.setLoadingToElementCenter('openStructureItem', $('.structure_item_content'));
                            structure.resizeing();
                        },
                        success: function(data){
                            core.loading.unsetLoading('openStructureItem');

                            if(data != null){
                                structure.createEditItemForm(data);
                                structure.resizeing();

                                $('.structure_item_content').animate({
                                    opacity: 1
                                }, {
                                    duration: 500,
                                    specialEasing: {
                                        opacity : 'easeOutExpo'
                                    }
                                });
                            };
                        }
                    });

                    structure.current_leaf_opened = leaf_id;
                }
            });
        };
    },

    setMarkerToActivePosition: function(speed){
        var tree_active_item = $('.tree li.active a'),
            maker            = $('#active_tree_item_marker');

        this.showHideMarker();

        if(tree_active_item.length > 0){
            var top     = tree_active_item.offset().top - $('.tree').offset().top + 8,
                height  = tree_active_item.height() + 4;

            if(maker.css('opacity') <= 0){
                maker.css({
                    top     : top,
                    height  : height
                });
            };

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

    init: function(){
        core.preloadImages([
            '/admin/resources/img/bg/popup.png',
            '/admin/resources/img/icons/micro_spinner.gif'
        ]);

        $('.tree_holder').disableSelection();
        this.readBranchesConditions();
        this.setMarkerToActivePosition(0);
        this.binds();
        this.resizeing();
        this.openItemByHash();
    },

    resizeing: function(){
        this.setMarkerToActivePosition(0);
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