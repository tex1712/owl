(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
    .forEach(function (form) {      
      form.addEventListener('submit', function (event) {
        
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      parseCoordinates();
      
      form.classList.add('was-validated')
      }, false)
    })
  })()



  // *********
  //  **** PARSE COORDINATES
  // *********

  let parseCoordinates = function(){

    let $coordinates = {
      point: [],
      square: []
    }

    // Parse Square Coordinates
    $('.coordinates-block-point').not('.coorditates-point-template .coordinates-block-point').each(function(index) {
      let $coordinates_point = {
        coordinates: [],
        description: ''
      };

      $coordinates_point.description = $(this).find('textarea').val();
      $(this).find('input').each(function(){
        $coordinates_point.coordinates.push($(this).val());
      });

      $coordinates.point.push($coordinates_point);
    });

    // Parse Square Coordinates
    $('.coordinates-block-square').not('.coorditates-square-template .coordinates-block-square').each(function(index) {
      let $coordinates_square = {
        coordinates: [],
        description: ''
      };

      $coordinates_square.description = $(this).find('textarea').val();
      $(this).find('input').each(function(){
        $coordinates_square.coordinates.push($(this).val());
      });

      $coordinates.square.push($coordinates_square);
    });

    $('#send-coordinates').val(JSON.stringify($coordinates));

  }
