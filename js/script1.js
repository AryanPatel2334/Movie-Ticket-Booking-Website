console.log("Let's write javascript...");

// Add an eventlistener to sign in button

let signin = document.querySelector(".signin");
let popupsignin = document.querySelector(".signin button")

document.querySelector("header .right button").addEventListener("click", () => {
    signin.style.top = "300px";
    signin.style.transform = "scale(0.99)";
    signin.style.visibility = "visible";
})

// popupsignin.addEventListener("click", () => {
//     // signin.style.visibility = "hidden";
//     signin.style.top = "10px";
//     signin.style.transform = "scale(0.1)";
//     signin.style.visibility = "hidden";
// })

//Script for slider


// Add an eventlistener to filters
// Languages

const languagesElement = document.querySelector(".languages");
const multiboxElement = languagesElement.querySelector(".multibox");

let isExpanded = false;

languagesElement.addEventListener("click", () => {
    isExpanded = !isExpanded;

    if (isExpanded) {
        languagesElement.style.height = "45px";
        multiboxElement.style.visibility = "hidden";
    } else {
        languagesElement.style.height = "195px";
        multiboxElement.style.visibility = "visible";
    }
});


const genresElement = document.querySelector(".genres");
const multiboxElement1 = genresElement.querySelector(".multibox");

let isExpanded1 = false;

genresElement.addEventListener("click", () => {
    isExpanded1 = !isExpanded1;

    if (isExpanded1) {
        genresElement.style.height = "300px";
        multiboxElement1.style.visibility = "visible";
    } else {
        genresElement.style.height = "45px";
        multiboxElement1.style.visibility = "hidden";
    }
});


const formatElement = document.querySelector(".format");
const multiboxElement2 = formatElement.querySelector(".multibox");

let isExpanded2 = false;

formatElement.addEventListener("click", () => {
    isExpanded2 = !isExpanded2;

    if (isExpanded2) {
        formatElement.style.height = "150px";
        multiboxElement2.style.visibility = "visible";
    } else {
        formatElement.style.height = "45px";
        multiboxElement2.style.visibility = "hidden";
    }
});

// Add an eventlistener to Language buttons


const All = document.querySelector(".All");
let isClicked1 = false;

All.addEventListener("click", (e) => {
    e.stopPropagation();
    if (!isClicked1) {
        document.querySelector(".All").style.backgroundColor = "red";
        document.querySelector(".All").style.color = "white";
        document.querySelector(".All").style.border = "2px solid red";
        document.querySelector(".All").style.fontWeight = 600;
        isClicked1 = true;
    }
    else {
        document.querySelector(".All").style.color = "red";
        document.querySelector(".All").style.backgroundColor = "white";
        document.querySelector(".All").style.border = "2px solid rgb(234, 233, 233)";
        document.querySelector(".All").style.fontWeight = 400;
        isClicked1 = false
    }

})


const Hindi = document.querySelector(".Hindi");
let isClicked2 = false;

Hindi.addEventListener("click", (e) => {
    e.stopPropagation();
    if (!isClicked2) {
        document.querySelector(".Hindi").style.backgroundColor = "red";
        document.querySelector(".Hindi").style.color = "white";
        document.querySelector(".Hindi").style.border = "2px solid red";
        document.querySelector(".Hindi").style.fontWeight = 600;
        isClicked2 = true;
    }
    else {
        document.querySelector(".Hindi").style.color = "red";
        document.querySelector(".Hindi").style.backgroundColor = "white";
        document.querySelector(".Hindi").style.border = "2px solid rgb(234, 233, 233)";
        document.querySelector(".Hindi").style.fontWeight = 400;
        isClicked2 = false
    }

})


const English = document.querySelector(".English");
let isClicked3 = false;

English.addEventListener("click", (e) => {
    e.stopPropagation();
    if (!isClicked3) {
        document.querySelector(".English").style.backgroundColor = "red";
        document.querySelector(".English").style.color = "white";
        document.querySelector(".English").style.border = "2px solid red";
        document.querySelector(".English").style.fontWeight = 600;
        isClicked3 = true;
    }
    else {
        document.querySelector(".English").style.color = "red";
        document.querySelector(".English").style.backgroundColor = "white";
        document.querySelector(".English").style.border = "2px solid rgb(234, 233, 233)";
        document.querySelector(".English").style.fontWeight = 400;
        isClicked3 = false
    }

})


const Gujarati = document.querySelector(".Gujarati");
let isClicked4 = false;

