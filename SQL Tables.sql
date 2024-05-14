DROP TABLE GENRES;

CREATE TABLE GENRES(
            genre VARCHAR2(25 CHAR) UNIQUE
            
);

SELECT * FROM GENRES;
SELECT DISTINCT genre FROM GENRES ORDER BY genre ASC;

DROP TABLE MOVIE;

CREATE TABLE MOVIE(
            movieId     INT,
            movieName   VARCHAR2(25 CHAR) NOT NULL,
            moviePrice INT DEFAULT 0,
            CONSTRAINT chk_price CHECK(movieprice>=0),
            PRIMARY KEY (movieId),
            genre       VARCHAR2(25 CHAR) NOT NULL,
            FOREIGN KEY (genre) REFERENCES genres(genre)
);

--Queries for movie table
SELECT * FROM MOVIE;

SELECT DISTINCT movieName FROM MOVIE ORDER BY movieName ASC;

SELECT DISTINCT moviePrice FROM MOVIE ORDER BY moviePrice DESC;

SELECT DISTINCT genre, AVG(moviePrice) FROM MOVIE GROUP BY genre;

SELECT DISTINCT genre FROM movie GROUP BY genre ORDER BY genre DESC;


--JOIN Queries
--ACTION movie that is less than 10 dollars
SELECT MOVIE.movieName, MOVIE.moviePrice FROM MOVIE INNER JOIN GENRES ON MOVIE.genre = GENRES.genre WHERE GENRES.genre = 'Action' AND MOVIE.moviePrice < 10;

--IF  there are 2 people with the same name
SELECT CUSTOMER.customerName, CUSTOMER.customerId FROM CUSTOMER INNER JOIN ACCOUNT ON CUSTOMER.customerId = ACCOUNT.customerId WHERE ACCOUNT.customerId = 29 AND CUSTOMER.customerName = 'Eric Adams';

--Display the average price of each genre
SELECT GENRES.genre, AVG(MOVIE.moviePrice) AS averagePrice FROM GENRES LEFT JOIN MOVIE ON GENRES.genre = MOVIE.genre GROUP BY GENRES.genre;

--View Queries
--view ACTION movies that are less than 10 dollars
CREATE VIEW WORKS_ON1
AS
SELECT MOVIE.movieName, MOVIE.moviePrice
FROM MOVIE 
INNER JOIN GENRES  ON MOVIE.genre = GENRES.genre
WHERE GENRES.genre = 'Action' AND MOVIE.moviePrice < 10;

--find a specific customer
CREATE VIEW CUSTOMER_ACCOUNT_INFO
AS
SELECT C.customerName, C.customerId
FROM CUSTOMER C
INNER JOIN ACCOUNT A ON C.customerId = A.customerId
WHERE A.customerId = 29 AND C.customerName = 'Eric Adams';

--view the most expensive movie per genre
CREATE VIEW MOST_EXPENSIVE_MOVIE_PER_GENRE
AS
SELECT GENRES.genre, MOVIE.movieName, MOVIE.moviePrice
FROM GENRES
LEFT JOIN MOVIE ON GENRES.genre = MOVIE.genre
WHERE (MOVIE.moviePrice, GENRES.genre) IN (
    SELECT MAX(moviePrice), genre
    FROM MOVIE
    GROUP BY genre
);


--Check constraint
--INSERT INTO MOVIE(movieId,movieName,moviePrice) VALUES (1,'Avengers',-10);

DROP TABLE CUSTOMER;
CREATE TABLE CUSTOMER(
            customerId     INT,
            customerName   VARCHAR2(25 CHAR) NOT NULL,
            PRIMARY KEY (customerId)
);

--Queries for customer table
SELECT * FROM CUSTOMER;

SELECT DISTINCT customerName FROM CUSTOMER ORDER BY customerName ASC;

SELECT * FROM ACCOUNT;

DROP TABLE ADMIN;

