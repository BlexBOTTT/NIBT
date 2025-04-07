document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("add-event-btn").addEventListener("click", function() {
        const title = document.getElementById("event-title").value;
        const date = document.getElementById("event-date").value;
        const timeStart = document.getElementById("event-time-start").value;
        const timeEnd = document.getElementById("event-time-end").value;
        const location = document.getElementById("event-location").value;

        if (title && date && timeStart && timeEnd && location) {
            const eventList = document.getElementById("event-list");

            const newEvent = document.createElement("li");
            newEvent.innerHTML = `
                <div class="singel-event">
                    <span><i class="fa fa-calendar"></i> ${date}</span>
                    <a href="#"><h4>${title}</h4></a>
                    <span><i class="fa fa-clock-o"></i> ${timeStart} - ${timeEnd}</span>
                    <span><i class="fa fa-map-marker"></i> ${location}</span>
                </div>
            `;

            eventList.appendChild(newEvent);

            // Clear input fields after submission
            document.getElementById("event-title").value = "";
            document.getElementById("event-date").value = "";
            document.getElementById("event-time-start").value = "";
            document.getElementById("event-time-end").value = "";
            document.getElementById("event-location").value = "";
        } else {
            alert("Please fill in all fields.");
        }
    });
});
