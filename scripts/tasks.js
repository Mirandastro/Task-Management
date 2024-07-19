
///////////////////////////////////////////////////////////

let img_task = document.getElementById("img_task");
let nav_task = document.getElementById("nav_task");

///////////////////////////////////////////////////////////
// Get the modal
var modal = document.getElementById("myModal");
// Get the button that opens the modal
var divNew = document.getElementById("tsk_new");


///////////////////////////////////////////////////////////

// When the user clicks the button, open the modal 
divNew.onclick = function() 
{
  window.location.href = "tasks.php?new=1";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    window.location.href = "tasks.php";
  }
}

///////////////////////////////////////////////////////////
init();


///////////////////////////////////////////////////////////
function init()
{
  console.log("init");

  img_task.setAttribute("src", "icons/Task_C.png");
  nav_task.setAttribute("class", "site_top_nav_sel");

}

///////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////

function isgroupcheck(e)
{
  let div_as_mb = document.getElementById("div_as_mb");
  let div_as_gp = document.getElementById("div_as_gp");
  if(e.checked) {
    div_as_mb.style.display = 'none';
    div_as_gp.style.display = 'flex';
  }
  else {
    div_as_mb.style.display = 'flex';
    div_as_gp.style.display = 'none';
  }
}


///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////
function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");

  if(ev.target.id === "col_new" || 
    ev.target.id === "col_started" ||
    ev.target.id === "col_done") 
  {
    ev.target.appendChild(document.getElementById(data));
  }

  let tid = data.replace("drag1", "");
  let state = 0;
  if(ev.target.id === "col_started") {
    state = 1;
  }
  else if(ev.target.id === "col_done") {
    state = 2;
  }

  
  window.location.href = "backend/task_update.php?" +
  "x=1"+"&id="+tid+"&state="+state;

}




///////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////









