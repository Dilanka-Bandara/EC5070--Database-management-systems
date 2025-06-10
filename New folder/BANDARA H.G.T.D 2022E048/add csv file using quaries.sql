SELECT * FROM lab04_2022e048.population;
LOAD DATA LOCAL INFILE 'C:\\BANDARA H.G.T.D 2022E048\\population.csv'
INTO TABLE population
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(id, age, sex, county, race, population);
