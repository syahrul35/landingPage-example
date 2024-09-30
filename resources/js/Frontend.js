document.addEventListener("DOMContentLoaded", (event) => {
    const navHeight = document.querySelector("nav").offsetHeight // Mengambil tinggi navbar
    const navLinks = document.querySelectorAll("#nav-link a")

    navLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault() // Mencegah link berfungsi normal

            // Menghapus kelas 'active' dari semua link
            navLinks.forEach((l) => l.classList.remove("active"))

            // Menambahkan kelas 'active' ke link yang diklik
            this.classList.add("active")

            const targetId = this.getAttribute("href") // Mengambil target id dari href
            const targetElement = document.querySelector(targetId) // Mendapatkan elemen target

            // Mengatur scroll dengan mengurangi tinggi navbar
            window.scrollTo({
                top: targetElement.offsetTop - navHeight, // Mengurangi tinggi navbar, 10 adalah tambahan offset yang opsional
                behavior: "smooth",
            })
        })
    })
})

window.addEventListener("scroll", function () {
    var navbar = document.querySelector("nav")

    // Pengecekan apakah berada di halaman ProductDetail
    if (document.body.classList.contains("product-detail-page")) {
        return
    }

    if (window.scrollY > 50) {
        // Sesuaikan dengan kebutuhan
        navbar.classList.remove("bg-opacity-50")
        navbar.classList.add("bg-opacity-100")
    } else {
        navbar.classList.remove("bg-opacity-100")
        navbar.classList.add("bg-opacity-50")
    }
})
