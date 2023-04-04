# Info over onze honeypot

## Admin login
- email: killerb@honeypot.com
- password: Sasuke

## Overview van alle main routes 
Public
- /
- /shop
- /login
- /register

Authenticated
- /users
- /products

Challenges
- /admin/.passwd
- /axwvomjwjumjwq -> /spongebobmeboi
- /broken
- /brokenuser
- /winniethepooh

---
## Usermanagement
Als admin user kan je alle gebruikers zien en bewerken. 
Je kan ook alle ingelogde users zien die actief zijn op de site en ze blocken. 
Je kan ook de actieve guests hun ip adres zien.
Via het admin panel kan je ook nieuwe users aanmaken en de rechten ervan aanpassen. 
Als admin kan je ook nieuwe rollen toevoegen en ze bepaalde rechten geven zoals toegang tot edit user etc.

## File-upload (/upload-file)
Als je ingelogd bent kan je een avatar uploaden gelinkt aan je account. Alle geuploade avatars kan je op de pagina zien met de naam van de persoon die dit heeft geupload.

## Shop
Op onze honeypot heb je ook een shop met een lijstje van producten. Als admin kan je via het dashboard hier ook producten aan toevoegen.

---

## Challenges 
### 1. Robots.txt (geheime recept)
Om deze challenge to voltooien moet je eerst naar de /robots.txt server daar vind je een link "/axwvomjwjumjwq" als je daar naartoe gaat kom je op een pagina met een gif van een salade dit is een subtiele hint wat je moet doen. De link die je hebt gekregen in de robots.txt in encoded via ceasar cipher als je deze ontcijfert. Vandaar de "ceasar" salade. eens je dit ontcijfert hebt kom je op "/spongebobmeboi" op deze pagina vind je het geheime recept van de krab burger en heb je de challenge voltooid.

### 2. XSS attack
Als je op de webshop komt heb je een zoekbalk om te zoeken naar producten. Hier kan je iets ingeven dat ervoor zorgt dat je een javascript alert krijgt. bv <img%20src=""%20onerror="javascript:alert(1)">

### 3. Exif tool secret
op de landing page voor je de shop binnenkomt heb je een foto van een honeypot. als je deze foto door een exif tool haalt krijg een link die leidt naar een pagina met winniethepooh, /winniethepooh

### 4. /admin password file
Voor deze challenge moet een een passwoord file vinden die in de map /admin staat je kan dus naar /admin/.passwd gaan om deze file te openen. hier vind je onderaan een email adres van jill@honeypot.com en het passwoord Vitalik12398705 dit kan je gebruiken om in to loggen op de webshop als administrator. 

### 5. Broken access
Users hebben de mogelijkheid om hun account te zien en editen maar enkel hun acount. Wanneer een persoon dat geen admin is probeert toegang te krijgen tot een ander account zal die een 'under construction' scherm zien. Op dit scherm zit een button verstopt. Als ze hier op klikken gaan ze naar een nep dashboard met een 'glitched' user als ze hier op show klikken zullen ze de gegevens van 'marget.barbra@honeypot.com vinden met wachtwoord 'DropTable123'. Als ze hier mee inloggen en het account proberen te te tonen of editen hebben ze de challange gecomplete.
