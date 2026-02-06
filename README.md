# 🔐 Projekti: PortaMagica Login

**PortaMagica Login** është një projekt didaktik në **PHP + MySQL** që implementon një sistem të plotë për:
- regjistrimin e përdoruesve
- login
- zonë të mbrojtur (dashboard)
- logout

Projekti është i strukturuar në mënyrë **të pastër dhe profesionale**, duke ndarë:
- **logjikën PHP** (controller)
- **HTML** (view)
- **layout-in e përbashkët** (header/footer)

---


## 🧠 Si funksionon projekti (përmbledhje)

1. Përdoruesi regjistrohet → të dhënat ruhen në databazë  
2. Përdoruesi bën login → PHP kontrollon email/username dhe fjalëkalimin  
3. Nëse të dhënat janë të sakta → krijohet një sesion  
4. Faqet e mbrojtura kontrollojnë sesionin  
5. Logout shkatërron sesionin  

---

## 🧱 Struktura e projektit



```text
login-site/
│
├── config.php         # → File di configurazione del database. Contiene DB_HOST, DB_NAME, DB_USER e DB_PASS.
├── db.php             # → Gestisce la connessione al database tramite PDO. Fornisce la funzione db() usata in tutto il progetto
├── install.sql        # → Script SQL per creare il database e la tabella users.
├── login.php          # → Controller del login (logica PHP).
├── register.php       # → Controller della registrazione (logica PHP).
├── dashboard.php      # → Controller della dashboard (pagina protetta).
├── logout.php         # → Gestione del logout e distruzione della sessione.
|
|
├── views/             
│   ├── login.view.php        # → View del login (solo HTML).
│   ├── register.view.php     # → View della registrazione (solo HTML).
|   └── dashboard.view.php    # → View della dashboard (contenuti riservati).
|
├── partials/          # → Parti HTML riutilizzabili
│   ├── header.php     # → Head HTML + apertura <body>
│   └── footer.php     # → Script JS + chiusura </body>
|
├── css/
|   └── style.css      #→ Stile grafico del sito.
|
├── js/
│ └── script.js        # → Funzioni JavaScript lato client.

```






---

# 📄 SHPJEGIMI SKEDAR PËR SKEDAR

---

## FILE 1 — `install.sql`

### Për çfarë shërben
Ky skedar krijon:
- databazën `login_db`
- tabelën `users`

Është **pika e nisjes**: pa këtë skedar projekti nuk mund të funksionojë.

### Çfarë përmban tabela `users`
- `id` → identifikues unik
- `username` → emri i përdoruesit
- `email` → email-i
- `password_hash` → fjalëkalimi i enkriptuar
- `created_at` → data e regjistrimit

### Kodi
```sql
CREATE DATABASE IF NOT EXISTS login_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE login_db;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(120) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

```

---

## FILE 2 — `config.php`

---

### Për çfarë shërben
Përmban kredencialet e lidhjes me databazën.

Ndarja e këtij skedari është e rëndësishme sepse:

- mund të ndryshosh databazën pa prekur pjesën tjetër të kodit
- kodi është më i rregullt dhe më i lexueshëm

```php
<?php
declare(strict_types=1);

define('DB_HOST', 'localhost');
define('DB_NAME', 'login_db');
define('DB_USER', 'root');
define('DB_PASS', '');

```

---

## FILE 3 — `db.php`

---

### Për çfarë shërben
Krijon lidhjen PDO me databazën.

I gjithë projekti përdor vetëm një funksion:

```
db()
```
Ky funksion:
- hap lidhjen me databazën
- e ripërdor lidhjen 
- mbron nga SQL Injection
- shfaq gabime të qarta nëse diçka shkon keq

```php
<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

function db(): PDO {
    static $pdo = null;
    if ($pdo instanceof PDO) return $pdo;

    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    return $pdo;
}
```

## FILE 4 — `partials/header.php`
### Për çfarë shërben
Përmban:
- HTML fillestar
- ``` <head> ```
- CSS
- Bootstrap
- hapjen e ``` <body> ```

