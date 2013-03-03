CREATE TABLE country (id VARCHAR(2) NOT NULL, name VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;

INSERT INTO `country` (`id`, `name`) VALUES ('BA', 'Bosna i Hercegovina');
INSERT INTO `country` (`id`, `name`) VALUES ('ME', 'Crna Gora');
INSERT INTO `country` (`id`, `name`) VALUES ('ZZ', 'Nepoznata ili nevažeća oblast');
INSERT INTO `country` (`id`, `name`) VALUES ('RS', 'Srbija');
INSERT INTO `country` (`id`, `name`) VALUES ('TO', 'Tonga');
