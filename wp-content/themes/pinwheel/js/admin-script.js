
jQuery(document).ready(function(jQuery) {
        var frame;
        jQuery(document).on('click', '.custom_media_button' , function(){ 
                var clicked = jQuery(this);
             
                frame = false;
                frame = wp.media({
                          title: 'Select or Upload Media Of Your Chosen Persuasion',
                          button: {
                            text: 'Select a photo'
                          },
                          multiple: false 
                        });
                 frame.on( 'select', function() {     
                  // Get media attachment details from the frame state
                  var attachment = frame.state().get('selection').first().toJSON(); console.log(attachment);
                   clicked.closest('.gt-input-group').find('.custom_media_id').val(attachment.id);
                   clicked.closest('.gt-input-group').find('.custom_media_image').attr('src',attachment.sizes.thumbnail.url).css('display','block');               

                });
                 
                // Finally, open the modal on click
                frame.open();
        });
     

});
