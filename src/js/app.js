//code pour le menu
document.addEventListener("DOMContentLoaded", function () {
  const mobileMenuButton = document.querySelector(
    '[aria-controls="mobile-menu"]'
  );
  const mobileMenu = document.getElementById("mobile-menu");

  mobileMenuButton.addEventListener("click", function () {
    const expanded = this.getAttribute("aria-expanded") === "true";

    if (expanded) {
      this.setAttribute("aria-expanded", "false");
      mobileMenu.classList.add("hidden");
    } else {
      this.setAttribute("aria-expanded", "true");
      mobileMenu.classList.remove("hidden");
    }
  });
});
// code pour dropdown profile
document.addEventListener("DOMContentLoaded", function () {
  const userMenuButton = document.getElementById("user-menu-button");
  const userMenu = document.querySelector(
    '[aria-labelledby="user-menu-button"]'
  );

  userMenuButton.addEventListener("click", function () {
    const expanded = this.getAttribute("aria-expanded") === "true";

    if (expanded) {
      this.setAttribute("aria-expanded", "false");
      userMenu.classList.add("hidden");
    } else {
      this.setAttribute("aria-expanded", "true");
      userMenu.classList.remove("hidden");
    }
  });
});
// code pour formulaire 
document.addEventListener("DOMContentLoaded", function () {
    const showMoreButton = document.getElementById("show-more");
    const showPrecedent = document.getElementById("show-precedent");
  const firstSection = document.getElementById("first-section");
  const secondSection = document.getElementById("second-section");

  showMoreButton.addEventListener("click", function () {
    firstSection.classList.add("hidden");
    secondSection.classList.remove("hidden");
  });
  showPrecedent.addEventListener("click", function () {
    firstSection.classList.remove("hidden");
    secondSection.classList.add("hidden");
  });
});

// wone de recherche
$(document).ready(function () {
  $("#recherche").on("input", function () {
    var recherche = $(this).val();
    $.ajax({
      url: "rechercher.php",
      type: "GET",
      data: { recherche: recherche },
      success: function (response) {
        $("#options").html(response);
      },
    });
  });
});
