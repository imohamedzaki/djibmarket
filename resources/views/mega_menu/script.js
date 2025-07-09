// Navbar and Mega Menu JavaScript
class NavbarMegaMenu {
  constructor() {
    this.activeCategory = null;
    this.categoriesContainer = document.getElementById("categoriesContainer");
    this.megaMenu = document.getElementById("megaMenu");
    this.scrollLeftBtn = document.getElementById("scrollLeftBtn");
    this.scrollRightBtn = document.getElementById("scrollRightBtn");
    this.navbarContainer = document.querySelector(".navbar-container");

    this.init();
  }

  init() {
    this.renderCategories();
    this.setupEventListeners();
    this.checkScroll();
    this.initializeLucideIcons();
  }

  // Initialize Lucide icons
  initializeLucideIcons() {
    if (typeof lucide !== "undefined") {
      lucide.createIcons();
    }
  }

  // Render navigation categories
  renderCategories() {
    const categoriesHTML = categories
      .map(
        (category) => `
            <div class="nav-category" data-category-id="${category.id}">
                ${category.name}
            </div>
        `
      )
      .join("");

    // Add the TRY FREE button
    const tryFreeButton = `
            <div class="try-free-btn">
                TRY FREE
            </div>
        `;

    this.categoriesContainer.innerHTML = categoriesHTML + tryFreeButton;
  }

  // Setup all event listeners
  setupEventListeners() {
    // Category hover events
    const categoryElements =
      this.categoriesContainer.querySelectorAll(".nav-category");
    categoryElements.forEach((categoryElement) => {
      categoryElement.addEventListener("mouseenter", (e) => {
        const categoryId = e.target.getAttribute("data-category-id");
        this.handleCategoryMouseEnter(categoryId);
      });
    });

    // Navbar container mouse leave
    this.navbarContainer.addEventListener("mouseleave", () => {
      this.handleMouseLeave();
    });

    // Mega menu mouse enter to keep it open
    this.megaMenu.addEventListener("mouseenter", () => {
      // Keep the current active category when hovering over mega menu
    });

    // Scroll buttons
    this.scrollLeftBtn.addEventListener("click", () => {
      this.scroll("left");
    });

    this.scrollRightBtn.addEventListener("click", () => {
      this.scroll("right");
    });

    // Check scroll on categories container scroll
    this.categoriesContainer.addEventListener("scroll", () => {
      this.checkScroll();
    });

    // Check scroll on window resize
    window.addEventListener("resize", () => {
      this.checkScroll();
    });
  }

  // Handle category mouse enter
  handleCategoryMouseEnter(categoryId) {
    this.setActiveCategory(categoryId);
    const category = categories.find((cat) => cat.id === categoryId);
    if (category) {
      this.showMegaMenu(category);
    }
  }

  // Handle mouse leave from navbar container
  handleMouseLeave() {
    this.setActiveCategory(null);
    this.hideMegaMenu();
  }

  // Set active category and update visual state
  setActiveCategory(categoryId) {
    this.activeCategory = categoryId;

    // Update visual state of category items
    const categoryElements =
      this.categoriesContainer.querySelectorAll(".nav-category");
    categoryElements.forEach((element) => {
      const elementCategoryId = element.getAttribute("data-category-id");
      if (elementCategoryId === categoryId) {
        element.classList.add("active");
      } else {
        element.classList.remove("active");
      }
    });
  }

  // Show mega menu with category data
  showMegaMenu(category) {
    this.megaMenu.innerHTML = this.generateMegaMenuHTML(category);
    this.megaMenu.classList.remove("hidden");
    this.megaMenu.classList.add("show");

    // Re-initialize Lucide icons for any new content
    this.initializeLucideIcons();
  }

  // Hide mega menu
  hideMegaMenu() {
    this.megaMenu.classList.add("hidden");
    this.megaMenu.classList.remove("show");
  }

