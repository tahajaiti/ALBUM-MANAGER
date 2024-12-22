

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

-- Insert data into Genres
INSERT INTO Genres (name) VALUES
('Pop'),
('Rock'),
('Jazz'),
('Classical'),
('Hip-Hop'),
('Rap'),
('EDM'),
('Techno'),
('Orchestra'),
('R&B'),
('Reggae'),
('Soul'),
('Neo-Soul'),
('Disco'),
('Afro'),
('Acoustic');
