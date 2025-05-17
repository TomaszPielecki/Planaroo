
-- Tworzenie bazy danych
CREATE DATABASE IF NOT EXISTS tomawebp_projekty_firma CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Wybór bazy danych
USE tomawebp_projekty_firma;

-- Tworzenie tabeli projekty
CREATE TABLE IF NOT EXISTS projekty (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nazwa VARCHAR(255) NOT NULL,
  opis TEXT,
  data_rozpoczecia DATE NOT NULL,
  data_zakonczenia DATE DEFAULT NULL,
  status ENUM('w trakcie', 'zakończony') NOT NULL DEFAULT 'w trakcie',
  odpowiedzialny VARCHAR(100) NOT NULL,
  data_utworzenia TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tworzenie tabeli zadania
CREATE TABLE IF NOT EXISTS zadania (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nazwa VARCHAR(255) NOT NULL,
  opis TEXT,
  termin DATE NOT NULL,
  status ENUM('do zrobienia', 'w trakcie', 'zakończony') NOT NULL DEFAULT 'do zrobienia',
  przypisane_do VARCHAR(100) NOT NULL,
  priorytet ENUM('niski', 'średni', 'wysoki') NOT NULL DEFAULT 'średni',
  projekt_id INT NOT NULL,
  data_utworzenia TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (projekt_id) REFERENCES projekty(id) ON DELETE CASCADE
);

-- Tworzenie tabeli logi_czasu_pracy
CREATE TABLE IF NOT EXISTS logi_czasu_pracy (
  id INT AUTO_INCREMENT PRIMARY KEY,
  zadanie_id INT NOT NULL,
  uzytkownik VARCHAR(100) NOT NULL,
  czas_pracy INT NOT NULL COMMENT 'Czas pracy w minutach',
  komentarz TEXT,
  data_utworzenia TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (zadanie_id) REFERENCES zadania(id) ON DELETE CASCADE
);

-- Procedura do resetowania danych
DELIMITER //
DROP PROCEDURE IF EXISTS ResetujDane//
CREATE PROCEDURE ResetujDane()
BEGIN
    SET FOREIGN_KEY_CHECKS = 0;

    TRUNCATE TABLE logi_czasu_pracy;
    TRUNCATE TABLE zadania;
    TRUNCATE TABLE projekty;

    SET FOREIGN_KEY_CHECKS = 1;
END//
DELIMITER ;

-- Wstawianie przykładowych danych - projekty
INSERT INTO projekty (nazwa, opis, data_rozpoczecia, data_zakonczenia, status, odpowiedzialny) VALUES
('Nowa strona internetowa', 'Stworzenie nowej strony internetowej firmy', '2023-01-15', '2023-03-30', 'zakończony', 'Jan Kowalski'),
('System CRM', 'Wdrożenie systemu zarządzania relacjami z klientami', '2023-02-10', NULL, 'w trakcie', 'Anna Nowak'),
('Kampania marketingowa', 'Przygotowanie i przeprowadzenie kampanii reklamowej w mediach społecznościowych', '2023-03-01', '2023-04-15', 'zakończony', 'Piotr Wiśniewski'),
('Modernizacja sieci', 'Modernizacja infrastruktury sieciowej w biurze', '2023-04-05', NULL, 'w trakcie', 'Tomasz Pielecki'),
('Projekt aplikacji mobilnej', 'Zaprojektowanie i wdrożenie aplikacji mobilnej dla klientów', '2023-05-10', NULL, 'w trakcie', 'Magdalena Lewandowska');

-- Wstawianie przykładowych danych - zadania
INSERT INTO zadania (nazwa, opis, termin, status, przypisane_do, priorytet, projekt_id) VALUES
('Projektowanie layoutu', 'Przygotowanie projektu graficznego strony', '2023-01-25', 'zakończony', 'Marta Zielińska', 'wysoki', 1),
('Kodowanie HTML/CSS', 'Kodowanie strony w HTML5 i CSS3', '2023-02-10', 'zakończony', 'Kamil Nowak', 'średni', 1),
('Integracja CMS', 'Integracja strony z CMS', '2023-03-01', 'zakończony', 'Jan Kowalski', 'wysoki', 1),
('Testowanie', 'Testowanie funkcjonalności strony', '2023-03-20', 'zakończony', 'Anna Dąbrowska', 'średni', 1),
('Analiza wymagań', 'Zebranie i analiza wymagań klienta', '2023-02-20', 'zakończony', 'Anna Nowak', 'wysoki', 2),
('Konfiguracja systemu', 'Instalacja i konfiguracja systemu CRM', '2023-03-15', 'zakończony', 'Tomasz Kowalczyk', 'wysoki', 2),
('Import danych', 'Migracja danych z poprzedniego systemu', '2023-04-01', 'w trakcie', 'Marek Jankowski', 'średni', 2),
('Szkolenie pracowników', 'Przeprowadzenie szkoleń dla zespołu', '2023-04-20', 'do zrobienia', 'Anna Nowak', 'wysoki', 2),
('Przygotowanie strategii', 'Opracowanie strategii marketingowej', '2023-03-10', 'zakończony', 'Piotr Wiśniewski', 'wysoki', 3),
('Projektowanie grafik', 'Przygotowanie materiałów graficznych', '2023-03-20', 'zakończony', 'Karolina Kowalska', 'średni', 3),
('Publikacja postów', 'Publikacja treści w mediach społecznościowych', '2023-03-25', 'zakończony', 'Michał Lewandowski', 'niski', 3),
('Analiza wyników', 'Analiza efektów kampanii', '2023-04-10', 'zakończony', 'Piotr Wiśniewski', 'średni', 3),
('Audyt sieci', 'Przeprowadzenie audytu obecnej infrastruktury', '2023-04-15', 'zakończony', 'Tomasz Pielecki', 'wysoki', 4),
('Zakup sprzętu', 'Zamówienie niezbędnego sprzętu', '2023-04-25', 'zakończony', 'Adam Nowak', 'średni', 4),
('Instalacja urządzeń', 'Instalacja nowych urządzeń sieciowych', '2023-05-10', 'w trakcie', 'Marcin Kowalski', 'wysoki', 4),
('Konfiguracja', 'Konfiguracja sieci', '2023-05-20', 'do zrobienia', 'Tomasz Pielecki', 'wysoki', 4),
('Analiza rynku', 'Badanie rynku i konkurencji', '2023-05-25', 'w trakcie', 'Magdalena Lewandowska', 'średni', 5),
('Projektowanie UX', 'Projektowanie interfejsu użytkownika', '2023-06-10', 'do zrobienia', 'Karolina Mazur', 'wysoki', 5),
('Prototypowanie', 'Stworzenie prototypu aplikacji', '2023-06-30', 'do zrobienia', 'Piotr Adamski', 'średni', 5),
('Testowanie koncepcji', 'Testy z użytkownikami', '2023-07-15', 'do zrobienia', 'Magdalena Lewandowska', 'wysoki', 5);