CREATE TABLE ADMIN(
            username VARCHAR2(25 CHAR) UNIQUE,
            pass VARCHAR2(25 CHAR),
            customerId     INT,
            catalogId INT,
            
            FOREIGN KEY (customerId) REFERENCES customer(customerId),
            FOREIGN KEY (catalogId) REFERENCES catalog(catalogId)
     
);

SELECT DISTINCT username FROM ADMIN ORDER BY username ASC;

INSERT INTO admin(username, pass)
VALUES ('admin','popcorn');
SELECT * FROM ADMIN;

DROP TABLE SHOPPINGCART;
CREATE TABLE SHOPPINGCART(

            orderId INT,
            total INT,
            price INT,
            movieId  INT,
            customerId INT,
            PRIMARY KEY(orderId),
            FOREIGN KEY (movieId) REFERENCES movie(movieId),
            FOREIGN KEY (customerId) REFERENCES customer(customerId) 
            
);

INSERT INTO SHOPPINGCART(orderId, movieId,customerId) VALUES (1,2,3);
SELECT * FROM SHOPPINGCART;

SELECT DISTINCT orderId, AVG(price) FROM SHOPPINGCART ORDER BY orderId ASC;

DROP TABLE PAYMENT;

CREATE TABLE PAYMENT(
            orderId INT,
            method VARCHAR2(25 CHAR),
            authen INT UNIQUE,
            
            FOREIGN KEY (orderId) REFERENCES shoppingcart(orderId)

);

INSERT INTO PAYMENT(orderId, method,authen) VALUES (1,'visa',2307);
SELECT * FROM PAYMENT;

SELECT DISTINCT authen FROM PAYMENT ORDER BY authen ASC;

DROP TABLE MEMBERSHIP;

CREATE TABLE MEMBERSHIP(
            points INT,
            CONSTRAINT chk_points CHECK(points>=0),

            PRIMARY KEY(points)
);

INSERT INTO MEMBERSHIP(points) VALUES (1000);
SELECT * FROM MEMBERSHIP;

SELECT DISTINCT points FROM MEMBERSHIP ORDER BY points DESC;


DROP TABLE ACCOUNT;
CREATE TABLE ACCOUNT(
            username VARCHAR2(25 CHAR),
            pass  VARCHAR2(25 CHAR),
            CONSTRAINT credentials PRIMARY KEY(username),
            points INT,
            customerId INT,
            FOREIGN KEY (customerId) REFERENCES customer(customerId),
            FOREIGN KEY (points) REFERENCES membership(points)
            
);

INSERT INTO ACCOUNT(username,pass) VALUES ('TimR200','cookie');
INSERT INTO ACCOUNT(username,pass) VALUES ('TimR200','muffin');
INSERT INTO ACCOUNT(username,pass) VALUES ('rchedde','cookie');

SELECT DISTINCT username, COUNT(points) FROM ACCOUNT GROUP BY username;


DROP TABLE CATALOG;

CREATE TABLE CATALOG(
        catalogId INT,
        genre       VARCHAR2(25 CHAR) NOT NULL,
        FOREIGN KEY (genre) REFERENCES genres(genre),
        movie REFERENCES movie(movieId),
        PRIMARY KEY(catalogId)
);

INSERT INTO CATALOG(catalogId,genre) VALUES (1,'comedy');
SELECT * FROM CATALOG;

SELECT genre, COUNT(genre) FROM CATALOG GROUP BY genre ORDER BY genre;


DROP TABLE WISHLIST;

CREATE TABLE WISHLIST(
        wishlistId INT,
        movieId  INT,
        username VARCHAR2(25 CHAR),
        FOREIGN KEY (movieId) REFERENCES movie(movieId),
        FOREIGN KEY (username) REFERENCES account(username),
        PRIMARY KEY(wishlistId)
);

INSERT INTO WISHLIST(wishlistId) VALUES (1);
SELECT * FROM WISHLIST;

SELECT DISTINCT username, COUNT(username) FROM WISHLIST GROUP BY username;
SELECT DISTINCT username FROM WISHLIST GROUP BY username;





