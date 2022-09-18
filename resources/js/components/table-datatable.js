import {$translation_ua} from './table-translate';

$(function() {
	"use strict";


    $(document).ready(function() {
        // Delta Table
        var table = $('#delta-table').DataTable( {
            lengthChange: true,
            buttons: [ 'copy', 'excel', 'pdf', 'print'],
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