// JavaScript function to toggle button state
function toggleSelect(button) {
  button.classList.toggle("unselect");
  button.innerText = button.classList.contains("unselect") ? "Unselect" : "Select";
}
