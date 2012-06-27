'use strict';

var sections = {
    listHaveChecked: function(ho_animation){
        var checkeds = false;
        var hiddens = false;
        var showeds = false;

        $('.list_table .checkbox').not('#list_checkbox_master').each(function(){
           if($(this).is(':checked')){
               checkeds = true;

               if($(this).attr('publish') == '1'){
                   showeds = true;
               }else{
                   hiddens = true;
               };
           };
        });

        if(ho_animation){
           var speed = 0;
        }else{
           var speed = 150;
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
        $('.list .checkbox').not('#list_checkbox_master').click(function(){
            sections.listHaveChecked();
        });

        this.listHaveChecked(true);
    }
};

$(function(){
    sections.init();
});