  // Generate mega menu HTML
  generateMegaMenuHTML(category) {
    const groupsHTML = category.groups
      .map(
        (group) => `
            <div>
                <h3 class="text-sm font-semibold text-gray-900 mb-4 uppercase tracking-wider">
                    ${group.title}
                </h3>
                <ul class="space-y-3">
                    ${group.items
                      .map(
                        (item) => `
                        <li>
                            <a href="${item.link}" class="category-link text-sm">
                                ${item.name}
                            </a>
                        </li>
                    `
                      )
                      .join("")}
                </ul>
            </div>
        `
      )
      .join("");

    const brandsHTML = category.brands
      .map(
        (brand) => `
            <a href="${brand.link}" class="brand-item group">
                <div class="brand-container">
                    <img src="${brand.image}" alt="${brand.name}" class="brand-image" />
                </div>
                <span class="brand-name">${brand.name}</span>
            </a>
        `
      )
      .join("");

    return `
            <div class="max-w-7xl mx-auto px-4 md:px-8 py-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                    <div class="md:col-span-9">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                            ${groupsHTML}
                        </div>
                        
                        <div class="mt-8 pt-6 border-t border-gray-100">
                            <h3 class="text-sm font-semibold text-gray-900 mb-4 uppercase tracking-wider">
                                Top Brands
                            </h3>
                            <div class="brands-grid">
                                ${brandsHTML}
                            </div>
                        </div>
                    </div>
                    
                    <div class="md:col-span-3">
                        <div class="promo-container">
                            <img src="${category.promoImage}" alt="${category.name}" class="promo-image" />
                            <div class="promo-overlay">
                                <h3 class="promo-title">${category.promoTitle}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
  }

  // Check if scroll buttons should be shown
  checkScroll() {
    if (!this.categoriesContainer) return;

    const { scrollLeft, scrollWidth, clientWidth } = this.categoriesContainer;
    const showLeft = scrollLeft > 0;
    const showRight = scrollLeft < scrollWidth - clientWidth - 10;

    this.toggleScrollButton(this.scrollLeftBtn, showLeft);
    this.toggleScrollButton(this.scrollRightBtn, showRight);
  }

  // Toggle scroll button visibility
  toggleScrollButton(button, show) {
    if (show) {
      button.classList.remove("hidden");
      button.classList.add("show");
    } else {
      button.classList.add("hidden");
      button.classList.remove("show");
    }
  }

  // Scroll categories container
  scroll(direction) {
    if (!this.categoriesContainer) return;

    const scrollAmount = 300;
    const currentScroll = this.categoriesContainer.scrollLeft;
    const newScrollLeft =
      direction === "left"
        ? currentScroll - scrollAmount
        : currentScroll + scrollAmount;

    this.categoriesContainer.scrollTo({
      left: newScrollLeft,
      behavior: "smooth",
    });
  }
}

// Utility functions for handling click events on links
function handleLinkClick(url) {
  console.log("Navigate to:", url);
  // In a real application, you would handle navigation here
  // For demo purposes, we're just logging the URL
}

// Initialize the navbar and mega menu when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
  // Initialize the navbar mega menu
  const navbarMegaMenu = new NavbarMegaMenu();

  // Initialize Lucide icons
  if (typeof lucide !== "undefined") {
    lucide.createIcons();
  }

  // Add click event listeners to all links for demo purposes
  document.addEventListener("click", function (e) {
    if (e.target.tagName === "A" && e.target.getAttribute("href")) {
      e.preventDefault(); // Prevent default navigation for demo
      const url = e.target.getAttribute("href");
      handleLinkClick(url);
    }
  });
});

// Handle window resize to recheck scroll buttons
window.addEventListener("resize", function () {
  // The checkScroll method is already bound to resize in the class
  // This is just a backup to ensure scroll buttons are properly updated
  setTimeout(() => {
    const navbarInstance = window.navbarMegaMenu;
    if (navbarInstance && navbarInstance.checkScroll) {
      navbarInstance.checkScroll();
    }
  }, 100);
});

// Export the class for potential external use
window.NavbarMegaMenu = NavbarMegaMenu;
