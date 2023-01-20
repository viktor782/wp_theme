jQuery(document).ready(function ($) {
    // Set all variables to be used in scope
    var frame,
            lastTarget,
            metaBox = $('#repeatable-fields');

    // ADD IMAGE LINK
    metaBox.on('click', '.upload-custom-img', function (event) {
        lastTarget = $(event.target);
        event.preventDefault();

        // If the media frame already exists, reopen it.
        if (frame) {
            frame.open();
            return;
        }

        // Create a new media frame
        frame = wp.media({
            title: 'Select or Upload Media Of Your Chosen Persuasion',
            button: {
                text: 'Use this media'
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });


        // When an image is selected in the media frame...
        frame.on('select', function () {
            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();
            lastTarget.closest('tr').find('input').val(attachment.url);
        });

        // Finally, open the modal on click
        frame.open();
    });


    $('#add-row').on('click', function () {
        var row = $('.empty-row.screen-reader-text').clone(true);
        row.removeClass('empty-row screen-reader-text');
        row.insertBefore('#repeatable-fieldset-one tbody>tr:last');
        return false;
    });

    $(document).on('click', '.remove-row', function () {
        $(this).parents('tr').remove();
        return false;
    });
});