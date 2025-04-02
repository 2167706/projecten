CREATE DATABASE HotelTerDuin;
USE HotelTerDuin;

-- Tabel: customers
CREATE TABLE customers (
    CustomerID INT(11) AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Phone VARCHAR(20),
    Address VARCHAR(255)
);

-- Tabel: rooms
CREATE TABLE rooms (
    RoomID INT(11) AUTO_INCREMENT PRIMARY KEY,
    RoomNumber INT(11) NOT NULL,
    RoomType VARCHAR(50) NOT NULL,
    Description TEXT,
    PricePerNight DECIMAL(10,2) NOT NULL
);

-- Tabel: reservations
CREATE TABLE reservations (
    ReservationID INT(11) AUTO_INCREMENT PRIMARY KEY,
    CustomerID INT(11) NOT NULL,
    CheckInDate DATE NOT NULL,
    CheckOutDate DATE NOT NULL,
    TotalPrice DECIMAL(10,2) NOT NULL,
    ReservationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Status VARCHAR(20) NOT NULL DEFAULT 'Confirmed',
    FOREIGN KEY (CustomerID) REFERENCES customers(CustomerID) 
        ON UPDATE RESTRICT ON DELETE RESTRICT
);

-- Tabel: reservationdetails
CREATE TABLE reservationdetails (
    ReservationDetailID INT(11) AUTO_INCREMENT PRIMARY KEY,
    ReservationID INT(11) NOT NULL,
    RoomID INT(11) NOT NULL,
    Date DATE NOT NULL,
    FOREIGN KEY (ReservationID) REFERENCES reservations(ReservationID) 
        ON UPDATE RESTRICT ON DELETE RESTRICT,
    FOREIGN KEY (RoomID) REFERENCES rooms(RoomID) 
        ON UPDATE RESTRICT ON DELETE RESTRICT
);

-- Tabel: users
CREATE TABLE users (
    UserID INT(11) AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    FullName VARCHAR(100) NOT NULL,
    Role VARCHAR(20) NOT NULL
);
