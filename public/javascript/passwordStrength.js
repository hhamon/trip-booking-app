$('#registration_password_first').keyup(function(){
   let password = $('#registration_password_first').val();
   if(checkPasswordStrength(password)===false)
   {
       $('#registration_submit').attr('disabled',true);
   } else {
       $('#registration_submit').removeAttr('disabled');
   }
});

$('#settings_password_first').keyup(function(){
    let password = $('#settings_password_first').val();
    if(checkPasswordStrength(password)===false)
    {
        $('#settings_submit').attr('disabled',true);
    } else {
        $('#settings_submit').removeAttr('disabled');
    }
    if(isEmpty(password))
    {
        $('#settings_submit').attr('disabled',false);
    }
});

function isEmpty(str) {
    return (!str || 0 === str.length);
}

function checkPasswordStrength(password) {
    let strength = 0;

    if(password.match(/([A-Z].*[a-z])|([a-z].*[A-Z])/))
    {
        strength = strength+1;
        $('.low-upper-case').addClass('text-success');
        $('.low-upper-case i').addClass('fa-check').removeClass('fa-times');
    } else {
        $('.low-upper-case').removeClass('text-success');
        $('.low-upper-case i').addClass('fa-times').removeClass('fa-check');
    }

    if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) {
        strength += 1;
        $('.one-number').addClass('text-success');
        $('.one-number i').removeClass('fa-times').addClass('fa-check');
    } else {
        $('.one-number').removeClass('text-success');
        $('.one-number i').addClass('fa-times').removeClass('fa-check');
    }

    //If it has one special character, increase strength value.
    if (password.match(/([!%&@#$^*?_~])/)) {
        strength += 1;
        $('.one-special-char').addClass('text-success');
        $('.one-special-char i').removeClass('fa-times').addClass('fa-check');

    } else {
        $('.one-special-char').removeClass('text-success');
        $('.one-special-char i').addClass('fa-times').removeClass('fa-check');
    }

    if (password.length >= 8) {
        strength = strength + 1;
        $('.eight-character').addClass('text-success');
        $('.eight-character i').removeClass('fa-times').addClass('fa-check');

    } else {
        $('.eight-character').removeClass('text-success');
        $('.eight-character i').addClass('fa-times').removeClass('fa-check');
    }

    switch (strength) {

        case 0: case 1:
            $('#result').removeClass();
            $('#password-strength').removeClass('bg-success');
            $('#password-strength').removeClass('bg-warning');
            $('#password-strength').addClass('bg-danger');
            $('#result').removeClass('text-warning');
            $('#result').removeClass('text-success');
            $('#result').addClass('text-danger').text('Weak');
            $('#password-strength').css('width', '10%');
            break;
        case 2:
            $('#result').addClass('good');
            $('#password-strength').removeClass('bg-success');
            $('#password-strength').removeClass('bg-danger');
            $('#password-strength').addClass('bg-warning');
            $('#result').removeClass('text-danger');
            $('#result').removeClass('text-success');
            $('#result').addClass('text-warning').text('Average');
            $('#password-strength').css('width', '30%');
            break;
        case 3:
            $('#result').addClass('veryGood');
            $('#password-strength').removeClass('bg-success');
            $('#password-strength').removeClass('bg-danger');
            $('#password-strength').addClass('bg-warning');
            $('#result').removeClass('text-success');
            $('#result').removeClass('text-danger');
            $('#result').addClass('text-warning').text('Strong');
            $('#password-strength').css('width', '60%');
            break;
        case 4:
            $('#result').removeClass();
            $('#result').addClass('strong');
            $('#password-strength').removeClass('bg-danger');
            $('#password-strength').removeClass('bg-warning');
            $('#password-strength').addClass('bg-success');
            $('#result').removeClass('text-warning');
            $('#result').removeClass('text-danger');
            $('#result').addClass('text-success').text('Very strong');
            $('#password-strength').css('width', '100%');
            break;
        default:
            break;
    }

    return password.length>=8;

}