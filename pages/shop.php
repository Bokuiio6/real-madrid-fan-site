<?php
require_once '../includes/config.php';
require_once '../includes/header.php';

// Fetch products from database
$stmt = $pdo->query("SELECT * FROM products ORDER BY category, name");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Group products by category - using the categories we have products for
$categories = [];
foreach ($products as $product) {
    if (!isset($categories[$product['category']])) {
        $categories[$product['category']] = [];
    }
    $categories[$product['category']][] = $product;
}
?>

<main class="container-fluid px-0">
    <!-- Shop Hero Banner -->
    <section class="shop-hero py-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center py-4">
                    <h1 class="display-3 fw-bold text-white mb-3">Shop Our Gear</h1>
                    <p class="lead fs-4 mb-0 text-white">Official Real Madrid merchandise for the true fans</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container mb-5">
        <!-- Search and Filter -->
        <div class="row mb-4">
            <div class="col-md-6">
                <input type="text" id="productSearch" placeholder="Search products..." class="form-control">
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-wrap gap-2 justify-content-md-end mt-3 mt-md-0">
                    <button class="btn btn-outline-primary active" data-category="all">All Products</button>
                    <?php foreach (array_keys($categories) as $category): ?>
                        <button class="btn btn-outline-primary" data-category="<?php echo htmlspecialchars($category); ?>"><?php echo htmlspecialchars($category); ?></button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
            <?php foreach ($products as $product): ?>
                <div class="col product-item" data-category="<?php echo htmlspecialchars($product['category']); ?>">
                    <div class="card h-100 product-card shadow-sm">
                        <div class="position-relative">
                            <?php if ($product['discount'] > 0): ?>
                                <div class="discount-badge">-<?php echo $product['discount']; ?>%</div>
                            <?php endif; ?>
                            <img src="../assets/images/shop/<?php echo htmlspecialchars($product['image_path']); ?>" 
                                class="card-img-top product-img" 
                                alt="<?php echo htmlspecialchars($product['name']); ?>"
                                onerror="this.src='../assets/images/shop/default-product.jpg'">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title product-name"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text product-category mb-1"><?php echo htmlspecialchars($product['category']); ?></p>
                            <p class="card-text product-description small text-muted mb-3"><?php echo htmlspecialchars($product['description']); ?></p>
                            <div class="product-price mt-auto mb-3">
                                <?php if ($product['discount'] > 0): ?>
                                    <span class="original-price me-2">€<?php echo number_format($product['price'], 2); ?></span>
                                    <span class="discounted-price">€<?php echo number_format($product['price'] * (1 - $product['discount'] / 100), 2); ?></span>
                                <?php else: ?>
                                    <span class="current-price">€<?php echo number_format($product['price'], 2); ?></span>
                                <?php endif; ?>
                            </div>
                            <button class="btn btn-primary add-to-cart-btn w-100" data-product-id="<?php echo $product['id']; ?>">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Shopping Cart -->
    <div id="shoppingCart" class="shopping-cart">
        <div class="cart-header">
            <h2>Shopping Cart</h2>
            <button class="close-cart">&times;</button>
        </div>
        <div class="cart-items">
            <!-- Cart items will be dynamically added here -->
        </div>
        <div class="cart-footer">
            <div class="cart-total">
                <span>Total:</span>
                <span class="total-amount">€0.00</span>
            </div>
            <button class="checkout-btn">Proceed to Checkout</button>
        </div>
    </div>
</main>

<style>
/* Shop Hero Section */
.shop-hero {
    background: linear-gradient(135deg, var(--rm-navy) 0%, #1a237e 100%);
    color: var(--rm-white);
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.shop-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('../assets/images/shop/shop-hero-bg.jpg') center center;
    background-size: cover;
    opacity: 0.15;
    z-index: 0;
}

.shop-hero .container {
    position: relative;
    z-index: 1;
}

/* Product Card Styling */
.product-card {
    transition: all 0.3s ease;
    border: none;
    overflow: hidden;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.product-img {
    height: 250px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-img {
    transform: scale(1.05);
}

.discount-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: var(--rm-gold);
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-weight: bold;
    z-index: 1;
}

.product-name {
    font-weight: 600;
    color: var(--rm-navy);
}

.product-category {
    color: var(--rm-gold);
    font-weight: 500;
}

.original-price {
    text-decoration: line-through;
    color: #6c757d;
}

.discounted-price,
.current-price {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--rm-navy);
}

.add-to-cart-btn {
    background-color: var(--rm-navy);
    border-color: var(--rm-navy);
    transition: all 0.3s ease;
}

.add-to-cart-btn:hover {
    background-color: var(--rm-gold);
    border-color: var(--rm-gold);
    transform: translateY(-2px);
}

/* Shopping Cart Styles */
.shopping-cart {
    position: fixed;
    top: 0;
    right: -400px;
    width: 400px;
    height: 100vh;
    background: var(--rm-white);
    box-shadow: -4px 0 15px rgba(0, 0, 0, 0.15);
    transition: right 0.3s ease;
    z-index: 1050;
    display: flex;
    flex-direction: column;
}

.shopping-cart.active {
    right: 0;
}

.cart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    border-bottom: 1px solid #eee;
}

