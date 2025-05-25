console.log("let's write js");

// Image Paths
const images = {
    "seat1": "Images/cycle.png",
    "seat2": "Images/motorcycle.png",
    "seat3": "Images/rickshaw.png",
    "seat4": "Images/technology.png",
    "seat5": "Images/car.png"
};

// Set default image
let e = document.createElement("img");
e.src = images["seat1"];
document.querySelector(".selection>p").after(e);

const seatno = document.querySelectorAll(".selection .seatno div");
let selectedNumber = null;

// Select seat number
seatno.forEach((number) => {
    number.addEventListener("click", () => {
        if (selectedNumber) {
            selectedNumber.classList.remove("selected2");
        }
        number.classList.add("selected2");
        selectedNumber = number;
    });
});

// Change image dynamically based on selection
Object.keys(images).forEach((seatClass) => {
    document.querySelector(`.selection .${seatClass}`).addEventListener("click", () => {
        document.querySelector(".selection img").src = images[seatClass];
    });
});

document.querySelector("body").style.backgroundColor = "rgb(113, 113, 113)";

// Seat selection logic
document.querySelector(".selection button").addEventListener("click", () => {
    const seatLayout = document.querySelectorAll(".seatlayout .seat");
    let selectedSeats = 0;
    const maxSeats = parseInt(document.querySelector(".selection .selected2 p")?.innerText || "0");
    console.log(maxSeats);

    // Add seat selection logic
    seatLayout.forEach((seat) => {
        seat.addEventListener("click", () => {
            if (seat.classList.contains("selected1")) {
                seat.classList.remove("selected1");
                selectedSeats--;
                // console.log(selectedSeats);
            } else if (selectedSeats < maxSeats) {
                seat.classList.add("selected1");
                selectedSeats++;
                // console.log(selectedSeats);
            }

          

            // Show/hide the button based on selection count
            const confirmBtn = document.querySelector(".confirm-Btn");
            const basePrice = parseInt(confirmBtn.getAttribute("data-price")) || 0;
            const movieName = confirmBtn.getAttribute("data-mname");
            const sid = confirmBtn.getAttribute("data-sid");
            const tid = confirmBtn.getAttribute("data-tid");
            const time = confirmBtn.getAttribute("data-time");
            const location = confirmBtn.getAttribute("data-location");
            
            if (selectedSeats === maxSeats) {
                confirmBtn.style.display = "block";
                let a = maxSeats * basePrice;  // Calculate total price
                confirmBtn.innerText = "Pay Rs. " + a;
            
                // ✅ Corrected URL syntax
                window.location.href = `bookingsummary.php?sid=${encodeURIComponent(sid)}&movieName=${encodeURIComponent(movieName)}&tid=${encodeURIComponent(tid)}&time=${encodeURIComponent(time)}&price=${encodeURIComponent(a)}&maxSeats=${encodeURIComponent(maxSeats)}&location=${encodeURIComponent(location)}`;
            
                confirmBtn.style.backgroundColor = "#f84464";
                confirmBtn.style.color = "white";
                confirmBtn.style.borderRadius = "5px";
                confirmBtn.style.border = "none";
                confirmBtn.style.width = "120px";
                confirmBtn.style.height = "35px";
                confirmBtn.style.cursor = "pointer";
            
                console.log("Total Price: ", a);
                console.log("Movie Name: ", movieName); // Debugging
            } else {
                confirmBtn.style.display = "none";
            }
            
        });
        
    });
});

// Submit Selection
let selectedNumber1 = null;

function selectNumber1(element) {
    if (selectedNumber1) {
        selectedNumber1.classList.remove("selected");
    }
    selectedNumber1 = element;
    selectedNumber1.classList.add("selected");
}

function submitSelection() {
    if (selectedNumber1) {
        document.querySelector("body").style.backgroundColor = "white";
        document.querySelector(".selection").style.bottom = "680px";
        document.querySelector(".selection").style.transform = "scale(0.3)";
        document.querySelector(".selection .seat1").style.backgroundColor = "#f84464";
        document.querySelector(".selection .seat1").style.color = "white";
        document.querySelector(".selection .seat1").style.borderRadius = "20px";
        document.querySelector(".selection .seat1").style.top = "0px";
    } else {
        alert("You must select at least one number!");
    }
}
