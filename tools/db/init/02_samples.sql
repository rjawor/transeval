INSERT INTO `assignments` VALUES (1, 1, 2, 'First test assignment', now()), (2, 1, 4, 'Second test assignment', now());

INSERT INTO `inputs` VALUES (1, 'Kazna medijskom mogulu obnovila raspravu u Makedoniji.', 0, 1), (2, 'Član Predsjedništva BiH Komšić podnio ostavku u svojoj stranci.', 1, 1), (3, ' U Zagrebu se održao sastanak na vrhu pod nazivom Predsjednički proces Brdo – Brijuni 2015.', 2, 1);
INSERT INTO `inputs` VALUES (4, ' Diljem Hrvatske organizirana je Noć kazališta: ove je godine u toj kulturnoj manifestaciji sudjelovalo 85 institucija na 78 lokacija u 42 mjesta.', 0, 2), (5, 'Započela je Bitka kod Austerlitza (na slici) poznata i pod nazivom "trocarska bitka", jer u njoj su se sukobili francuski car Napoleon, austrijski car Franjo II. i ruski car Aleksandar I.', 1, 2), (6, 'Američki predsjednik James Monroe Kongresu je iznio teze, danas poznate kao Monroeva doktrina.', 2, 2);

INSERT INTO `users_assignments` VALUES(1, 1, 1,0), (2,1,0,0), (1,2,1,0);
