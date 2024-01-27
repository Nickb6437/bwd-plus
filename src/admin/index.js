import "./main.css"

const ogImgBtn = document.getElementById("og-img-btn");
const ogImgPrev = document.getElementById("og-img-preview");
const ogImgInput = document.getElementById("bwd_plus_og_image");

const mediaFrame = wp.media(
  {
    title: "Select or Upload Image",
    button: {
      text: "Select Image"
    },
    multiple: false
  }
);

ogImgBtn.addEventListener("click", (e) => {
  e.preventDefault();
  mediaFrame.open();
});

mediaFrame.on("select", () => {
  const attachment = mediaFrame.state().get("selection").first().toJSON();
  ogImgInput.value = attachment.sizes.opengraph.url;
  ogImgPrev.src = attachment.sizes.opengraph.url;
});
