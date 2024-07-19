<?php
session_start();

if (!isset($_SESSION['user'])) {
  header('Location: index.php');
}
?>

<!DOCTYPE html>
<!---------------------------------------------------------------------------->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="HD">
    <meta name="description" content="GTLM">
    <title>GTLM-HD-C2</title>

    <link rel="stylesheet" type="text/css" href="styles/site.css">
    <link rel="stylesheet" type="text/css" href="styles/calendar.css">

    <script src="scripts/calendar.js" defer></script>
    <script src="scripts/calendarbig.js" defer></script>
  </head>

  <body>
    <div class="site_content">
      <!-- //////////////////////////////////////////////////// -->
      <!-- //////////////////////////////////////////////////// -->
      <?php require_once "nav_top.php"; ?>

      <!-- //////////////////////////////////////////////////// -->
      <div class="site_center">
        <!-- ////////////////////////////////////////////////// -->
        <?php require_once "nav_left.php"; ?>

        <!-- ////////////////////////////////////////////////// -->
        <!-- ////////////////////////////////////////////////// -->
        <div class="site_main">

          <div class="top">
            Calendar
            <p>
              Manage and view your every event
            </p>
          </div>

          <div class="main">
            

          <!-- ///////////////////////// small calendar  //////////////////////////////////////// -->

          <div class="col">
          <div class="smallcalendarback">
            <header>
              <p class="current-date"></p>
              <div class="icons">
                <span id="prev" class="arrowL">&lt;</span>
                <span id="next" class="arrowR">&gt;</span>
              </div>
            </header>
            <div class="calendar">
              <ul class="weeks">
                <li>Sun</li>
                <li>Mon</li>
                <li>Tue</li>
                <li>Wed</li>
                <li>Thu</li>
                <li>Fri</li>
                <li>Sat</li>
              </ul>
              <ul class="days"></ul>
            </div>
          </div>

          <div class="todayEvent">
            <div class="todayEventTitle">Started Tasks</div>
            <div class="eventcontent">
             
            </div>
          </div>
       
          </div>
      
        
 <!-- ///////////////////////// big calendar  //////////////////////////////////////// -->
 <div id="calendarFrame">
          <div id="controls">
            <div id="yearControl">
              <button onclick="changeYear(-1)">&lt;&lt;</button>
              <span id="currentYear"></span>
              <button onclick="changeYear(1)">&gt;&gt;</button>
            </div>
            <div id="monthControl">
              <button onclick="changeMonth(-1)">&lt;</button>
              <select id="monthSelect" onchange="updateCalendar()">
                <option value="0">January</option>
                <option value="1">February</option>
                <option value="2">March</option>
                <option value="3">April</option>
                <option value="4">May</option>
                <option value="5">June</option>
                <option value="6">July</option>
                <option value="7">August</option>
                <option value="8">September</option>
                <option value="9">October</option>
                <option value="10">November</option>
                <option value="11">December</option>
              </select>
              <button onclick="changeMonth(1)">&gt;</button>
            </div>
            <div id="addEventControl">
              <button class="addEvent" onclick="addEvent()">Add Event</button>
            </div>
          </div>
    
          <table id="calendar">
            <thead>
              <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
              </tr>
            </thead>
            <tbody id="calendarBody"></tbody>
          </table>
        </div>
    
        <div id="eventModal" class="modal">
          <div class="modal-content">
            <span class="close">&times;</span>
            <div class="addEventTitle">Add New Event</div>

            <div class="twoParts">

              <div class="addEventContent">

                <label>Event Name</label>
                <input type="text" id="eventName" placeholder="Enter event name" />

                <label>Event Location</label>
                <input type="text" id="eventLocation" placeholder="Enter event location" />
            
                <label>Event Date</label>
                <input type="date" id="eventStartDate" />

                <label>Event Start Time</label>
                <input type="time" id="eventStartTime" />

                <label>Event End Time</label>
                <input type="time" id="eventEndTime" />
              </div>

              <div class="addEventContent">
                <label>Description</label>
                <textarea id="eventDescription" placeholder="Enter description" ></textarea>

                <label class="attendees">Attendees <button class="plusIcon"  onclick="showInviteModal()">+</button><br /></label> 
                <textarea id="eventAttendees" placeholder="Invite attendees or input attendees"></textarea>
              </div>

        </div>
            <div class="button-container">
            <button class="Add" onclick="saveEvent()">Add</button>
            <button class="cancel" onclick="closeEventModal()()">Cancel</button>
          </div>

          </div>
        </div>
    
        <div id="allEventsModal" class="modal">
          <div class="modal-content">
            <span onclick="closeAllEventsModal()" class="close">×</span>
            <div class="showAllEventTitle">All Events for Today</div>
            <div id="allEventsList"></div>
          </div>
        </div>
    
        <div id="inviteModal" class="modal">
          <div class="invitemodal-content">
            <span onclick="closeInviteModal()" class="close">×</span>
            <div class="inviteEventTitle">Invite Attendees</div>
            Email: <input type="text" id="attendeeEmail" /><br/>
            <button class="inviteAttendee" onclick="addAttendee()">Invite</button>
            <button class="cancelInvite" onclick="closeInviteModal()">Cancel</button>
          </div>
        </div>
    
        <div id="editEventModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeEditEventModal()">&times;</span>
                <div class="editEventTitle"> Edit Event</div>
                
                <div class="twoParts">

                <div class="editEventContent">
                  <label>Event Name</label>
                  <input type="text" id="editEventName" placeholder="Edit event name" />

                
                  <label>Event Location</label>
                  <input type="text" id="editEventLocation" placeholder="Edit event location"/>
                    
                  <label>Event Date</label>
                  <input type="date" id="editEventDate" disabled />

                  <label>Event Start Time</label>
                  <input type="time" id="editEventStartTime" />

                  <label>Event End Time</label>
                  <input type="time" id="editEventEndTime" />
              </div>

                <div class="editEventContent">
                  <label>Description</label>
                  <textarea id="editEventDescription" placeholder="Edit event description"></textarea>

                  <label class="attendees">Attendees <button class="plusIcon"  onclick="showInviteModal()">+</button></label> 
                  <textarea id="editEventAttendees" placeholder="Edit attendees"></textarea>
              </div>

              </div>

                <div class="editButton-container">
                <button class="updateEvent" onclick="updateEvent()">Update</button>
                <button class="deleteEvent" onclick="deleteEvent()">Delete</button>
                <button class="cancelEvent" onclick="closeEditEventModal()">Cancel</button>
              </div>
            </div>
        </div>




      </div>

   
        </div>
      <!-- //////////////////////////////////////////////////// -->
      </div>    
    </div>


 

  </body>
</html>

<!---------------------------------------------------------------------------->



