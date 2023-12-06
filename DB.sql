
CREATE DATABASE laravel_master;

CREATE TABLE users(
    id                  INT(255) auto_increment not null,
    role                VARCHAR(20),
    name                VARCHAR(100),
    surname             VARCHAR(200),
    nick                 VARCHAR(100),
    email               VARCHAR(255),
    password            VARCHAR(255),
    image               VARCHAR(255),
    created_at          DATETIME,
    updated_at           DATETIME,
    remember_token      VARCHAR(255),
    CONSTRAINT pk_user  PRIMARY KEY (id)
)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'user', 'jordan', 'aguilera', 'jordamcho','aguilerajordan2@gmail.com', 'pass', NULL, CURTIME(), CURTIME(), NULL);
INSERT INTO users VALUES(NULL, 'user', 'matias', 'alarcon', 'mati','aguilerajordan2@gmail.com', 'pass', NULL, CURTIME(), CURTIME(), NULL);


CREATE TABLE images(
    id                  INT(255) auto_increment not null,
    user_id             INT(255),
    image_path          VARCHAR(255),
    description         TEXT,
    created_at          DATETIME,
    updated_at           DATETIME,
    CONSTRAINT pk_images PRIMARY KEY(id),
    CONSTRAINT pk_user FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;

INSERT INTO images VALUES(NULL, 1, 'test.jpg', 'descripcion', CURTIME(), CURTIME());
INSERT INTO images VALUES(NULL, 2, 'playa.jpg', 'descripcion2', CURTIME(), CURTIME());
INSERT INTO images VALUES(NULL, 1, 'arena.jpg', 'descripcion3', CURTIME(), CURTIME());


CREATE TABLE comments(
    id                 INT(255) auto_increment not null,
    user_id            INT(255),
    image_id           INT(255),
    content            text,
    created_at         DATETIME,
    updated_at         DATETIME,
    CONSTRAINT pk_comments PRIMARY KEY(id),
    CONSTRAINT fk_comments_user FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_comments_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;

INSERT INTO comments VALUES(NULL, 1, 2, 'Buena foto', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 2, 1, 'descripcion2', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 1, 2, 'descripcion3', CURTIME(), CURTIME());

CREATE TABLE likes(
    id                INT(255) auto_increment not null,
    user_id           INT(255),
    image_id          INT(255),
    created_at        DATETIME,
    update_at         DATETIME,
    CONSTRAINT pk_likes PRIMARY KEY(id),
    CONSTRAINT fk_likes_user FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_likes_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;

INSERT INTO `likes` (`id`, `user_id`, `image_id`, `created_at`, `update_at`) VALUES (NULL, '1', '5', '2023-11-18 16:53:56.000000', '2023-11-18 16:53:56.000000');
INSERT INTO `likes` (`id`, `user_id`, `image_id`, `created_at`, `update_at`) VALUES (NULL, '2', '5', '2023-11-18 16:53:56.000000', '2023-11-18 16:53:56.000000');

INSERT INTO images VALUES(NULL, 2, 1, CURTIME(), CURTIME());

