SET @start_time = NOW();
SELECT * FROM lab04_2022e048.population;

-- Female, age 15, Alameda
SELECT population, race 
FROM sample_population 
WHERE sex = 'Female' AND age = 15 AND county = 'Alameda';

-- Male, Imperial
SELECT population 
FROM population 
WHERE sex = 'Male' AND county = 'Imperial';

-- Age 6-14, Inyo
SELECT * 
FROM population 
WHERE age BETWEEN 6 AND 14 AND county = 'Inyo';

-- Count of records
SELECT COUNT(*) FROM sample_population;

-- Distinct county
SELECT DISTINCT county FROM population;
SET @end_time = NOW();
SELECT TIMEDIFF(@start_time, @end_time) as Execution_time;
