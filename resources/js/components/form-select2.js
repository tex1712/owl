$(function() {
	"use strict";

    $('.single-select-empty').prepend('<option selected></option>').select2({
        theme: 'bootstrap4',
        width: '100%',
        placeholder: 'Зробіть вибір...',
        allowClear: true,
        minimumResultsForSearch: Infinity
    });

    $('.single-select').select2({
        theme: 'bootstrap4',
        width: '100%',
        placeholder: 'Зробіть вибір...',
        allowClear: true,
        minimumResultsForSearch: Infinity
    });

    $('.multiple-select').select2({
        theme: 'bootstrap4',
        width: '100%',
        placeholder: "Виберіть декілька",
        allowClear: true,
    });

    $('.multiple-select-tags').select2({
        theme: 'bootstrap4',
        width: '100%',
        placeholder: "Виберіть декілька",
        allowClear: true,
        tags: true,
    });

    
});