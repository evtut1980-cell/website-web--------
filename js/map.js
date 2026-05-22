const tabItem = document.querySelectorAll('.tabs__btn-item');
const tabContent = document.querySelectorAll('.tabs__content-item');



tabItem.forEach(function (element) {
  element.addEventListener('click', open);
})

function open(evt) {
  const tabTarget = evt.currentTarget;
  const button = tabTarget.dataset.button;

  tabItem.forEach(function (item) {
    item.classList.remove('tabs__btn-item--active');
  });


  tabTarget.classList.add('tabs__btn-item--active');


  tabContent.forEach(function (item) {
    item.classList.remove
      ('tabs__content-item--active');
  });

  document.querySelector(`#${button}`).classList.add('tabs__content-item--active');
}

const menuBtn = document.querySelector('.menu__btn');
const menu = document.querySelector('.menu__list');

menuBtn.addEventListener('click', () => {
  menu.classList.toggle('menu__list--active');

});



// Map initialization is handled directly on the contacts page.
// This file keeps tab/menu behavior only.

// ========== ПЛАВНОЕ ПОЯВЛЕНИЕ ПРИ СКРОЛЛЕ ==========
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
    }
  });
}, { threshold: 0.1 });

document.querySelectorAll('.important__item, .card, .why-lease__item').forEach(el => {
  observer.observe(el);
});