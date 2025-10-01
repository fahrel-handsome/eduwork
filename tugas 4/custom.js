// Navbar scroll effect
window.addEventListener("scroll", function () {
  const navbar = document.querySelector(".navbar");
  if (window.scrollY > 50) {
    navbar.classList.add("scrolled");
  } else {
    navbar.classList.remove("scrolled");
  }
});

// Back-to-top button
const backToTop = document.createElement("button");
backToTop.innerHTML = "⬆";
backToTop.id = "backToTop";
document.body.appendChild(backToTop);

window.addEventListener("scroll", () => {
  if (window.scrollY > 300) {
    backToTop.classList.add("show");
  } else {
    backToTop.classList.remove("show");
  }
});

backToTop.addEventListener("click", () => {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
});

// Parallax Background + Image
window.addEventListener("scroll", function () {
  const scrollY = window.scrollY;
  const bg = document.querySelector(".parallax-bg");
  const img = document.querySelector(".parallax-img");

  if (bg) {
    bg.style.transform = `translateY(${scrollY * 0.3}px)`; // background gerak halus
  }
  if (img) {
    img.style.transform = `translateY(${scrollY * 0.15}px)`; // foto profil ikut gerak
  }
});

// Typing Animation
const typingText = document.querySelector(".typing-text");
const words = ["Selamat Datang di Website Saya", "Saya Seorang Web Developer", "Mari Bekerja Sama!"];
let wordIndex = 0;
let charIndex = 0;
let isDeleting = false;

function typeEffect() {
  if (typingText) {
    let currentWord = words[wordIndex];
    let displayed = currentWord.substring(0, charIndex);

    typingText.textContent = displayed;

    if (!isDeleting && charIndex < currentWord.length) {
      charIndex++;
      setTimeout(typeEffect, 120);
    } else if (isDeleting && charIndex > 0) {
      charIndex--;
      setTimeout(typeEffect, 60);
    } else {
      if (!isDeleting) {
        isDeleting = true;
        setTimeout(typeEffect, 1000); // tunggu sebentar sebelum delete
      } else {
        isDeleting = false;
        wordIndex = (wordIndex + 1) % words.length;
        setTimeout(typeEffect, 200);
      }
    }
  }
}

typeEffect();
