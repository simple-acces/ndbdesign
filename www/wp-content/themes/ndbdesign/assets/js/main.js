switch (location.pathname) {
  default:
    const slides = document.querySelectorAll(".slide");
    slides.forEach((slide) =>
      slide.addEventListener("click", () =>
        jQuery(slide).children(".woocommerce").slideToggle()
      )
    );
    const menuButtons = document.querySelectorAll(
      "li.menu-item-has-children > a"
    );
    menuButtons.forEach((a) => {
      const sub = a.parentElement.querySelector("ul.sub-menu");
      a.addEventListener("mouseenter", () => {
        a.style.color = "black";
        sub.style.display = "block";
      });
      sub.addEventListener("mouseleave", () => {
        a.style.color = "inherit";
        sub.style.display = "none";
      });
    });
    break;
}
