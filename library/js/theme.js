// Responsive videos
const allVideos = document.querySelectorAll('.entry-content iframe[src*="player.vimeo.com"], .entry-content iframe[src*="youtube.com"], .entry-content iframe[src*="dailymotion.com"], .entry-content iframe[src*="kickstarter.com"][src*="video.html"], .entry-content object, .entry-content embed');

allVideos.forEach(function(video) {
  const aspectRatio = video.height / video.width;

  video.removeAttribute('height');
  video.removeAttribute('width');

  if (!video.parentElement.matches('object')) {
    const wrapper = document.createElement('div');
    wrapper.classList.add('responsive-video-wrapper');
    wrapper.style.paddingTop = aspectRatio * 100 + '%';
    video.parentNode.insertBefore(wrapper, video);
    wrapper.appendChild(video);
  }
});

// Mobile menu
const header = document.getElementById('header');
const mobileMenuLink = header.querySelector('#mobile-menu a');

header.addEventListener('click', (event) => {
  if (event.target === mobileMenuLink && mobileMenuLink.classList.contains('left-menu')) {
    document.body.classList.toggle('left-menu-open');
  } else if (event.target === mobileMenuLink) {
    const dropDownSearch = document.getElementById('drop-down-search');
    dropDownSearch.style.display = dropDownSearch.style.display === 'none' ? 'block' : 'none';
  }
});

const secondaryNav = document.getElementById('secondary');
const leftNav = document.getElementById('left-nav');

if (secondaryNav || leftNav) {
  const subMenuParent = document.querySelectorAll('.sub-menu-parent > a');
  subMenuParent.forEach((link) => {
    link.addEventListener('click', (event) => {
      event.preventDefault();
      link.classList.toggle('open');
      link.nextElementSibling.classList.toggle('sub-menu');
    });
  });
}

const isLeftSidebar = document.body.classList.contains('left-sidebar');
const targetNav = isLeftSidebar ? secondaryNav : leftNav;

if (targetNav) {
  const mediaQuery = window.matchMedia("(max-width:768px)");
  const handleMediaChange = function(mq) {
    if (mq.matches) {
      targetNav.classList.add('offcanvas');
      document.getElementById('site-navigation').prependTo(targetNav).style.display = 'block';
      document.querySelector('.widget_search').style.display = 'none';
    } else {
      targetNav.classList.remove('offcanvas');
      document.body.classList.remove('left-menu-open');
      document.querySelectorAll('#secondary, .widget_search').forEach(el => el.style.display = 'block');
      document.getElementById('site-navigation').appendTo(document.querySelector('#header .c12'));
      document.getElementById('drop-down-search').style.display = 'none';
    }
  };

  mediaQuery.addListener(handleMediaChange);
  handleMediaChange(mediaQuery); // Initial setup for current screen size
}

// Image anchor
const imageAnchors = document.querySelectorAll('a:has(img)');
imageAnchors.forEach(link => link.classList.add('image-anchor'));

// Prevent default behavior for links with href="#"
document.querySelectorAll('a[href="#"]').forEach(link => link.addEventListener('click', (event) => event.preventDefault())); 