Gujarati.addEventListener("click", (e) => {
    e.stopPropagation();
    if (!isClicked4) {
        document.querySelector(".Gujarati").style.backgroundColor = "red";
        document.querySelector(".Gujarati").style.color = "white";
        document.querySelector(".Gujarati").style.border = "2px solid red";
        document.querySelector(".Gujarati").style.fontWeight = 600;
        isClicked4 = true;
    }
    else {
        document.querySelector(".Gujarati").style.color = "red";
        document.querySelector(".Gujarati").style.backgroundColor = "white";
        document.querySelector(".Gujarati").style.border = "2px solid rgb(234, 233, 233)";
        document.querySelector(".Gujarati").style.fontWeight = 400;
        isClicked4 = false
    }

})


const Tamil = document.querySelector(".Tamil");
let isClicked5 = false;

Tamil.addEventListener("click", (e) => {
    e.stopPropagation();
    if (!isClicked5) {
        document.querySelector(".Tamil").style.backgroundColor = "red";
        document.querySelector(".Tamil").style.color = "white";
        document.querySelector(".Tamil").style.border = "2px solid red";
        document.querySelector(".Tamil").style.fontWeight = 600;
        isClicked5 = true;
    }
    else {
        document.querySelector(".Tamil").style.color = "red";
        document.querySelector(".Tamil").style.backgroundColor = "white";
        document.querySelector(".Tamil").style.border = "2px solid rgb(234, 233, 233)";
        document.querySelector(".Tamil").style.fontWeight = 400;
        isClicked5 = false
    }

})


const Telugu = document.querySelector(".Telugu");
let isClicked6 = false;

Telugu.addEventListener("click", (e) => {
    e.stopPropagation();
    if (!isClicked6) {
        document.querySelector(".Telugu").style.backgroundColor = "red";
        document.querySelector(".Telugu").style.color = "white";
        document.querySelector(".Telugu").style.border = "2px solid red";
        document.querySelector(".Telugu").style.fontWeight = 600;
        isClicked6 = true;
    }
    else {
        document.querySelector(".Telugu").style.color = "red";
        document.querySelector(".Telugu").style.backgroundColor = "white";
        document.querySelector(".Telugu").style.border = "2px solid rgb(234, 233, 233)";
        document.querySelector(".Telugu").style.fontWeight = 400;
        isClicked6 = false
    }

})


const Malyalam = document.querySelector(".Malyalam");
let isClicked7 = false;

Malyalam.addEventListener("click", (e) => {
    e.stopPropagation();
    if (!isClicked7) {
        document.querySelector(".Malyalam").style.backgroundColor = "red";
        document.querySelector(".Malyalam").style.color = "white";
        document.querySelector(".Malyalam").style.border = "2px solid red";
        document.querySelector(".Malyalam").style.fontWeight = 600;
        isClicked7 = true;
    }
    else {
        document.querySelector(".Malyalam").style.color = "red";
        document.querySelector(".Malyalam").style.backgroundColor = "white";
        document.querySelector(".Malyalam").style.border = "2px solid rgb(234, 233, 233)";
        document.querySelector(".Malyalam").style.fontWeight = 400;
        isClicked7 = false
    }

})


const Kannada = document.querySelector(".Kannada");
let isClicked8 = false;

Kannada.addEventListener("click", (e) => {
    e.stopPropagation();
    if (!isClicked8) {
        document.querySelector(".Kannada").style.backgroundColor = "red";
        document.querySelector(".Kannada").style.color = "white";
        document.querySelector(".Kannada").style.border = "2px solid red";
        document.querySelector(".Kannada").style.fontWeight = 600;
        isClicked8 = true;
    }
    else {
        document.querySelector(".Kannada").style.color = "red";
        document.querySelector(".Kannada").style.backgroundColor = "white";
        document.querySelector(".Kannada").style.border = "2px solid rgb(234, 233, 233)";
        document.querySelector(".Kannada").style.fontWeight = 400;
        isClicked8 = false
    }

})


const Marathi = document.querySelector(".Marathi");
let isClicked9 = false;

Marathi.addEventListener("click", (e) => {
    e.stopPropagation();
    if (!isClicked9) {
        document.querySelector(".Marathi").style.backgroundColor = "red";
        document.querySelector(".Marathi").style.color = "white";
        document.querySelector(".Marathi").style.border = "2px solid red";
        document.querySelector(".Marathi").style.fontWeight = 600;
        isClicked9 = true;
    }
    else {
        document.querySelector(".Marathi").style.color = "red";
        document.querySelector(".Marathi").style.backgroundColor = "white";
        document.querySelector(".Marathi").style.border = "2px solid rgb(234, 233, 233)";
        document.querySelector(".Marathi").style.fontWeight = 400;
        isClicked9 = false
    }

})

