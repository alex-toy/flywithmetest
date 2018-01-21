-- Données pour remplissage des tables

USE news;

DELETE FROM article;
DELETE FROM comments;





INSERT INTO article (titre, depart, arrivee, dateAjout, dateModif, contenu) 
VALUES 	('Corbas-Gap', 'Corbas', 'Gap', '2017-11-17', '2017-11-22', 'Article Corbas Gap : Leiusmod tempor incididunt ut la.'),
		('Corbas-Gap', 'Corbas', 'Gap', '2017-11-17', '2017-11-22', 'Article Corbas Gap : Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
        ('Corbas-Gap', 'Corbas', 'Gap', '2017-12-17', '2017-12-22', 'Article Corbas Gap : Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
        ('Calvi-Avignon', 'Calvi', 'Avignon', '2017-11-17', '2017-11-22', 'Article Corbas Avignon : Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
		('Avignon-Dole', 'Avignon', 'Dole', '2017-11-17', '2017-11-22', 'Article Corbas Dole : Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
		('Chambéry-Moulins', 'Chambéry', 'Moulins', '2017-12-17', '2017-12-22', 'Article Corbas Moulins : Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
		('Villefranche-Montpellier', 'Villefranche', 'Montpellier', '2017-12-17', '2017-12-22', 'Article Corbas Montpellier : Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
		('Montellimar-Le Puy', 'Montellimar', 'Le Puy', '2017-12-17', '2017-12-22', 'Article Corbas Le Puy : Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
		('Valence-Aubenas', 'Valence', 'Aubenas', '2017-12-17', '2017-12-22', 'Article Corbas Aubenas : Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');





INSERT INTO comments (id_article, auteur, date, contenu, validated) 
VALUES 	(1, 'alex', '2018-11-17', 'SUPER', false),
        (2, 'seb', '2018-11-18', 'super', false),
		(3, 'elo', '2018-11-19', 'Bien cool', false),
		(4, 'elo', '2018-11-20', 'a refaire', false),
		(5, 'kate', '2018-11-21', 'Magnifique, vivement la corse', false),
		(6, 'kate', '2018-11-22', 'Magnifique, a refaire', false);


-- SELECT * FROM comments;

 
 
 
 
 
 
  
