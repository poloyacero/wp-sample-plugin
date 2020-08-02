jQuery(function($){
    $('body').on('click', '.upload_image_button', function(e){
        e.preventDefault();
        var button = $(this),
        uploader = wp.media({
            title: 'Custom image',
            library : {
                uploadedTo : wp.media.view.settings.post.id,
                type : 'image'
            },
            button: {
                text: 'Use this image'
            },
            multiple: false
        }).on('select', function() {
            var attachment = uploader.state().get('selection').first().toJSON();
			console.log(attachment);
            $('#featured_image').val(attachment.url);
        })
        .open();
    });
	
	$('#course_title').bind('keyup', function(){
		var text = $(this).val().toLowerCase();
		var tokens = text.replace(/ /g, '-');
		$('#course_name').val(tokens);
	});
});