<?php must_have_access(); ?>

<script>
    function edit_list(id = false) {
        var data = {};
        data.id = id;
        edit_list_modal = mw.tools.open_module_modal('newsletter/edit_list', data, {overlay: true, skin: 'simple'});
    }

    function delete_list(id) {
        var ask = confirm("<?php _ejs('Are you sure you want to delete this list?'); ?>");
        if (ask == true) {
            var data = {};
            data.id = id;
            $.ajax({
                url: mw.settings.api_url + 'newsletter_delete_list',
                type: 'POST',
                data: data,
                success: function (result) {
                    mw.notification.success('<?php _ejs('List deleted'); ?>');

                    // Reload the modules
                    mw.reload_module('newsletter/lists_list')
                    mw.reload_module('newsletter/edit_campaign')
                    mw.reload_module_parent('newsletter')
                }
            });
        }
        return false;
    }
</script>

<a href="javascript:;" class="btn btn-primary mb-3" onclick="edit_list();"><i class="mdi mdi-plus"></i><?php _e('Add new list'); ?></a>

<module type="newsletter/lists_list"/>