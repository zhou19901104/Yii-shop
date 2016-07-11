// http://stackoverflow.com/questions/260749/what-is-the-best-way-to-get-and-set-a-single-cookie-value-using-javascript
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function createCookie(name,value,days,domain) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        expires = "; expires="+date.toGMTString();
    }
    else expires = "";

    if (domain) {
        domain = '; domain=' + domain;
    } else {
        domain = '';
    }

    document.cookie = name+"="+value+expires+domain+"; path=/";
}