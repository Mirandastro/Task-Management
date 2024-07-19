
///////////////////////////////////////////////////////////
init();

///////////////////////////////////////////////////////////
function init()
{
  let img_calendar = document.getElementById("img_calendar");
  let nav_calendar = document.getElementById("nav_calendar");
  img_calendar.setAttribute("src", "icons/Calander_C.png");
  nav_calendar.setAttribute("class", "site_top_nav_sel");

}




//************************** small calendar **********************************

function goToWelcomePage() {
  window.location.href = "welcome-page.html";
}

const daysTag = document.querySelector(".days"),
      currentDate = document.querySelector(".current-date"),
      prevNextIcon = document.querySelectorAll(".icons span");

let date = new Date(),
    currYear = date.getFullYear(),
    currMonth = date.getMonth();

const monthsOne = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];

prevNextIcon[0].addEventListener("click", () => {
  currMonth--;
  if (currMonth < 0) {
      currMonth = 11;
      currYear--;
  }
  renderCalendarOne();
});

prevNextIcon[1].addEventListener("click", () => {
  currMonth++;
  if (currMonth > 11) {
      currMonth = 0;
      currYear++;
  }
  renderCalendarOne();
});

const renderCalendarOne = () => {
  let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), 
      lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), 
      lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), 
      lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); 
  let liTag = "";

// get previous month's last days
  for (let i = firstDayofMonth; i > 0; i--) {
    liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
  }

// get all days of current month and find current day
  for (let i = 1; i <= lastDateofMonth; i++) {
    let isToday =
      i === date.getDate() &&
      currMonth === new Date().getMonth() &&
      currYear === new Date().getFullYear()
        ? "active"
        : "";
    liTag += `<li class="${isToday}">${i}</li>`;
  }
//get next month first days
  for (let i = lastDayofMonth; i < 6; i++) {
    liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`;
  }
  currentDate.innerText = `${monthsOne[currMonth]} ${currYear}`; 
  daysTag.innerHTML = liTag;
};
renderCalendarOne();


function getAndDisplayTodayEvents() {
  fetch('getTodayEvents.php')
      .then(response => response.json())
      .then(tasks => {
          const eventContentDiv = document.querySelector(".eventcontent");
          eventContentDiv.innerHTML = '';  

          tasks.forEach(task => {
              const eventDiv = document.createElement('div');
              const nameSpan = document.createElement('span');
              nameSpan.textContent = `${task.name} ${task.description}`;
              eventDiv.appendChild(nameSpan);

              const timeSpan = document.createElement('span');
              timeSpan.textContent = `${task.stime} - ${task.etime}`;
              timeSpan.style.display = 'block'; // Makes the time appear on a new line
              eventDiv.appendChild(timeSpan);

              // Add spacing for each task div
              eventDiv.style.marginBottom = '10px';

              eventContentDiv.appendChild(eventDiv);
          });
      })
      .catch(error => {
          console.error('There was an error getting the tasks:', error);
      });
}

// Execute the function after the page loads
window.onload = getAndDisplayTodayEvents;
