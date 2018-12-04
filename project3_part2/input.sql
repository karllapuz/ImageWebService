CREATE TABLE imageInfo (
    imageID int(11) NOT NULL AUTO_INCREMENT,
    imageName varchar(256),
    category varchar(256),
    imagePath varchar(256),
    resolution varchar(256),
    size varchar(256),
    photographer varchar(256),
    primary key ( imageID )
)

CREATE TABLE customer (
    customerID int(11) NOT NULL AUTO_INCREMENT,
    username varchar(256),
    password varchar(256), 
    firstName varchar(256),
    lastName varchar(256),
    userType varchar(128),
    primary key ( customerID )
)

CREATE TABLE transaction (
    transactionID int(11) NOT NULL AUTO_INCREMENT,
    customerID int(11),
    imageID int(11),
    ts TIMESTAMP,
    primary key ( transactionID )
)