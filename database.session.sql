CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    year YEAT(4),
    released VARCHAR(50),
    runtime VARCHAR(11),
    genre VARCHAR(255),
    director VARCHAR(255),
    actors TEXT,
    country VARCHAR(255),
    poster VARCHAR(255),
    imdb DECIMAL(3, 1),
    type VARCHAR(255)
);
