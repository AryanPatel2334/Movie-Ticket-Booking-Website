document.addEventListener("DOMContentLoaded", () => {
    let timeSlots = document.querySelectorAll(".time");

    timeSlots.forEach(slot => {
        slot.addEventListener("click", function (event) {
            let time = this.getAttribute("data-time");
            let currentTime = new Date();
            let [hours, minutes] = time.split(":").map(Number);
            
            let showTime = new Date();
            showTime.setHours(hours, minutes, 0, 0); // Set showtime with hours and minutes

            if (showTime < currentTime) {
                alert("You cannot book this timeslot!");
                event.preventDefault(); // Prevents the `<a>` from navigating
            } 
        });
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const timeslots = document.querySelectorAll(".time");

    timeslots.forEach(slot => {
        slot.addEventListener("mouseenter", function () {
            let price = this.getAttribute("data-price");
            showPriceTooltip(this, price);
        });

        slot.addEventListener("mouseleave", function () {
            hidePriceTooltip();
        });
    });

    function showPriceTooltip(element, price) {
        let tooltip = document.createElement("div");
        tooltip.className = "price-tooltip";
        tooltip.innerText = price;
        document.body.appendChild(tooltip);

        let rect = element.getBoundingClientRect();
        tooltip.style.left = rect.left + window.scrollX + "px";
        tooltip.style.top = rect.top + window.scrollY - 30 + "px";
    }

    function hidePriceTooltip() {
        let tooltip = document.querySelector(".price-tooltip");
        if (tooltip) {
            tooltip.remove();
        }
    }
});




