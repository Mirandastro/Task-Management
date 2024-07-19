
///////////////////////////////////////////////////////////
init();


///////////////////////////////////////////////////////////
function init()
{
  console.log("init");

  img_ds.setAttribute("src", "icons/Home_C.png");
  nav_ds.setAttribute("class", "site_top_nav_sel");

}

function goToWelcomePage() {
  window.location.href = 'welcome-page.html';
}


function fetchData(endpoint) {
    return new Promise((resolve) => {
      setTimeout(() => {
        let data;
        switch(endpoint) {
          case 'totalUsers':
            data = '6';
            break;
          case 'completedTasks':
            data = '15';
            break;
          case 'upcomingEvents':
            data = '12';
            break;
          default:
            data = 'N/A';
        }
        resolve(data);
      }, 1000);
    });
  }
  
  document.addEventListener("DOMContentLoaded", function() {
    const metrics = ['totalUsers', 'completedTasks', 'upcomingEvents'];
    
    metrics.forEach(async (metric) => {
      const element = document.getElementById(metric);
      if (element) {
        element.textContent = await fetchData(metric);
      }
    });
  
    const notifications = ['Server updated', 'User joined', 'File uploaded'];
    const notificationList = document.getElementById('notificationList');
    notifications.forEach((notification) => {
      const li = document.createElement('li');
      li.textContent = notification;
      notificationList.appendChild(li);
    });
  
    const tasks = ['Choose project name', 'Send email', 'Plan meeting'];
    const taskList = document.getElementById('taskList');
    tasks.forEach((task) => {
      const li = document.createElement('li');
      li.textContent = task;
      taskList.appendChild(li);
    });
  
  }); 

  function goToWelcomePage() {
    window.location.href = 'welcome-page.html';
  }

  function getFormattedDate() {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const today = new Date();
    return today.toLocaleDateString('en-US', options);
  }

  // Set the date and fetch weather data when the page loads
  window.onload = function () {
    document.getElementById('date').textContent = getFormattedDate();
    fetchWeather();
  };

  function getRandomStatus() {
    const statuses = ['Done', 'Process', 'OnHold', 'Rejected'];
    const randomIndex = Math.floor(Math.random() * statuses.length);
    return statuses[randomIndex];
  }

  // Function to generate a random date for last update
  function getRandomDate() {
    const startDate = new Date(2023, 0, 1); // January 1, 2023
    const endDate = new Date(); // Current date
    const randomDate = new Date(
      startDate.getTime() + Math.random() * (endDate.getTime() - startDate.getTime())
    );
    return randomDate.toDateString();
  }

  // Function to generate and add a random task row to the table
  function addRandomTask() {
    const taskName = `Task ${Math.floor(Math.random() * 100) + 1}`;
    const subject = `Subject ${Math.floor(Math.random() * 5) + 1}`;
    const status = getRandomStatus();
    const lastUpdate = getRandomDate();

    const table = document.getElementById('task-list');
    const newRow = table.insertRow();
    const cell1 = newRow.insertCell(0);
    const cell2 = newRow.insertCell(1);
    const cell3 = newRow.insertCell(2);
    const cell4 = newRow.insertCell(3);
    
    cell1.textContent = taskName;
    cell2.textContent = subject;
    cell3.textContent = status;
    cell4.textContent = lastUpdate;

    // Apply status-specific styles
    switch (status) {
      case 'Done':
        cell3.style.backgroundColor = 'green';
        cell3.style.color = 'white';
        break;
      case 'Process':
        cell3.style.backgroundColor = 'yellow';
        cell3.style.color = 'white';
        break;
      case 'OnHold':
        cell3.style.backgroundColor = 'blue';
        cell3.style.color = 'white';
        break;
      case 'Rejected':
        cell3.style.backgroundColor = 'red';
        cell3.style.color = 'white';
        break;
    }
  }

  // Generate and add multiple random task rows
  for (let i = 0; i < 5; i++) {
    addRandomTask();
  }

  function goToWelcomePage() {
    window.location.href = 'welcome-page.html';
  }