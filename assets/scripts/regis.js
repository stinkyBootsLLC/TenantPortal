
// Use Jquery to match the password fields on a KEYUP EVENT
$('#userPassWord, #conFirmUserPassWord').on('keyup', function () {
    if ($('#userPassWord').val() == $('#conFirmUserPassWord').val()) {
      $('#message').html('Matching').css('color', 'green');
    } else 
      $('#message').html('Not Matching').css('color', 'red');
  });

 