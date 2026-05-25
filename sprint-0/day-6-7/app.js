// Data
let tasks = [];
let currentFilter = "all";

// Utilities
function geretateID() {}
function saveToStorage() {}
function loadFromStorage() {}

// Rendering
function renderTasks() {}
function createTaskElement(task) {}
function renderCounter() {}

// Handlers

// on Main
document.querySelector(".main").addEventListener("click", (event) => {
  handleTaskComplete(event);
  handleTaskDelete(event);
});

// Complete task
function handleTaskComplete(event) {
  const completeBtn = event.target.closest("#card-complete");
  if (!completeBtn) return;

  const card = completeBtn.closest(".card");
  card.classList.toggle("task-done");
}
// Delete task
function handleTaskDelete(event) {
  const deleteBtn = event.target.closest(".card-delete");
  if (!deleteBtn) return;

  const card = deleteBtn.closest(".card");
  card.remove();
}

function handleAddTask(event) {}

function handleFilterChange(event) {}

// Initialization
function init() {
  loadFromStorage();
  renderTasks();
  // use handlers
}

document.addEventListener("DOMContentLoaded", init);

/* 
Task object structure:

{
  id: 1,
  title: "Купить продукты",
  priority: "high",      // "low" | "medium" | "high"
  dueDate: "2024-12-25", // YYYY-MM-DD или null
  completed: false,
  createdAt: "2024-01-15T10:30:00"
}
*/

// Overlay logic
const overlay = document.querySelector(".modal-overlay");

const openBtn = document.querySelector(".modal-open");
openBtn.addEventListener("click", () => {
  overlay.classList.remove("hidden");
});

const closeBtn = document.querySelector(".modal-close");
closeBtn.addEventListener("click", () => {
  overlay.classList.add("hidden");
});
