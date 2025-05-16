// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');

    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    }

    // Hero slider
    const heroSlides = document.querySelectorAll('.hero-slide');
    let currentSlide = 0;

    function showSlide(index) {
        heroSlides.forEach(slide => slide.classList.remove('active'));
        heroSlides[index].classList.add('active');
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % heroSlides.length;
        showSlide(currentSlide);
    }

    if (heroSlides.length > 0) {
        showSlide(0);
        setInterval(nextSlide, 5000);
    }

    // Player card flip effect
    const playerCards = document.querySelectorAll('.player-card');
    
    playerCards.forEach(card => {
        card.addEventListener('click', () => {
            card.style.transform = card.style.transform === 'rotateY(180deg)' 
                ? 'rotateY(0deg)' 
                : 'rotateY(180deg)';
        });
    });

    // Newsletter form submission
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const email = newsletterForm.querySelector('input[type="email"]').value;
            
            // Here you would typically send this to your backend
            alert('Thank you for subscribing to our newsletter!');
            newsletterForm.reset();
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Shop filters
    const filterButtons = document.querySelectorAll('.filter-btn');
    const shopItems = document.querySelectorAll('.shop-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            const category = button.dataset.category;
            
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            shopItems.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Image lazy loading
    const lazyImages = document.querySelectorAll('img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                observer.unobserve(img);
            }
        });
    });

    lazyImages.forEach(img => imageObserver.observe(img));

    // Shop cart functionality
    const cart = {
        items: [],
        total: 0,
        
        addItem(product) {
            const existingItem = this.items.find(item => item.id === product.id);
            
            if (existingItem) {
                existingItem.quantity++;
            } else {
                this.items.push({
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    quantity: 1
                });
            }
            
            this.updateCart();
            this.saveCart();
        },
        
        removeItem(productId) {
            this.items = this.items.filter(item => item.id !== productId);
            this.updateCart();
            this.saveCart();
        },
        
        updateCart() {
            const cartItems = document.querySelector('.cart-items');
            const totalAmount = document.querySelector('.total-amount');
            
            if (!cartItems || !totalAmount) return;
            
            // Update cart items
            cartItems.innerHTML = this.items.map(item => `
                <div class="cart-item">
                    <span class="item-name">${item.name}</span>
                    <span class="item-quantity">x${item.quantity}</span>
                    <span class="item-price">€${(item.price * item.quantity).toFixed(2)}</span>
                    <button class="remove-item" data-id="${item.id}">&times;</button>
                </div>
            `).join('');
            
            // Update total
            this.total = this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            totalAmount.textContent = `€${this.total.toFixed(2)}`;
            
            // Add event listeners to remove buttons
            document.querySelectorAll('.remove-item').forEach(button => {
                button.addEventListener('click', () => {
                    this.removeItem(button.dataset.id);
                });
            });
        },
        
        saveCart() {
            localStorage.setItem('cart', JSON.stringify(this.items));
        },
        
        loadCart() {
            const savedCart = localStorage.getItem('cart');
            if (savedCart) {
                this.items = JSON.parse(savedCart);
                this.updateCart();
            }
        }
    };

    // Initialize cart
    cart.loadCart();

    // Add to cart buttons
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', () => {
            const productCard = button.closest('.product-card');
            const product = {
                id: button.dataset.productId,
                name: productCard.querySelector('.product-name').textContent,
                price: parseFloat(productCard.querySelector('.current-price, .discounted-price').textContent.replace('€', ''))
            };
            
            cart.addItem(product);
            document.getElementById('shoppingCart').classList.add('active');
        });
    });

    // Cart toggle
    const closeCart = document.querySelector('.close-cart');
    if (closeCart) {
        closeCart.addEventListener('click', () => {
            document.getElementById('shoppingCart').classList.remove('active');
        });
    }

    // Checkout button
    const checkoutBtn = document.querySelector('.checkout-btn');
    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', () => {
            if (cart.items.length === 0) {
                alert('Your cart is empty!');
                return;
            }
            
            alert('Thank you for your purchase! This is a demo site, so no actual transaction will be processed.');
            cart.items = [];
            cart.updateCart();
            cart.saveCart();
            document.getElementById('shoppingCart').classList.remove('active');
        });
    }

    // Trophy modal functionality
    const trophyItems = document.querySelectorAll('.trophy-item');
    const trophyModal = document.getElementById('trophyModal');
    const closeModal = document.querySelector('.close-modal');
    
    if (trophyItems.length > 0 && trophyModal && closeModal) {
        trophyItems.forEach(item => {
            item.addEventListener('click', () => {
                const trophyId = item.dataset.trophyId;
                const trophyName = item.querySelector('.trophy-name').textContent;
                const trophyYear = item.querySelector('.trophy-year').textContent;
                const trophyImg = item.querySelector('.trophy-img').src;
                
                // Update modal content
                trophyModal.querySelector('.modal-trophy-img').src = trophyImg;
                trophyModal.querySelector('.modal-trophy-name').textContent = trophyName;
                trophyModal.querySelector('.modal-trophy-year').textContent = trophyYear;
                
                // Fetch additional trophy details
                fetch(`../includes/get_trophy_details.php?id=${trophyId}`)
                    .then(response => response.json())
                    .then(data => {
                        trophyModal.querySelector('.trophy-description').textContent = data.description;
                        trophyModal.querySelector('.stat-value:nth-child(1)').textContent = data.times_won;
                        trophyModal.querySelector('.stat-value:nth-child(2)').textContent = data.first_win;
                        trophyModal.querySelector('.stat-value:nth-child(3)').textContent = data.last_win;
                    })
                    .catch(error => {
                        console.error('Error fetching trophy details:', error);
                        trophyModal.querySelector('.trophy-description').textContent = 'Details not available';
                    });
                
                // Show modal
                trophyModal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            });
        });
        
        // Close modal
        closeModal.addEventListener('click', () => {
            trophyModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
        
        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === trophyModal) {
                trophyModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    }

    // Add hover effects for trophy items
    trophyItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            item.style.transform = 'translateY(-10px)';
            item.style.boxShadow = '0 8px 25px rgba(0, 0, 0, 0.2)';
        });
        
        item.addEventListener('mouseleave', () => {
            item.style.transform = 'translateY(0)';
            item.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.1)';
        });
    });
}); 