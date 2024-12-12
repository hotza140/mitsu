<script src="{{ asset('mobile/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('mobile/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('mobile/assets/js/popper.min.js') }}"></script>

<script>
    // to top
    let slideIndex = 1;

    function showSlide(n) {
        const slides = document.getElementsByClassName("slide");
        const dots = document.getElementsByClassName("dot");

        if (n > slides.length) slideIndex = 1;
        if (n < 1) slideIndex = slides.length;

        for (let i = 0; i < slides.length; i++) {
            slides[i].classList.remove("active");
        }
        for (let i = 0; i < dots.length; i++) {
            dots[i].classList.remove("active");
        }

        slides[slideIndex - 1].classList.add("active");
        dots[slideIndex - 1].classList.add("active");
    }

    function changeSlide(n) {
        showSlide(slideIndex += n);
    }

    function currentSlide(n) {
        showSlide(slideIndex = n);
    }

    // Initial slide
    showSlide(slideIndex);

    // Auto-slide every 3 seconds
    setInterval(() => {
        changeSlide(1); // Move to the next slide
    }, 5000); // 3000 milliseconds = 3 seconds


    window.addEventListener("scroll", function() {
        const app = document.getElementById("app");
        const appPosition = app.getBoundingClientRect().top;
        const screenPosition = window.innerHeight / 1.3;

        if (appPosition < screenPosition) {
            app.classList.add("show");
        }
    });
</script>