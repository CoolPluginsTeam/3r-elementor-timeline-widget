jQuery(document).on('click', '.twae_hide_upgrade_notice_editor', function () {

    jQuery.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: 'twae_hide_upgrade_notice_editor'
        },
        success: function (response) {
            console.log('Notice dismissed');
        }
    });

    jQuery(this).closest('.twae-upgrade-pro-notice').slideUp();
});
