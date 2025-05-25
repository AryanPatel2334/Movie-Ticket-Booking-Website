// document.querySelector(".pay").addEventListener("click",()=>{
//     alert("Your Tickets are booked..");
// })


// Loader 


document.addEventListener("DOMContentLoaded", function () {
    const bookButton = document.getElementById("bookButton");
    const loader = document.getElementById("loader");

    if (bookButton && loader) {
        bookButton.addEventListener("click", function () {
            loader.style.display = "flex"; // Show loader
        });
    }
});


// document.getElementsByClassName("pay").addEventListener("click", function() {
//     // Show the loader
//     document.getElementById("loader").style.display = "flex";
    
//     // Simulate a delay before redirecting
//     setTimeout(function() {
//         window.location.href = "index.php"; // Change this to your next page
//     }, 3000); // 3 seconds delay
// });