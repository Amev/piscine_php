SELECT COUNT(DISTINCT id_film) AS 'films' FROM historique_membre WHERE DATE(date) LIKE '%-12-24' OR (DATE(date) >= 2006-10-30 AND DATE(date) <= 2007-07-27);
