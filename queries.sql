CREATE DATABASE alif_music;

USE alif_music;

CREATE TABLE authors
(
    id     INT PRIMARY KEY AUTO_INCREMENT,
    name   VARCHAR(255) NOT NULL,
    bio    TEXT         NOT NULL,
    avatar VARCHAR(255),
    genre_id INT,
    FOREIGN KEY genre_id REFERENCES genres(id)
);

CREATE TABLE albums
(
    id        INT PRIMARY KEY AUTO_INCREMENT,
    name      VARCHAR(255) NOT NULL,
    year      INT          NOT NULL,
    author_id INT          NOT NULL,
    photo VARCHAR(255),
    FOREIGN KEY (author_id) REFERENCES authors (id)
);

CREATE TABLE genres
(
    id          INT PRIMARY KEY AUTO_INCREMENT,
    genre       VARCHAR(255) NOT NULL,
    description TEXT
);

CREATE TABLE musics
(
    id          INT PRIMARY KEY AUTO_INCREMENT,
    title       VARCHAR(255) NOT NULL,
    genre_id    INT          NOT NULL,
    album_id    INT          NOT NULL,
    author_id   INT          NOT NULL,
    length      VARCHAR(255),
    is_active   BOOLEAN   DEFAULT true,
    music_image VARCHAR(255),
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (genre_id) REFERENCES genres (id),
    FOREIGN KEY (album_id) REFERENCES albums (id),
    FOREIGN KEY (author_id) REFERENCES authors (id)

);

CREATE TABLE favorites(
  id INT PRIMARY KEY AUTO_INCREMENT ,
  user_id INT NOT NULL ,
  music_id INT NOT NULL ,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (music_id) REFERENCES musics(id)
);

# CREATE TABLE countries(
#     id   INT PRIMARY KEY AUTO_INCREMENT,
#     name VARCHAR(255)
# )


CREATE TABLE roles
(
    id   INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL ,
    password VARCHAR(255) NOT NULL ,
    email VARCHAR(255) NOT NULL ,
    phone VARCHAR(255) NOT NULL ,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
);

CREATE TABLE user_has_roles
(
    user_id INT,
    role_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (role_id) REFERENCES roles(id)
);
