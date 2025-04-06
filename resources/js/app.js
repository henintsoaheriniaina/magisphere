import intersect from "@alpinejs/intersect";
import Alpine from "alpinejs";
import "./bootstrap";

if (window.Livewire) {
    window.Livewire.start();
}
window.Alpine = Alpine;

Alpine.plugin(intersect);
Alpine.start();
