/**
 * Created by Christian on 03.05.2017.
 * Siehe: http://jsfiddle.net/rpP4K/
 */



function checkPasswordMatch() {
    var password = $("#txtNewPassword").val();
    var confirmPassword = $("#txtConfirmPassword").val();

    if (password != confirmPassword)
        $("#divCheckPasswordMatch").html("Passwörter stimmen nicht überein!"),
        $('#absenden').prop('disabled', true);
    else
        $("#divCheckPasswordMatch").html("Passwörter stimmen! Du kannst dich nun registrieren!"),
        $('#absenden').prop('disabled', false);
}

$(document).ready(function () {
    $("#txtConfirmPassword").keyup(checkPasswordMatch);
});
