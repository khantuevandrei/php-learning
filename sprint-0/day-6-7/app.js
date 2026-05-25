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
function handleAddTask(event) {}
function handleTaskAction(event) {}
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
