///////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////

init();

///////////////////////////////////////////////////////////
function goToWelcomePage() {
  window.location.href = 'index.html';
}

function init() {
  img_file.setAttribute('src', 'icons/File_C.png');
  nav_file.setAttribute('class', 'site_top_nav_sel');
}

function getQuestion() {}

function next(event) {}

///////////////////////////////////////////////////////////
function showResults() {}

var deleteButtons = document.querySelectorAll('.delete-button');
var editButtons = document.querySelectorAll('.edit-button');
var shareButtons = document.querySelectorAll('.share-button');

var deleteModals = document.querySelectorAll('.modal');
var editModals = document.querySelectorAll('.edit-modal');
var shareModals = document.querySelectorAll('.share-modal');

document.addEventListener('click', function (event) {
  if (event.target.classList.contains('delete-button')) {
    showDeleteModal();
  }
});

function showDeleteModal() {
  var modal = document.getElementById('myModal');

  modal.style.display = 'block';
}

document.addEventListener('click', function (event) {
  if (event.target.classList.contains('Discard-Changes')) {
    discardChanges();
  }
});

function discardChanges() {
  var modal = document.getElementById('shareModal');

  modal.style.display = 'none';
}

deleteModals.forEach(function (deleteModal, index) {
  var closeBtn = deleteModal.querySelector('.close');
  closeBtn.addEventListener('click', function () {
    deleteModal.style.display = 'none';
  });
});

////////////////////////EDIT //////////////////////////////

document.addEventListener('click', function (event) {
  if (event.target.classList.contains('edit-button')) {
    showEditModal();
  }
});

function showEditModal() {
  var editModals = document.getElementById('editModal');

  editModals.style.display = 'block';
}

editButtons.forEach(function (editButton, index) {
  editButton.addEventListener('click', function () {
    editModals[index].style.display = 'block';
  });
});

editModals.forEach(function (editModal, index) {
  var closeBtn = editModal.querySelector('.close');
  closeBtn.addEventListener('click', function () {
    editModal.style.display = 'none';
  });
});

/////////////////////SHARE/////////////////////////////////////

document.addEventListener('click', function (event) {
  if (event.target.classList.contains('share-button')) {
    showShareModal();
  }
});

function copy_link(link, file_id) {
  document.getElementById('share-link').value = link;
  document.getElementById('share-file-id').value = file_id;
}

function showShareModal() {
  var shareModals = document.getElementById('shareModal');
  shareModals.style.display = 'block';
}

shareButtons.forEach(function (shareButton, index) {
  shareButton.addEventListener('click', function () {
    shareModals[index].style.display = 'block';
  });
});

shareModals.forEach(function (shareModal, index) {
  var closeBtn = shareModal.querySelector('.close');
  closeBtn.addEventListener('click', function () {
    shareModal.style.display = 'none';
  });
});

/////////////////////////////////////////////////////////////////////

var deleteButtons = document.querySelectorAll('.DeleteFile');
var fileIdToDeleteInput = document.getElementById('fileIdToDelete');
var deleteFileForm = document.getElementById('deleteFileForm');

deleteButtons.forEach(function (deleteButton) {
  deleteButton.addEventListener('click', function () {
    var parentRow = this.closest('tr');

    var fileId = parentRow.getAttribute('data-file-id');

    fileIdToDeleteInput.value = fileId;

    var deleteFileInput = document.createElement('input');
    deleteFileInput.setAttribute('type', 'hidden');
    deleteFileInput.setAttribute('name', 'DeleteFile');
    deleteFileInput.setAttribute('value', 'true');
    deleteFileForm.appendChild(deleteFileInput);

    deleteFileForm.submit();

    parentRow.remove();
  });
});

function showDeleteModal() {
  var modal = document.getElementById('myModal');
  modal.style.display = 'block';
}

//////////////////////////////////////////////////////////////////////

