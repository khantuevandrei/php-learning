const { createElement } = require("react");

document.querySelector(".card");
document.querySelectorAll(".card");
document.querySelector("#main");
document.querySelector('[data-id="5"]');

const card = document.createElement("div");
card.className = "card";
card.id = "card-1";
card.setAttribute("data-id", "1");
card.innerHTML = "<h3>Header</h3><p>Text</p>";
card.textContent = "Just text";

document.querySelector(".list").addEventListener("click", (event) => {
  const deleteBtn = event.target.closest(".delete-btn");
  if (!deleteBtn) return;
  const item = deleteBtn.closest(".item");
  item.remove();
});

const formData = new FormData(form);
