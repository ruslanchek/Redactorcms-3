'use strict';

var core = {
    options: {

    },

    tableZebra: function(obj){
        obj.find('tr').removeClass('odd').removeClass('even');
        obj.find('tr:not(.ui-sortable-helper):odd').not(':first').addClass('odd');
        obj.find('tr:not(.ui-sortable-helper):even').not(':first').addClass('even');
    },

    preloadImages: function(images_array){
        this.preloaded_images = new Array();
        
        for(var i = 0, l = images_array.length; i < l; i++){
            this.preloaded_images[i] = new Image();
            this.preloaded_images[i].src = images_array[i];
        };
    },

    init: function(){
        jQuery.easing.def = "easeOutQuad";
        this.keyboard.init();
    }
};

core.utilities = {
    plural: function(i, str1, str3, str5){
        function plural (a){
            if ( a % 10 == 1 && a % 100 != 11 ) return 0
            else if ( a % 10 >= 2 && a % 10 <= 4 && ( a % 100 < 10 || a % 100 >= 20)) return 1
            else return 2;
        };

        switch (plural(i)) {
            case 0: return str1;
            case 1: return str3;
            default: return str5;
        };
    },

    explode: function(delimiter, string, limit) {
        var emptyArray = {
            0: ''
        };

        // third argument is not required
        if (arguments.length < 2 || typeof arguments[0] == 'undefined' || typeof arguments[1] == 'undefined') {
            return null;
        }

        if (delimiter === '' || delimiter === false || delimiter === null) {
            return false;
        }

        if (typeof delimiter == 'function' || typeof delimiter == 'object' || typeof string == 'function' || typeof string == 'object') {
            return emptyArray;
        }

        if (delimiter === true) {
            delimiter = '1';
        }

        if (!limit) {
            return string.toString().split(delimiter.toString());
        }
        // support for limit argument
        var splitted = string.toString().split(delimiter.toString());
        var partA = splitted.splice(0, limit - 1);
        var partB = splitted.join(delimiter.toString());
        partA.push(partB);
        return partA;
    },

    jsonNullToEmptyString: function(str){
        if(str === null){
            return '';
        }else{
            return str;
        };
    },

    getParameterByName: function(name){
        name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");

        var regexS = "[\\?&]" + name + "=([^&#]*)";
        var regex = new RegExp(regexS);
        var results = regex.exec(window.location.search);

        if(results == null){
            return "";
        }else{
            return decodeURIComponent(results[1].replace(/\+/g, " "));
        };
    }
};

core.storage = {
    set: function(name, string){
        window.localStorage.setItem(name, string);
    },

    get: function(name){
        return window.localStorage.getItem(name);
    },

    setJSON: function(name, object){
        this.set(name, JSON.stringify(object));
    },

    getJSON: function(name){
        return $.parseJSON(this.get(name));
    },

    remove: function(name){
        window.localStorage.removeItem(name);
    }
};

core.keyboard = {
    keys: {},

    unBindKeyboardAction: function(keycode){
        this.keys[keycode] = undefined;
    },

    bindKeyboardAction: function(keycode, unbind_after_exec, action){
        this.keys[keycode] = {
            action: action,
            unbind_after_exec: unbind_after_exec
        };
    },

    processKeyboard: function(event){
        if(this.keys[event.keyCode] != null && typeof this.keys[event.keyCode].action != 'undefined'){
            this.keys[event.keyCode].action();

            if(this.keys[event.keyCode].unbind_after_exec === true){
                this.unBindKeyboardAction(event.keyCode);
            };
        };
    },

    init: function(){
        $('body').live('keyup', function(){
            core.keyboard.processKeyboard(event);
        });
    }
};

