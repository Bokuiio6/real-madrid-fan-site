<?php
require_once '../includes/config.php';
require_once '../includes/header.php';

// Fetch trophies from database
$stmt = $pdo->query("SELECT * FROM trophies ORDER BY category, year DESC");
$trophies = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Comprehensive trophy data with counts and years
$majorHonours = [
    'Best Club of the 20th Century' => [
        'count' => 1,
        'years' => '11 December 2000',
        'image' => 'fifa-20th.png'
    ],
    'Champions League' => [
        'count' => 15,
        'years' => '1955–56, 1956–57, 1957–58, 1958–59, 1959–60, 1965–66, 1997–98, 1999–00, 2001–02, 2013–14, 2015–16, 2016–17, 2017–18, 2021–22, 2023–24',
        'image' => 'cl-15.png'
    ],
    'FIFA Club World Cup' => [
        'count' => 9,
        'years' => '1960, 1998, 2002, 2014, 2016, 2017, 2018, 2022, 2024',
        'image' => 'cwc-9.png'
    ],
    'European Super Cup' => [
        'count' => 6,
        'years' => '2002, 2014, 2016, 2017, 2022, 2024',
        'image' => 'esc-6.png'
    ],
    'UEFA Cup' => [
        'count' => 2,
        'years' => '1984–85, 1985–86',
        'image' => 'uefacup-2.png'
    ],
    'La Liga' => [
        'count' => 36,
        'years' => '1931–32, 1932–33, 1953–54, 1954–55, 1956–57, 1957–58, 1960–61, 1961–62, 1962–63, 1963–64, 1964–65, 1966–67, 1967–68, 1968–69, 1971–72, 1974–75, 1975–76, 1977–78, 1978–79, 1979–80, 1985–86, 1986–87, 1987–88, 1988–89, 1989–90, 1994–95, 1996–97, 2000–01, 2002–03, 2006–07, 2007–08, 2011–12, 2016–17, 2019–20, 2021–22, 2023–24',
        'image' => 'laliga-36.png'
    ],
    'Copa del Rey' => [
        'count' => 20,
        'years' => '1904–05, 1905–06, 1906–07, 1907–08, 1916–17, 1933–34, 1935–36, 1945–46, 1946–47, 1961–62, 1969–70, 1973–74, 1974–75, 1979–80, 1981–82, 1988–89, 1992–93, 2010–11, 2013–14, 2022–23',
        'image' => 'copa-20.png'
    ],
    'Supercopa de España' => [
        'count' => 13,
        'years' => '1988, 1989, 1990, 1993, 1997, 2001, 2003, 2008, 2012, 2017, 2020, 2022, 2024',
        'image' => 'supercopa-13.png'
    ],
    'League Cup' => [
        'count' => 1,
        'years' => '1984–85',
        'image' => 'leaguecup-1.png'
    ],
    'Mini World Cup' => [
        'count' => 2,
        'years' => '1952, 1956',
        'image' => 'miniwc-2.png'
    ],
    'Latin Cup' => [
        'count' => 2,
        'years' => '1955, 1957',
        'image' => 'latin-2.png'
    ],
    'Ibero-American Cup' => [
        'count' => 1,
        'years' => '1994',
        'image' => 'ibero-1.png'
    ],
    'Regional Championships' => [
        'count' => 18,
        'years' => '1903–04, 1904–05, 1905–06, 1906–07, 1907–08, 1912–13, 1915–16, 1916–17, 1917–18, 1919–20, 1921–22, 1922–23, 1923–24, 1925–26, 1926–27, 1928–29, 1929–30, 1930–31',
        'image' => 'regional-18.png'
    ],
    'Mancomunados Trophies' => [
        'count' => 5,
        'years' => '1931–32, 1932–33, 1933–34, 1934–35, 1935–36',
        'image' => 'mancomunados-5.png'
    ]
];