// Genres


const Drama = document.querySelector(".Drama");
let isClicked10 = false;

Drama.addEventListener("click", (e) => {
    e.stopPropagation();
    if (!isClicked10) {
        document.querySelector(".Drama").style.backgroundColor = "red";
        document.querySelector(".Drama").style.color = "white";
        document.querySelector(".Drama").style.border = "2px solid red";
        document.querySelector(".Drama").style.fontWeight = 600;
        isClicked10 = true;
    }
    else {
        document.querySelector(".Drama").style.color = "red";
        document.querySelector(".Drama").style.backgroundColor = "white";
        document.querySelector(".Drama").style.border = "2px solid rgb(234, 233, 233)";
        document.querySelector(".Drama").style.fontWeight = 400;
        isClicked10 = false
    }

})



const Action = document.querySelector(".Action");
let isClicked11 = false;

Action.addEventListener("click", (e) => {
    e.stopPropagation();
    if (!isClicked11) {
        document.querySelector(".Action").style.backgroundColor = "red";
        document.querySelector(".Action").style.color = "white";
        document.querySelector(".Action").style.border = "2px solid red";
        document.querySelector(".Action").style.fontWeight = 600;
        isClicked11 = true;
    }
    else {
        document.querySelector(".Action").style.color = "red";
        document.querySelector(".Action").style.backgroundColor = "white";
        document.querySelector(".Action").style.border = "2px solid rgb(234, 233, 233)";
        document.querySelector(".Action").style.fontWeight = 400;
        isClicked11 = false
    }

})


// Format


const D2 = document.querySelector(".D2");
let isClicked12 = false;

D2.addEventListener("click", (e) => {
    e.stopPropagation();
    if (!isClicked12) {
        document.querySelector(".D2").style.backgroundColor = "red";
        document.querySelector(".D2").style.color = "white";
        document.querySelector(".D2").style.border = "2px solid red";
        document.querySelector(".D2").style.fontWeight = 600;
        isClicked12 = true;
    }
    else {
        document.querySelector(".D2").style.color = "red";
        document.querySelector(".D2").style.backgroundColor = "white";
        document.querySelector(".D2").style.border = "2px solid rgb(234, 233, 233)";
        document.querySelector(".D2").style.fontWeight = 400;
        isClicked12 = false
    }

})



const D3 = document.querySelector(".D3");
let isClicked13 = false;

D3.addEventListener("click", (e) => {
    e.stopPropagation();
    if (!isClicked13) {
        document.querySelector(".D3").style.backgroundColor = "red";
        document.querySelector(".D3").style.color = "white";
        document.querySelector(".D3").style.border = "2px solid red";
        document.querySelector(".D3").style.fontWeight = 600;
        isClicked13 = true;
    }
    else {
        document.querySelector(".D3").style.color = "red";
        document.querySelector(".D3").style.backgroundColor = "white";
        document.querySelector(".D3").style.border = "2px solid rgb(234, 233, 233)";
        document.querySelector(".D3").style.fontWeight = 400;
        isClicked13 = false
    }

})


const DX4 = document.querySelector(".DX4");
let isClicked14 = false;

DX4.addEventListener("click", (e) => {
    e.stopPropagation();
    if (!isClicked14) {
        document.querySelector(".DX4").style.backgroundColor = "red";
        document.querySelector(".DX4").style.color = "white";
        document.querySelector(".DX4").style.border = "2px solid red";
        document.querySelector(".DX4").style.fontWeight = 600;
        isClicked14 = true;
    }
    else {
        document.querySelector(".DX4").style.color = "red";
        document.querySelector(".DX4").style.backgroundColor = "white";
        document.querySelector(".DX4").style.border = "2px solid rgb(234, 233, 233)";
        document.querySelector(".DX4").style.fontWeight = 400;
        isClicked14 = false
    }

})



// Add an evnetlistener to Movie buttons

document.querySelectorAll(".movie").forEach(e => {
    e.addEventListener("click", () => {
        window.location.href = "booking.php";
    })

});


document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        document.getElementById("preloader").classList.add("hidden");
    }, 3000); // Hides preloader after 3 seconds
});