.cart-header h2 {
    margin: 0;
    color: var(--rm-navy);
}

.close-cart {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
}

.cart-items {
    flex: 1;
    overflow-y: auto;
    padding: 1rem;
}

.cart-item {
    padding: 1rem 0;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.cart-footer {
    padding: 1rem;
    border-top: 1px solid #eee;
}

.cart-total {
    display: flex;
    justify-content: space-between;
    font-weight: bold;
    margin-bottom: 1rem;
    color: var(--rm-navy);
}

.checkout-btn {
    width: 100%;
    padding: 0.75rem;
    background: var(--rm-gold);
    color: white;
    border: none;
    border-radius: 4px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
}

.checkout-btn:hover {
    background: var(--rm-navy);
}

@media (max-width: 768px) {
    .shopping-cart {
        width: 100%;
        right: -100%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Product filtering
    const filterButtons = document.querySelectorAll('[data-category]');
    const productItems = document.querySelectorAll('.product-item');
    const searchInput = document.getElementById('productSearch');

    // Filter by category
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            
            // Get category to filter by
            const category = button.dataset.category;
            
            // Show/hide products
            productItems.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Search functionality
    searchInput.addEventListener('input', () => {
        const searchTerm = searchInput.value.toLowerCase();
        
        productItems.forEach(item => {
            const productName = item.querySelector('.product-name').textContent.toLowerCase();
            const productCategory = item.querySelector('.product-category').textContent.toLowerCase();
            const productDescription = item.querySelector('.product-description').textContent.toLowerCase();
            
            if (productName.includes(searchTerm) || 
                productCategory.includes(searchTerm) || 
                productDescription.includes(searchTerm)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Shopping cart functionality
    const cart = {
        items: [],
        
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
        },
        
        removeItem(productId) {
            this.items = this.items.filter(item => item.id !== productId);
            this.updateCart();
        },
        
        updateCart() {
            const cartItems = document.querySelector('.cart-items');
            const totalAmount = document.querySelector('.total-amount');
            
            // Update cart items
            cartItems.innerHTML = '';
            
            if (this.items.length === 0) {
                cartItems.innerHTML = '<div class="text-center py-4">Your cart is empty</div>';
            } else {
                this.items.forEach(item => {
                    const cartItem = document.createElement('div');
                    cartItem.className = 'cart-item';
                    cartItem.innerHTML = `
                        <div>
                            <h6 class="mb-0">${item.name}</h6>
                            <div class="d-flex align-items-center mt-1">
                                <button class="btn btn-sm btn-outline-secondary me-2 decrease-quantity" data-id="${item.id}">-</button>
                                <span class="quantity">${item.quantity}</span>
                                <button class="btn btn-sm btn-outline-secondary ms-2 increase-quantity" data-id="${item.id}">+</button>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold">€${(item.price * item.quantity).toFixed(2)}</div>
                            <button class="btn btn-sm text-danger remove-item" data-id="${item.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                    cartItems.appendChild(cartItem);
                });
            }
            
            // Update total
            const total = this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            totalAmount.textContent = `€${total.toFixed(2)}`;
            
            // Add event listeners to buttons
            document.querySelectorAll('.remove-item').forEach(button => {
                button.addEventListener('click', () => {
                    this.removeItem(button.dataset.id);
                });
            });
            
            document.querySelectorAll('.increase-quantity').forEach(button => {
                button.addEventListener('click', () => {
                    const item = this.items.find(item => item.id === button.dataset.id);
                    if (item) {
                        item.quantity++;
                        this.updateCart();
                    }
                });
            });
            
            document.querySelectorAll('.decrease-quantity').forEach(button => {
                button.addEventListener('click', () => {
                    const item = this.items.find(item => item.id === button.dataset.id);
                    if (item) {
                        if (item.quantity > 1) {
                            item.quantity--;
                        } else {
                            this.removeItem(item.id);
                        }
                        this.updateCart();
                    }
                });
            });
        }
    };

    // Add to cart buttons
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', () => {
            const productCard = button.closest('.product-card');
            const productName = productCard.querySelector('.product-name').textContent;
            let productPrice;
            const discountedPrice = productCard.querySelector('.discounted-price');
            
            if (discountedPrice) {
                productPrice = parseFloat(discountedPrice.textContent.replace('€', ''));
            } else {
                productPrice = parseFloat(productCard.querySelector('.current-price').textContent.replace('€', ''));
            }
            
            const product = {
                id: button.dataset.productId,
                name: productName,
                price: productPrice
            };
            
            cart.addItem(product);
            document.getElementById('shoppingCart').classList.add('active');
        });
    });

    // Cart toggle
    document.querySelector('.close-cart').addEventListener('click', () => {
        document.getElementById('shoppingCart').classList.remove('active');
    });

    // Checkout button
    document.querySelector('.checkout-btn').addEventListener('click', () => {
        if (cart.items.length === 0) {
            alert('Your cart is empty!');
            return;
        }
        
        alert('Thank you for your purchase! This is a demo site, so no actual transaction will be processed.');
        cart.items = [];
        cart.updateCart();
        document.getElementById('shoppingCart').classList.remove('active');
    });
});
</script>

<?php require_once '../includes/footer.php'; ?> 