core.loading = {
    unsetLoading: function(name, micro){
        if($('.notify .loading_area').html() != ''){
            var kill_notify = true;
        };

        var $loading = $('i.loading[name="'+name+'"]');

        if(!micro){
            this.stopAnimation(name);
        };

        $loading.remove();

        if(kill_notify){
            core.notify.hideNotify();
        };
    },

    animationIteration: function(name){
        var $loading = $('i.loading[name="'+name+'"]'),
            pos = $loading.data('pos');

        if((pos + 42) < (42*12)){
            pos += 42;
        }else{
            pos = 0;
        };

        $loading.data('pos', pos).css({
            backgroundPosition: '0 -' + pos + 'px'
        });
    },

    stopAnimation: function(name){
        var $loading = $('i.loading[name="'+name+'"]');

        $loading.data('pos', 0);

        if(typeof $loading.data('animation_interval') != 'undefined'){
            clearInterval($loading.data('animation_interval'));
        };
    },

    //todo: побороть баг с многократным вызовом анимации

    startAnimation: function(name){
        var $loading = $('i.loading[name="'+name+'"]');

        this.stopAnimation(name);

        $loading.data(
            'animation_interval',
            setInterval(function(){core.loading.animationIteration(name)}, 70)
        );
    },

    setLoadingToElementPos: function(name, obj, top, left, zIndex, micro){
        var micro_class = new String();

        if(micro){
            micro_class += ' micro'
        };

        if(!zIndex){
            zIndex = 100;
        };

        var obj_offset = obj.offset();

        var $loading = $('<i name="'+name+'" class="loading'+micro_class+'"></i>')

        $loading.css({
            top     : obj_offset.top + $loading.height()/2 + top,
            left    : obj_offset.left + $loading.width()/2 + left,
            zIndex  : zIndex
        });

        $('body').prepend($loading);

        if(!micro){
            this.startAnimation(name);
        };

        return $loading;
    },

    setLoadingToElementCenter: function(name, obj, zIndex, micro){
        var micro_class = new String();

        if(micro){
            micro_class += ' micro'
        };

        var obj_offset = obj.offset();

        if(!zIndex){
            zIndex = 100;
        };

        var $loading = $('<i name="'+name+'" class="loading'+micro_class+'"></i>').css({
            top     : obj_offset.top + obj.height()/2,
            left    : obj_offset.left + obj.width()/2,
            zIndex  : zIndex
        });

        $('body').prepend($loading);

        $(window).bind('resize', function(){
            var obj_offset = obj.offset();
            $loading.css({
                top     : obj_offset.top + obj.height()/2,
                left    : obj_offset.left + obj.width()/2
            });
        });

        if(!micro){
            this.startAnimation(name);
        };

        return $loading;
    },

    setLoadingToElementByAppend: function(name, obj, micro){
        var micro_class = new String();

        if(micro){
            micro_class += ' micro'
        };

        var $loading = $('<i name="'+name+'" class="loading'+micro_class+'"></i>').css({
            margin  : '0'
        });

        obj.append($loading);

        if(!micro){
            this.startAnimation(name);
        };

        return $loading;
    },

    setLoadingWithNotify: function(name, micro, text){
        core.notify.showNotify('<h2>'+text+'</h2><div class="loading_area"></div>');
        this.setLoadingToElementByAppend(name, $('.notify .loading_area'), micro);
    }
};

core.modal = {
    __action: void(0),

    createOverlay: function(){
        $('.overlay').remove();

        var html = '<div class="overlay"></div>';
        $('body').prepend(html);
    },

    closeDialog: function(){
        $('.dialog')
            .fadeOut(150, 'easeOutQuad', function(){
                $('.dialog').remove();
            });

        $('.overlay').animate({
            opacity: 0
        }, {
            duration: 100,
            complete: function(){
                $('.overlay').remove();
            }
        });
    },

    createDialog: function(){
        $('.dialog').remove();
        var ok;

        if(this.options.action != null){
            ok = '<input class="btn btn-primary pull-left ok" type="submit" value="ОК" />';
        }else{
            ok = '';
        };

        var html =  $('<div class="modal dialog">' +
                        '<div class="modal-header">' +
                            '<button class="close" data-dismiss="modal">×</button>' +
                            '<h3>' + this.options.header + '</h3>' +
                        '</div>' +
                        '<div class="modal-body">' +
                            this.options.content +
                        '</div>' +
                        '<div class="modal-footer">' +
                            ok +
                            '<input class="btn pull-left cancel" type="button" value="Закрыть" />' +
                        '</div>' +
                    '</div>');


        $('body').prepend(html);

        $('.dialog').css({
            marginTop: -$('.dialog').height()/2
        });

        if(this.options.width > 0){
            $('.dialog').css({
                width: this.options.width,
                marginLeft: -this.options.width/2
            });
        };

        $('.dialog .ok').on('click', function(){
            core.modal.__action();
            core.modal.closeDialog();
        });

        $('.dialog .cancel, .dialog .close').on('click', function(){
            core.modal.closeDialog();
        });

        core.keyboard.bindKeyboardAction('13', true, function(){
            core.modal.__action();
            core.modal.closeDialog();
            core.keyboard.unBindKeyboardAction('27');
        });

        core.keyboard.bindKeyboardAction('27', true, function(){
            core.modal.closeDialog();
            core.keyboard.unBindKeyboardAction('13');
        });
    },

    /**
     * Создает модальное окно
     *
     * @param {Object} options Параметры ({String} content Содержимое, {Function} action Действие при подтверждении)
     */
    showDialog: function(options){
        this.options = {
            content: new String()
        };

        this.__action = options.action;
        this.options = options;

        this.createOverlay();
        this.createDialog();
    }
};

