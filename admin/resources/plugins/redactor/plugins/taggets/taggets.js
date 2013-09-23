if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.taggets = {
	init: function()
	{
        var callback = $.proxy(function()
		{
            var t = this;

            function fx(){
                $('#redactor_modal').find('.redactor_clip_link').each($.proxy(function(i, s)
                {
                    $(s).click($.proxy(function()
                    {
                        t.insertClip('{' + $(s).data('tagget') + '}');
                        return false;

                    }, t));
                }, t));
            }

            $.ajax({
                url: '/admin/sections/?ajax&get_taggets',
                type: 'get',
                dataType: 'json',
                success: function(taggets){
                    var taggets_html = '';

                    $.each(taggets, function(key, val){
                        taggets_html += '<li><a class="redactor_clip_link" data-tagget="' + key + '" href="javascript:void(0)">' + key + '</a> &mdash; <span>' + val.title + '</span></li>';
                    });

                    $('#redactor_modal_inner').html('<div class="taggets-modal"><ul>' + taggets_html + '</ul></div>');

                    fx();
                }
            });

			this.selectionSave();
			this.bufferSet();

		}, this );

		this.buttonAdd('clips', 'Taggets', function(e)
		{
			this.modalInit('Taggets', '#clipsmodal', 500, callback);
		});
	},
	insertClip: function(html)
	{
		this.selectionRestore();
		this.insertHtml($.trim(html));
		this.modalClose();
	}
};