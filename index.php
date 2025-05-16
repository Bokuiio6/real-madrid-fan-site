<?php
require_once 'includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Madrid - Official Fan Site</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Hero Section */
        .hero {
            position: relative;
            height: 600px;
            margin-bottom: var(--spacing-xl);
        }

        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .hero-slide.active {
            opacity: 1;
        }

        .hero-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: var(--spacing-lg);
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            color: var(--rm-white);
        }

        /* Next Match Section */
        .next-match {
            background-color: var(--rm-navy);
            color: var(--rm-white);
            padding: var(--spacing-lg);
            border-radius: 8px;
            margin-bottom: var(--spacing-xl);
        }

        .countdown {
            display: flex;
            justify-content: center;
            gap: var(--spacing-md);
            margin: var(--spacing-md) 0;
        }

        .countdown-item {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: var(--spacing-sm);
            border-radius: 4px;
            min-width: 80px;
        }

        .countdown-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--rm-gold);
        }

        /* Fan Stories Section */
        .fan-stories {
            margin-bottom: var(--spacing-xl);
        }

        .testimonial-card {
            background: var(--rm-white);
            padding: var(--spacing-md);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .testimonial-text {
            font-style: italic;
            margin-bottom: var(--spacing-sm);
        }

        .testimonial-author {
            font-weight: 600;
            color: var(--rm-navy);
        }

        /* Legacy Section */
        .legacy {
            background-color: var(--rm-light-gray);
            padding: var(--spacing-xl) 0;
            margin-bottom: var(--spacing-xl);
        }

        .legacy-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: var(--spacing-md);
        }

        .legacy-item {
            text-align: center;
            padding: var(--spacing-md);
        }

        .legacy-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--rm-navy);
            margin-bottom: var(--spacing-xs);
        }

        /* Events Section */
        .events {
            margin-bottom: var(--spacing-xl);
        }

        .event-card {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            height: 300px;
        }

        .event-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .event-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: var(--spacing-md);
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            color: var(--rm-white);
        }

        /* Gallery Section */
        .gallery {
            margin-bottom: var(--spacing-xl);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: var(--spacing-sm);
        }

        .gallery-item {
            position: relative;
            height: 200px;
            border-radius: 8px;
            overflow: hidden;
        }

        .gallery-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover .gallery-img {
            transform: scale(1.1);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .legacy-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .gallery-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hero {
                height: 400px;
            }

            .countdown {
                flex-wrap: wrap;
            }

            .legacy-grid {
                grid-template-columns: 1fr;
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .gallery-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <!-- Hero Section -->
        <section class="hero position-relative">
            <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/images/hero/training-1.jpg" alt="Real Madrid Training" class="hero-img" style="object-fit: cover; height: 600px; width: 100%;">
                        <div class="carousel-caption d-none d-md-block">
                            <h1 class="display-4 fw-bold">Real Madrid</h1>
                            <p class="lead">Experience the passion of the world's greatest football club</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/hero/training-2.jpg" alt="Team Training" class="hero-img" style="object-fit: cover; height: 600px; width: 100%;">
                        <div class="carousel-caption d-none d-md-block">
                            <h1 class="display-4 fw-bold">Champions League</h1>
                            <p class="lead">15 European Cups and counting</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/hero/event-1.jpg" alt="Club Event" class="hero-img" style="object-fit: cover; height: 600px; width: 100%;">
                        <div class="carousel-caption d-none d-md-block">
                            <h1 class="display-4 fw-bold">Club Events</h1>
                            <p class="lead">Join us in celebrating our rich history</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

        <!-- Next Match Section -->
        <section class="next-match py-5">
            <div class="container">
                <h2 class="section-title text-center mb-4">Next Match</h2>
                <div class="match-info text-center">
                    <h3 class="h2 mb-3">Real Madrid vs Barcelona</h3>
                    <p class="lead mb-4">La Liga - Matchday 29</p>
                    <div class="countdown d-flex justify-content-center gap-3 mb-4">
                        <div class="countdown-item bg-white bg-opacity-10 p-3 rounded">
                            <div class="countdown-number h2 mb-0" id="countdown-days">00</div>
                            <div class="countdown-label">Days</div>
                        </div>
                        <div class="countdown-item bg-white bg-opacity-10 p-3 rounded">
                            <div class="countdown-number h2 mb-0" id="countdown-hours">00</div>
                            <div class="countdown-label">Hours</div>
                        </div>
                        <div class="countdown-item bg-white bg-opacity-10 p-3 rounded">
                            <div class="countdown-number h2 mb-0" id="countdown-minutes">00</div>
                            <div class="countdown-label">Minutes</div>
                        </div>
                        <div class="countdown-item bg-white bg-opacity-10 p-3 rounded">
                            <div class="countdown-number h2 mb-0" id="countdown-seconds">00</div>
                            <div class="countdown-label">Seconds</div>
                        </div>
                    </div>
                    <a href="#" class="btn btn-warning btn-lg">Get Tickets</a>
                </div>
            </div>
        </section>

        <!-- Fan Stories Section -->
        <section class="fan-stories py-5">
            <div class="container">
                <h2 class="section-title text-center mb-5">Fan Stories</h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="testimonial-card h-100">
                            <img src="assets/images/fans/fan-1.jpg" alt="Fan Story" class="img-fluid rounded mb-3" style="width: 100%; height: 200px; object-fit: cover;">
                            <p class="testimonial-text">"Being a Real Madrid fan has been the greatest joy of my life. The passion, the history, and the glory nights at the Bernabéu are unforgettable."</p>
                            <p class="testimonial-author">- Maria Rodriguez, Madrid</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="testimonial-card h-100">
                            <img src="assets/images/fans/fan-2.jpg" alt="Fan Story" class="img-fluid rounded mb-3" style="width: 100%; height: 200px; object-fit: cover;">
                            <p class="testimonial-text">"From watching the Galácticos to the current era, Real Madrid has always represented excellence in football. ¡Hala Madrid!"</p>
                            <p class="testimonial-author">- Carlos Mendez, Mexico</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="testimonial-card h-100">
                            <img src="assets/images/fans/fan-3.jpg" alt="Fan Story" class="img-fluid rounded mb-3" style="width: 100%; height: 200px; object-fit: cover;">
                            <p class="testimonial-text">"The Champions League nights at the Bernabéu are magical. The atmosphere, the passion, and the history make it the greatest stadium in the world."</p>
                            <p class="testimonial-author">- John Smith, England</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Legacy Section -->
        <section class="legacy py-5 bg-light">
            <div class="container">
                <h2 class="section-title text-center mb-4">Our Legacy</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="text-center">
                            <div class="display-1 fw-bold text-primary mb-3">15</div>
                            <h3 class="h4 mb-2">Champions League Titles</h3>
                            <p class="text-muted">Most successful club in European history</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <div class="display-1 fw-bold text-primary mb-3">35</div>
                            <h3 class="h4 mb-2">La Liga Titles</h3>
                            <p class="text-muted">Record number of Spanish league championships</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <div class="display-1 fw-bold text-primary mb-3">120</div>
                            <h3 class="h4 mb-2">Years of History</h3>
                            <p class="text-muted">Founded in 1902, a century of excellence</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Events Section -->
        <section class="events py-5">
            <div class="container">
                <h2 class="section-title text-center mb-4">Upcoming Events</h2>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm overflow-hidden">
                            <img src="assets/images/events/classico-2024.jpg" alt="El Clásico 2024" class="card-img-top">
                            <div class="card-img-overlay d-flex flex-column justify-content-end bg-dark bg-opacity-75">
                                <h3 class="card-title text-white h4">El Clásico 2024</h3>
                                <p class="card-text text-white-50">Experience the biggest match in world football</p>
                                <a href="#" class="btn btn-warning">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm overflow-hidden">
                            <img src="assets/images/events/champions-league-final-2024.jpg" alt="Champions League Final 2024" class="card-img-top">
                            <div class="card-img-overlay d-flex flex-column justify-content-end bg-dark bg-opacity-75">
                                <h3 class="card-title text-white h4">Champions League Final 2024</h3>
                                <p class="card-text text-white-50">Watch us make history once again</p>
                                <a href="#" class="btn btn-warning">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        <section class="gallery py-5">
            <div class="container">
                <h2 class="section-title text-center mb-4">Fan Gallery</h2>
                <div class="row g-3">
                    <div class="col-md-3 col-6">
                        <div class="gallery-item position-relative overflow-hidden rounded">
                            <img src="assets/images/fan-gallery/bernabeu-tour.jpg" alt="Bernabéu Tour" class="gallery-img w-100">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="gallery-item position-relative overflow-hidden rounded">
                            <img src="assets/images/fan-gallery/match-day.jpg" alt="Match Day" class="gallery-img w-100">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="gallery-item position-relative overflow-hidden rounded">
                            <img src="assets/images/fans/fan-1.jpg" alt="Fan Photo 1" class="gallery-img w-100">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="gallery-item position-relative overflow-hidden rounded">
                            <img src="assets/images/fans/fan-2.jpg" alt="Fan Photo 2" class="gallery-img w-100">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Latest News Section -->
        <section class="latest-news py-5 bg-light">
            <div class="container">
                <h2 class="section-title text-center mb-4">Latest News</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="assets/images/news/match-report.jpg" class="card-img-top" alt="Match Report" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">Match Report: Real Madrid 3-1 Barcelona</h5>
                                <p class="card-text">A dominant performance sees Los Blancos extend their lead at the top of La Liga.</p>
                                <a href="#" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="assets/images/news/player-interview.jpg" class="card-img-top" alt="Player Interview" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">Exclusive: Jude Bellingham Interview</h5>
                                <p class="card-text">The English midfielder opens up about his first season at Real Madrid.</p>
                                <a href="#" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="assets/images/news/stadium-update.jpg" class="card-img-top" alt="Stadium Update" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">Bernabéu Renovation Progress</h5>
                                <p class="card-text">Latest updates on the stadium's transformation into a world-class venue.</p>
                                <a href="#" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Match Highlights Section -->
        <section class="highlights py-5">
            <div class="container">
                <h2 class="section-title text-center mb-4">Match Highlights</h2>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/placeholder1" title="Match Highlights" allowfullscreen></iframe>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Real Madrid vs Barcelona</h5>
                                <p class="card-text">Watch the best moments from El Clásico</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/placeholder2" title="Training Session" allowfullscreen></iframe>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Behind the Scenes: Training Session</h5>
                                <p class="card-text">Exclusive access to the team's preparation</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script>
        // Hero Slider
        let currentSlide = 0;
        const slides = document.querySelectorAll('.hero-slide');
        
        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            slides[index].classList.add('active');
        }
        
        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }
        
        setInterval(nextSlide, 5000);

        // Countdown Timer
        function updateCountdown() {
            // Set the target date (July 1, 2025)
            const targetDate = new Date('2025-07-01T00:00:00');
            const currentDate = new Date();
            
            // Calculate the time difference in milliseconds
            const timeDifference = targetDate.getTime() - currentDate.getTime();
            
            // Calculate days, hours, minutes, and seconds
            const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);
            
            // Update the DOM elements with padded values
            document.getElementById('countdown-days').textContent = String(days).padStart(2, '0');
            document.getElementById('countdown-hours').textContent = String(hours).padStart(2, '0');
            document.getElementById('countdown-minutes').textContent = String(minutes).padStart(2, '0');
            document.getElementById('countdown-seconds').textContent = String(seconds).padStart(2, '0');
        }

        // Update the countdown immediately when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Initial update
            updateCountdown();
            
            // Update the countdown every second
            setInterval(updateCountdown, 1000);
        });
    </script>
</body>
</html>

<!-- IMAGES NEEDED FOR THIS PAGE:
  images/hero/training-1.jpg        — "Real Madrid Training Session"
  images/hero/training-2.jpg        — "Team Training"
  images/hero/event-1.jpg           — "Club Event"
  images/hero/event-2.jpg           — "Fan Event"
  images/fans/fan-1.jpg             — "Fan Photo 1"
  images/fans/fan-2.jpg             — "Fan Photo 2"
  images/fans/fan-3.jpg             — "Fan Photo 3"
  images/features/highlights-1.jpg   — "Match Highlights"
  images/features/news-1.jpg         — "Latest News"
  images/features/interview-1.jpg    — "Player Interview"
  images/stadium/bernabeu-banner.jpg — "Santiago Bernabéu Stadium"
--> 