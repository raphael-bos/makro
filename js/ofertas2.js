function clickDownload(){
    let downloadDiv = document.getElementById("download-div");
    let retornarDiv = document.getElementById("return-div");
    let follow = document.getElementById("follow-div");
    let qrcode = document.getElementById("qrcode-div");
    let email = document.getElementById("email-div");
    let returnBottom = document.getElementById("return-bottom-div");
    let followBottom = document.getElementById("follow-bottom-div");
    let qrDiv = document.getElementById("qrcode-content-div")
    let emailDiv = document.getElementById("email-content-div");
    downloadDiv.classList.toggle("grid-collumn-span-2");
    downloadDiv.classList.toggle("grid-collumn-span-3");
    retornarDiv.classList.toggle("grid-collumn-span-2");
    retornarDiv.classList.toggle("grid-collumn-span-3");
    follow.classList.toggle("hide");
    email.classList.toggle("hide");
    returnBottom.classList.toggle("hide");
    qrcode.classList.toggle("hide");
    followBottom.classList.toggle("hide");
    qrDiv.classList.add("hide");
    emailDiv.classList.add("hide");
}

function clickQR(){
    let qrDiv = document.getElementById("qrcode-content-div")
    let emailDiv = document.getElementById("email-content-div");
    qrDiv.classList.toggle("hide");
    emailDiv.classList.add("hide");
}

function clickEmail(){
    let emailDiv = document.getElementById("email-content-div");
    let qrDiv = document.getElementById("qrcode-content-div");
    emailDiv.classList.toggle("hide");
    qrDiv.classList.add("hide");
}