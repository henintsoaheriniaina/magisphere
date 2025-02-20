document.addEventListener("DOMContentLoaded", function () {
    const themeToggleBtn = document.getElementById("theme-toggle");

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener("click", function () {
            let html = document.documentElement;
            let isDark = html.classList.toggle("dark");

            localStorage.setItem("theme", isDark ? "dark" : "light");

            // Si l'utilisateur est connecté, on envoie la requête au backend
            if (themeToggleBtn.dataset.authenticated === "true") {
                fetch("/toggle-theme", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content,
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ theme: isDark ? "dark" : "light" }),
                });
            }
        });
    }
});
