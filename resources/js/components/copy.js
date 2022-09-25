$(function() {
	"use strict";

    $('.copy-to-clipboard').on('click', function(e){
        e.preventDefault();

        // Copy to clickboard
        var sampleTextarea = document.createElement("textarea");
        document.body.appendChild(sampleTextarea);
        sampleTextarea.value = $(this).html(); //save main text in it
        sampleTextarea.select(); //select textarea contenrs
        document.execCommand("copy");
        document.body.removeChild(sampleTextarea);

        // Update Tooltip
        $(this).attr('data-bs-original-title', 'Скопійовано');

        // Fire new tooltip
        let btn_tooltip = bootstrap.Tooltip.getInstance($(this));
        btn_tooltip.show();

        // Return old one
        $(this).attr('data-bs-original-title', 'Копіювати в буфер обміну');
    });

    $('.btn-copy').on('click', function(e){
        e.stopImmediatePropagation();
        e.preventDefault();

        // Copy to clickboard
        var sampleTextarea = document.createElement("textarea");
        document.body.appendChild(sampleTextarea);
        sampleTextarea.value = $('.content-copy').text().trim().replace(/\t+/g, " "); //save main text in it
        sampleTextarea.select(); //select textarea contenrs
        document.execCommand("copy");
        document.body.removeChild(sampleTextarea);

        // New btn Status
        $('.btn-copy').text('Скопійовано').addClass('disabled');

        $('.content-copy span').animate({
            opacity: 0.5
          }, 400);

        // Return btn back
        setTimeout(function(){ 
            $('.btn-copy').text('Копіювати').removeClass('disabled');
            $('.content-copy span').animate({
                opacity: 1
              }, 400);
        }, 1000);

    });
    
});
