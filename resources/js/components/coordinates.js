$(function() {
	"use strict";

    // VALIDATE new added blocks and fields 
    let addValidation = function(){
      $('#coordinates-wrap').find('input, textarea').attr('required', true);
      $('#coordinates-wrap').find('textarea').attr('minlength', 10);
    }

    let requiredContent = function(){
      let $is_coordinates = $('#coordinates-wrap .coordinates-block').length === 0;
      $('#target-content').attr('required', $is_coordinates);
    }
    
    // ADD coordinates block
    $('.btn-coordinates-block-add').on('click', function(){
      let $coordinates_type = $('#coorditates-type-choose').find(":selected").val();

      let $coordinates_template = $(`.coorditates-${$coordinates_type}-template`).html();
      $('#coordinates-wrap').prepend($coordinates_template);
      addValidation();
      requiredContent();
    });

    // REMOVE coordinates block
    $('#coordinates-wrap').on('click', '.btn-coordinates-block-delete', function(){
      $(this).closest('.coordinates-block').remove();
      requiredContent();
    });

    
    // ADD coordinates single point field
    $('#coordinates-wrap').on('click', '.btn-coordinates-single-add', function(){
      let $coordinate_field_template = $('.coordinates-single-point-template').html();
      $($coordinate_field_template).insertBefore( $(this).parent() );
      addValidation();
    });

    // REMOVE coordinates single point field
    $('#coordinates-wrap').on('click', '.btn-coordinates-single-point-delete', function(){
      $(this).closest('.coordinates-single-point').remove();
    });
});