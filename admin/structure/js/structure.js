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
        modules: [
            {id: 1, name : 'Страницы', modes: [
                {   id: 1,
                    name: 'HTML-страница',
                    action: 'get_pages'
                }
            ]},

            {id: 2, name : 'Меню', modes: [
                {
                    id: 1,
                    name: 'Одноуровневое',
                    action: 'get_menu_list'
                },
                {
                    id: 2,
                    name: 'Многоуровневое',
                    action: 'get_menu_list'
                }
            ]},

            {id: 3, name : 'Новости', modes: [
                {
                    id: 1,
                    name: 'Список линеек',
                    action: false
                },
                {
                    id: 2,
                    name: 'Линейка',
                    action: 'get_news_section'
                }
            ]},

            {id: 4, name : 'Галерея', modes: [
                {
                    id: 1,
                    name: 'Вся галерея',
                    action: false
                },
                {
                    id: 2,
                    name: 'Альбом',
                    action: 'get_albums'
                },
                {
                    id: 3,
                    name: 'Случайная фотография',
                    action: false
                }
            ]}
        ],

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

        getblockData: function(id){
            for(var i = 0, l = this.blocks_obj.length; i < l; i++){
                if(this.blocks_obj[i].id == id){
                    var block = this.blocks_obj[i];
                };
            };

            return block;
        },

        setData: function(){
            $('#hidden_blocks').val(encodeURI(JSON.stringify(this.blocks_obj)));
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

            $('#select_block_module').on('change', function(){
                structure.blocksInput.drawSelectModuleMode($(this).val(), 1);
                structure.blocksInput.drawSelectContentId($(this).val(), 1, '');
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

            $('#select_block_module_mode').on('change', function(){
                structure.blocksInput.drawSelectContentId($('#select_block_module').val(), $(this).val(), '');
            });
        },

        drawSelectContentId: function(module, module_mode, content_id){
            var module_mode = this.getblockModuleMode(module, module_mode),
                options = new String(),
                html = new String(),
                selected;

            if(module_mode.action != false){
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
                            /*case 'get_albums' : {
                                for(var i = 0, l = result.length; i < l; i++){
                                    if(result[i].id == content_id){
                                        selected = ' selected';
                                    }else{
                                        selected = '';
                                    };

                                    options += '<div class="item'+selected+'" value="'+result[i].id+'">'+result[i].name+'</div>';
                                };

                                html += '<input type="hidden" id="select_block_content_id" value="'+content_id+'" />';
                                html += '<div class="content_id_albums">' +
                                            options +
                                            '<div class="clear"></div>' +
                                        '</div>';

                                $('#select_block_content_id_placeholder').html(html);
                            }; break;*/

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

        getAndSetblockParams: function(block_id){
            var block_data,
                new_block = false;

            if(block_id == 'new'){
                block_id     = structure.blocksInput.blocks_obj.length+1;
                new_block    = true;

                this.blocks_obj.push({
                    id            : block_id,
                    module        : parseInt($('#select_block_module').val()),
                    module_mode   : parseInt($('#select_block_module_mode').val()),
                    content_id    : parseInt($('#select_block_content_id').val())
                });
            };

            for(var i = 0, l = this.blocks_obj.length; i < l; i++){
                if(this.blocks_obj[i].id == block_id){
                    this.blocks_obj[i].module        = parseInt($('#select_block_module').val());
                    this.blocks_obj[i].module_mode   = parseInt($('#select_block_module_mode').val());
                    this.blocks_obj[i].content_id    = parseInt($('#select_block_content_id').val());

                    block_data = this.blocks_obj[i];
                };
            };

            var module      = this.getblockModule(block_data.module),
                module_mode = this.getblockModuleMode(block_data.module, block_data.module_mode);

            if(new_block){
                var new_block_html = '<div class="item popup_effect" rel="' + block_id + '">' +
                                        '<span class="num">' + block_id + '</span>' +
                                        '<span class="module_name">' + module.name + '</span>' +
                                        '<span class="module_mode">' + module_mode.name + '</span>' +
                                    '</div>';

                $('#blocks .item[rel="new"]').before(new_block_html);
            }else{
                var $block_item  = $('#blocks .item[rel="'+block_id+'"]');

                $block_item.find('.module_name').html(module.name);
                $block_item.find('.module_mode').html(module_mode.name);
            };

            $('#hidden_blocks').val(encodeURIComponent(JSON.stringify(this.blocks_obj)));
        },

        editblock: function($item_obj){
            var block_id = $item_obj.attr('rel'),
                block_data = this.getblockData(block_id),
                header,
                module,
                module_mode,
                content_id;

            if(block_id == 'new'){
                header = 'Новый блок №' + (this.blocks_obj.length+1);
                module = 1;
                module_mode = 1;
                content_id  = 0;
            }else{
                header = 'Настройка блока №'+block_id;
                module = block_data.module;
                module_mode = block_data.module_mode;
                content_id  = block_data.content_id;
            };

            var content =   '<h2>'+header+'</h2>' +
                            '<div class="block_setup">' +
                                '<table>' +
                                    '<tr>' +
                                        '<th><label for="select_block_module">Модуль</label></th>' +
                                        '<td id="select_block_module_placeholder"></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                        '<th><label for="select_block_module_mode">Режим модуля</label></th>' +
                                        '<td id="select_block_module_mode_placeholder"></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                        '<th><label for="select_block_content_id">Контент-юнит</label></th>' +
                                        '<td id="select_block_content_id_placeholder"></td>' +
                                    '</tr>' +
                                '</table>' +
                            '</div>';

            core.modal.showDialog({
                content: content,
                width: 500,
                action: function(){
                    structure.blocksInput.getAndSetblockParams(block_id);
                }
            });

            this.drawSelectModule(module);
            this.drawSelectModuleMode(module, module_mode);
            this.drawSelectContentId(module, module_mode, content_id);
        },

        init: function(){
            var blocks_value =   core.form.options.data.blocks,
                blocks_html  =   new String(),
                html        =   'Блоки' +
                                '<div id="blocks" class="input_holder"></div>' +
                                '<input type="hidden" id="hidden_blocks" name="blocks" value="'+encodeURIComponent(blocks_value)+'" />';

            this.blocks_obj = $.parseJSON(blocks_value);
            core.form.options.container_obj.find('form#'+core.form.options.form_id).find('.form_items').append(html);

            for(var i = 0, l = this.blocks_obj.length; i < l; i++){
                var module          = this.getblockModule(this.blocks_obj[i].module),
                    module_mode     = this.getblockModuleMode(this.blocks_obj[i].module, this.blocks_obj[i].module_mode);

                blocks_html +=   '<div class="item" rel="' + this.blocks_obj[i].id + '">' +
                                    '<span class="num">' + this.blocks_obj[i].id + '</span>' +
                                    '<span class="module_name">' + module.name + '</span>' +
                                    '<span class="module_mode">' + module_mode.name + '</span>' +
                                '</div>';
            };

            blocks_html +=   '<div class="item" rel="new">' +
                                '<span class="num plus">+</span>' +
                                '<span class="module_name">Добавить блок</span>' +
                                '<span class="module_mode"></span>' +
                            '</div>' +
                            '<div class="clear"></div>';

            $('#blocks').html(blocks_html);

            $('#blocks .item').live('click', function(){
                structure.blocksInput.editblock($(this));
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
                structure.setMarkerToActivePosition();
                sub.addClass('closed');
                structure.saveBranchesConditions();
                structure.resizeing();
            });

        }else if(obj.hasClass('closed')){
            obj.removeClass('closed').addClass('opened');

            sub.slideDown(100, function(){
                structure.setMarkerToActivePosition();
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
                var status_class;

                if(result.publish == '1'){
                    status_class = 'published';
                }else{
                    status_class = 'hidden';
                };

                $('#leaf_' + data.id + '>a>span').html(data.name);
                $('#leaf_' + data.id + '>a').removeClass('published').removeClass('hidden').addClass(status_class);

                $('#current_path').attr('href', result.path).html(result.path);
                $('#text_part').val(result.part);

                structure.setMarkerToActivePosition();

                setTimeout(function(){
                    core.loading.unsetLoading();
                }, 200);
            }
        });
    },

    createEditItemForm: function(data){
        core.form.createForm({
            form_id             : 'edit_item_form',
            container_obj       : $('#form'),
            data                : data.node_data,
            beforeSubmit        : function(){
                structure.resizeing();
            },
            submit              : function(data){
                structure.saveItemData(data);
            }
        });

        var html =  '<a title="Открыть узел в новом окне" target="_blank" href="'+data.node_data.path+'" class="mono gray_button">' +
                        '<i class="new_window"></i>' +
                        '<span id="current_path">'+data.node_data.path+'</span>' +
                    '</a>';

        $('.structure_item_content .inner_tools').html(html);

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

        this.blocksInput.init();

        /*core.form.drawTextInput({
            label       : 'SEO Title',
            name        : 'seo_title',
            collapsed   : true
        });

        core.form.drawTextarea({
            label       : 'SEO Keywords',
            name        : 'seo_keywords',
            visywig     : false,
            rows        : 6,
            collapsed   : true
        });

        core.form.drawTextarea({
            label       : 'SEO Description',
            name        : 'seo_description',
            visywig     : false,
            rows        : 6,
            collapsed   : true
        });*/

        /*

        core.form.drawRadioButtonInput({
            name    : 'type',
            options : [
                {
                    label   : 'Текстовая страница',
                    value   : 1
                },
                {
                    label   : 'Фотогалерея',
                    value   : 2
                },
                {
                    label   : 'Блог',
                    value   : 3
                }
            ]
        });

        core.form.drawTextarea({
            label   : 'Контент',
            name    : 'content',
            visywig : true,
            rows    : 20
        });

        core.form.drawHiddenInput({
            name    : 'id'
        });

        */
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
            var top     = tree_active_item.offset().top - $('.tree').offset().top - 3,
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
        var lc_height = $('.structure_left_col').height();

        $('.structure .vline').css({
            height: 0
        });

        $('.structure_right_col, .structure_item_content').css({
            minHeight: 0
        });

        $('.structure_right_col').css({
            minHeight: lc_height
        });

        $('.structure .vline').css({
            height: $('.black_linen_container').height()
        });

        $('.structure_item_content').css({
            minHeight: $('.structure_right_col').height()
        });

        this.setMarkerToActivePosition(0);
    }
};

$(function(){
    structure.init();
});

$(window).resize(function(){
    structure.resizeing();
});

$(window).scroll(function(){
    structure.resizeing();
});