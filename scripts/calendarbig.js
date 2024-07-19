//************************** big calendar **********************************/

const months = [
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
let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();
let events = {};

let tasks = [];

function getTasks() {
    fetch('getTodayEvents.php')
        .then(response => response.json())
        .then(data => {
            tasks = data;
            renderCalendar();
        })
        .catch(error => {
            console.error('Error fetching tasks:', error);
        });
}

getTasks();


function changeMonth(delta) {
  currentMonth += delta;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  } else if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  document.getElementById("monthSelect").value = currentMonth;
  renderCalendar();
}

function changeYear(delta) {
  currentYear += delta;
  renderCalendar();
}

function addEvent() {
  document.getElementById("eventModal").style.display = "block";
  document.getElementById("eventName").value = "";
  document.getElementById("eventLocation").value = "";
  document.getElementById("eventStartDate").value = "";
  document.getElementById("eventStartTime").value = "";
  document.getElementById("eventEndTime").value = "";
  document.getElementById("eventDescription").value = "";
  document.getElementById("eventAttendees").value = "";
}

function closeEventModal() {
  document.getElementById("eventModal").style.display = "none";
}

function saveEvent() {
  const name = document.getElementById("eventName").value;
  const location = document.getElementById("eventLocation").value;
  const startDate = document.getElementById("eventStartDate").value;
  const startTime = document.getElementById("eventStartTime").value;
  const endTime = document.getElementById("eventEndTime").value;
  const description = document.getElementById("eventDescription").value;
  const attendees = document.getElementById("eventAttendees").value.split("\n");

  if (name && location && startDate && startTime && endTime && description) {
    if (
      new Date(`1970-01-01T${endTime}`) <= new Date(`1970-01-01T${startTime}`)
    ) {
      alert("Event end time must be later than the start time.");
      return;
    }

    if (!events[startDate]) {
      events[startDate] = []; 
    }

    events[startDate].push({
      name: name,
      location: location,
      startTime: startTime,
      endTime: endTime,
      description: description,
      attendees: attendees,
    });

    closeEventModal();
    renderCalendar();
  
  } else {
    alert("Please fill in all the information.");
  }
}

function showInviteModal() {
  document.getElementById("inviteModal").style.display = "block";
}

function closeInviteModal() {
  document.getElementById("inviteModal").style.display = "none";
}

function validateEmail(email) {
  var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
  return regex.test(email);
}

function addAttendee() {
  const emailInput = document.getElementById("attendeeEmail");
  const email = emailInput.value;
  if (email) {
    if (validateEmail(email)) {
      const attendees = document.getElementById("eventAttendees");
      attendees.value += email + "\n";
      emailInput.value = ""; 
      closeInviteModal();
    } else {
      alert("Please enter a valid email address.");
    }
  } else {
    alert("Please enter an email address.");
  }
}

var modal = document.getElementById("eventModal");
var span = document.getElementsByClassName("close")[0];

span.onclick = function () {
  modal.style.display = "none";
};

function showAllEventsModal(dateStr) {
  const allEventsList = document.getElementById("allEventsList");
  allEventsList.innerHTML = "";

  events[dateStr].forEach((event) => {
    allEventsList.innerHTML += `
      <div class="event-name"><strong>Event Name:</strong> ${event.name}</div>
      <div class="event-time"><strong>Event Time:</strong> (${event.startTime}-${event.endTime})</div>
      <div class="event-name"><strong>Event Location:</strong>  ${event.location}</div>
      <div class="event-description"><strong>Description:</strong> ${event.description}</div>
      <div class="event-attendees"><strong>Attendees:</strong> ${event.attendees.join(", ")}</div>
      <div>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </div>
      `;
  });
  document.getElementById("allEventsModal").style.display = "block";
}

function closeAllEventsModal() {
  document.getElementById("allEventsModal").style.display = "none";
}

function deleteEvent(dateStr, index) {
  events[dateStr].splice(index, 1);
  if (events[dateStr].length === 0) {
    delete events[dateStr];
  }
  closeEventModal();
  renderCalendar();
}

//****************  Edit event **************/

let currentEditingDate; 
let currentEditingIndex; 

