switch (location.pathname) {
  case "/temoignages/":
    const titles = document.querySelectorAll("h3.author-name");
    titles.forEach((title) =>
      title.parentElement.parentElement
        .querySelector(".item-content-wrapper.tss-right")
        .prepend(title)
    );

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
        a.style.color = "#a3b4ae";
        sub.style.display = "block";
      });
      sub.addEventListener("mouseleave", () => {
        a.style.color = "inherit";
        sub.style.display = "none";
      });
    });
    break;
}
