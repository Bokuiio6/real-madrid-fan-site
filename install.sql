-- Create database
CREATE DATABASE IF NOT EXISTS real_madrid_fan_site;
USE real_madrid_fan_site;

-- Players table
CREATE TABLE players (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    position VARCHAR(50) NOT NULL,
    number INT,
    nationality VARCHAR(50),
    birth_date DATE,
    height INT,
    weight INT,
    bio TEXT,
    image_path VARCHAR(255),
    stats_appearances INT DEFAULT 0,
    stats_goals INT DEFAULT 0,
    stats_assists INT DEFAULT 0,
    stats_clean_sheets INT DEFAULT 0,
    career_highlights TEXT,
    social_media VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Legends table
CREATE TABLE legends (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    position VARCHAR(50) NOT NULL,
    years_active VARCHAR(50),
    achievements TEXT,
    bio TEXT,
    image_path VARCHAR(255),
    stats_appearances INT DEFAULT 0,
    stats_goals INT DEFAULT 0,
    stats_assists INT DEFAULT 0,
    stats_clean_sheets INT DEFAULT 0,
    career_highlights TEXT,
    era VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Coaches table
CREATE TABLE coaches (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    years_active VARCHAR(50),
    trophies TEXT,
    achievements TEXT,
    bio TEXT,
    image_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Trophies table
CREATE TABLE trophies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(100) NOT NULL,
    year INT NOT NULL,
    description TEXT,
    times_won INT DEFAULT 1,
    first_win INT,
    last_win INT,
    image_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Events table
CREATE TABLE events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    event_date DATETIME NOT NULL,
    location VARCHAR(255),
    image_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the products table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(8,2) NOT NULL,
    category VARCHAR(50) NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    discount INT DEFAULT 0,
    stock INT DEFAULT 100,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Fan gallery table
CREATE TABLE fan_gallery (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image_path VARCHAR(255),
    submitted_by VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Seed data for current players
INSERT INTO players (name, position, number, nationality, birth_date, height, weight, bio, image_path, stats_appearances, stats_goals, stats_assists, stats_clean_sheets, career_highlights) VALUES
-- Goalkeepers
('Thibaut Courtois', 'Goalkeeper', 1, 'Belgium', '1992-05-11', 199, 96, 'Belgian goalkeeper known for his exceptional reflexes and commanding presence.', 'assets/images/players/courtois.jpg', 150, 0, 0, 45, 'Champions League winner 2022, La Liga winner 2020, 2022'),
('Andriy Lunin', 'Goalkeeper', 13, 'Ukraine', '1999-02-11', 191, 80, 'Ukrainian goalkeeper with great potential and shot-stopping abilities.', 'assets/images/players/lunin.jpg', 25, 0, 0, 8, 'UEFA Youth League winner 2018'),
('Kepa Arrizabalaga', 'Goalkeeper', 25, 'Spain', '1994-10-03', 186, 88, 'Spanish goalkeeper on loan from Chelsea, known for his penalty-saving abilities.', 'assets/images/players/kepa.jpg', 15, 0, 0, 5, 'Europa League winner 2019'),

-- Defenders
('Dani Carvajal', 'Defender', 2, 'Spain', '1992-01-11', 173, 73, 'Spanish right-back known for his attacking prowess and defensive solidity.', 'assets/images/players/carvajal.jpg', 350, 8, 45, 0, '5x Champions League winner, 3x La Liga winner'),
('Éder Militão', 'Defender', 3, 'Brazil', '1998-01-18', 186, 78, 'Brazilian center-back with excellent defensive skills and aerial ability.', 'assets/images/players/militao.jpg', 120, 5, 2, 0, 'Champions League winner 2022'),
('David Alaba', 'Defender', 4, 'Austria', '1992-06-24', 180, 78, 'Versatile Austrian defender who can play as center-back or left-back.', 'assets/images/players/alaba.jpg', 80, 3, 5, 0, 'Champions League winner 2022'),
('Jesús Vallejo', 'Defender', 5, 'Spain', '1997-01-05', 184, 77, 'Spanish center-back with great potential.', 'assets/images/players/vallejo.jpg', 30, 0, 1, 0, 'UEFA Youth League winner 2015'),
('Nacho', 'Defender', 6, 'Spain', '1990-01-18', 180, 76, 'Versatile Spanish defender who can play across the back line.', 'assets/images/players/nacho.jpg', 300, 15, 10, 0, '5x Champions League winner, 3x La Liga winner'),
('Ferland Mendy', 'Defender', 23, 'France', '1995-06-08', 180, 73, 'French left-back known for his pace and defensive abilities.', 'assets/images/players/mendy.jpg', 120, 4, 8, 0, 'Champions League winner 2022'),
('Antonio Rüdiger', 'Defender', 22, 'Germany', '1993-03-03', 190, 85, 'German center-back with strong defensive presence.', 'assets/images/players/rudiger.jpg', 60, 2, 1, 0, 'Champions League winner 2021'),
('Fran García', 'Defender', 20, 'Spain', '1999-08-14', 175, 70, 'Spanish left-back with attacking qualities.', 'assets/images/players/garcia.jpg', 40, 1, 5, 0, 'La Liga winner 2023'),

-- Midfielders
('Jude Bellingham', 'Midfielder', 5, 'England', '2003-06-29', 186, 75, 'English midfielder known for his technical ability and leadership.', 'assets/images/players/bellingham.jpg', 30, 15, 8, 0, 'Golden Boy 2023'),
('Toni Kroos', 'Midfielder', 8, 'Germany', '1990-01-04', 183, 76, 'German midfielder known for his passing and control.', 'assets/images/players/kroos.jpg', 400, 25, 80, 0, '5x Champions League winner, 3x La Liga winner'),
('Luka Modrić', 'Midfielder', 10, 'Croatia', '1985-09-09', 172, 66, 'Croatian midfielder known for his vision and creativity.', 'assets/images/players/modric.jpg', 450, 35, 70, 0, 'Ballon d\'Or 2018, 5x Champions League winner'),
('Federico Valverde', 'Midfielder', 15, 'Uruguay', '1998-07-22', 182, 78, 'Uruguayan midfielder known for his energy and versatility.', 'assets/images/players/valverde.jpg', 200, 20, 25, 0, 'Champions League winner 2022'),
('Eduardo Camavinga', 'Midfielder', 12, 'France', '2002-11-10', 182, 68, 'French midfielder known for his technical skills.', 'assets/images/players/camavinga.jpg', 100, 5, 10, 0, 'Champions League winner 2022'),
('Aurélien Tchouaméni', 'Midfielder', 18, 'France', '2000-01-27', 187, 81, 'French midfielder known for his defensive abilities.', 'assets/images/players/tchouameni.jpg', 80, 3, 5, 0, 'Champions League winner 2022'),
('Dani Ceballos', 'Midfielder', 19, 'Spain', '1996-08-07', 179, 74, 'Spanish midfielder known for his creativity.', 'assets/images/players/ceballos.jpg', 150, 8, 15, 0, 'Champions League winner 2022'),

-- Forwards
('Vinicius Jr', 'Forward', 7, 'Brazil', '2000-07-12', 176, 73, 'Brazilian forward known for his pace and skills.', 'assets/images/players/vinicius.jpg', 200, 60, 40, 0, 'Champions League winner 2022'),
('Rodrygo', 'Forward', 11, 'Brazil', '2001-01-09', 174, 63, 'Brazilian forward known for his technical ability.', 'assets/images/players/rodrygo.jpg', 150, 30, 20, 0, 'Champions League winner 2022'),
('Joselu', 'Forward', 14, 'Spain', '1990-03-27', 192, 86, 'Spanish striker known for his aerial ability.', 'assets/images/players/joselu.jpg', 50, 15, 5, 0, 'La Liga winner 2023'),
('Brahim Díaz', 'Forward', 21, 'Spain', '1999-08-03', 171, 69, 'Spanish forward known for his creativity.', 'assets/images/players/diaz.jpg', 80, 10, 8, 0, 'Champions League winner 2022'),
('Arda Güler', 'Forward', 24, 'Turkey', '2005-02-25', 176, 73, 'Turkish forward known for his potential.', 'assets/images/players/guler.jpg', 20, 5, 3, 0, 'Turkish Super Cup winner 2023');

-- Seed data for legends
INSERT INTO legends (name, position, years_active, achievements, bio, image_path, stats_appearances, stats_goals, stats_assists, era) VALUES
('Iker Casillas', 'Goalkeeper', '1999-2015', '5 Champions League titles, 5 La Liga titles', 'Legendary goalkeeper and captain who led Real Madrid to numerous titles.', 'assets/images/legends/casillas.jpg', 725, 0, 0, 'Modern Era'),
('Sergio Ramos', 'Defender', '2005-2021', '4 Champions League titles, 5 La Liga titles', 'One of the greatest defenders in Real Madrid history.', 'assets/images/legends/ramos.jpg', 671, 101, 40, 'Modern Era'),
('Roberto Carlos', 'Defender', '1996-2007', '3 Champions League titles, 4 La Liga titles', 'Brazilian left-back known for his powerful free-kicks.', 'assets/images/legends/carlos.jpg', 527, 70, 90, 'Galácticos Era'),
('Marcelo', 'Defender', '2007-2022', '5 Champions League titles, 6 La Liga titles', 'Brazilian left-back with incredible attacking abilities.', 'assets/images/legends/marcelo.jpg', 546, 38, 101, 'Modern Era'),
('Pepe', 'Defender', '2007-2017', '3 Champions League titles, 3 La Liga titles', 'Portuguese center-back known for his defensive prowess.', 'assets/images/legends/pepe.jpg', 334, 15, 8, 'Modern Era'),
('Zinedine Zidane', 'Midfielder', '2001-2006', '1 Champions League title, 1 La Liga title', 'French midfielder known for his elegance and skill.', 'assets/images/legends/zidane.jpg', 227, 49, 68, 'Galácticos Era'),
('Claude Makélélé', 'Midfielder', '2000-2003', '2 Champions League titles, 1 La Liga title', 'French defensive midfielder who defined the position.', 'assets/images/legends/makelele.jpg', 145, 0, 8, 'Galácticos Era'),
('Toni Kroos', 'Midfielder', '2014-2024', '4 Champions League titles, 3 La Liga titles', 'German midfielder known for his passing and control.', 'assets/images/legends/kroos.jpg', 450, 25, 80, 'Modern Era'),
('Raúl González', 'Forward', '1994-2010', '3 Champions League titles, 6 La Liga titles', 'Spanish forward and club legend.', 'assets/images/legends/raul.jpg', 741, 323, 115, 'Modern Era'),
('Karim Benzema', 'Forward', '2009-2023', '5 Champions League titles, 4 La Liga titles', 'French forward and Ballon d\'Or winner.', 'assets/images/legends/benzema.jpg', 648, 354, 165, 'Modern Era'),
('Ronaldo Nazário', 'Forward', '2002-2007', '1 La Liga title', 'Brazilian striker known as "The Phenomenon".', 'assets/images/legends/ronaldo.jpg', 177, 104, 35, 'Galácticos Era'),
('Cristiano Ronaldo', 'Forward', '2009-2018', '4 Champions League titles, 2 La Liga titles', 'Portuguese forward and all-time leading goalscorer.', 'assets/images/legends/cristiano.jpg', 438, 450, 131, 'Modern Era'),
('Alfredo Di Stéfano', 'Forward', '1953-1964', '5 European Cups, 8 La Liga titles', 'Argentine-Spanish forward and club legend.', 'assets/images/legends/di-stefano.jpg', 396, 308, 0, 'Golden Era'),
('Fabio Cannavaro', 'Defender', '2006-2009', '2 La Liga titles', 'Italian defender and Ballon d\'Or winner.', 'assets/images/legends/cannavaro.jpg', 118, 1, 2, 'Modern Era');

-- Seed data for coaches
INSERT INTO coaches (name, years_active, trophies, achievements, bio, image_path) VALUES
('Zinedine Zidane', '2016-2018, 2019-2021', '3 Champions League titles, 2 La Liga titles', 'First coach to win three consecutive Champions League titles', 'Legendary player turned successful coach.', 'assets/images/coaches/zidane.jpg'),
('José Mourinho', '2010-2013', '1 La Liga title, 1 Copa del Rey', 'Led Real Madrid to record points in La Liga', 'Portuguese tactician known for his defensive organization.', 'assets/images/coaches/mourinho.jpg'),
('Carlo Ancelotti', '2013-2015, 2021-present', '2 Champions League titles, 1 La Liga title', 'One of the most successful coaches in Real Madrid history', 'Italian tactician known for his man-management skills.', 'assets/images/coaches/ancelotti.jpg');

-- Seed data for trophies
INSERT INTO trophies (name, category, year, description, times_won, first_win, last_win, image_path) VALUES
('European Cup/UEFA Champions League', 'European Cup/UEFA Champions League', 2022, 'Real Madrid won their 14th European Cup/UEFA Champions League title, defeating Liverpool 1-0 in the final.', 14, 1956, 2022, 'assets/images/trophies/champions-league-2022.jpg'),
('La Liga', 'La Liga', 2022, 'Real Madrid won their 35th La Liga title, finishing 13 points ahead of Barcelona.', 35, 1932, 2022, 'assets/images/trophies/la-liga-2022.jpg'),
('Copa del Rey', 'Copa del Rey', 2023, 'Real Madrid won their 20th Copa del Rey title, defeating Osasuna 2-1 in the final.', 20, 1905, 2023, 'assets/images/trophies/copa-del-rey-2023.jpg'),
('Supercopa de España', 'Supercopa de España', 2022, 'Real Madrid won their 12th Supercopa de España title.', 12, 1988, 2022, 'assets/images/trophies/supercopa-2022.jpg'),
('UEFA Super Cup', 'UEFA Super Cup', 2022, 'Real Madrid won their 5th UEFA Super Cup title.', 5, 2002, 2022, 'assets/images/trophies/super-cup-2022.jpg'),
('FIFA Club World Cup', 'FIFA Club World Cup', 2022, 'Real Madrid won their 5th FIFA Club World Cup title.', 5, 2014, 2022, 'assets/images/trophies/club-world-cup-2022.jpg');

-- Seed data for events
INSERT INTO events (title, description, event_date, location, image_path) VALUES
('Real Madrid vs Barcelona', 'El Clásico - La Liga Match', '2024-04-21 20:00:00', 'Santiago Bernabéu', 'assets/images/events/classico-2024.jpg'),
('Champions League Final', 'UEFA Champions League Final', '2024-06-01 20:00:00', 'Wembley Stadium', 'assets/images/events/champions-league-final-2024.jpg');

-- Seed data for products
INSERT INTO products (name, description, price, category, image_path, discount, stock) VALUES
('Home Jersey 2023/24', 'Official Real Madrid home jersey for the 2023/24 season. Features the iconic white color with subtle gold details.', 89.99, 'Jerseys', 'home-jersey-2024.jpg', 0, 100),
('Away Jersey 2023/24', 'Official Real Madrid away jersey for the 2023/24 season. Bold navy design with gold accents.', 89.99, 'Jerseys', 'away-jersey-2024.jpg', 10, 100),
('Training Kit', 'Official Real Madrid training kit. Lightweight, breathable fabric perfect for training sessions or casual wear.', 59.99, 'Training Wear', 'training-kit-2024.jpg', 0, 50),
('Official Scarf', 'Real Madrid official scarf with club colors. Show your support on matchday or display as memorabilia.', 24.99, 'Accessories', 'scarf-2024.jpg', 0, 75),
('Official Cap', 'Real Madrid official cap with embroidered logo. Adjustable strap for perfect fit.', 19.99, 'Accessories', 'cap-2024.jpg', 15, 100),
('Official Jacket', 'Real Madrid official jacket for cold weather. Water-resistant with warm lining.', 129.99, 'Training Wear', 'jacket-2024.jpg', 20, 50),
('Official Match Ball', 'Official Real Madrid match ball. Professional quality with club emblem.', 34.99, 'Collectibles', 'ball-2024.jpg', 0, 30),
('Official Mug', 'Real Madrid official ceramic mug. Perfect for the Madridista fan in your life.', 14.99, 'Collectibles', 'mug-2024.jpg', 0, 200),
('Home Jersey 2024/25', 'Brand new official Real Madrid home jersey for the 2024/25 season. Classic white with modern design elements.', 94.99, 'Jerseys', 'home-jersey-2025.jpg', 0, 150),
('Away Jersey 2024/25', 'Brand new official Real Madrid away jersey for the 2024/25 season. Bold design for away matches.', 94.99, 'Jerseys', 'away-jersey-2025.jpg', 0, 120),
('Third Kit 2024/25', 'Official Real Madrid third kit for the 2024/25 season. Unique design for European competitions.', 94.99, 'Jerseys', 'third-kit-2025.jpg', 5, 100),
('Replica Scarf', 'High-quality replica of the iconic Real Madrid scarf. Perfect for match days or display.', 19.99, 'Accessories', 'replica-scarf.jpg', 0, 200),
('Club Cap', 'Stylish Real Madrid club cap with embroidered crest. Adjustable fit for all fans.', 22.99, 'Accessories', 'club-cap.jpg', 10, 150),
('Training Jacket', 'Premium Real Madrid training jacket as worn by the players. Comfortable and stylish.', 119.99, 'Training Wear', 'training-jacket.jpg', 15, 80),
('Mini Football', 'Real Madrid mini football. Perfect for young fans or as a collectible item.', 19.99, 'Collectibles', 'mini-football.jpg', 0, 100),
('Coffee Mug', 'Elegant Real Madrid coffee mug with team colors and logo. Dishwasher safe.', 12.99, 'Collectibles', 'coffee-mug.jpg', 0, 250),
('Keychain Set', 'Set of 3 Real Madrid keychains featuring different club emblems and player silhouettes.', 9.99, 'Accessories', 'keychain-set.jpg', 0, 300),
('Poster Pack', 'Collection of 5 high-quality Real Madrid posters featuring the stadium and star players.', 24.99, 'Collectibles', 'poster-pack.jpg', 0, 150),
('Youth Jersey', 'Official Real Madrid jersey designed for young fans. Available in various sizes.', 69.99, 'Jerseys', 'youth-jersey.jpg', 10, 120),
('Vintage Retro Shirt', 'Replica of the classic 1960s Real Madrid shirt. Vintage design with modern comfort.', 79.99, 'Jerseys', 'vintage-retro-shirt.jpg', 0, 75);

-- Seed data for fan gallery
INSERT INTO fan_gallery (title, description, image_path, submitted_by) VALUES
('Bernabéu Tour', 'Amazing experience visiting the stadium', 'assets/images/fan-gallery/bernabeu-tour.jpg', 'John Doe'),
('Match Day', 'Incredible atmosphere during El Clásico', 'assets/images/fan-gallery/match-day.jpg', 'Jane Smith'); 