// const viewAllButton = document.getElementById('viewAllButton');
// const yourFilesButton = document.getElementById('yourFilesButton');
// const shareFilesButton = document.getElementById('shareFilesButton');

// const yourFiles = ['file1.jpg', 'file2.pdf', 'file3.doc'];
// const sharedFiles = ['file4.jpg', 'file5.doc', 'file6.pdf'];

// function displayFiles(fileList) {
//   const fileListContainer = document.querySelector('.file-list');
//   fileListContainer.innerHTML = '';

//   fileList.forEach((file) => {
//     const listItem = document.createElement('li');
//     listItem.textContent = file;
//     fileListContainer.appendChild(listItem);
//   });
// }

// document.addEventListener("DOMContentLoaded", function () {
//     const viewAllButton = document.getElementById("viewAllButton");
//     const yourFilesButton = document.getElementById("yourFilesButton");
//     const shareFilesButton = document.getElementById("shareFilesButton");

//     viewAllButton.addEventListener("click", function () {
//       console.log('Clicked "View All"');
//       const user1Rows = document.querySelectorAll(".User1");
//       user1Rows.forEach((row) => {
//         row.classList.add("show-row");
//       });

//       const user2Rows = document.querySelectorAll(".User2");
//       user2Rows.forEach((row) => {
//         row.classList.add("show-row");
//       });

//       const user4Rows = document.querySelectorAll(".User4");
//       user4Rows.forEach((row) => {
//         row.classList.add("show-row");
//       });

//     });

//     yourFilesButton.addEventListener("click", function () {
//       console.log('Clicked "Your Files"');
//       const user4Rows = document.querySelectorAll(".User4");
//       user4Rows.forEach((row) => {
//         row.classList.remove("show-row");
//       });

//       const user1Rows = document.querySelectorAll(".User1");
//       user1Rows.forEach((row) => {
//         row.classList.add("show-row");
//       });

//       const user2Rows = document.querySelectorAll(".User2");
//       user2Rows.forEach((row) => {
//         row.classList.remove("show-row");
//       });

//     });

//     const user4Rows = document.querySelectorAll(".User4");

//     shareFilesButton.addEventListener("click", function () {
//       console.log('Clicked "Share Files"');
//       user4Rows.forEach((row) => {
//         row.classList.add("show-row");
//       });
//       const user1Rows = document.querySelectorAll(".User1");
//       user1Rows.forEach((row) => {
//         row.classList.remove("show-row");
//       });

//       const user2Rows = document.querySelectorAll(".User2");
//       user2Rows.forEach((row) => {
//         row.classList.remove("show-row");
//       });

//      });
//   });

document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('searchInput');
  const submitButton = document.getElementById('submitimg');

  searchInput.addEventListener('click', function () {
    submitButton.click();
  });
});

document.querySelector('#searchInput').addEventListener('input', function () {
  const searchTerm = this.value.toLowerCase();
  const rows = document.querySelectorAll('#fileTable tbody tr');

  rows.forEach(function (row) {
    const fileName = row
      .querySelector('td:nth-child(2)')
      .textContent.toLowerCase();
    const dateUploaded = row
      .querySelector('td:nth-child(3)')
      .textContent.toLowerCase();
    const lastUpdated = row
      .querySelector('td:nth-child(4)')
      .textContent.toLowerCase();
    const uploadedBy = row
      .querySelector('td:nth-child(5)')
      .textContent.toLowerCase();

    if (
      fileName.includes(searchTerm) ||
      dateUploaded.includes(searchTerm) ||
      lastUpdated.includes(searchTerm) ||
      uploadedBy.includes(searchTerm)
    ) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });
});

document
  .getElementById('yourFilesButton')
  .addEventListener('click', function () {
    window.location.href = 'files.php?my_files';
  });

document.getElementById('viewAllButton').addEventListener('click', function () {
  window.location.href = 'files.php';
});
