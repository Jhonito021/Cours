<script>
document.addEventListener("DOMContentLoaded", () => {
  const toggler = document.querySelector(".navbar-toggler");
  const collapse = document.getElementById("navbarNav");

  // --- COLLAPSE ---
  if (collapse) {
    toggler.addEventListener("click", () => {
      collapse.classList.toggle("show");
    });
  }

  // --- DROPDOWN ---
  const dropdownToggle = document.querySelector(".dropdown-toggle");
  const dropdownMenu = document.getElementById("dropdown-menu");

  if (dropdownToggle && dropdownMenu) {
    dropdownToggle.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      dropdownMenu.classList.toggle("show");
    });

    // Fermer le dropdown si on clique ailleurs
    document.addEventListener("click", () => {
      dropdownMenu.classList.remove("show");
    });
  }
});

</script>
