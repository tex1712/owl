import {$translation_ua} from './table-translate';

$(function() {
	"use strict";


    $(document).ready(function() {
        // Delta Table
        var table = $('#delta-table').DataTable( {
            lengthChange: true,
            pageLength : 50,
            order: [[3, 'desc']],
            buttons: [
                { extend: 'excel', className: 'btn btn-secondary px-5' }
            ],
            language: $translation_ua
        } );
     
        table.buttons().container()
            .appendTo( '#delta-table_wrapper .col-md-6:eq(0)' );

        // Users Table
        var table = $('#users-table').DataTable( {
            lengthChange: true,
            language: $translation_ua
        } );
    } );


});