document.addEventListener("DOMContentLoaded", () => {
    console.log("script.js caricato ✅");

    if (typeof anime === "undefined") {
        console.error("anime.js NON caricato ❌ (manca CDN o ordine sbagliato)");
        return;
    }

    const lettersEl = document.querySelector(".ml11 .letters");
    const lineEl = document.querySelector(".ml11 .line");

    if (!lettersEl || !lineEl) {
        console.error("Elementi .ml11 .letters o .ml11 .line NON trovati ❌");
        return;
    }

    lettersEl.innerHTML = lettersEl.textContent.replace(
        /([^\x00-\x80]|\w)/g,
        "<span class='letter'>$&</span>"
    );

    anime.timeline({ loop: true })
        .add({
            targets: ".ml11 .line",
            scaleY: [0, 1],
            opacity: [0.5, 1],
            easing: "easeOutExpo",
            duration: 700
        })
        .add({
            targets: ".ml11 .line",
            translateX: [0, lettersEl.getBoundingClientRect().width + 10],
            easing: "easeOutExpo",
            duration: 700,
            delay: 100
        })
        .add({
            targets: ".ml11 .letter",
            opacity: [0, 1],
            easing: "easeOutExpo",
            duration: 600,
            offset: "-=775",
            delay: (el, i) => 34 * (i + 1)
        })
        .add({
            targets: ".ml11",
            opacity: 0,
            duration: 1000,
            easing: "easeOutExpo",
            delay: 1000
        });
});