Përfshihet në të gjitha faqet për të shmangur përsëritjen e kodit.


## FILE 5 — `partials/footer.php`
### Për çfarë shërben
Përmban:
- skriptet JavaScript
- mbylljen e ``` <body> ``` dhe ``` <html> ```
Edhe ky skedar përfshihet në të gjitha faqet.


## FILE 6 — `login.php`
### Për çfarë shërben
Është controller-i i login-it (vetëm logjikë PHP).
Bën këto veprime:
- kontrollon nëse përdoruesi është tashmë i loguar
- lexon të dhënat nga forma
- kërkon përdoruesin në databazë
- verifikon fjalëkalimin me ``` password_verify ```
- krijon sesionin
- ngarkon view-n e login-it
Nuk përmban HTML.

## FILE 7 — `views/login.view.php`
### Për çfarë shërben
Është pjesa grafike e login-it.
Bën vetëm:
- shfaq gabimet
- shfaq formën
- dërgon të dhënat te ``` login.php ```
Nuk përmban query ose logjikë.


## FILE 8 — `register.php`
### Për çfarë shërben
Është controller-i i regjistrimit.
Bën këto veprime:
- lexon të dhënat nga forma
- i validon ato
- kontrollon nëse ekziston email/username
- enkripton fjalëkalimin me ``` password_hash ```
- ruan përdoruesin në databazë
- shfaq view-n e regjistrimit

## FILE 9 — `views/register.view.php`
### Për çfarë shërben
Shfaq:
- formën e regjistrimit
- gabimet eventuale
- mesazhin e suksesit
Nuk përmban kod SQL.

## FILE 10 — `dashboard.php`
### Për çfarë shërben
Mbron faqen.
Nëse:
- përdoruesi nuk është i loguar → ridrejtohet te login
- përdoruesi është i loguar → ngarkohet dashboard-i


## FILE 11 — `views/dashboard.view.php`
### Për çfarë shërben
Shfaq:
- username-in e përdoruesit të loguar
- përmbajtje të rezervuar
- butonin e logout-it

## FILE 12 — `logout.php`
### Për çfarë shërben
Ekzekuton logout-in:
- shkatërron sesionin
- e kthen përdoruesin te login-i

## 🔐 Siguria e përdorur
- ` password_hash()`  për ruajtjen e fjalëkalimeve
- `password_verify()` për krahasimin e tyre
- PDO + prepared statements
- sesione PHP
- `session_regenerate_id(true)`

## SCREEN

<img width="1908" height="940" alt="Immagine 2026-02-06 030938" src="https://github.com/user-attachments/assets/c853499d-9b9f-4503-b2b3-3472a8aba406" />

<img width="1915" height="949" alt="Immagine 2026-02-06 031001" src="https://github.com/user-attachments/assets/785e6b8f-3d98-43b1-b8f8-c0a7735446e1" />

<img width="1916" height="998" alt="Immagine 2026-02-06 031104" src="https://github.com/user-attachments/assets/ee03c8d0-8f4c-4a4b-ae3a-f931e87c70de" />

<img width="1916" height="1001" alt="Immagine 2026-02-06 031128" src="https://github.com/user-attachments/assets/9740179d-c4d1-4ef0-8a1d-84b40250c39f" />

<img width="1915" height="959" alt="Immagine 2026-02-06 031157" src="https://github.com/user-attachments/assets/85f4fb04-1ff4-4088-b864-40b21b1ad072" />


<img width="1917" height="994" alt="Screenshot 2026-02-06 035733" src="https://github.com/user-attachments/assets/a2a3803f-9e26-4705-8171-b75694e3356d" />


<img width="1918" height="993" alt="Screenshot 2026-02-06 031534" src="https://github.com/user-attachments/assets/84815848-0d01-4402-86a3-ce8e93cb8796" />


<img width="1919" height="998" alt="Screenshot 2026-02-06 035828" src="https://github.com/user-attachments/assets/7a6de029-9b2a-422a-aa40-03cc895f5e0f" />

