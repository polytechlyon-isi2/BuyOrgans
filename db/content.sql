        /* t_categorie */
insert into t_categorie values
(1, 'Orgue à tuyaux','orgueatuyaux.jpg');

insert into t_categorie values
(2, 'Orgue Numérique','orguenumerique.png');

insert into t_categorie values
(3, 'Orgue Electronique','orgueelectronique.jpg');

insert into t_categorie values
(4, 'Harmonium','harmonium.png');

insert into t_categorie values
(5, 'Orgue de Barbarie','orguebarbarie.png');

        /* t_article */
insert into t_article values
(1, 'Bel Orgue', 'Bel orgue de salon. bon état mais ne plais pas beaucoup aux voisins...', 35000, 1, 'belorgue.jpg');

insert into t_article values
(2, 'Orgue fantôme', 'Orgue magique, il vaut cher, mais si on a une bonne imagination, il peut tout faire', 9876543210, 1, 'default_image.png');

insert into t_article values
(3, 'Orgue Roland', "Bel orgue, pratique, bon état. Trop petit pour pouvoir y enterrer sa soeur.", 12.69, 3, 'roland.jpg');

insert into t_article values
(4, "Orgue d'église", "Vend orgue d'église, prends trop de place (le démontage n'est pas prévu)", 95000, 1, 'téléchargement.jpg');

insert into t_article values
(5, "Orgue", "Vend orgue, tres beau", 95000, 1, 'default_image.png');

insert into t_article values
(6, "Orgue2", "Vend orgue, tres beau, bon état", 120000, 1, 'default_image.png');

insert into t_article values
(7, "Orgue3", "Vend orgue, tres beau, unique en son genre", 250000, 1, 'default_image.png');

insert into t_article values
(8, "Orgue4", "Vend orgue, tres beau, pièce de collection", 370000, 1, 'default_image.png');

insert into t_article values
(9, "Orgue5", "Vend orgue, tres beau, donne faim", 9999999.99, 1, 'default_image.png');

        /* t_user */
/* raw password is 'john' */
insert into t_user values
(1, 'JohnDoe', 'JohnDoe', 'L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER', 'city', 'address', '101000');
/* raw password is 'jane' */
insert into t_user values
(2, 'JaneDoe', 'JaneDoe', 'EfakNLxyhHy2hVJlxDmVNl1pmgjUZl99gtQ+V3mxSeD8IjeZJ8abnFIpw9QNahwAlEaXBiQUBLXKWRzOmSr8HQ==', 'dhMTBkzwDKxnD;4KNs,4ENy', 'ROLE_USER', 'city', 'address', '101000');

        /* t_comment */
insert into t_comment values
(1, 'Great! Keep up the good work.', 1, 1);
insert into t_comment values
(2, "Thank you, I'll try my best.", 1, 2);
