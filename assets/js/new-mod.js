const buttons = document.querySelectorAll(".bottom-navbar button:not(.float)");
const effect = document.querySelector(".effect");
const container = document.querySelector(".container-nav");
let y = 0;
let moveY = 0;
let open = false;

const vh = window.innerHeight * 0.01;
document.documentElement.style.setProperty("--vh", `${vh}px`);
setTimeout(function () {
  window.scrollTo(0, 1);
}, 0);

window.addEventListener("touchstart", (evt) => {
  const area = window.innerHeight - evt.touches[0].clientY;
  y = area;
  console.log(y);
});

window.addEventListener("touchend", (evt) => {
  y = 0;
  console.log(moveY);
  if (moveY > window.innerHeight / 4) {
    anime({
      targets: ".container-nav",
      translateY: `-${window.innerHeight / 2}px`,
      duration: 600,
    });
    open = true;
  } else {
    anime({
      targets: ".container-nav",
      translateY: `0px`,
      duration: 600,
      easing: "easeOutExpo",
    });
    open = false;
  }
});

buttons.forEach((item) => {
  item.addEventListener("click", (evt) => {
    const x = evt.target.offsetLeft;

    // Hapus kelas 'active' dari semua tombol
    buttons.forEach((btn) => {
      btn.classList.remove("active");
    });

    // Tambahkan kelas 'active' pada tombol yang diklik
    evt.target.classList.add("active");

    // Tampilkan efek
    effect.classList.add("active");

    // Atur posisi efek
    anime({
      targets: ".effect",
      left: `${x}px`,
      duration: 600,
    });
  });
});

// Tambahkan event listener untuk menyembunyikan efek jika tidak ada tombol yang aktif
document.addEventListener("click", (event) => {
  if (!event.target.closest(".bottom-navbar")) {
    // Jika klik di luar navbar, sembunyikan efek
    effect.classList.remove("active");
    buttons.forEach((btn) => {
      btn.classList.remove("active");
    });
  }
});

buttons.forEach((item) => {
  item.addEventListener("click", (evt) => {
    const x = evt.target.offsetLeft;
    buttons.forEach((btn) => {
      btn.classList.remove("active");
    });
    evt.target.classList.add("active");
    anime({
      targets: ".effect",
      left: `${x}px`,
      duration: 600,
    });
  });
});

function handleClickPlus(evt) {
  anime({
    targets: ".container-nav",
    translateY: `-${window.innerHeight / 2}px`,
    duration: 600,
  });
  open = true;
  y = window.innerHeight / 2;
  moveY += window.innerHeight / 2;
}

function handleClose() {
  anime({
    targets: ".container-nav",
    translateY: `0px`,
    duration: 600,
    easing: "easeOutExpo",
  });
  open = false;
  moveY = 0;
}

// Detect click outside container-nav
document.addEventListener("click", (event) => {
  if (open && !container.contains(event.target)) {
    handleClose();
  }
});

// search
const placeholders = ["Cari destinasi impian Anda...", "Cari kuliner enak...", "Cari penginapan..."];

let currentIndex = 0;
const placeholderElement = document.getElementById("placeholder");

function changePlaceholder() {
  // Menyimpan teks placeholder saat ini
  const currentPlaceholder = placeholderElement.innerText;

  // Tambahkan kelas untuk menggerakkan placeholder lama ke atas
  placeholderElement.classList.add("moving-up");

  // Tunggu hingga animasi selesai sebelum mengganti teks
  setTimeout(() => {
    // Ganti teks placeholder
    currentIndex = (currentIndex + 1) % placeholders.length;
    placeholderElement.innerText = placeholders[currentIndex];

    // Tambahkan kelas untuk animasi placeholder baru
    placeholderElement.classList.remove("moving-up");
    placeholderElement.classList.add("new");

    // Tunggu sejenak sebelum menampilkan placeholder baru
    setTimeout(() => {
      placeholderElement.classList.remove("new");
      placeholderElement.classList.add("moving-in");
    }, 50); // Tunggu sedikit sebelum menampilkan placeholder baru

    // Hapus kelas animasi setelah animasi selesai
    setTimeout(() => {
      placeholderElement.classList.remove("moving-in");
    }, 300); // Sesuaikan dengan durasi animasi
  }, 300); // Sesuaikan dengan durasi animasi
}

// Ganti placeholder setiap 3 detik
setInterval(changePlaceholder, 3000);

// Set placeholder awal
changePlaceholder();

// Event listener untuk menghilangkan placeholder saat mengetik
const inputField = document.getElementById("search");
const searchIcon = document.getElementById("search-icon");
// Pastikan elemen ini ada di HTML

inputField.addEventListener("input", function () {
  if (inputField.value) {
    placeholderElement.style.opacity = "0"; // Menghilangkan placeholder saat mengetik
    searchIcon.style.opacity = "0"; // Menghilangkan ikon saat mengetik
  } else {
    placeholderElement.style.opacity = "1"; // Menampilkan kembali placeholder jika input kosong
    searchIcon.style.opacity = "1"; // Menampilkan kembali ikon jika input kosong
    changePlaceholder(); // Ganti placeholder jika input kosong
  }
});

inputField.addEventListener("focus", () => {
  searchIcon.style.opacity = 0; // Menghilangkan ikon saat fokus
});

inputField.addEventListener("blur", () => {
  if (!inputField.value) {
    searchIcon.style.opacity = 1; // Menampilkan kembali ikon jika input kosong saat blur
  }
});
