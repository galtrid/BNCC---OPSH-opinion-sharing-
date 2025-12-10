# BNCC — OPSH (Opinion Sharing) — Single-file Quickstart

Repository: https://github.com/galtrid/BNCC---OPSH-opinion-sharing-. :contentReference[oaicite:1]{index=1}

This README is a single-file step-by-step guide to get the project running locally.  
Files included in the repo: `install.php`, `index.php`, `style.css`, plus `controllers`, `models`, `views`. :contentReference[oaicite:2]{index=2}

---

## Prerequisites

1. PHP (7.4+ recommended).  
2. MySQL server (or MariaDB).  
   - If you prefer a bundled environment, install **XAMPP** (Windows/macOS) or **MAMP** (macOS) or **LAMP** (Linux).  
3. A browser (Chrome / Firefox).

---

## One-file quick setup (what you will do)

1. Put the project folder into your web server folder:
   - XAMPP: `C:\xampp\htdocs\BNCC-opsh`  
   - MAMP: `/Applications/MAMP/htdocs/BNCC-opsh`  

2. Start Apache and MySQL (via XAMPP/MAMP control panel).

3. Edit `install.php` to match your local DB settings:
   - Open `install.php` in an editor.
   - Find the DB config section (example variables shown below) and change if needed:
     ```php
     $host = 'localhost';
     $username = 'root';
     $password = '';   // put your MySQL password here
     $port = 3306;     // IMPORTANT !!!!!! change only if your MySQL uses a different port
     ```
   - Save the file.

4. Run the installer in your browser:
   - Open: `http://localhost/BNCC-opsh/install.php`
   - The installer will create the database and tables. If it shows success, you're done with DB setup.

5. Open the app:
   - Visit: `http://localhost/BNCC-opsh/` (this loads `index.php`).

---

## Detailed step-by-step (expanded)

### A. Clone or copy the repository
```bash
git clone https://github.com/galtrid/BNCC---OPSH-opinion-sharing-.git
# or download the ZIP and extract to your webserver's folder
