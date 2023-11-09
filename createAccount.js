const createForm = document.getElementById("accreate-form");
const createButton = document.getElementById("accreate-submit");
//const loginErrMsg = document.getElementById("accreate-error-msg");

// creating object and JSON from the form info
const accountInfo = {Name:uname, PWD:pword};
let myTextJSON = JSON.stringify(studentInfo);
// storing them in the local computer
localStorage.setItem("accountsJSON", myTextJSON);