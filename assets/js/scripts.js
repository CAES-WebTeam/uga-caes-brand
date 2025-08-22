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

document.addEventListener('DOMContentLoaded', function() {
    console.log('Search highlight script loaded from file');
    
    // Check if we have a highlight parameter
    const urlParams = new URLSearchParams(window.location.search);
    const highlightText = urlParams.get('highlight');
    
    if (highlightText) {
        console.log('Looking for:', highlightText);
        
        // Decode the highlight text
        const searchText = decodeURIComponent(highlightText).toLowerCase();
        
        // Check user's motion preferences
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        
        // Function to find and highlight text
        function findAndHighlightText(searchText) {
            const walker = document.createTreeWalker(
                document.body,
                NodeFilter.SHOW_TEXT,
                null,
                false
            );
            
            let node;
            let found = false;
            
            // Search through all text nodes
            while (node = walker.nextNode()) {
                const text = node.textContent.toLowerCase();
                const position = text.indexOf(searchText);
                
                if (position !== -1 && !found) {
                    console.log('Found text, scrolling to it');
                    // Found the text! Get the element containing it
                    const element = node.parentElement;
                    
                    console.log('Element to scroll to:', element);
                    console.log('Element position:', element.getBoundingClientRect());
                    console.log('Window height:', window.innerHeight);
                    
                    // Try different scroll approaches
                    try {
                        // Method 1: scrollIntoView
                        element.scrollIntoView({ 
                            behavior: prefersReducedMotion ? 'auto' : 'smooth', 
                            block: 'center' 
                        });
                        console.log('scrollIntoView called');
                        
                        // Method 2: Also try scrolling the window directly
                        setTimeout(() => {
                            const rect = element.getBoundingClientRect();
                            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                            const targetY = rect.top + scrollTop - (window.innerHeight / 2);
                            
                            console.log('Manually scrolling to:', targetY);
                            window.scrollTo({
                                top: targetY,
                                behavior: prefersReducedMotion ? 'auto' : 'smooth'
                            });
                        }, 100);
                        
                    } catch (error) {
                        console.log('Scroll error:', error);
                    }
                    
                    // Add temporary highlight
                    const originalText = node.textContent;
                    const beforeText = originalText.substring(0, position);
                    const matchText = originalText.substring(position, position + highlightText.length);
                    const afterText = originalText.substring(position + highlightText.length);
                    
                    const span = document.createElement('span');
                    span.innerHTML = beforeText + 
                        '<mark style="background: var(--wp--preset--color--odyssey); padding: 2px 4px; border-radius: 3px; transition: background-color 3s ease;">' + 
                        matchText + '</mark>' + afterText;
                    
                    element.replaceChild(span, node);
                    
                    found = true;
                    break;
                }
            }
            
            return found;
        }
        
        // Try to find exact phrase first
        let found = findAndHighlightText(searchText);
        
        // If exact phrase not found, try individual words
        if (!found) {
            console.log('Exact phrase not found, trying individual words');
            const words = searchText.split(' ').filter(word => word.length > 2);
            for (let word of words) {
                console.log('Trying word:', word);
                if (findAndHighlightText(word)) {
                    break;
                }
            }
        }
    }
});