function showEditEventModal(dateStr, eventIndex) {
  const eventToEdit = events[dateStr][eventIndex];

  document.getElementById("editEventName").value = eventToEdit.name;
  document.getElementById("editEventLocation").value = eventToEdit.location;
  document.getElementById("editEventDate").value = dateStr;
  document.getElementById("editEventStartTime").value = eventToEdit.startTime;
  document.getElementById("editEventEndTime").value = eventToEdit.endTime;
  document.getElementById("editEventDescription").value = eventToEdit.description;
  document.getElementById("editEventAttendees").value = eventToEdit.attendees.join("\n");

  currentEditingDate = dateStr;
  currentEditingIndex = eventIndex;

  document.getElementById("editEventModal").style.display = "block";
}

function updateEvent() {
  const updatedEvent = {
    name: document.getElementById("editEventName").value,
    location: document.getElementById("editEventLocation").value,
    startTime: document.getElementById("editEventStartTime").value,
    endTime: document.getElementById("editEventEndTime").value,
    description: document.getElementById("editEventDescription").value,
    attendees: document.getElementById("editEventAttendees").value.split("\n"),
  };

  events[currentEditingDate][currentEditingIndex] = updatedEvent;
  renderCalendar();
  closeEditEventModal();
}

function deleteEvent() {
  events[currentEditingDate].splice(currentEditingIndex, 1);
  if (events[currentEditingDate].length === 0) {
    delete events[currentEditingDate]; 
  }
  renderCalendar();
  closeEditEventModal();
}

function closeEditEventModal() {
  document.getElementById("editEventModal").style.display = "none";
  currentEditingDate = null;
  currentEditingIndex = null;
}

function renderCalendar() {
  const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();
  const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
  const daysInPrevMonth = new Date(currentYear, currentMonth, 0).getDate();
  const todayDate = new Date();
  const currentDay = todayDate.getDate();
  const thisMonth = todayDate.getMonth();
  const thisYear = todayDate.getFullYear();

  let dayCounter = 1 - firstDayOfMonth;
  let weeks = 6;
  let table = "";

  while (weeks--) {
    table += "<tr>";
    for (let i = 0; i < 7; i++) {
      if (dayCounter < 1) {
        table += `<td>${daysInPrevMonth + dayCounter}</td>`;
      } else if (dayCounter > daysInMonth) {
        table += `<td>${dayCounter - daysInMonth}</td>`;
      } 
   

      else {
        const dateStr = `${currentYear}-${String(currentMonth + 1).padStart(2, "0")}-${String(dayCounter).padStart(2, "0")}`;
        let taskHtml = "";
        let eventHtml = "";
        
        // First check for tasks on this date
        tasks.forEach(task => {
            const taskDate = task.stime.split(' ')[0]; //  'YYYY-MM-DD HH:MM:SS'
            if (taskDate === dateStr) {

                taskHtml += `<div class="task">${task.name} ${task.description} (${task.etime}-${task.etime})</div>`;
            }
        });
    
        // Then check for events on this date
        if (events[dateStr]) {
            // first event
            eventHtml += `<span class="event-label" onclick="showEditEventModal('${dateStr}', 0)">${events[dateStr][0].name}<br>(${events[dateStr][0].startTime}-${events[dateStr][0].endTime})</span><br>`;
            //+X events
            if (events[dateStr].length > 1) {
                eventHtml += `<span class="clickable-event-label" onclick="showAllEventsModal('${dateStr}')">+${events[dateStr].length - 1} more event(s)</span>`;
            }
        }
    
        // Combine task and event HTML and add to table cell
        table += `<td class="thisMonth ${dayCounter === currentDay && currentMonth === thisMonth && currentYear === thisYear ? "currentDay" : ""}">${dayCounter}<br>${taskHtml}${eventHtml}</td>`;
    }
    


      dayCounter++;
    }
    
    table += "</tr>";
  }

  document.getElementById("calendarBody").innerHTML = table;
  document.getElementById("currentYear").textContent = `${currentYear}`;
  document.getElementById("monthSelect").value = currentMonth;
}

function updateCalendar() {
  currentMonth = parseInt(document.getElementById("monthSelect").value);
  renderCalendar();
}

renderCalendar();
