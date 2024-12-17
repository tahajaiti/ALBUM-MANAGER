

-- Table: Roles
CREATE TABLE Roles (
    id SERIAL PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL
);

-- Table: Users
CREATE TABLE Users (
    id SERIAL PRIMARY KEY,
    role_id INTEGER NOT NULL DEFAULT 3,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by INTEGER DEFAULT NULL,
    updated_by INTEGER DEFAULT NULL,
    is_archived BOOLEAN DEFAULT FALSE,
    is_accepted BOOLEAN DEFAULT FALSE,
    slug VARCHAR(255) UNIQUE,
    FOREIGN KEY (role_id) REFERENCES Roles(id)
);

-- Table: Albums
CREATE TABLE Albums (
    id SERIAL PRIMARY KEY,
    artist_id INTEGER NOT NULL,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    cover_image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by INTEGER DEFAULT NULL,
    updated_by INTEGER DEFAULT NULL,
    is_archived BOOLEAN DEFAULT FALSE,
    slug VARCHAR(255) UNIQUE,
    FOREIGN KEY (artist_id) REFERENCES Users(id) ON DELETE CASCADE
);

-- Table: Purchases
CREATE TABLE Purchases (
    id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL,
    album_id INTEGER NOT NULL,
    purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    quantity INTEGER NOT NULL CHECK (quantity > 0),
    total_price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE,
    FOREIGN KEY (album_id) REFERENCES Albums(id) ON DELETE CASCADE
);

-- Table: Genres
CREATE TABLE Genres (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

-- Table: Album_genres
CREATE TABLE Album_genres (
    id SERIAL PRIMARY KEY,
    album_id INTEGER NOT NULL,
    genre_id INTEGER NOT NULL,
    FOREIGN KEY (album_id) REFERENCES Albums(id) ON DELETE CASCADE,
    FOREIGN KEY (genre_id) REFERENCES Genres(id) ON DELETE CASCADE,
    UNIQUE (album_id, genre_id)
);


-- Insert data into Roles
INSERT INTO Roles (role_name) VALUES
('admin'),
('artist'),
('customer');

-- Insert data into Users
INSERT INTO Users (role_id, name, email, password, is_archived, slug) VALUES
(1, 'Taha', 'taha@admin.com', 'admin', FALSE, 'taha-admin'),
(2, 'Alice Artist', 'alice.artist@example.com', 'hashedpassword2', FALSE, 'alice-artist'),
(2, 'Bob Musician', 'bob.musician@example.com', 'hashedpassword3', FALSE, 'bob-musician'),
(3, 'Charlie Buyer', 'charlie.buyer@example.com', 'hashedpassword4', FALSE, 'charlie-buyer'),
(3, 'Dana Listener', 'dana.listener@example.com', 'hashedpassword5', FALSE, 'dana-listener');

-- Insert data into Albums
INSERT INTO Albums (artist_id, title, description, price, cover_image, is_archived, slug) VALUES
(2, 'Summer Vibes', 'A chill summer album', 19.99, 'summer_vibes.jpg', FALSE, 'summer-vibes'),
(2, 'Acoustic Journeys', 'Acoustic tracks for relaxation', 14.99, 'acoustic_journeys.jpg', FALSE, 'acoustic-journeys'),
(3, 'Rock Revival', 'The best rock hits', 24.99, 'rock_revival.jpg', FALSE, 'rock-revival'),
(3, 'Jazz Nights', 'Smooth jazz for evenings', 17.99, 'jazz_nights.jpg', FALSE, 'jazz-nights'),
(3, 'Classical Harmony', 'A collection of classical masterpieces', 21.50, 'classical_harmony.jpg', FALSE, 'classical-harmony');

-- Insert data into Genres
INSERT INTO Genres (name) VALUES
('Pop'),
('Rock'),
('Jazz'),
('Classical'),
('Acoustic');

-- Insert data into Album_genres
INSERT INTO Album_genres (album_id, genre_id) VALUES
(1, 1), -- Summer Vibes -> Pop
(2, 5), -- Acoustic Journeys -> Acoustic
(3, 2), -- Rock Revival -> Rock
(4, 3), -- Jazz Nights -> Jazz
(5, 4); -- Classical Harmony -> Classical

-- Insert data into Purchases
INSERT INTO Purchases (user_id, album_id, purchase_date, quantity, total_price) VALUES
(4, 1, '2024-06-01 12:30:00', 1, 19.99),  -- Charlie buys Summer Vibes
(5, 2, '2024-06-02 15:45:00', 2, 29.98),  -- Dana buys 2x Acoustic Journeys
(4, 3, '2024-06-03 10:15:00', 1, 24.99),  -- Charlie buys Rock Revival
(5, 4, '2024-06-04 18:00:00', 1, 17.99),  -- Dana buys Jazz Nights
(5, 5, '2024-06-05 20:00:00', 1, 21.50);  -- Dana buys Classical Harmony

-- Insert data into Admin_actions
INSERT INTO Admin_actions (admin_id, action, target_id, target_role, created_at) VALUES
(1, 'Approved user account', 2, 'artist', '2024-06-01 09:00:00'),
(1, 'Approved user account', 3, 'artist', '2024-06-01 09:05:00'),
(1, 'Deleted album', 4, 'album', '2024-06-02 14:00:00'),
(1, 'Archived user account', 5, 'customer', '2024-06-03 11:00:00'),
(1, 'Updated album price', 3, 'album', '2024-06-04 12:30:00');
