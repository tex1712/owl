$(function() {
	"use strict";

    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: "Зробіть вибір...",
        allowClear: true,
        minimumResultsForSearch: Infinity
    });

    $('.multiple-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: "Виберіть декілька",
        allowClear: true,
    });

    $('.multiple-select-tags').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: "Виберіть декілька",
        allowClear: true,
        tags: true,
    });

    
});