// Individual awards data
$individualAwards = [
    'Ballon d\'Or' => [
        ['name' => 'Luka Modrić', 'year' => '2018', 'image' => 'modric-ballon.jpg'],
        ['name' => 'Karim Benzema', 'year' => '2022', 'image' => 'benzi-ballon.jpg'],
        ['name' => 'Cristiano Ronaldo', 'year' => '2013, 2014, 2016, 2017', 'image' => 'ronaldo-ballon.jpg'],
        ['name' => 'Kaká', 'year' => '2007', 'image' => 'kaka-ballon.jpg'],
        ['name' => 'Ronaldo Nazário', 'year' => '1997, 2002', 'image' => 'r9-ballon.jpg'],
        ['name' => 'Zinedine Zidane', 'year' => '1998', 'image' => 'zidan-ballon.jpg'],
        ['name' => 'Alfredo Di Stéfano', 'year' => '1957, 1959', 'image' => 'di-stefano.jpg']
    ],
    'The Best FIFA Men\'s Player' => [
        ['name' => 'Luka Modrić', 'year' => '2018', 'image' => 'modric.jpg'],
        ['name' => 'Cristiano Ronaldo', 'year' => '2016, 2017', 'image' => 'cristiano.jpg']
    ],
    'Golden Boot' => [
        ['name' => 'Cristiano Ronaldo', 'year' => '2010–11, 2013–14', 'image' => 'cristiano.jpg'],
        ['name' => 'Alfredo Di Stéfano', 'year' => '1956–57, 1957–58', 'image' => 'di-stefano.jpg'],
        ['name' => 'Karim Benzema', 'year' => '2021–22', 'image' => 'benzema.jpg']
    ],
    'Zamora Trophy' => [
        ['name' => 'Iker Casillas', 'year' => '2007–08, 2011–12', 'image' => 'casillas.jpg'],
        ['name' => 'Thibaut Courtois', 'year' => '2019–20', 'image' => 'courtois.jpg'],
        ['name' => 'Santiago Cañizares', 'year' => '2001–02', 'image' => 'canizares.jpg']
    ]
];

// Club records data
$clubRecords = [
    'Most Consecutive League Titles' => '5 (1960-1965)',
    'Most Goals in a Season' => '121 (2011-2012)',
    'Longest Unbeaten Run' => '40 matches (2016-2017)',
    'Most Points in a Season' => '100 (2011-2012)',
    'Most Goals in Champions League' => '17 (Cristiano Ronaldo, 2013-2014)',
    'Most Appearances' => '741 (Raúl González)'
];
?>

