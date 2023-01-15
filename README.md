# M183 Blog Projektarbeit

## Setup
todo

## Posts Status
0 = hidden
1 = published
2 = deleted

## Password Konventionen (serverseitig)
- Zwischen 8 und 20 Zeichen
- min. ein Klein- und Grossbuchstaben
- min. eine Zahl
- min. ein Sonderzeichen

## Username Konventionen (serverseitig)
- Zwischen 3 und 16 Zeichen
- Erlaubt sind:
    - Buchstaben
    - Zahlen
    - "-"
    - "_"

## Phone Konventionen (clientseitig)
- Clientseitig weil man sich nicht registrieren kann ohne ein Gültigen Token zu erhalten wo die Nummer bereits dort validiert wird.
- 11 Zeichen
- Im Format: 417********

## SMS Token
- Wird eine anfrage mit dem Token nach 5 Minuten gemacht kann der user nicht registriert/eingeloggt werden.

## XSS
XSS attacken werden bei den Kommentaren durch die php htmlspecialchars() funktion verhindert.
Der Rest der Applikation wird nicht durch diese Funktion geschützt.

## Bibliotheken
Diese Applikation verwendet HTML, JS, CSS und PHP. 
Die einzige Zusätzliche Bibliothek ist Bootstrap v.5.2.3. Die CSS Library wird für das ganze Design der Applikation verwendet.
