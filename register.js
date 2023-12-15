let specialChars =/[`!@#$%^&*()\-+=\[\]{};':"\\|,.<>\/?~ ]/;

function validate_uname(){
    const username = document.getElementById("uname").value;
    if(specialChars.test(username)){
        document.getElementById('bad-uname').innerHTML = `<p>Username can only contain letters, numbers, and underscores.</p>`;
    }
    else{
        document.getElementById('bad-uname').innerHTML = ``;
    }
}

function validate_pass(){
    const password = document.getElementById("pword").value;
    if(password.length < 5){
        document.getElementById('bad-pass').innerHTML = `<p>Password must be at least 6 characters long</p>`;
    }
    else{
        document.getElementById('bad-pass').innerHTML = ``;
    }
}

function validate_conf(){
    const password = document.getElementById("pword").value;
    const confirm_pass = document.getElementById("cpword").value;
    if(confirm_pass != password){
        document.getElementById('bad-conf').innerHTML = `<p>Passwords do not match</p>`;
    }
    else{
        document.getElementById('bad-conf').innerHTML = ``;
    }
}
