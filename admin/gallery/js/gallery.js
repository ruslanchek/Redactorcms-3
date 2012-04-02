'use strict';

var gallery = {
    options: {

    },

    gallery_mode: 'normal',

    pubHideItem: function(obj){
        if(obj.attr('status') == '1'){
            obj.attr('status', '0').addClass('hidden');
        }else{
            obj.attr('status', '1').removeClass('hidden');
        };
    },

    deletePic: function(obj){
        core.modal.showDialog({
            content: 'Удалить картинку?',
            action: function(){
                var $obj = obj.parent(),
                    id = $obj.attr('rel');

                this.delete_img_request = $.ajax({
                    url         : '/admin/gallery/?ajax&action=delete_image&id='+id,
                    type        : 'GET',
                    beforeSend  : function(){
                        if(this.delete_img_request != null){
                            this.delete_img_request.abort();
                        };

                        core.loading.unsetLoading('deletePic_'+id);
                        core.loading.setLoadingToElementCenter('deletePic_'+id, $obj.find('i.preview'));
                    },
                    success     : function(){
                        core.loading.unsetLoading('deletePic_'+id);
                        $obj.removeClass('wobble').hide(250, 'easeOutQuad', function(){
                            $obj.remove();
                            gallery.reinitMode();
                        });
                    }
                });
            }
        });
    },

    deleteAlbum: function(obj){
        core.modal.showDialog({content: 'Удалить альбом вместе со всеми его картинками?', action: function(){
            var $obj = obj.parent();
            $obj.removeClass('wobble').hide(250, 'easeOutQuad', function(){
                $obj.remove();
                gallery.reinitMode();
            });
        }});
    },

    deleteAll: function(){
        core.modal.showDialog({content: 'Удалить все картинки альбома?', action: function(){
            $('.gallery_pics .items_holder .item').hide(250, 'easeOutQuad', function(){
                $('.gallery_pics .items_holder .item').remove();
                gallery.reinitMode();
            });
        }});
    },

    reinitMode: function(){
        var i = 0;

        $('.gallery_pics .item').each(function(){
            i++;
        });

        if(this.gallery_mode == 'normal'){
            $('#button_gallery_edit').show(150);
            $('#button_gallery_upload').show(150);
            $('#button_gallery_new_album').show(150);

            $('#button_gallery_edit_ok').hide(150);
            $('#button_gallery_delete_all').hide(150);
        }else{
            $('#button_gallery_edit').hide(150);
            $('#button_gallery_upload').hide(150);
            $('#button_gallery_new_album').hide(150);

            $('#button_gallery_edit_ok').show(150);

            if(i <= 0){
                $('#button_gallery_delete_all').hide(150);
            }else{
                $('#button_gallery_delete_all').show(150);
            };
        };
    },

    showPopup: function(obj, data){
        var html =  '<div class="popup popup_effect">' +
                        '<div class="top">' +
                            '<div class="popup_content">' +
                                '<form action="javascript:void(0)" id="image_edit_form">' +
                                    '<div class="params">' + 
                                        '<a target="_blank" href="/content/gallery/images/'+data.id+'.'+data.extension+'" class="show_pic"><span class="new_window"></span> Посмотреть изображение</a>' +
                                    '</div>' +
                                    '<label>Название картинки' +
                                        '<input type="text" id="picture_name" value="' + core.utilities.jsonNullToEmptyString(data.name) + '" />' +
                                    '</label>' +
                                    '<label>Описание картинки' + 
                                        '<textarea id="picture_description" rows="5">'+core.utilities.jsonNullToEmptyString(data.description)+'</textarea>' +
                                    '</label>' + 
                                    '<div class="buttons">' + 
                                        '<input class="dialog_button save" type="submit" value="ОК" />' +
                                        '<input class="dialog_button cancel" type="button" value="Закрыть" />' +
                                    '</div>' + 
                                '</form>' +
                            '</div>' +
                        '</div>' +
                        '<div class="bottom"></div>' +
                    '</div>';

                    $('.popup').remove();
                    $('body').prepend(html);

                    var $popup = $('.popup'),
                        obj_offset = obj.offset();

                    $popup.css({
                        top: obj_offset.top + obj.height() + 3,
                        left: obj_offset.left + obj.width() / 2 + 3
                    });

                    document.getElementById('picture_name').focus();

        core.keyboard.bindKeyboardAction('13', true, function(){
            core.keyboard.unBindKeyboardAction('27');
        });

        core.keyboard.bindKeyboardAction('27', true, function(){
            core.keyboard.unBindKeyboardAction('13');
            gallery.closeEdit();
        });
    },

    hidePopup: function(){
        var $popup = $('.popup');
        $popup
            .addClass('popdown_effect')
            .fadeOut(150, 'easeOutQuad', function(){
                $popup.remove();
            });
    },

    closeEdit: function(){
        this.removeFocusFromEditPic();
        this.hidePopup();

        if(this.edit_request != null){
            this.edit_request.abort();
            core.loading.unsetLoading('editPic');
        };
    },

    saveItemData: function(){
        this.save_request = $.ajax({
            url         : '/admin/gallery/?ajax&action=set_image_data',
            data        : {
                id          : gallery.item_edit_id,
                name        : $('#picture_name').val(),
                description : $('#picture_description').val()
            },
            type        : 'POST',
            dataType    : 'json',
            beforeSend  : function(){
                if(this.save_request != null){
                    this.save_request.abort();
                };

                core.loading.unsetLoading('saveItemData');
                core.loading.setLoadingToElementCenter('saveItemData', $('.popup'));
            },
            success     : function(){
                core.loading.unsetLoading('saveItemData');

                gallery.closeEdit();
            }
        });
    },

    cancelItemEdit: function(){
        if(this.save_request != null){
            this.save_request.abort();
        };

        this.closeEdit();
        this.item_edit_id = null;
    },
	
	focusIntoEditPic: function(){
		$('.gallery_pics .item.active').css({
			opacity: 1
		});
	},
	
	removeFocusFromEditPic: function(){
		$('.gallery_pics .item.active').removeClass('active');

		$('.gallery_pics .item, .gallery_pics .album_item').animate({
			opacity: 1
		}, 200);
	},

    editPic: function(obj){
        this.closeEdit();
        obj = obj.parent();

        this.item_edit_id = null;

        if(obj.hasClass('active')){
            this.closeEdit();
			this.removeFocusFromEditPic();
        }else{
			$('.gallery_pics .item, .gallery_pics .album_item').not(obj).animate({
				opacity: 0.4
			}, 200);

            obj.addClass('active');
			
			this.focusIntoEditPic();

            this.item_edit_id = obj.attr('rel');

            if(this.edit_request != null){
                this.edit_request.abort();
            };

            this.edit_request = $.ajax({
                url         : '/admin/gallery?ajax',
                data        : {
                    action      : 'get_image_data',
                    id          : gallery.item_edit_id
                },
                type        : 'GET',
                dataType    : 'json',
                beforeSend  : function(){
                    if(this.edit_request != null){
                        this.edit_request.abort();
                    };

                    core.loading.unsetLoading('editPic');
                    core.loading.setLoadingToElementCenter('editPic', obj.find('i.preview'));

                    gallery.hidePopup();

                    core.keyboard.bindKeyboardAction('27', true, function(){
                        gallery.closeEdit();
                        gallery.removeFocusFromEditPic();
                    });

                    obj.addClass('active');
                },
                success     : function(data){
                    core.loading.unsetLoading('editPic');
                    gallery.showPopup(obj, data);

                    obj.addClass('active');
                }
            });
        };
    },

    setEjectPlaceDropareaFuncionality: function(){
        $('#item_ejector').droppable({
            accept: '.item',
            connectToSortable: '.gallery_pics div.items_holder',
            drop: function(event, ui){
                ui.draggable.addClass('popdown_effect');
                setTimeout(function(){ui.draggable.hide()}, 150);
                $('.ui-sortable-placeholder').hide(250);

                var $this = $(this);
                $this.removeClass('upscale').addClass('downscale');
            },
            over: function() {
                var $this = $(this);
                $this.addClass('upscale').removeClass('downscale').animate({
                    opacity: 1
                }, 100);
            },
            out: function() {
                var $this = $(this);
                $this.addClass('downscale').removeClass('upscale').animate({
                    opacity: 0.6
                }, 100);
            }
        });
    },

    showDropPlace: function(drop_place){
        if(drop_place.length > 0){
            drop_place.show().stop().animate({
                opacity: 0.6
            }, 250);

            $('.header_block').stop().animate({
                opacity: 0
            }, 200);
        };
    },

    hideDropPlace: function(drop_place){
        if(drop_place.length > 0){
            drop_place.stop().animate({
                opacity: 0
            }, 250, function(){
                drop_place.hide();
            });

            $('.header_block').stop().animate({
                opacity: 1
            }, 200);
        };
    },

    editAlbum: function(){
        this.gallery_mode = 'edit';

        if(this.edit_request != null){
            this.edit_request.abort();
        };

        core.loading.unsetLoading('editPic');

        /*$('.gallery_pics .item').removeClass('active').stop().animate({
            opacity: 1
        }, 200);*/

        this.reinitMode();
		this.removeFocusFromEditPic();

		$('.gallery_pics .item, .gallery_pics .album_item').removeClass('downscale_x2');

        $('.popup').remove();
        
        $('.gallery_pics .item, .gallery_pics .album_item').removeClass('up_effect').addClass('wobble').each(function(){
            $(this).prepend('<a href="javascript:void(0)" class="x_button"></a>')
        });

        $('.gallery_pics div.albums_holder').sortable({
            items       : '.album_item',
            revert      : true,
            tolerance   : 'intersect'
        });

        $('.gallery_pics div.items_holder').sortable({
            items       : '.item',
            revert      : true,
            tolerance   : 'intersect',
            start       : function(){
                gallery.setEjectPlaceDropareaFuncionality();
                gallery.showDropPlace($('#item_ejector'));
            },
            stop       : function(){
                gallery.hideDropPlace($('#item_ejector'));
                $('.gallery_pics #item_ejector').droppable('destroy');
            }
        });

        $('.gallery_pics div.albums_holder .album_item').droppable({
	        accept: '.item',
            connectToSortable: '.gallery_pics div.items_hoder',
            drop: function(event, ui){
                ui.draggable.addClass('popdown_effect');
                setTimeout(function(){ui.draggable.hide()}, 150);
                $('.ui-sortable-placeholder').hide(250);

                var $this = $(this),
                    previews_lenght = $this.find('i').length;

                $this.removeClass('over');

                if(previews_lenght < 3){
                    var rand = Math.random(),
                        preview = $('<i>').css({
                            backgroundImage: ui.draggable.children('i').css('background-image')
                        }).attr('new_preview', rand).addClass('preview').addClass('popup_effect');

                    $this.append(preview);
                }else{
                    if($this.find('.counter').length > 0){
                        var counter = $this.find('.counter'),
                            count = parseInt(counter.html());

                        counter.html(count+1);
                    }else{
                        var rand = Math.random(),
                        preview = $('<span>')
                            .attr('new_counter', rand)
                            .addClass('counter')
                            .addClass('preview')
                            .addClass('popup_effect')
                            .html('4');

                        $this.append(preview);
                    };
                };

                var album_id = $this.attr('rel'),
                    image_id = ui.draggable.attr('rel');

                gallery.moveImageToAlbum(album_id, image_id, preview);
            },
            over: function() {
                var $this = $(this);
                $this.addClass('over');
            },
            out: function() {
                var $this = $(this);
                $this.removeClass('over');
            }
		});

        $('.gallery_pics .item i.preview').off('click');

        $('#album_name_block').hide();
        $('#album_name_edit').show();
    },

    moveImageToAlbum: function(album_id, image_id, preview){
        $.ajax({
            url         : '/admin/gallery/?ajax&action=move_image_to_album',
            data        : {
                album_id    : album_id,
                image_id    : image_id
            },
            type        : 'POST',
            dataType    : 'json',
            beforeSend  : function(){
                core.loading.setLoadingToElementByAppend('moveImageToAlbum', preview);
            },
            success     : function(){
                core.loading.unsetLoading('moveImageToAlbum');
            }
        });
    },

    saveAlbum: function(){
        this.gallery_mode = 'normal';

		this.removeFocusFromEditPic();
		
        $('.gallery_pics .item, .gallery_pics .album_item').removeClass('wobble').find('.x_button').remove();
        $('.gallery_pics .item a.pic').addClass('fancybox');

        this.reinitMode();

        $('.gallery_pics div.albums_holder').sortable('destroy');
        $('.gallery_pics div.items_holder').sortable('destroy');
        $('.gallery_pics div.albums_holder .album_item').droppable('destroy');

        $('#album_name_block').show();
        $('#album_name_edit').hide();

        $('.gallery_pics .item i.preview').off('click');

        $('.gallery_pics .item i.preview').on('click', function(){
            gallery.editPic($(this));
        });
    },

    addQueue: function(data){
        if(this.edit_request != null){
            this.edit_request.abort();
        };

        core.loading.unsetLoading('editPic');

        this.closeEdit();
        this.removeFocusFromEditPic();

        $.each(data.files, function(index, file){
            var $html = $('<div class="item hidden new_item" rel="new_'+index+'" status="0">' +
                            '<span class="status"></span>' +
                            '<i class="preview"></i>' +
                        '</div>');

            $.data(file, $html);

            $('.gallery_pics .items_holder').prepend($html);
        });

        $('.new_item').each(function(){
            core.loading.setLoadingToElementCenter($(this).attr('rel'), $(this).find('i.preview'));
        });
    },

    completeQueue: function(data){
        $.each(data.files, function(index, file){
            var $file = $.data(file);

            $file.find('i.preview').css({
                backgroundImage: 'url('+data.result[index].thumbnail_url+')'
            });

            $file.removeClass('new_item').addClass('up_effect');
            core.loading.unsetLoading($file.attr('rel'));
            $file.attr('rel', data.result[index].id);

            $file.find('i.preview').on('click', function(){
                gallery.editPic($(this));
            });

            gallery.reinitMode();

            $('#gallery_total').html(parseInt($('#gallery_total').html())+1);
        });
    },

    initUploader: function(){
        $('#fileupload').fileupload({
            dataType: 'json',
            url: '/admin/gallery/?ajax&action=upload&album_id='+$('#album_id').val(),
            sequentialUploads: true,

            change: function(e, data){
                gallery.addQueue(data);
            },

            drop: function(e, data){
                gallery.addQueue(data);
            },

            always: function(e, data){
                gallery.completeQueue(data);
            }
        });
    },

    binds: function(){
        $('#button_gallery_edit_ok').on('click', function(){
            gallery.saveAlbum();
        });

        $('#button_gallery_delete_all').on('click', function(){
            gallery.deleteAll();
        });

        $('#button_gallery_edit').on('click', function(){
            gallery.editAlbum();
        });

        $('#button_gallery_upload').on('click', function(){
            $('#fileupload').trigger('click');
        });

        $('.gallery_pics .item .x_button').live('click', function(){
            gallery.deletePic($(this));
        });

        $('.gallery_pics .album_item .x_button').live('click', function(){
            gallery.deleteAlbum($(this));
        });

        $('.gallery_pics .item i.preview').on('click', function(){
            gallery.editPic($(this));
        });

        $('#image_edit_form').live('submit', function(){
            gallery.saveItemData();
        });

        $('.gallery_pics .wobble').live('click', function(){
            gallery.pubHideItem($(this));
        });

        $('.popup .dialog_button.cancel').live('click', function(){
            gallery.cancelItemEdit();
        });
    },

    init: function(){
        core.preloadImages([
            '/admin/resources/img/bg/popup.png',
            '/admin/resources/img/icons/spinner.png',
            '/admin/resources/img/icons/neww.gif',
            '/admin/resources/img/icons/x_btn.png',
            '/admin/gallery/img/eject.png'
        ]);

        $('.gallery_pics').disableSelection();
        this.binds();
        this.initUploader();
    }
};

$(function(){
    gallery.init();
});