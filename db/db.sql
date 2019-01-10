DROP DATABASE IF EXISTS hde;
CREATE DATABASE hde;

USE hde

CREATE TABLE rooms(
	nr VARCHAR(3) NOT NULL,
	UNIQUE(nr),
	htf VARCHAR(12) NULL,
	dtf DATE NULL,
	sts VARCHAR(30) NOT NULL,
	who VARCHAR(20) NULL,
	dat DATE NULL,
	PRIMARY KEY(nr)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

INSERT INTO rooms VALUES('h1', null, null, 'fr', null, null);
INSERT INTO rooms VALUES('h2', null, null, 'fr', null, null);
INSERT INTO rooms VALUES('h3', null, null, 'fr', null, null);
INSERT INTO rooms VALUES('h4', null, null, 'fr', null, null);
INSERT INTO rooms VALUES('h5', null, null, 'fr', null, null);
INSERT INTO rooms VALUES('h6', null, null, 'fr', null, null);
INSERT INTO rooms VALUES('h8', null, null, 'fr', null, null);
INSERT INTO rooms VALUES('h9', null, null, 'fr', null, null);
INSERT INTO rooms VALUES('h10', null, null, 'fr', null, null);
INSERT INTO rooms VALUES('h11', null, null, 'fr', null, null);
INSERT INTO rooms VALUES('h12', null, null, 'fr', null, null);
INSERT INTO rooms VALUES('h13', null, null, 'fr', null, null);
INSERT INTO rooms VALUES('h14', null, null, 'fr', null, null);
INSERT INTO rooms VALUES('h15', null, null, 'fr', null, null);
INSERT INTO rooms VALUES('h16', null, null, 'fr', null, null);
INSERT INTO rooms VALUES('h17', null, null, 'fr', null, null);
INSERT INTO rooms VALUES('h18', null, null, 'fr', null, null);
INSERT INTO rooms VALUES('h19', null, null, 'fr', null, null);
INSERT INTO rooms VALUES('h20', null, null, 'fr', null, null);
INSERT INTO rooms VALUES('h21', null, null, 'fr', null, null);

CREATE TABLE users(
	id INT AUTO_INCREMENT NOT NULL,
	ci VARCHAR(20) NOT NULL,
	id_ced VARCHAR(300) NOT NULL,
	nom VARCHAR(150) NOT NULL,
	ape VARCHAR(150) NOT NULL,
	fna VARCHAR(600) NOT NULL,
	room VARCHAR(90) NOT NULL,
	he VARCHAR(12) NOT NULL,
	hs VARCHAR(12) NOT NULL,
	tt VARCHAR(30) NOT NULL,
	dat DATE NOT NULL,
	dexit DATE NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

