import intersect from "@alpinejs/intersect";
import Alpine from "alpinejs";
import "./bootstrap";
window.Alpine = Alpine;

Alpine.plugin(intersect);
Alpine.start();
