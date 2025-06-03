document.getElementById("open-dialog").addEventListener("click", function () {
  document.getElementById("warning-dialog").showModal();
});

document.getElementById("close-dialog").addEventListener("click", function () {
  document.getElementById("warning-dialog").close();
});
