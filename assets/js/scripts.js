document.addEventListener("DOMContentLoaded", function() {
	const navItems = document.querySelectorAll(".wp-block-navigation-item a");
	const submenus = document.querySelectorAll(".wp-block-navigation-submenu");

	// Helper function to normalize URLs (remove trailing slash and make lowercase)
	function normalizeUrl(url) {
		return url.replace(/\/+$/, "").toLowerCase();
	}

	const currentUrl = normalizeUrl(window.location.href);

	// Highlight current menu item
	navItems.forEach((item) => {
		if (normalizeUrl(item.href) === currentUrl) {
			item.classList.add("active-page");
		}
	});

	// Highlight parent menu item if any child link is active
	submenus.forEach(submenu => {
		const childLinks = submenu.querySelectorAll(".wp-block-navigation-item a");
		childLinks.forEach(link => {
			if (normalizeUrl(link.href) === currentUrl) {
				submenu.closest(".wp-block-navigation-item").classList.add("child-active");
			}
		});
	});
});


// document.addEventListener("DOMContentLoaded", function () {
//   const sideNav = document.querySelector('.side-nav');
//   const footer = document.querySelector('.uga_footer ');
  
//   // Calculate offset for the side navigation
//   const footerOffset = footer.offsetTop;

//   window.addEventListener('scroll', function () {
// 	const scrollPosition = window.scrollY;
// 	const sideNavHeight = sideNav.offsetHeight;
// 	const windowHeight = window.innerHeight;

// 	// When the user scrolls past the footer, make the side-nav "absolute"
// 	  console.log("SideNavHEight", sideNavHeight);
// 			console.log("scrollPosition", scrollPosition);
// 	  console.log("footerOffset - sidenav: ", footerOffset - sideNavHeight);

// 	if (scrollPosition + sideNavHeight >= footerOffset) {
// 	  sideNav.style.position = 'absolute';
// 	  sideNav.style.top = footerOffset - sideNavHeight + 35 + 'px';
// 	} else {
// 	  // Reset to fixed when above the footer
// 	  sideNav.style.position = 'fixed';
// 	  sideNav.style.top = '100px';
// 	}
//   });
// });


document.addEventListener("DOMContentLoaded", () => {
  const currentUrl = window.location.href;
  const menuLinks = document.querySelectorAll('.vertical-menu a');

  menuLinks.forEach(link => {
	if (link.href === currentUrl) {
	  link.classList.add('active');  // Highlight the current link
	  const childMenu = link.closest('.child-links');
	  if (childMenu) {
		childMenu.style.display = 'block';  // Keep the menu open
		const parentLink = childMenu.previousElementSibling;
		const triangleIcon = parentLink.querySelector('.triangle');
		if (triangleIcon) {
		  triangleIcon.style.transform = 'rotate(180deg)';  // Rotate the arrow
		}
	  }
	}
  });
});

function toggleMenu(event) {
  event.preventDefault();
  const parentLink = event.target.closest('.parent');
  const childMenu = parentLink.nextElementSibling;
  const triangleIcon = parentLink.querySelector('.triangle');

  if (childMenu && (childMenu.classList.contains('child-links') || childMenu.classList.contains('child-links-home'))) {
	const isVisible = childMenu.style.display === 'block';

	const allChildMenus = document.querySelectorAll('.child-links, .child-links-home');
	const allTriangles = document.querySelectorAll('.triangle');

	allChildMenus.forEach(menu => {
	  menu.style.display = 'none';
	});
	allTriangles.forEach(triangle => {
	  triangle.style.transform = 'rotate(0deg)';
	});

	if (!isVisible) {
	  childMenu.style.display = 'block';
	  triangleIcon.style.transform = 'rotate(180deg)';
	}
  }
}

/*// Select the elements
const searchIcon = document.querySelector('.search_icon');
const searchInput = document.querySelector('.search_input');
const searchInput_white = document.querySelector('.search_input_white');

// Initial width and opacity state
let isOpen = false;

// Add click event listener to the search icon
searchIcon.addEventListener('click', function() {
  if (isOpen) {
	// If input is open, shrink the width to 0 and hide the input by setting opacity to 0
	  if(searchInput) {
			searchInput.style.width = '0';
	searchInput.style.opacity = '0';
	  } else {
		  searchInput_white.style.width = '0';
	searchInput_white.style.opacity = '0'; 
	  }
  
	  
  
  } else {
	// If input is closed, expand the width to 200px and set opacity to 1
	  if(searchInput) {
			searchInput.style.width = '40%';
	searchInput.style.opacity = '1';
	  } else {  
	searchInput_white.style.width = '40%';
	searchInput_white.style.opacity = '1';
	  }
  
  }
  // Toggle the state
  isOpen = !isOpen;
});*/