<main class="container-fluid px-0">
    <!-- Immersive Hero Section -->
    <section class="honours-hero">
        <div class="honours-hero-bg"></div>
        <div class="honours-hero-overlay"></div>
        <div class="container position-relative">
            <div class="row min-vh-80 align-items-center">
                <div class="col-lg-10 mx-auto text-center honours-hero-content">
                    <div class="trophy-icon trophy-icon-1"><img src="<?php echo SITE_URL; ?>/assets/images/icons/trophy-icon.png
                    
                    " alt="Trophy"></div>
                    <div class="trophy-icon trophy-icon-2"><img src="<?php echo SITE_URL; ?>/assets/images/icons/trophy-icon.png
                    
                    " alt="Trophy"></div>
                    <h1 class="display-2 fw-bold text-white honours-title">Our Honours</h1>
                    <p class="lead fs-4 text-gold mb-4 honours-subtitle">The legacy of the most successful club in football history</p>
                    <a href="#major-honours" class="btn btn-gold btn-lg explore-btn">
                        Explore Our Trophies <i class="fas fa-chevron-down ms-2"></i>
                    </a>
                    <div class="trophy-icon trophy-icon-3"><img src="<?php echo SITE_URL; ?>/assets/images/icons/trophy-icon.png
                    
                    " alt="Trophy"></div>
                    <div class="trophy-icon trophy-icon-4"><img src="<?php echo SITE_URL; ?>/assets/images/icons/trophy-icon.png
                    
                    " alt="Trophy"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- President Section -->
    <section id="president" class="president-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="president-image">
                        <img src="<?php echo SITE_URL; ?>/assets/images/honours/perez.jpg" alt="Florentino Pérez" class="img-fluid rounded">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="president-content">
                        <h2 class="section-title mb-4">Club President</h2>
                        <h3 class="president-name">Florentino Pérez</h3>
                        <p class="president-bio lead">
                            Club President since 2009 (and previously 2000–2006). Under his leadership, Real Madrid reclaimed European dominance and expanded the Bernabéu.
                        </p>
                        <div class="president-achievements">
                            <div class="achievement">
                                <span class="achievement-number">7</span>
                                <span class="achievement-label">Champions League titles won under his presidency</span>
                            </div>
                            <div class="achievement">
                                <span class="achievement-number">6</span>
                                <span class="achievement-label">La Liga titles won under his presidency</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Major Honours Section -->
    <section id="major-honours" class="major-honours py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-5">Complete Honours Collection</h2>
            <div class="row g-4">
                <?php foreach ($majorHonours as $trophy => $data): ?>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="honour-card" data-bs-toggle="modal" data-bs-target="#honourModal" 
                             data-trophy="<?php echo htmlspecialchars($trophy); ?>"
                             data-count="<?php echo $data['count']; ?>"
                             data-years="<?php echo htmlspecialchars($data['years']); ?>">
                            <div class="honour-icon">
                                <img src="<?php echo SITE_URL; ?>/assets/images/honours/<?php echo $data['image']; ?>" 
                                     alt="<?php echo htmlspecialchars($trophy); ?>" class="img-fluid">
                            </div>
                            <h4 class="honour-title"><?php echo htmlspecialchars($trophy); ?></h4>
                            <div class="honour-count">
                                <span class="count-number"><?php echo $data['count']; ?></span>
                                <span class="count-label"><?php echo $data['count'] == 1 ? 'Time' : 'Times'; ?></span>
                            </div>
                            <div class="honour-overlay">
                                <i class="fas fa-search"></i>
                                <p>Click to view years</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Individual Awards Section -->
    <section id="individual-awards" class="individual-awards py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Individual Accolades</h2>
            <?php foreach ($individualAwards as $award => $players): ?>
                <div class="award-category mb-5">
                    <h3 class="award-title"><?php echo htmlspecialchars($award); ?></h3>
                    <div class="row g-4">
                        <?php foreach ($players as $player): ?>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="player-award-card">
                                    <div class="player-image">
                                        <img src="<?php echo SITE_URL; ?>/assets/images/legends/<?php echo $player['image']; ?>" 
                                             alt="<?php echo htmlspecialchars($player['name']); ?>" class="img-fluid">
                                    </div>
                                    <div class="player-details">
                                        <h4 class="player-name"><?php echo htmlspecialchars($player['name']); ?></h4>
                                        <p class="award-year"><?php echo htmlspecialchars($player['year']); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Club Records Section -->
    <section id="records" class="club-records py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-5">Legendary Records</h2>
            <div class="row g-4">
                <?php foreach ($clubRecords as $record => $value): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="record-card">
                            <h3 class="record-title"><?php echo htmlspecialchars($record); ?></h3>
                            <p class="record-value"><?php echo htmlspecialchars($value); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Top Statistics Section -->
    <section id="top-stats" class="top-stats py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Club Legends & Statistics</h2>
            
            <!-- Top Goal Scorers -->
            <div class="stat-category mb-5">
                <h3 class="stat-title">Top Goal Scorers (All-Time)</h3>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-rank">#1</div>
                            <h4>Cristiano Ronaldo</h4>
                            <p class="stat-value">451 Goals</p>
                            <p class="stat-period">2009-2018</p>
                            </div>
                        </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-rank">#2</div>
                            <h4>Raúl González</h4>
                            <p class="stat-value">323 Goals</p>
                            <p class="stat-period">1994-2010</p>
                    </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-rank">#3</div>
                            <h4>Alfredo Di Stéfano</h4>
                            <p class="stat-value">308 Goals</p>
                            <p class="stat-period">1953-1964</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Assists -->
            <div class="stat-category mb-5">
                <h3 class="stat-title">Top Assists Leaders</h3>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-rank">#1</div>
                            <h4>Karim Benzema</h4>
                            <p class="stat-value">165 Assists</p>
                            <p class="stat-period">2009-2023</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-rank">#2</div>
                            <h4>Cristiano Ronaldo</h4>
                            <p class="stat-value">131 Assists</p>
                            <p class="stat-period">2009-2018</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-rank">#3</div>
                            <h4>Luka Modrić</h4>
                            <p class="stat-value">109 Assists</p>
                            <p class="stat-period">2012-Present</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Champions League Top Scorers -->
            <div class="stat-category mb-5">
                <h3 class="stat-title">Champions League Top Scorers</h3>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-rank">#1</div>
                            <h4>Cristiano Ronaldo</h4>
                            <p class="stat-value">105 Goals</p>
                            <p class="stat-period">17 in 2013-14 season</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-rank">#2</div>
                            <h4>Karim Benzema</h4>
                            <p class="stat-value">78 Goals</p>
                            <p class="stat-period">15 in 2021-22 season</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-rank">#3</div>
                            <h4>Raúl González</h4>
                            <p class="stat-value">66 Goals</p>
                            <p class="stat-period">All-time legend</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trophy Timeline Slider -->
    <section id="timeline" class="trophy-timeline py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-5">Trophy Timeline</h2>
            <div class="timeline-container">
                <div class="timeline-slider-wrapper">
                    <label for="yearSlider" class="timeline-label">Select Year:</label>
                    <input type="range" id="yearSlider" min="1902" max="2025" value="2025" class="timeline-slider">
                    <div class="timeline-markers">
                        <span class="timeline-marker start">1902</span>
                        <span class="timeline-marker current-year" id="currentYear">2025</span>
                        <span class="timeline-marker end">2025</span>
                    </div>
                </div>
                
                <div class="trophy-counters mt-5">
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-4">
                            <div class="counter-card">
                                <div class="counter-icon">🏆</div>
                                <h4>National Leagues</h4>
                                <span class="counter-value" id="laLigaCounter">36</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="counter-card">
                                <div class="counter-icon">🏺</div>
                                <h4>Spanish Cups</h4>
                                <span class="counter-value" id="copaCounter">20</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="counter-card">
                                <div class="counter-icon">🥇</div>
                                <h4>Spanish Super Cups</h4>
                                <span class="counter-value" id="supercopaCounter">13</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="counter-card">
                                <div class="counter-icon">🌟</div>
                                <h4>European Cups</h4>
                                <span class="counter-value" id="europeanCounter">17</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="counter-card">
                                <div class="counter-icon">🌍</div>
                                <h4>FIFA Club World Cups</h4>
                                <span class="counter-value" id="worldCounter">9</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="counter-card">
                                <div class="counter-icon">⭐</div>
                                <h4>European Super Cups</h4>
                                <span class="counter-value" id="euroSuperCounter">6</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Celebration Gallery -->
    <section id="gallery" class="celebration-gallery py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Iconic Moments</h2>
            <div class="row g-4">
                <?php
                $celebrationImages = [
                    'champions-2022.jpg',
                    'champions-2018.jpg',
                    'champions-2017.jpg',
                    'champions-2016.jpg',
                    'champions-2014.jpg',
                    'champions-2002.jpg'
                ];
                foreach ($celebrationImages as $image):
                ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="celebration-card">
                            <img src="<?php echo SITE_URL; ?>/assets/images/honours/<?php echo $image; ?>" 
                                 alt="Trophy Celebration"
                                 class="img-fluid">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-5">
        <div class="container text-center">
            <h2 class="section-title mb-4">Join the Legacy</h2>
            <p class="lead mb-4">Wear the colors of the most successful club in football history</p>
            <a href="<?php echo SITE_URL; ?>/pages/shop.php" class="btn btn-primary btn-lg">Shop Official Gear</a>
        </div>
    </section>

    <!-- Honours Modal -->
    <div id="honourModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="honourModalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <img id="honourModalImage" src="" alt="" class="img-fluid">
                            <div class="modal-count mt-3">
                                <span id="honourModalCount"></span>
                                <span id="honourModalLabel"></span>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <h6>Years Won:</h6>
                            <p id="honourModalYears" class="years-list"></p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
