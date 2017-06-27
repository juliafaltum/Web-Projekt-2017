/**
 * Created by Christian on 27.06.2017.
 */

function folgenJS (userID, followerID, contentID) {
    $.post('ajax/follow.php', {followerID:followerID}, function(data) {
        if ($.trim(data) == 'success') {
            buttonUpdateNeu(userID, followerID, contentID);

        } else {
            alert('Fehler: '+data+' Seite wird neugeladen!');
            location.reload();
        }
    });

}

function entfolgenJS (userID, followerID, contentID) {
    $.post('ajax/unfollow.php', {followerID:followerID}, function(data) {
        if ($.trim(data) == 'success') {
            buttonUpdateNeu(userID, followerID, contentID);

        } else {
            alert('Fehler: '+data+' Seite wird neugeladen!');
            location.reload();
        }
    });

}



function buttonUpdateNeu (userID, followerID, contentID) {
    $('.Folgenbutton'+followerID).load("ajax/loadbutton.php?userID="+userID+"&followerID="+followerID+"&contentID="+contentID).hide().fadeIn(300);
    }







function buttonUpdate (userID, followerID) {
    $.post('ajax/loadbutton.php', {userID:userID, followerID:followerID}, function (data) {
        $('.ajaxtest').html(data);
    });
}