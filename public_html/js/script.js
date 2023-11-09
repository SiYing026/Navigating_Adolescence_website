let navbar = document.querySelector('.header .navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
}

window.onscroll = () =>{
    navbar.classList.remove('active');
}

// Function to handle scroll event
        function handleScroll() {
            const header = document.querySelector(".header");
            if (window.scrollY > 50) {
                header.classList.add("hidden");
            } else {
                header.classList.remove("hidden");
            }
        }

        // Add scroll event listener
        window.addEventListener("scroll", handleScroll);

let mainVid = document.querySelector('.main-video');

document.querySelectorAll('.course-3 .box .video video').forEach(vid =>{

    vid.onclick = () =>{
        let src = vid.getAttribute('src');
        mainVid.classList.add('active');
        mainVid.querySelector('video').src = src;
    }

});

document.querySelector('#close-vid').onclick = () =>{
    mainVid.classList.remove('active');
}
