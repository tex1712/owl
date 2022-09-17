import Swal from 'sweetalert2/dist/sweetalert2.js';

$(function() {
	"use strict";

    $('.delete-item').on('click', function(){
        var current_id = jQuery(this).attr('id');
        Swal.fire({
            title: 'Ви впевнені?',
            text: 'Ви не зможете відновити цей запис',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: 'Так, видалити!',
            closeOnConfirm: false,
            cancelButtonText: 'Скасувати',
        }).then( (result) => {
            if (result.isConfirmed) {   
                $('#delete_' + current_id).submit();
            }
        });
    });
    
});