<?php
require_once '../includes/config.php';
require_once '../includes/header.php';

// Fetch only the columns that exist in the database
$stmt = $pdo->query("SELECT name, position, number, nationality, bio FROM players ORDER BY position, number");
$players = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Group players by position
$positions = [
    'Goalkeeper' => [],
    'Defender' => [],
    'Midfielder' => [],
    'Forward' => []
];

foreach ($players as $player) {
    $positions[$player['position']][] = $player;
}
?>

<main class="container">
    <section class="players-section">
        <h1 class="section-title">Squad</h1>
        
        <!-- Search and Filter -->
        <div class="search-filter">
            <input type="text" id="playerSearch" placeholder="Search players..." class="search-input">
            <div class="filter-buttons">
                <button class="filter-btn active" data-position="all">All</button>
                <button class="filter-btn" data-position="Goalkeeper">Goalkeepers</button>
                <button class="filter-btn" data-position="Defender">Defenders</button>
                <button class="filter-btn" data-position="Midfielder">Midfielders</button>
                <button class="filter-btn" data-position="Forward">Forwards</button>
            </div>
        </div>

        <!-- Players Grid -->
        <div class="players-grid">
            <?php foreach ($positions as $position => $positionPlayers): ?>
                <?php foreach ($positionPlayers as $player): ?>
                    <div class="player-card" data-position="<?php echo htmlspecialchars($player['position']); ?>">
                        <div class="card-inner">
                            <div class="card-front">
                                <div class="player-img-container">
                                    <?php
                                    // Map player names to their correct image filenames
                                    $imageMap = [
                                        'Thibaut Courtois' => 'courtois.jpg',
                                        'Andriy Lunin' => 'lunin.jpg',
                                        'Kepa Arrizabalaga' => 'kepa.jpg',
                                        'Dani Carvajal' => 'carvajal.jpg',
                                        'Éder Militão' => 'militao.jpg',
                                        'David Alaba' => 'alaba.jpg',
                                        'Jesús Vallejo' => 'vallejo.jpg',
                                        'Nacho' => 'nacho.jpg',
                                        'Ferland Mendy' => 'mendy.jpg',
                                        'Antonio Rüdiger' => 'rudiger.jpg',
                                        'Fran García' => 'garcia.jpg',
                                        'Jude Bellingham' => 'bellingham.jpg',
                                        'Toni Kroos' => 'kroos.jpg',
                                        'Luka Modrić' => 'modric.jpg',
                                        'Federico Valverde' => 'valverde.jpg',
                                        'Eduardo Camavinga' => 'camavinga.jpg',
                                        'Aurélien Tchouaméni' => 'tchouameni.jpg',
                                        'Dani Ceballos' => 'ceballos.jpg',
                                        'Vinicius Jr' => 'vinicius.jpg',
                                        'Rodrygo' => 'rodrygo.jpg',
                                        'Joselu' => 'joselu.jpg',
                                        'Brahim Díaz' => 'diaz.jpg',
                                        'Arda Güler' => 'guler.jpg'
                                    ];
                                    $imageFile = isset($imageMap[$player['name']]) ? $imageMap[$player['name']] : 'default-player.jpg';
                                    ?>
                                    <img src="../assets/images/players/<?php echo $imageFile; ?>" 
                                         alt="<?php echo htmlspecialchars($player['name']); ?>"
                                         class="player-img">
                                </div>
                                <div class="player-info">
                                    <div class="player-number"><?php echo htmlspecialchars($player['number']); ?></div>
                                    <h3 class="player-name"><?php echo htmlspecialchars($player['name']); ?></h3>
                                    <p class="player-position"><?php echo htmlspecialchars($player['position']); ?></p>
                                    <div class="player-flag">
                                        <img src="../assets/images/flags/<?php echo strtolower($player['nationality']); ?>.png" 
                                             alt="<?php echo htmlspecialchars($player['nationality']); ?> Flag">
                                    </div>
                                </div>
                            </div>
                            <div class="card-back">
                                <div class="player-stats">
                                    <h4>Player Information</h4>
                                    <ul>
                                        <li>Name: <?php echo htmlspecialchars($player['name']); ?></li>
                                        <li>Position: <?php echo htmlspecialchars($player['position']); ?></li>
                                        <li>Number: <?php echo htmlspecialchars($player['number']); ?></li>
                                        <li>Nationality: <?php echo htmlspecialchars($player['nationality']); ?></li>
                                    </ul>
                                    <?php if (!empty($player['bio'])): ?>
                                    <div class="player-bio">
                                        <p><?php echo htmlspecialchars($player['bio']); ?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<style>
.players-section {
    padding: var(--spacing-xl) 0;
}

.search-filter {
    margin-bottom: var(--spacing-lg);
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

.players-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: var(--spacing-md);
}

.player-card {
    perspective: 1000px;
    height: 450px;
}