core.notify = {
    showNotify: function(content){
        $('.notify').remove();
        var html = '<div class="notify">'+content+'</div>';
        $('body').prepend(html);

        var $notify = $('.notify');
        $notify.css({
            marginTop: -$notify.height()/2
        });
    },

    hideNotify: function(){
        setTimeout(function(){
            var $notify = $('.notify');
            $notify.fadeOut(100, function(){
                $notify.remove();
            });
        }, 200);
    }
};

core.form = {
    options: {
        form_id         : new String(), //ID создаваемой формы
        container_obj   : new Object(), //jQuery-объект контейнера-родителя для формы,
        data            : new Object(), //Данные элемента
        submit          : function(data){}
    },

    validator: {
        methods: {
            required: function(val){
                return (val != '');
            },

            email: function (val){
                return /^(?:\w+\.?)*\w+@(?:\w+\.)+\w+$/.test(val);
            },

            minLength: function(val, params){
                return val.length >= params.length;
            },

            maxLength: function(val, params){
                return val.length <= params.length;
            },

            equal: function(val, params){
                return(val == params.other_val);
            },

            ajax: function(val, params){
                var result;

                $.ajax({
                    url         : params.url,
                    data        : $.extend(params.data, {value: val}),
                    type        : 'post',
                    dataType    : 'json',
                    async       : false,
                    success     : function(data){
                        result = data;
                    }
                });

                return (result === false);
            }
        },

        validate: function(form){
            var valid = true;
            $('.field_error').remove();
            $('form .error').removeClass('error');

            form.find('input, textarea, select').not(':submit').each(function(){
                var validate;

                if(validate = $(this).data('validate')){
                    for(var i = 0, l = validate.length; i < l; i++){
                        if(typeof validate[i].method != 'undefined' && core.form.validator.methods[validate[i].method] !== null){
                            if(!core.form.validator.methods[validate[i].method]($(this).val(), validate[i].params)){
                                valid = false;
                                var error = $('<span class="help-inline field_error">' + validate[i].message + '</span>');
                                $(this).parent().parent().addClass('error');
                                $(this).parent().append(error);
                            };
                        };
                    };
                };
            });

            if(valid){
                return true;
            };
        },

        bind: function(obj, validate){
            if(validate){
                obj.data('validate', validate);
            };
        }
    },

    //Создаем форму
    createForm: function(options){
        this.options = $.extend(this.options, options);
        this.createFormContainer();
    },

    //Создание формы
    createFormContainer: function(){
        var html =  '<form action="javascript:void(0)" class="form-horizontal" id="'+this.options.form_id+'">' +
                        '<fieldset class="form_items "></fieldset>' +
                        '<hr>' +
                        '<input class="btn" type="submit" name="save" value="Сохранить" />' +
                    '</form>';

        this.options.container_obj.html(html);

        var form = this.options.container_obj.find('form#'+this.options.form_id);

        form.on('submit', function(){
            var data = new Object();

            $(this).find('input, textarea, select').not(':submit').each(function(){
                var name, value;

                if($(this).attr('type') == 'checkbox'){
                    name = $(this).attr('name');
                    value = ($(this).is(':checked')) ? 1 : 0;
                    data[name] = value;

                }else if($(this).attr('type') == 'radio' && $(this).attr('checked') == 'checked'){
                    name = $(this).attr('name');
                    value = $(this).val();
                    data[name] = value;

                }else if($(this).attr('type') != 'radio'){
                    name = $(this).attr('name');
                    value = $(this).val();
                    data[name] = value;
                };
            });

            var valid = core.form.validator.validate(form);
            core.form.options.beforeSubmit();

            if(valid){
                core.form.options.submit(data);
            };
        });
    },

    //Рисование чекбокса
    drawCheckboxInput: function(data){
        var id      =   'checkbox_' + data.name,
            checked =   (this.options.data[data.name] == '1') ? 'checked="checked"' : '',
            html    =   '<div class="control-group">' +
                            '<label class="control-label" for="'+id+'">' + data.label + '</label>' +
                            '<div class="controls">' +
                                '<label class="checkbox"><input type="checkbox" id="' + id + '" '+checked+' name="'+data.name+'"></label>' +
                            '</div>' +
                        '</div>';

        this.options.container_obj.find('form#'+this.options.form_id).find('.form_items').append(html);
    },

    //Рисование радиокнопок
    drawRadioButtonInput: function(data){
        var id          = 'checkbox_' + data.name,
            radios_html = new String(),
            width       = Math.floor(100/data.options.length),
            items       = new String();

        for(var i = 0, l = data.options.length; i < l; i++){
            var checked = (data.options[i].value == this.options.data[data.name]) ? 'checked="checked"' : '',
                active  = (data.options[i].value == this.options.data[data.name]) ? 'class="active"' : '';

            radios_html +=  '<td width="' + width + '%">' +
                                '<label ' + active + '>' +
                                    '<input type="radio" id="' + id + '_' + data.options[i].value + '" name="' + data.name + '" ' + checked + ' value="' + data.options[i].value + '" />' +
                                    data.options[i].label +
                                '</label>' +
                            '</td>';

            items += '#' + id + '_' + data.options[i].value + ', ';
        };

        items = items.substr(0, items.length - 2);

        var html =  '<div class="clear"></div>' +
                    '<div class="radio_container input_holder">' +
                        '<table>' +
                            '<tr>' + radios_html + '</tr>' +
                        '</table>' +
                    '</div>' +
                    '<div class="clear"></div>';

        this.options.container_obj.find('form#'+this.options.form_id).find('.form_items').append(html);

        $(items).on('change', function(){
            $(items).parent().removeClass('active');
            $(this).parent().addClass('active');
        });
    },

    //Рисование текстарии
    drawTextarea: function(data){
        var id          =   'textarea_' + data.name,
            collapsed   =   (data.collapsed) ? 'collapsed' : '',
            html        =   '<label>' +
                                data.label +
                                '<div class="textarea input_holder '+collapsed+'">' +
                                    '<textarea id="' + id + '" name="'+data.name+'" rows="' + data.rows + '">' +
                                        core.utilities.jsonNullToEmptyString(this.options.data[data.name]) +
                                    '</textarea>' +
                                '</div>' +
                            '</label>';

        this.options.container_obj.find('form#'+this.options.form_id).find('.form_items').append(html);

        if(data.visywig){
            $('#'+id).redactor({

            });
        };
    },

    //Рисование текстового поля
    drawTextInput: function(data){
        var id          =   'text_' + data.name,
            collapsed   =   (data.collapsed) ? 'collapsed' : '',
            html        =   '<div class="control-group">' +
                                '<label class="control-label" for="' + id + '">' + data.label + '</label>' +
                                '<div class="controls '+collapsed+'">' +
                                    '<input class="input-xlarge" type="text" id="' + id + '" name="'+data.name+'" value="'+core.utilities.jsonNullToEmptyString(this.options.data[data.name])+'" />' +
                                '</div>' +
                            '</div>';

        this.options.container_obj.find('form#'+this.options.form_id).find('.form_items').append(html);

        if(typeof data.validate != 'undefined' && data.validate.length > 0){
            this.validator.bind($('#'+id), data.validate);
        };
    },

    //Рисование текстового поля
    drawSelectInput: function(data){
        var id      =   'select_' + data.name,
            options =   '<option value="">&mdash;</option>';

        for(var i = 0, l = data.options.length; i < l; i++){
            var selected = new String();

            if(this.options.data[data.name] == data.options[i].id){
                selected = 'selected="selected"';
            };

            options += '<option '+selected+' value="'+data.options[i].id+'">'+data.options[i].name+'</option>';
        };

        var html    =   '<div class="control-group">' +
                            '<label class="control-label" for="' + id + '">' + data.label + '</label>' +
                            '<div class="controls">' +
                                '<select id="' + id + '" name="'+data.name+'">' +
                                    options +
                                '</select>' +
                            '</div>' +
                        '</div>';

        this.options.container_obj.find('form#'+this.options.form_id).find('.form_items').append(html);

        if(typeof data.validate != 'undefined' && data.validate.length > 0){
            this.validator.bind($('#'+id), data.validate);
        };

        $('#'+id).chosen();
    },

    //Рисование скрытого элемента
    drawHiddenInput: function(data){
        var id      = 'hidden_' + data.name,
            html    =  '<input type="hidden" id="' + id + '" name="'+data.name+'" value="'+core.utilities.jsonNullToEmptyString(this.options.data[data.name])+'" />';

        this.options.container_obj.find('form#'+this.options.form_id).find('.form_items').append(html);
    }
};

$(function(){
    core.init();
});