SELECT titre, resum FROM film WHERE UCASE(resum) LIKE '%VINCENT%' ORDER BY id_film;
