<?php
require_once '../includes/config.php';
require_once '../includes/header.php';

// Fetch legends from database
$stmt = $pdo->query("SELECT * FROM legends ORDER BY era, name");
$legends = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Group legends by era
$eras = [
    'Early Years' => [],
    'Golden Era' => [],
    'Modern Era' => []
];

foreach ($legends as $legend) {
    $eras[$legend['era']][] = $legend;
}
?>

<main class="container">
    <section class="legends-section">
        <h1 class="section-title">Club Legends</h1>
        
        <!-- Search and Filter -->
        <div class="search-filter">
            <input type="text" id="legendSearch" placeholder="Search legends..." class="search-input">
            <div class="filter-buttons">
                <button class="filter-btn active" data-era="all">All Eras</button>
                <button class="filter-btn" data-era="Early Years">Early Years</button>
                <button class="filter-btn" data-era="Golden Era">Golden Era</button>
                <button class="filter-btn" data-era="Modern Era">Modern Era</button>
            </div>
        </div>

        <!-- Legends Grid -->
        <div class="legends-grid">
            <?php foreach ($eras as $era => $eraLegends): ?>
                <?php foreach ($eraLegends as $legend): ?>
                    <div class="legend-card" data-era="<?php echo htmlspecialchars($legend['era']); ?>">
                        <div class="card-inner">
                            <div class="card-front">
                                <div class="legend-img-container">
                                    <?php
                                    $imageMap = [
                                        'Iker Casillas' => 'casillas.jpg',
                                        'Sergio Ramos' => 'ramos.jpg',
                                        'Roberto Carlos' => 'carlos.jpg',
                                        'Marcelo' => 'marcelo.jpg',
                                        'Pepe' => 'pepe.jpg',
                                        'Zinedine Zidane' => 'zidane.jpg',
                                        'Claude Makélélé' => 'makelele.jpg',
                                        'Toni Kroos' => 'kroos.jpg',
                                        'Raúl González' => 'raul.jpg',
                                        'Karim Benzema' => 'benzema.jpg',
                                        'Ronaldo Nazário' => 'ronaldo.jpg',
                                        'Cristiano Ronaldo' => 'cristiano.jpg',
                                        'Alfredo Di Stéfano' => 'di-stefano.jpg',
                                        'Fabio Cannavaro' => 'cannavaro.jpg'
                                    ];
                                    $imageFile = $imageMap[$legend['name']] ?? 'default-legend.jpg';
                                    ?>
                                    <img src="<?php echo SITE_URL; ?>/assets/images/legends/<?php echo $imageFile; ?>" 
                                         alt="<?php echo htmlspecialchars($legend['name']); ?>"
                                         class="legend-img"
                                         onerror="this.src='<?php echo SITE_URL; ?>/assets/images/legends/default-legend.jpg'">
                                </div>
                                <div class="legend-info">
                                    <h3 class="legend-name"><?php echo htmlspecialchars($legend['name']); ?></h3>
                                    <p class="legend-era"><?php echo htmlspecialchars($legend['era']); ?></p>
                                    <div class="legend-position"><?php echo htmlspecialchars($legend['position']); ?></div>
                                </div>
                            </div>
                            <div class="card-back">
                                <div class="legend-stats">
                                    <h4>Achievements</h4>
                                    <ul>
                                        <li>Years: <?php echo htmlspecialchars($legend['years_active']); ?></li>
                                        <li>Appearances: <?php echo htmlspecialchars($legend['stats_appearances']); ?></li>
                                        <li>Goals: <?php echo htmlspecialchars($legend['stats_goals']); ?></li>
                                        <li>Assists: <?php echo htmlspecialchars($legend['stats_assists']); ?></li>
                                    </ul>
                                    <div class="legend-bio">
                                        <p><?php echo htmlspecialchars($legend['bio']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>

        <!-- Historic Coaches Section -->
        <h2 class="section-subtitle">Historic Coaches</h2>
        <div class="coaches-grid">
            <?php
            $stmt = $pdo->query("SELECT * FROM coaches ORDER BY years_active DESC");
            $coaches = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($coaches as $coach):
                $coachImageMap = [
                    'Zinedine Zidane' => 'zidane.jpg',
                    'José Mourinho' => 'mourinho.jpg',
                    'Carlo Ancelotti' => 'ancelotti.jpg'
                ];
                $coachImageFile = $coachImageMap[$coach['name']] ?? 'default-coach.jpg';
            ?>
                <div class="coach-card">
                    <div class="card-inner">
                        <div class="card-front">
                            <div class="coach-img-container">
                                <img src="<?php echo SITE_URL; ?>/assets/images/coaches/<?php echo $coachImageFile; ?>" 
                                     alt="<?php echo htmlspecialchars($coach['name']); ?>"
                                     class="coach-img"
                                     onerror="this.src='<?php echo SITE_URL; ?>/assets/images/coaches/default-coach.jpg'">
                            </div>
                            <div class="coach-info">
                                <h3 class="coach-name"><?php echo htmlspecialchars($coach['name']); ?></h3>
                                <p class="coach-years"><?php echo htmlspecialchars($coach['years_active']); ?></p>
                            </div>
                        </div>
                        <div class="card-back">
                            <div class="coach-achievements">
                                <h4>Achievements</h4>
                                <p><?php echo htmlspecialchars($coach['achievements']); ?></p>
                                <div class="coach-bio">
                                    <p><?php echo htmlspecialchars($coach['bio']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<style>
.legends-section {
    padding: var(--spacing-xl) 0;
}

.section-title {
    color: var(--rm-navy);
    text-align: center;
    margin-bottom: var(--spacing-xl);
    font-size: 2.5rem;
    font-weight: 700;
}

.section-subtitle {
    margin: var(--spacing-xl) 0 var(--spacing-lg);
    color: var(--rm-navy);
    text-align: center;
    font-size: 2rem;
    font-weight: 600;
}

.search-filter {
    margin-bottom: var(--spacing-lg);
    text-align: center;
}

.search-input {
    width: 100%;
    max-width: 400px;
    padding: 0.75rem 1rem;
    border: 2px solid var(--rm-navy);
    border-radius: 4px;
    font-size: 1rem;
    margin-bottom: var(--spacing-sm);
}

.filter-buttons {
    display: flex;
    gap: var(--spacing-sm);
    flex-wrap: wrap;
    justify-content: center;
}

.filter-btn {
    padding: 0.5rem 1rem;
    border: 2px solid var(--rm-navy);
    border-radius: 4px;
    background: transparent;
    color: var(--rm-navy);
    cursor: pointer;
    transition: all 0.3s ease;
}

.filter-btn:hover,
.filter-btn.active {
    background: var(--rm-navy);
    color: var(--rm-white);
}

.legends-grid,
.coaches-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: var(--spacing-md);
    margin-top: var(--spacing-lg);
}

.legend-card,
.coach-card {
    perspective: 1000px;
    width: 100%;
    height: 450px;
    cursor: pointer;
    border: 4px solid var(--rm-gold);
    border-radius: 8px;
    overflow: hidden;
    margin: 0 auto;
    max-width: 350px;
}

.card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    transition: transform 0.8s;
    transform-style: preserve-3d;
}

