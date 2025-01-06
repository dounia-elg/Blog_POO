USE BlogPlatform;

CREATE TABLE Admin (
    idadmin INT AUTO_INCREMENT PRIMARY KEY,
    adminname VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO admin (adminname, email, password) VALUES ('admin', 'admin@gmail.com', 'admin');
select * from admin;

CREATE TABLE users (
    iduser INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE articles (
    idarticle INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    iduser INT NOT NULL,
    FOREIGN KEY (iduser) REFERENCES users(iduser) ON DELETE CASCADE
);

CREATE TABLE comments (
    idcomment INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    iduser INT NOT NULL,
    idarticle INT NOT NULL,
    FOREIGN KEY (iduser) REFERENCES users(iduser) ON DELETE CASCADE,
    FOREIGN KEY (idarticle) REFERENCES articles(idarticle) ON DELETE CASCADE
);

CREATE TABLE likes (
    idlike INT AUTO_INCREMENT PRIMARY KEY,
    iduser INT NOT NULL,
    idarticle INT NOT NULL,
    FOREIGN KEY (iduser) REFERENCES users(iduser) ON DELETE CASCADE,
    FOREIGN KEY (idarticle) REFERENCES articles(idarticle) ON DELETE CASCADE
);

CREATE TABLE Tags (
    idtag INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE tag_article (
    idtag_article INT PRIMARY KEY AUTO_INCREMENT,
    idtag INT NOT NULL,
    idarticle INT NOT NULL,
    FOREIGN KEY (idtag) REFERENCES tags(idtag),
    FOREIGN KEY (idarticle) REFERENCES articles(idarticle)
);
