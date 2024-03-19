/*!
* Start Bootstrap - Agency v7.0.12 (https://startbootstrap.com/theme/agency)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-agency/blob/master/LICENSE)
*/
//
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {
    
    let isNavbarShrunk = false;

    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY <= 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } 
        else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

    // Shrink the navbar 
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);

        
    //  Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav && !isNavbarShrunk) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            rootMargin: '0px 0px -40%',
        });
    };

    const isAtTop = function () {
        return window.scrollY === 0;
    };
 
    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');


     // Función para manejar el evento de clic en el botón
     const handleNavbarTogglerClick = function () {
        console.log('Botón de la barra de navegación presionado');
        if (isNavbarShrunk && window.scrollY <= 0) {
            // Si la barra de navegación está encogida, eliminar la clase navbar-shrink
            mainNav.classList.add('navbar-shrink');
            isNavbarShrunk = false;

        } else if(isNavbarShrunk && isAtTop){
            mainNav.classList.remove('navbar-shrink');
            isNavbarShrunk = false;
        }
        else {
            // Si la barra de navegación no está encogida, agregar la clase navbar-shrink
            mainNav.classList.add('navbar-shrink');
            isNavbarShrunk = true;
        }
    };

    navbarToggler.addEventListener('click', handleNavbarTogglerClick);

    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });
// Close the responsive navbar when scrolling at the top of the page
window.addEventListener('scroll', () => {
    const navbarResponsive = document.body.querySelector('#navbarResponsive');
    if (window.scrollY <= 0 && navbarResponsive.classList.contains('show')) {
        navbarToggler.click();
    }
});
});
