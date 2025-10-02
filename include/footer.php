<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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