/* Immersive Hero Section */
.honours-hero {
    position: relative;
    overflow: hidden;
    padding: 0;
    margin-bottom: 3rem;
    height: 80vh;
    min-height: 550px;
}

.honours-hero-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('<?php echo SITE_URL; ?>/assets/images/honours/hero-bg.jpg');
    background-size: cover;
    background-position: center;
    transform: scale(1.05);
    transition: transform 0.5s ease-out;
}

.honours-hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0, 0, 34, 0.8), rgba(0, 0, 59, 0.9));
}

.min-vh-80 {
    min-height: 80vh;
}

.honours-hero-content {
    position: relative;
    z-index: 2;
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 1.2s ease-out forwards;
    animation-delay: 0.3s;
}

.honours-title {
    margin-bottom: 1rem;
    text-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.honours-subtitle {
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
    color: var(--rm-gold);
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    margin-bottom: 2rem;
}

.btn-gold {
    background-color: var(--rm-gold);
    border-color: var(--rm-gold);
    color: var(--rm-navy);
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.btn-gold:hover {
    background-color: #d4af37;
    border-color: #d4af37;
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
}

.trophy-icon {
    position: absolute;
    opacity: 0;
    animation: fadeIn 1.5s forwards, float 4s ease-in-out infinite;
}

.trophy-icon img {
    width: 50px;
    height: 50px;
    filter: drop-shadow(0 3px 6px rgba(0, 0, 0, 0.2));
}

.trophy-icon-1 {
    top: -40px;
    right: 20%;
    animation-delay: 0.6s;
}

.trophy-icon-2 {
    bottom: 50px;
    left: 15%;
    animation-delay: 1s;
}

.trophy-icon-3 {
    top: 30px;
    left: 20%;
    animation-delay: 1.4s;
}

.trophy-icon-4 {
    bottom: -20px;
    right: 15%;
    animation-delay: 1.8s;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 0.8;
    }
}

@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
    100% {
        transform: translateY(0px);
    }
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .honours-hero {
        height: 70vh;
    }
    
    .honours-title {
        font-size: 3rem;
    }
    
    .honours-subtitle {
        font-size: 1.2rem;
    }
    
    .trophy-icon img {
        width: 40px;
        height: 40px;
    }
}

