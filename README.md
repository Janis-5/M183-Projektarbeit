# M183 Blog Projektarbeit

## Setup
php applikation mit xampp (v3.3 funktioniert) php shorttags müssen in der konfiguration von xampp aktiviert sein.

SQL Datenbank in phpmyadmin importieren von database.sql (root)

der Namen der Datenbank kann angepasst werden. danach muss dies aber im /app/core/config.php file ebenfalls angepasst werden

### User
Admin: 
Normal: 

## Authentifizierung
### Login
Man kann sich mit einem Usernamen sowie Passwort anmelden. Danach wird ein SMS Token gebraucht um sich zu identifizieren.

Beim Login gibt es den Button "Login whitout SMS Token" diese ist nur dafür da damit man sich beim **Entwickeln** schneller einloggen kann. Sollte man diese Applikation in einer scharfen umgebung nutzen wollen ist dieser Button un ddie dazugehörenden Funktionen ein Sicherheitsrisiko.

Das ist meine alternativen Login Methode ohne SMS Token.

### Register
Beim Registrieren wird ein Nutzernamen welchen es noch nicht in der Datenbank gibt gebraucht sowie das Passwort welches doppelt eingegeben werden muss. 
Um sich entgültig zu Registrieren wir noch eine Telefonnummer gebraucht welche man über das SMS-Token bestätigt und nur dann kan ein Neuer Nutzer Registriert werden.

### Telefonnummer Anpassen
Beim Menüpunkt My Account kann die Telefonnummer angepasst werden. Auch da muss das SMS Token korrekt sein um die Nummer zu ändern.

### Password Konventionen (serverseitig)
- Zwischen 8 und 20 Zeichen
- min. ein Klein- und Grossbuchstaben
- min. eine Zahl
- min. ein Sonderzeichen

### Password Speicherung/Sicherheit
Passwörter werden mit Argon2 gehasht und so in der Datenbank abgespeichert. Argon2 ist sicherer als zb. md5. Deshalb habe ich mich für diese Variante entschieden.


### Username Konventionen (serverseitig)
- Zwischen 3 und 16 Zeichen
- Erlaubt sind:
    - Buchstaben
    - Zahlen
    - "-"
    - "_"

### Phone Konventionen (clientseitig)
- Clientseitig weil man sich nicht registrieren kann ohne ein Gültigen Token zu erhalten wo die Nummer bereits dort validiert wird.
- 11 Zeichen
- Im Format: 417********

### SMS Token
- Wird eine Anfrage mit dem Token nach 5 Minuten gemacht kann nicht registriert, eingeloggt oder die Nummer angepasst werden werden.

## Sicherheit
### XSS
XSS attacken werden bei den Kommentaren durch die php htmlspecialchars() funktion verhindert.
Der Rest der Applikation wird nicht durch diese Funktion geschützt.

### Clickjacking
Die Anwendung ist über die "Content-Security-Policy" geschützt. -> header("Content-Security-Policy: frame-ancestors 'none'")
Somit kann die Seite nicht in ein Iframe geladen werden und dadurch auch nicht für clickjacking ausgenutzt werden.

## Logging


## API
Alle Öffentlichen Posts werden unter /api/posts/allposts.json abgespeichert

## Bibliotheken
Diese Applikation verwendet HTML, JS, CSS und PHP. 
Die einzige Zusätzliche Bibliothek ist Bootstrap v.5.2.3. Die CSS Library wird für das ganze Design der Applikation verwendet.

## Notizen
### Posts Status
0 = hidden
1 = published
2 = deleted
