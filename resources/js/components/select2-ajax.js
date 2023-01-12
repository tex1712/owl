
$(function() {
	"use strict";


    // **************
    // ***** AGENTS SELECT2 FOR CHOSEN OFFICER
    // **************
    $('#choose-officer-ajax').on('change', function(){        
        let $officer_id = $(this).val();
        let $api_token = $("meta[name='api-tokem']").attr("content"); 

        // Clear Select
        $("#choose-agent-ajax").empty();
        $("#choose-source-ajax").empty();

        if(!$officer_id){
            return false;
        }
    
        $.ajax({
            type: 'GET',
            url: `/api/get-agents/${$officer_id}?api_token=${$api_token}`,            
            success: function(data){
                var data = jQuery.parseJSON(data);
                var data = $.map(data, function (obj) {
                    obj.id = obj.id;
                    obj.text = obj.name;
    
                    return obj;
                });
    
                $("#choose-agent-ajax").select2({
                    theme: 'bootstrap4',
                    data: data,
                    width: '100%',
                    placeholder: 'Зробіть вибір...',
                    allowClear: true,
                    minimumResultsForSearch: true
                });

                // Clear picked value of the Select
                $("#choose-agent-ajax").val([]).trigger('change');
                $("#choose-source-ajax").val([]).trigger('change');
            }
        });
    });

    
    // **************
    // ***** SOURCES SELECT2 FOR CHOSEN AGENT
    // **************
    $('#choose-agent-ajax').on('change', function(){        
        let $agent_id = $(this).val();
        let $api_token = $("meta[name='api-tokem']").attr("content"); 

        // Clear Select
        $("#choose-source-ajax").empty();

        if(!$agent_id){
            return false;
        }
    
        $.ajax({
            type: 'GET',
            url: `/api/get-sources/${$agent_id}?api_token=${$api_token}`,            
            success: function(data){
                var data = jQuery.parseJSON(data);
                var data = $.map(data, function (obj) {
                    obj.id = obj.id;
                    obj.text = obj.name;
    
                    return obj;
                });
    
                $("#choose-source-ajax").select2({
                    theme: 'bootstrap4',
                    data: data,
                    width: '100%',
                    placeholder: 'Зробіть вибір...',
                    allowClear: true,
                    minimumResultsForSearch: true
                });

                // Clear picked value of the Select
                $("#choose-source-ajax").val([]).trigger('change');
            }
        });
    });





        
});