.legend-card:hover .card-inner,
.coach-card:hover .card-inner {
    transform: rotateY(180deg);
}

.card-front,
.card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    border-radius: 4px;
    overflow: hidden;
}

.card-front {
    background: var(--rm-white);
}

.card-back {
    background: var(--rm-navy);
    color: var(--rm-white);
    transform: rotateY(180deg);
    padding: var(--spacing-lg);
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.legend-img-container,
.coach-img-container {
    height: 300px;
    overflow: hidden;
    position: relative;
}

.legend-img,
.coach-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
    transition: transform 0.3s ease;
}

.legend-card:hover .legend-img,
.coach-card:hover .coach-img {
    transform: scale(1.05);
}

.legend-info,
.coach-info {
    padding: var(--spacing-md);
    text-align: center;
    background: var(--rm-white);
}

.legend-name,
.coach-name {
    color: var(--rm-navy);
    margin: var(--spacing-xs) 0;
    font-size: 1.5rem;
    font-weight: 600;
    line-height: 1.2;
}

.legend-era,
.coach-years {
    color: var(--rm-gold);
    font-weight: 500;
    margin-bottom: var(--spacing-xs);
    font-size: 1.1rem;
}

.legend-position {
    color: var(--rm-navy);
    font-size: 1rem;
    font-weight: 500;
}

.legend-stats,
.coach-achievements {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.legend-stats h4,
.coach-achievements h4 {
    color: var(--rm-gold);
    margin-bottom: var(--spacing-md);
    font-size: 1.4rem;
    font-weight: 600;
}

.legend-stats ul {
    list-style: none;
    padding: 0;
    margin-bottom: var(--spacing-md);
}

.legend-stats li {
    margin-bottom: var(--spacing-sm);
    font-size: 1rem;
    line-height: 1.4;
}

.legend-bio,
.coach-bio {
    font-size: 1rem;
    line-height: 1.5;
    margin-top: var(--spacing-md);
}

@media (max-width: 768px) {
    .legends-grid,
    .coaches-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    }
    
    .legend-card,
    .coach-card {
        height: 400px;
        max-width: 320px;
    }
    
    .legend-img-container,
    .coach-img-container {
        height: 250px;
    }
}

@media (max-width: 576px) {
    .legends-grid,
    .coaches-grid {
        grid-template-columns: 1fr;
    }

    .legend-card,
    .coach-card {
        max-width: 100%;
    }

    .filter-buttons {
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('legendSearch');
    const legendCards = document.querySelectorAll('.legend-card');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        legendCards.forEach(card => {
            const name = card.querySelector('.legend-name').textContent.toLowerCase();
            const era = card.querySelector('.legend-era').textContent.toLowerCase();
            const position = card.querySelector('.legend-position').textContent.toLowerCase();
            
            if (name.includes(searchTerm) || era.includes(searchTerm) || position.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
    
    // Filter functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const era = this.dataset.era;
            
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            legendCards.forEach(card => {
                if (era === 'all' || card.dataset.era === era) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>

<?php require_once '../includes/footer.php'; ?>

<!-- IMAGES NEEDED FOR THIS PAGE:
  images/legends/casillas.jpg      — "Iker Casillas"
  images/legends/ramos.jpg         — "Sergio Ramos"
  images/legends/carlos.jpg        — "Roberto Carlos"
  images/legends/marcelo.jpg       — "Marcelo"
  images/legends/pepe.jpg          — "Pepe"
  images/legends/zidane.jpg        — "Zinedine Zidane"
  images/legends/makelele.jpg      — "Claude Makélélé"
  images/legends/kroos.jpg         — "Toni Kroos"
  images/legends/raul.jpg          — "Raúl González"
  images/legends/benzema.jpg       — "Karim Benzema"
  images/legends/ronaldo.jpg       — "Ronaldo Nazário"
  images/legends/cristiano.jpg     — "Cristiano Ronaldo"
  images/legends/di-stefano.jpg    — "Alfredo Di Stéfano"
  images/legends/cannavaro.jpg     — "Fabio Cannavaro"
  images/coaches/zidane.jpg        — "Zinedine Zidane"
  images/coaches/mourinho.jpg      — "José Mourinho"
  images/coaches/ancelotti.jpg     — "Carlo Ancelotti"
--> 