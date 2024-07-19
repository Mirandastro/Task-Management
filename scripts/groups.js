
let img_gp = document.getElementById("img_gp");
let nav_gp = document.getElementById("nav_gp");
///////////////////////////////////////////////////////////
init();

///////////////////////////////////////////////////////////
function init()
{
  img_gp.setAttribute("src", "icons/GroupManagement_C.png");
  nav_gp.setAttribute("class", "site_top_nav_sel");
}




function setMenuSelected() {
  const menu = document.querySelectorAll("#menu a");
  for (let opt of menu) {
      if (document.location.href.includes(opt.href)) {
          opt.classList.add("selected");
          break;
      }
  }
}

setMenuSelected();
