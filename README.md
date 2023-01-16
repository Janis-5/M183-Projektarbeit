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

Beim Login gibt es den Button "Login whitout SMS Token". Damit kann man sich mit dem beim Register erstellten Recovery Code einloggen um danach die Telefonnummer zu ändern wenn man z.B sein Handy verloren hat. Das Login funktioniert alles aber die Logik dahinter ist noch nicht ganz ausgereift. Damit meine ich das der Token für immer gleich bleibt und das man nach dem einloggen mit dem Token seine Telefonnummer nicht zwingend anpassen muss. 

### Register
Beim Registrieren wird ein Nutzernamen welchen es noch nicht in der Datenbank gibt gebraucht sowie das Passwort welches doppelt eingegeben werden muss. 
Um sich entgültig zu Registrieren wir noch eine Telefonnummer gebraucht welche man über das SMS-Token bestätigt und nur dann kan ein Neuer Nutzer Registriert werden. Nach dem Registrieren wird einem noch ein Recovery Token ausgegeben welches man nutzen kann um sich ohne eine Telefonnummer einzuloggen.

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
Alle Ausgaben welche durch User erstellt werden können werden durch die php htmlspecialchars() funktion ausgegeben.
Das bedeutet das falls dort ein Skript eingebaut ist, dies nicht ausgeführt wird.

### Clickjacking
Die Anwendung ist über die "Content-Security-Policy" geschützt. -> header("Content-Security-Policy: frame-ancestors 'none'")
Somit kann die Seite nicht in ein Iframe geladen werden und dadurch auch nicht für clickjacking ausgenutzt werden.

## Logging
### Konzept
General in Applikationen mit Userzugriffen is es fast notwendig ein Error sowie auch ein Access log zu haben. Im Error Log sollen alle fahler welche der Server oder auch der Nutzer hat protokoliert werden um fü den Support oder den Entwickler aufmerksam zu machen un den Fehler zu beheben. Das Acces Log dient zur protokolierung der Erfolgreichen Login Zugriffe auf die Applikation. 

Ein Weiteres Log in dieser Anwendung wäre für die Erstellung der Posts damit man sehen kann wann und von wem diese erstellt wurden. Klar kann man diese Daten auch in der Datenbank sehen jedoch ist es in einem Error Log einfacher

### In Applikation
Im Ordner /log/ befinden sich 2 Dateien
- error.log
- access.log
Im Error Log werden alle Fehlermeldungen aufgezeichnet die ein User ausgeführt hat.
Im Access Log werden alle erfolgreichen Logins und Registrierungen ausfgeführt.

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
