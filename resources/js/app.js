import intersect from "@alpinejs/intersect";
import Alpine from "alpinejs";
import "./bootstrap";
window.Alpine = Alpine;

Alpine.plugin(intersect);
Alpine.start();
function animateLike() {
    let heart = document.querySelector('[x-ref="heart"]');
    let counter = document.querySelector('[x-ref="counter"]');

    heart.classList.add("scale-125");
    setTimeout(() => heart.classList.remove("scale-125"), 200);

    counter.classList.add("animate-bounce");
    setTimeout(() => counter.classList.remove("animate-bounce"), 300);
}
