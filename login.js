function validateUser(){
    var un = document.login.uname.value;
    var pw = docment.login.pword.value;
    if(un.length == "" || pw.length == ""){
        alert("Cannot leave username or password fields blank");
        return false;
    }
}