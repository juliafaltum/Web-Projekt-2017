
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




function voteJS (contentID, wertung) {
    $.post('rating_do.php', {contentID:contentID,wertung:wertung}, function(data) {
        if ($.trim(data) == 'success') {
            VotebuttonUpdate(contentID);

        } else {
            alert('Fehler: '+data+' Seite wird neugeladen!');
            location.reload();
        }
    });

}



function buttonUpdateNeu (userID, followerID, contentID) {
    $('.Folgenbutton'+followerID).load("ajax/loadbutton.php?userID="+userID+"&followerID="+followerID+"&contentID="+contentID).hide().fadeIn(300);
    }

function VotebuttonUpdate (contentID) {
    $('.Votebutton'+contentID).load("ajax/loadVoteButton.php?contentID="+contentID).hide().fadeIn(300);
    $('.Punkte'+contentID).load("ajax/loadPunkte.php?contentID="+contentID).hide().fadeIn(300);
}
