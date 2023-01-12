$(function() {
	"use strict";

    $(document).ready(function() {
        $('#delta-status-switcher').on('click', function(){
            let $checked = $(this).is(':checked');
            let $id = $(this).data('id');
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: `/delta/${$id}/status`,
                type: 'POST',
                data: {_token: CSRF_TOKEN, status:$checked, id:$id},
                dataType: 'JSON',
                success: function (data) { 
                    //
                }
            });

        });
    } );


});