'use strict';

window.addEventListener('DOMContentLoaded', () => { 
    // Scroll
    const anchors = document.querySelector('.menu'),
          aboutMeBlock = document.querySelector('.about_me'),
          projectBlock = document.querySelector('.projects'),
          contactBlock = document.querySelector('.contact');

    function scroll (itemText) {
        switch (itemText) {
        case 'Обо мне':
            aboutMeBlock.scrollIntoView({behavior: "smooth"});
            break;
        case 'Проекты':
            projectBlock.scrollIntoView({behavior: "smooth"});
            break;
        case 'Контакты':
            contactBlock.scrollIntoView({behavior: "smooth"});
            console.log('scroll');

            break;
        }
    }

    anchors.addEventListener('click', event => {
        if (event.target && event.target.classList.contains('menu_item')) {
        scroll(event.target.innerText);
        }
    });

    // hamburger

    const menu = document.querySelector('.menu'),
          menuItem = document.querySelectorAll('.menu_item'),
          hamburger = document.querySelector('.hamburger');

    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('hamburger_active');
        menu.classList.toggle('menu_active');
    });

    menuItem.forEach(item => {
        item.addEventListener('click', () => {
            hamburger.classList.toggle('hamburger_active');
            menu.classList.toggle('menu_active');
        });
    });

});
