console.log("let's write javascript");

document.querySelector(".details button").addEventListener("click",()=>{
    window.location.href = "showtheatre.php";
})


document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        document.getElementById("preloader").classList.add("hidden");
    }, 3000); // Hides preloader after 3 seconds
});


