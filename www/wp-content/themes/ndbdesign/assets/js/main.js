switch (location.pathname) {
  default:
    const slides = document.querySelectorAll(".slide");
    slides.forEach((slide) =>
      slide.addEventListener("click", () =>
        jQuery(slide).children(".woocommerce").slideToggle()
      )
    );
    break;
}
