/**
 * Created by alice on 06/10/17.
 */
function aggiungi() {
    var token_page = document.getElementById('token_invisible').value;
    $.get("https://accounts.spotify.com/authorize/?client_id=3a763d56ebf549c8bb288f11b8216192&response_type=code&redirect_uri=http%3A%2F%2Flocalhost%3A8080%2Fcallback&scope=user-read-private%20user-read-email&state=34fFs29kd09" , {_token: token_page}, function (spotify_authorize){

    });
}