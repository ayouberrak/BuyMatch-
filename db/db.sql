CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    image_profil VARCHAR(255) DEFAULT 'default.png',
    role ENUM('acheteur', 'organisateur', 'admin') NOT NULL,
    status ENUM('actif', 'inactif','banner') DEFAULT 'actif'
);

CREATE TABLE evenements (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(150),
    mignature VARCHAR(255),
    date_event DATETIME,
    lieu VARCHAR(150),
    organisateur_id INT,
    equipe_a_id INT,
    equipe_b_id INT,
    statut ENUM('en_attente', 'valide', 'refuse') DEFAULT 'en_attente',
    FOREIGN KEY (organisateur_id) REFERENCES users(id),
    FOREIGN KEY (equipe_a_id) REFERENCES equipes(id),
    FOREIGN KEY (equipe_b_id) REFERENCES equipes(id)
);

CREATE TABLE equipes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    logo VARCHAR(255)
);

CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    event_id INT,
    nom_categorie VARCHAR(50),
    prix DECIMAL(10,2),
    place_debut INT, 
    place_fin INT,   
    FOREIGN KEY (event_id) REFERENCES evenements(id) ON DELETE CASCADE
);

CREATE TABLE reservations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    event_id INT,
    total_prix DECIMAL(10,2),
    date_reservation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (event_id) REFERENCES evenements(id)
);

CREATE TABLE billets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    reservation_id INT,
    categorie_id INT,
    numero_place INT,
    qr_code VARCHAR(100) UNIQUE,
    FOREIGN KEY (reservation_id) REFERENCES reservations(id) ON DELETE CASCADE,
    FOREIGN KEY (categorie_id) REFERENCES categories(id)
);



CREATE VIEW eventDetails AS
SELECT e.id,e.titre,e.date_event,e.lieu,e.statut,u.nom ,ea.nom ,eb.nom
FROM evenements e
JOIN users u ON e.organisateur_id = u.id
JOIN equipes ea ON e.equipe_a_id = ea.id
JOIN equipes eb ON e.equipe_b_id = eb.id;




DELIMITER $$
CREATE PROCEDURE createRes (
    IN p_user_id INT,
    IN p_event_id INT,
    IN p_total_prix DECIMAL(10,2)
)
BEGIN
    INSERT INTO reservations (user_id, event_id, total_prix)
    VALUES (p_user_id, p_event_id, p_total_prix);

    SELECT LAST_INSERT_ID() AS reservation_id;
END$$
DELIMITER ;
CALL create_reservation(1, 3, 250.00);
