import domReady from "@roots/bud-client/dom-ready";

const init = () => {
  document.body.querySelectorAll('.acorn-social-icon-native').forEach((el) => {
    el.addEventListener('click', function (e) {
      e.preventDefault();

      if (!navigator.share) {
        console.warn("Your browser doesn't support navigator.share().");
        return;
      }
      navigator
        .share({
          title: document.title,
          url: window.location.href,
        })
        .catch(console.error);
    });
  });
}

domReady(init);
