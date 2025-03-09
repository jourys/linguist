$(document).ready(function() {
    $('#bookingForm').submit(function(event) {
      event.preventDefault();
      var formData = $(this).serialize();
      $.ajax({
        type: 'POST',
        url: '../php/tutors_p.php',
        data: formData,
        success: function(response) {
          $('#bookingResult').html(response);
        }
      });
    });
  });