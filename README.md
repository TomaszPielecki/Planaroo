# Planaroo - System Zarządzania Projektami

Planaroo to kompleksowe rozwiązanie do zarządzania projektami i zadaniami, stworzone z myślą o małych i średnich firmach. System umożliwia efektywne planowanie, monitorowanie oraz raportowanie postępów projektów.

## Funkcjonalności

### Zarządzanie Projektami

- Tworzenie nowych projektów z określeniem nazwy, opisu, dat rozpoczęcia/zakończenia
- Przypisywanie osób odpowiedzialnych za realizację projektu
- Śledzenie statusu projektów (w trakcie, zakończony)
- Edycja i usuwanie projektów
- Widok kalendarza projektów

### Zarządzanie Zadaniami

- Dodawanie zadań do projektów
- Określanie terminów realizacji zadań
- Przypisywanie priorytetów (niski, średni, wysoki)
- Śledzenie statusu zadań
- Przypisywanie osób odpowiedzialnych

### Śledzenie Czasu Pracy

- Rejestrowanie czasu pracy nad zadaniami
- Dodawanie komentarzy do wpisów czasu pracy
- Raportowanie łącznego czasu pracy dla zadania
- Usuwanie wpisów czasu pracy

### Raportowanie i Eksport

- Eksport danych projektów do formatu CSV
- Eksport zadań do formatu CSV
- Statystyki projektów
- Powiadomienia o zbliżających się terminach zadań

## Technologia

- **Backend**: PHP
- **Frontend**: HTML, CSS, JavaScript
- **Szablony**: Smarty
- **Baza danych**: MySQL
- **Biblioteki**: FontAwesome, FullCalendar

## Struktura Projektu

- `/controllers` - Kontrolery obsługujące logikę biznesową
- `/models` - Modele zarządzające dostępem do danych
- `/views` - Widoki prezentujące dane użytkownikowi
- `/config` - Pliki konfiguracyjne
- `/css` - Arkusze stylów
- `/js` - Skrypty JavaScript
- `/smarty/templates` - Szablony Smarty

## Instalacja

1. Sklonuj repozytorium na serwer z PHP 7.4+ i MySQL
2. Zaimportuj strukturę bazy danych z pliku `database.sql`
3. Skonfiguruj połączenie z bazą danych w pliku `db.php`
4. Uruchom aplikację przez przeglądarkę

## Plany rozwoju

### Krótkoterminowe (1-3 miesiące)

- Dodanie systemu autentykacji użytkowników
- Implementacja uprawnień dostępu (role: administrator, kierownik projektu, pracownik)
- Dodanie funkcji filtrowania i sortowania zadań
- Rozbudowa modułu kalendarza o widok tygodniowy i miesięczny
- Optymalizacja interfejsu dla urządzeń mobilnych

### Średnioterminowe (3-6 miesięcy)

- Implementacja systemu powiadomień (email, wewnątrz aplikacji)
- Dodanie modułu budżetowania projektów
- Implementacja systemu komentarzy do projektów i zadań
- Dodanie funkcji załączników (dokumenty, obrazy) do projektów i zadań
- Rozbudowa mechanizmu raportowania o wykresy i dashboardy

### Długoterminowe (6+ miesięcy)

- Integracja z zewnętrznymi kalendarzami (Google Calendar, Microsoft Outlook)
- Implementacja API REST do integracji z innymi systemami
- Dodanie modułu zarządzania zasobami (przydzielanie zasobów do projektów)
- Implementacja systemu workflow dla projektów i zadań
- Rozwój aplikacji mobilnej (iOS, Android)

## Autor

Tomasz Pielecki

## Licencja

Projekt jest własnością intelektualną autora i nie może być używany bez wyraźnej zgody.

---

© 2025 Planaroo - System Zarządzania Projektami