@media (max-width: 768px) {
    .honours-hero {
        height: 60vh;
    }
    
    .honours-title {
        font-size: 2.5rem;
    }
    
    .btn-gold {
        padding: 0.6rem 1.2rem;
    }
    
    .trophy-icon {
        display: none;
    }
}

/* Honours Cards - Improved Size & Layout */
.honour-card {
    background: var(--rm-white);
    border: 2px solid var(--rm-gold);
    border-radius: 15px;
    padding: 1.75rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    height: 350px; /* Fixed height */
    width: 100%; /* Full width of column */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.honour-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

.honour-icon {
    height: 140px; /* Fixed icon height */
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
}

.honour-icon img {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain; /* Ensure images don't get cropped */
}

.honour-title {
    color: var(--rm-navy);
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0.75rem 0;
    line-height: 1.3;
}

.honour-count {
    color: var(--rm-gold);
    margin-top: auto;
}

.count-number {
    display: block;
    font-size: 2.8rem;
    font-weight: 700;
    line-height: 1;
}

.count-label {
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.honour-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(39, 50, 113, 0.95);
    color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.honour-card:hover .honour-overlay {
    opacity: 1;
}

.honour-overlay i {
    font-size: 2rem;
    margin-bottom: 1rem;
}

/* Individual Awards - Improved Cards */
.award-category {
    border-bottom: 2px solid #f0f0f0;
    padding-bottom: 2rem;
}

.award-title {
    color: var(--rm-navy);
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    text-align: center;
}

/* Player Award Cards - Better Image Handling */
.player-award-card {
    background: var(--rm-white);
    border: 2px solid var(--rm-gold);
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
    height: 350px; /* Fixed height */
    width: 100%;
}

.player-award-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.player-image {
    height: 250px;
    overflow: hidden;
    background-color: #f5f5f5; /* Background for loading */
}

.player-image img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Cover to ensure no empty space */
    object-position: center top; /* Focus on player's face */
    transition: transform 0.3s ease;
}

.player-award-card:hover .player-image img {
    transform: scale(1.05);
}

.player-details {
    padding: 1rem;
    text-align: center;
}

.player-name {
    color: var(--rm-navy);
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.award-year {
    color: var(--rm-gold);
    font-weight: 600;
    margin: 0;
}

/* Record Cards - Consistent Height */
.record-card {
    background: var(--rm-white);
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    height: 100%;
    border-left: 4px solid var(--rm-gold);
    min-height: 180px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.record-title {
    color: var(--rm-navy);
    font-size: 1.2rem;
    margin-bottom: 1rem;
}

.record-value {
    color: var(--rm-gold);
    font-size: 1.5rem;
    font-weight: 700;
}

/* Top Statistics Section - Improved Layout */
.top-stats {
    background: var(--rm-white);
}

.stat-category {
    border-bottom: 1px solid #e0e0e0;
    padding-bottom: 2rem;
    margin-bottom: 2rem;
}

.stat-title {
    color: var(--rm-navy);
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    text-align: center;
}

.stat-card {
    background: var(--rm-white);
    border: 2px solid var(--rm-gold);
    border-radius: 15px;
    padding: 1.5rem;
    text-align: center;
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.stat-rank {
    background: var(--rm-gold);
    color: var(--rm-white);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    margin: 0 auto 1rem;
}

.stat-card h4 {
    color: var(--rm-navy);
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
}

.stat-value {
    color: var(--rm-gold);
    font-size: 1.8rem;
    font-weight: 700;
    display: block;
    margin-bottom: 0.5rem;
}

.stat-period {
    color: #666;
    font-size: 0.9rem;
    margin: 0;
}

/* Trophy Timeline - Improved Slider */
.trophy-timeline {
    background: #f8f9fa;
}

.timeline-container {
    max-width: 800px;
    margin: 0 auto;
}

.timeline-slider-wrapper {
    background: var(--rm-white);
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.timeline-label {
    display: block;
    color: var(--rm-navy);
    font-weight: 600;
    margin-bottom: 1rem;
    text-align: center;
}

.timeline-slider {
    width: 100%;
    height: 8px;
    background: #ddd;
    outline: none;
    border-radius: 4px;
    -webkit-appearance: none;
}

.timeline-slider::-webkit-slider-thumb {
    appearance: none;
    width: 24px;
    height: 24px;
    background: var(--rm-gold);
    border-radius: 50%;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.timeline-slider::-moz-range-thumb {
    width: 24px;
    height: 24px;
    background: var(--rm-gold);
    border-radius: 50%;
    cursor: pointer;
    border: none;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.timeline-markers {
    display: flex;
    justify-content: space-between;
    margin-top: 1rem;
    font-size: 0.9rem;
    color: var(--rm-navy);
}

.current-year {
    font-weight: 700;
    color: var(--rm-gold);
}

.trophy-counters {
    background: var(--rm-white);
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.counter-card {
    text-align: center;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 12px;
    transition: all 0.3s ease;
    height: 100%;
}

.counter-card:hover {
    background: var(--rm-navy);
    color: var(--rm-white);
    transform: translateY(-5px);
}

.counter-icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.counter-card h4 {
    color: var(--rm-navy);
    font-size: 1rem;
    margin-bottom: 1rem;
    transition: color 0.3s ease;
}

.counter-card:hover h4 {
    color: var(--rm-white);
}

.counter-value {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--rm-gold);
    display: block;
    animation: countUp 0.5s ease-out;
}

@keyframes countUp {
    from { transform: scale(0.5); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

/* Celebration Gallery - Better Image Display */
.celebration-card {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    height: 100%;
}

.celebration-card:hover {
    transform: scale(1.05);
}

.celebration-card img {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

/* CTA Section */
.cta-section {
    background: var(--rm-navy);
    color: var(--rm-white);
}

.btn-primary {
    background: var(--rm-gold);
    border-color: var(--rm-gold);
    padding: 1rem 2rem;
    font-size: 1.2rem;
}

.btn-primary:hover {
    background: #b8860b;
    border-color: #b8860b;
}

/* Modal Styles - Improved */
.modal {
    z-index: 1050;
}

.modal-backdrop {
    z-index: 1040;
}

.modal-content {
    border: 2px solid var(--rm-gold);
    border-radius: 15px;
}

.modal-header {
    border-bottom: 1px solid var(--rm-gold);
    background: linear-gradient(135deg, var(--rm-navy) 0%, #34408d 100%);
    color: var(--rm-white);
}

.modal-title {
    font-weight: 700;
}

.btn-close {
    filter: invert(1);
    opacity: 1;
}

.btn-close:hover {
    opacity: 0.8;
}

.modal-count {
    background: var(--rm-gold);
    color: var(--rm-white);
    padding: 1rem;
    border-radius: 50%;
    width: 100px;
    height: 100px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.modal-count span:first-child {
    font-size: 2rem;
    font-weight: 700;
    line-height: 1;
}

.modal-count span:last-child {
    font-size: 0.8rem;
    text-transform: uppercase;
}

.years-list {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
    font-family: monospace;
    line-height: 1.8;
    color: var(--rm-navy);
}

/* Responsive Design - Improved */
@media (max-width: 1200px) {
    .honour-card,
    .player-award-card {
        height: 320px;
    }
    
    .player-image {
        height: 220px;
    }
}

@media (max-width: 992px) {
    .honour-card {
        height: 300px;
    }
    
    .player-award-card {
        height: 300px;
    }
    
    .player-image {
        height: 200px;
    }
}

@media (max-width: 768px) {
    .honour-card {
        height: auto;
        min-height: 300px;
    }
    
    .player-award-card {
        height: 280px;
    }
    
    .player-image {
        height: 180px;
    }
    
    .president-achievements {
        justify-content: center;
    }
    
    .achievement-number {
        font-size: 2rem;
    }
    
    .counter-card {
        margin-bottom: 1rem;
    }
    
    .celebration-card img {
        height: 200px;
    }
}

@media (max-width: 576px) {
    .honour-card {
        height: auto;
        padding: 1.5rem;
        min-height: 280px;
    }
    
    .honour-icon {
        height: 100px;
    }
    
    .count-number {
        font-size: 2rem;
    }
    
    .honour-title {
        font-size: 1rem;
    }
    
    .player-award-card {
        height: 260px;
    }
    
    .player-image {
        height: 160px;
    }
}

/* Animation for cards */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-in {
    animation: slideInUp 0.6s ease-out forwards;
}

.honour-card,
.player-award-card {
    opacity: 0;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Trophy timeline data - year to cumulative counts mapping
    const trophyData = {
        1902: { laLiga: 0, copa: 0, supercopa: 0, european: 0, world: 0, euroSuper: 0 },
        1905: { laLiga: 0, copa: 1, supercopa: 0, european: 0, world: 0, euroSuper: 0 },
        1932: { laLiga: 1, copa: 4, supercopa: 0, european: 0, world: 0, euroSuper: 0 },
        1954: { laLiga: 2, copa: 6, supercopa: 0, european: 0, world: 0, euroSuper: 0 },
        1956: { laLiga: 3, copa: 6, supercopa: 0, european: 1, world: 1, euroSuper: 0 },
        1960: { laLiga: 5, copa: 6, supercopa: 0, european: 5, world: 2, euroSuper: 0 },
        1966: { laLiga: 11, copa: 7, supercopa: 0, european: 6, world: 2, euroSuper: 0 },
        1980: { laLiga: 17, copa: 11, supercopa: 0, european: 6, world: 2, euroSuper: 0 },
        1985: { laLiga: 19, copa: 12, supercopa: 0, european: 6, world: 2, euroSuper: 0 },
        1986: { laLiga: 20, copa: 13, supercopa: 0, european: 8, world: 2, euroSuper: 0 },
        1990: { laLiga: 23, copa: 16, supercopa: 3, european: 8, world: 2, euroSuper: 0 },
        1998: { laLiga: 26, copa: 16, supercopa: 5, european: 9, world: 3, euroSuper: 0 },
        2000: { laLiga: 27, copa: 16, supercopa: 5, european: 10, world: 3, euroSuper: 0 },
        2002: { laLiga: 28, copa: 16, supercopa: 6, european: 11, world: 4, euroSuper: 1 },
        2008: { laLiga: 30, copa: 16, supercopa: 8, european: 11, world: 4, euroSuper: 1 },
        2012: { laLiga: 31, copa: 16, supercopa: 9, european: 11, world: 4, euroSuper: 1 },
        2014: { laLiga: 31, copa: 17, supercopa: 9, european: 12, world: 5, euroSuper: 2 },
        2016: { laLiga: 31, copa: 17, supercopa: 9, european: 13, world: 6, euroSuper: 3 },
        2017: { laLiga: 32, copa: 17, supercopa: 10, european: 14, world: 7, euroSuper: 4 },
        2018: { laLiga: 32, copa: 17, supercopa: 10, european: 15, world: 8, euroSuper: 4 },
        2020: { laLiga: 33, copa: 17, supercopa: 11, european: 15, world: 8, euroSuper: 4 },
        2022: { laLiga: 34, copa: 17, supercopa: 12, european: 16, world: 9, euroSuper: 5 },
        2023: { laLiga: 34, copa: 18, supercopa: 12, european: 16, world: 9, euroSuper: 5 },
        2024: { laLiga: 35, copa: 19, supercopa: 13, european: 17, world: 9, euroSuper: 6 },
        2025: { laLiga: 36, copa: 20, supercopa: 13, european: 17, world: 9, euroSuper: 6 }
    };

    // Get closest year with data
    function getClosestYearData(year) {
        const years = Object.keys(trophyData).map(Number).sort((a, b) => a - b);
        let closest = years[0];
        
        for (let i = 0; i < years.length; i++) {
            if (years[i] <= year) {
                closest = years[i];
            } else {
                break;
            }
        }
        
        return trophyData[closest];
    }

    // Update trophy counters
    function updateCounters(year) {
        const data = getClosestYearData(year);
        
        document.getElementById('laLigaCounter').textContent = data.laLiga;
        document.getElementById('copaCounter').textContent = data.copa;
        document.getElementById('supercopaCounter').textContent = data.supercopa;
        document.getElementById('europeanCounter').textContent = data.european;
        document.getElementById('worldCounter').textContent = data.world;
        document.getElementById('euroSuperCounter').textContent = data.euroSuper;
        document.getElementById('currentYear').textContent = year;
        
        // Trigger animation
        document.querySelectorAll('.counter-value').forEach(counter => {
            counter.style.animation = 'none';
            counter.offsetHeight; // Trigger reflow
            counter.style.animation = 'countUp 0.5s ease-out';
        });
    }

    // Initialize timeline slider
    const yearSlider = document.getElementById('yearSlider');
    if (yearSlider) {
        yearSlider.addEventListener('input', function() {
            updateCounters(parseInt(this.value));
        });
        
        // Initialize with 2025
        updateCounters(2025);
    }

    // Honours modal functionality - Fixed overlay issue
    const honourCards = document.querySelectorAll('.honour-card');
    const honourModalElement = document.getElementById('honourModal');
    
    honourCards.forEach(card => {
        card.addEventListener('click', function() {
            const trophy = this.dataset.trophy;
            const count = this.dataset.count;
            const years = this.dataset.years;
            const image = this.querySelector('.honour-icon img').src;

            document.getElementById('honourModalTitle').textContent = trophy;
            document.getElementById('honourModalImage').src = image;
            document.getElementById('honourModalCount').textContent = count;
            document.getElementById('honourModalLabel').textContent = count == 1 ? 'Time' : 'Times';
            document.getElementById('honourModalYears').textContent = years;
            
            const honourModal = new bootstrap.Modal(honourModalElement);
            honourModal.show();
        });
    });
    
    // Ensure modal and backdrop are properly removed when closing
    const closeBtn = document.querySelector('#honourModal .btn-close');
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            const honourModal = bootstrap.Modal.getInstance(honourModalElement);
            if (honourModal) {
                honourModal.hide();
                
                // Ensure backdrop is removed
                honourModalElement.addEventListener('hidden.bs.modal', function() {
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) {
                        backdrop.remove();
                    }
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = '';
                    document.body.style.paddingRight = '';
                });
            }
        });
    }
    
    // Also remove backdrop when clicking outside the modal
    honourModalElement.addEventListener('click', function(e) {
        if (e.target === this) {
            const honourModal = bootstrap.Modal.getInstance(honourModalElement);
            if (honourModal) honourModal.hide();
        }
    });
    
    // Parallax effect for hero section
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const heroBackground = document.querySelector('.honours-hero-bg');
        if (heroBackground) {
            heroBackground.style.transform = `scale(1.05) translateY(${scrolled * 0.1}px)`;
        }
    });
    
    // Smooth scroll for the Explore button
    const exploreBtn = document.querySelector('.explore-btn');
    if (exploreBtn) {
        exploreBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                const targetPosition = targetSection.offsetTop;
                window.scrollTo({
                    top: targetPosition - 80, // Offset for fixed headers if any
                    behavior: 'smooth'
                });
            }
        });
    }
    
    // Animate honours cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationDelay = Math.random() * 0.3 + 's';
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.honour-card, .player-award-card, .stat-card, .counter-card').forEach(card => {
        observer.observe(card);
    });
});
</script>

<?php require_once '../includes/footer.php'; ?> 