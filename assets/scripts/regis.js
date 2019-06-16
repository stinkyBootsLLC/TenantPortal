


// // get the form
// let form = document.getElementsByName("login");

const userPassWord = document.getElementById("userPassWord");
const conFirmuserPassWord = document.getElementById("conFirmUserPassWord");
const registerBtn = document.getElementById("registerBtn");

// add listeners 
//document.getElementsByName("registerBtn")//.addEventListener("click", displayDate);
//get the values from text field

//alert("in the fucking file");
// console.log("pass- " + userPassWord);
// console.log("cpass- " + conFirmuserPassWord);
// console.log("button- " + registerBtn);
// 1qazxsw2@WSXZAQ!
function setPassword(){

    let pass1 = userPassWord.values;
    console.log("pass- " + pass1);

}
function setConfirmPassword(){
    let pass2 = conFirmuserPassWord.values;
    console.log("pass- " + pass2);

}

function buttonPressed(){
    console.log("buttonpreseed()");
    //userPassWord.addEventListener("input", setPassword);
    //conFirmuserPassWord.addEventListener("input", setConfirmPassword);
    let pass1 = userPassWord.values;
    console.log("pass- " + pass1);
    alert("in the fucking file" + pass1);

}

function comparePasswords(){
    // userPassWord.addEventListener("input", myScript);
    // let pass1 = userPassWord.values;
    // console.log("pass- " + pass1);

}

registerBtn.addEventListener("click", buttonPressed);



 