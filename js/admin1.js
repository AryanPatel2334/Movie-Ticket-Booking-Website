let hindi = document.querySelector(".buttons .Hindi");
let english = document.querySelector(".buttons .English");
let gujarati = document.querySelector(".buttons .Gujarati");
let tamil = document.querySelector(".buttons .Tamil");
let telugu = document.querySelector(".buttons .Telugu");
// let update = document.querySelector("form .update");

// hindi.addEventListener("click",()=>{
//     window.location.href = "hindi.php";
// })

// english.addEventListener("click",()=>{
//     window.location.href = "english.php";
// })


// gujarati.addEventListener("click",()=>{
//     window.location.href = "gujarati.php";
// })


let hamburg = document.querySelector(".toggle img");
let close = document.querySelector(".close img");
let nav = document.querySelector(".navigation");

close.addEventListener("click",()=>{
    nav.style.left="-600px";
})


hamburg.addEventListener("click",()=>{
    nav.style.left="0px";
})