.card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    transition: transform 0.8s;
    transform-style: preserve-3d;
}

.player-card:hover .card-inner {
    transform: rotateY(180deg);
}

.card-front,
.card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.card-front {
    background: var(--rm-white);
}

.card-back {
    background: var(--rm-navy);
    color: var(--rm-white);
    transform: rotateY(180deg);
    padding: var(--spacing-md);
}

.player-img-container {
    height: 300px;
    overflow: hidden;
    background-color: var(--rm-light-gray);
}

.player-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform 0.3s ease;
    padding: 10px;
}

.player-card:hover .player-img {
    transform: scale(1.05);
}

.player-info {
    padding: var(--spacing-sm);
    text-align: center;
    background: var(--rm-white);
}

.player-number {
    position: absolute;
    top: var(--spacing-sm);
    right: var(--spacing-sm);
    background: var(--rm-navy);
    color: var(--rm-white);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.2rem;
    z-index: 1;
}

.player-name {
    color: var(--rm-navy);
    margin: var(--spacing-xs) 0;
    font-size: 1.5rem;
    font-weight: 600;
}

.player-position {
    color: var(--rm-gold);
    font-weight: 500;
    margin-bottom: var(--spacing-xs);
}

.player-flag {
    margin-top: var(--spacing-xs);
}

.player-flag img {
    height: 24px;
    border-radius: 2px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.player-stats {
    height: 100%;
    display: flex;
    flex-direction: column;
    padding: var(--spacing-md);
}

.player-stats h4 {
    color: var(--rm-gold);
    margin-bottom: var(--spacing-sm);
    font-size: 1.2rem;
}

.player-stats ul {
    list-style: none;
    padding: 0;
    margin-bottom: var(--spacing-sm);
}

.player-stats li {
    margin-bottom: var(--spacing-xs);
    font-size: 0.9rem;
}

.player-bio {
    font-size: 0.9rem;
    line-height: 1.4;
    margin-top: var(--spacing-sm);
}

@media (max-width: 768px) {
    .players-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    }
    
    .player-card {
        height: 400px;
    }
    
    .player-img-container {
        height: 250px;
    }
}

@media (max-width: 576px) {
    .players-grid {
        grid-template-columns: 1fr;
    }

    .filter-buttons {
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('playerSearch');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const playerCards = document.querySelectorAll('.player-card');

    // Search functionality
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        
        playerCards.forEach(card => {
            const playerName = card.querySelector('.player-name').textContent.toLowerCase();
            const playerPosition = card.querySelector('.player-position').textContent.toLowerCase();
            
            if (playerName.includes(searchTerm) || playerPosition.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Filter functionality
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const position = this.dataset.position;
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter players
            playerCards.forEach(card => {
                if (position === 'all' || card.dataset.position === position) {
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
  images/players/courtois.jpg      — "Thibaut Courtois"
  images/players/lunin.jpg         — "Andriy Lunin"
  images/players/kepa.jpg          — "Kepa Arrizabalaga"
  images/players/carvajal.jpg      — "Dani Carvajal"
  images/players/militao.jpg       — "Éder Militão"
  images/players/alaba.jpg         — "David Alaba"
  images/players/vallejo.jpg       — "Jesús Vallejo"
  images/players/nacho.jpg         — "Nacho"
  images/players/mendy.jpg         — "Ferland Mendy"
  images/players/rudiger.jpg       — "Antonio Rüdiger"
  images/players/garcia.jpg        — "Fran García"
  images/players/bellingham.jpg    — "Jude Bellingham"
  images/players/kroos.jpg         — "Toni Kroos"
  images/players/modric.jpg        — "Luka Modrić"
  images/players/valverde.jpg      — "Federico Valverde"
  images/players/camavinga.jpg     — "Eduardo Camavinga"
  images/players/tchouameni.jpg    — "Aurélien Tchouaméni"
  images/players/ceballos.jpg      — "Dani Ceballos"
  images/players/vinicius.jpg      — "Vinicius Jr"
  images/players/rodrygo.jpg       — "Rodrygo"
  images/players/joselu.jpg        — "Joselu"
  images/players/diaz.jpg          — "Brahim Díaz"
  images/players/guler.jpg         — "Arda Güler"
  images/flags/belgium.png         — "Belgium Flag"
  images/flags/ukraine.png         — "Ukraine Flag"
  images/flags/spain.png           — "Spain Flag"
  images/flags/brazil.png          — "Brazil Flag"
  images/flags/austria.png         — "Austria Flag"
  images/flags/france.png          — "France Flag"
  images/flags/germany.png         — "Germany Flag"
  images/flags/england.png         — "England Flag"
  images/flags/croatia.png         — "Croatia Flag"
  images/flags/uruguay.png         — "Uruguay Flag"
  images/flags/turkey.png          — "Turkey Flag"
--> 