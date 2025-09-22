$(document).ready(function() {
    loadCategories();
    loadMenuItems();
    AOS.init({
        duration: 1000, // Animation duration
        once: true, // Whether animation should happen only once
    });

    // Smooth scrolling for navigation links
    $('a.nav-link').on('click', function(event) {
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;

            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function() {
                window.location.hash = hash;
            });
        }
    });


   // Navbar background change on scroll
   $(window).scroll(function() {
    if ($(this).scrollTop() > 50) {
        $('.navbar').addClass('navbar-scrolled');
    } else {
        $('.navbar').removeClass('navbar-scrolled');
    }
});

    // AJAX call for logout
    $('.logout-link').on('click', function(e) {
        e.preventDefault(); // Prevent default action of the link
        $.ajax({
            url: 'logout.php', // The PHP script that handles logout
            method: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // If logout is successful, redirect to login page
                    window.location.href = 'login.php';
                } else {
                    alert('Logout failed, please try again.');
                }
            },
            error: function() {
                alert('Error in logout process.');
            }
        });
    });



});




