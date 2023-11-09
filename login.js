const loginForm = document.getElementById("login-form");
const loginButton = document.getElementById("login-submit");
const loginErrMsg = document.getElementById("login-error-msg");

loginButton.addEventListener("click",(e)=>{
    //don't actually submit anything (yet)
    e.preventDefault();
    const uname = loginForm.uname.value;
    const pword = loginForm.pword.value;

    if(uname == "user" && pword == "pass"){
        //reload page on successful login
        location.reload();
    }
    else{
        //make error message visible
        loginErrMsg.style.opacity = 1;
    }
});