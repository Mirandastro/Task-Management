



///////////////////////////////////////////////////////////
init();

///////////////////////////////////////////////////////////
function init()
{
  let img_admin = document.getElementById("img_admin");
  let nav_admin = document.getElementById("nav_admin");
  img_admin.setAttribute("src", "icons/Admin_C.png");
  nav_admin.setAttribute("class", "site_top_nav_sel");

}

////////////////edit//////////////////111111111

//Edit buttons
var editButtons = document.querySelectorAll(".btn_ed");
editButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    var memberData = {
      id: button.getAttribute("data-member-id"),
      name: button.getAttribute("data-member-name"),
      email: button.getAttribute("data-member-email"),
      position: button.getAttribute("data-member-position"),
      joined: button.getAttribute("data-member-joined"),
    };
    openEditModal(memberData);
  });
});

// populate the responding data
function openEditModal(memberData) {
  var modal = document.getElementById("editMemberModal");
  var form = document.getElementById("editMemberForm");
  modal.style.display = "block";
  
  form.querySelector('#editMemberId').value = memberData.id;
  form.querySelector('#editEmployeeName').value = memberData.name;
  form.querySelector('#editEmployeeEmail').value = memberData.email;
  form.querySelector('#editEmployeePosition').value = memberData.position;
  form.querySelector('#editEmployeeJoinedDate').value = memberData.joined;
}

////////////////edit//////////////////2222222222


////////////////// "Add New" ////////////////111111

//Add New button
var addNewButton = document.getElementById("btn_new");
addNewButton.addEventListener("click", openAddModal);

// opening modal
function openAddModal() {
  var modal = document.getElementById("myModal");
  modal.style.display = "block";
}

////////////////// "Add New" ////////////////22222

//////////////////delete////////////11111111

// Delete buttons
var deleteButtons = document.querySelectorAll(".btn_dl");
deleteButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    var memberId = button.getAttribute("data-member-id");
    openDeleteModal(memberId);
  });
});

// opening the delete confirmation modal
function openDeleteModal(memberId) {
  var modal = document.getElementById("deleteMemberModal");
  modal.style.display = "block";
  
  // Store the memberId in a hidden field for confirmation
  var deleteMemberForm = document.getElementById("deleteMemberForm");
  deleteMemberForm.querySelector('#deleteMemberId').value = memberId;
}

// Confirm button
var confirmDeleteButton = document.getElementById("btn");
confirmDeleteButton.addEventListener("click", function (e) {
  e.preventDefault(); // Prevent the default form submission
  var deleteConfirmationForm = document.getElementById("deleteMemberForm");
  var memberId = deleteConfirmationForm.querySelector('#deleteMemberId').value;


  deleteMember(memberId);

  // Function to delete a member
function deleteMember(memberId) {

  var deleteForm = document.createElement('form');
  deleteForm.method = 'post';
  deleteForm.action = 'admin_delete.php';


  var memberIdInput = document.createElement('input');
  memberIdInput.type = 'hidden';
  memberIdInput.name = 'member_id';
  memberIdInput.value = memberId;

  deleteForm.appendChild(memberIdInput);

  document.body.appendChild(deleteForm);
  deleteForm.submit();
}

  closeModal("deleteMemberModal");
});


/////////////////delete/////////////////////////222222