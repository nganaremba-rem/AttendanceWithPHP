document.addEventListener("click", (e) => {
  if (e.target.matches("[data-toggle-btn]")) {
    let dropdown = document.querySelectorAll(".dropdown");

    dropdown.forEach((drop) => {
      drop.classList.remove("active");
    });

    e.target.closest("[dropdown]").classList.toggle("active");
  }
  if (e.target.matches("[data-close-btn]")) {
    e.target.closest("[dropdown]").classList.remove("active");
  }
  if (
    !e.target.matches("[data-toggle-btn]") &&
    e.target.closest("[dropdown]") == null
  ) {
    var dropdownI = document.querySelectorAll(".dropdown");

    dropdownI.forEach((drop) => {
      drop.classList.remove("active");
    });
  }
});
