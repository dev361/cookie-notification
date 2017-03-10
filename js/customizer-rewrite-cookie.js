writeCookie("cookie-notification-enabled", "customizeArea", getDomain(), "/");
function isIPaddress(ip){
    if (/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(ip)) return true;
    return false;
}

function getDomain(){
    var domain;

    if(isIPaddress(window.location.hostname))
        domain = "";
    else{
        domain = window.location.hostname.split(".");
        domain = "." + domain[domain.length-2] + "." + domain[domain.length-1];
    }
    return domain;
}
function writeCookie(key, value, domain, path){
    var dateExpire = new Date();
    dateExpire.setMonth(dateExpire.getMonth() + 13);
    document.cookie= key + "=" + value + "; expires=" + dateExpire.toUTCString() + "; domain=" + domain + ";" + "path=" + path + ";";
}