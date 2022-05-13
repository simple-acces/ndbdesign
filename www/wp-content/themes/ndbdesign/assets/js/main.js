const q = document.querySelector.bind(document);
const qa = document.querySelectorAll.bind(document);

switch (location.pathname) {
  case "/temoignages/":
    const titles = qa("h3.author-name");
    titles.forEach((title) =>
      title.parentElement.parentElement
        .querySelector(".item-content-wrapper.tss-right")
        .prepend(title)
    );

  default:
    const slides = qa(".slide");
    slides.forEach((slide) =>
      slide.addEventListener("click", () =>
        jQuery(slide).children(".woocommerce").slideToggle()
      )
    );
    const menuButtons = qa("li.menu-item-has-children > a");
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

    q("#masthead #menu-bt-open").addEventListener("click", () => {
      const t = q(".site-navigation-mobile");
      t.style.transform = "scaleY(1)";
      t.style.opacity = "1";
      q("#masthead #menu-bt-open").style.display = "none";
      q("#masthead #menu-bt-close").style.display = "block";
    });

    q("#masthead #menu-bt-close").addEventListener("click", () => {
      const t = q(".site-navigation-mobile");
      t.style.transform = "scaleY(0)";
      t.style.opacity = "0";
      q("#masthead #menu-bt-close").style.display = "none";
      q("#masthead #menu-bt-open").style.display = "block";
    });
    break;
}
