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
                };

                if($(this).parent().parent().hasClass('hidden')){
                    hiddens = true;
                };
            };
        });

        if(no_animation){
           var speed = 0;
        }else{
           var speed = 120;
        };

        if(checkeds){
           if(showeds && !hiddens){
               $('.multiaction_button').not('[rel="show"]').show(speed);
               $('.multiaction_button[rel="show"]').hide(speed);

           }else if(!showeds && hiddens){
               $('.multiaction_button').not('[rel="hide"]').show(speed);
               $('.multiaction_button[rel="hide"]').hide(speed);

           }else{
               $('.multiaction_button').show(speed);
           };
        }else{
           $('.multiaction_button').hide(speed);
        };
    },

    init: function(){
        $('.list .checkbox').live('click', function(){
            sections.listHaveChecked();
        });

        $('#list_checkbox_master').live('click', function(){
            if($(this).is(':checked')){
                $('.list .checkbox').attr('checked', true);
            }else{
                $('.list .checkbox').attr('checked', false);
            };

            sections.listHaveChecked();
        });

        this.listHaveChecked(true);
    }
};

$(function(){
    sections.init();
});