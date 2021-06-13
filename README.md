# Fakebook

Socialinio tinklo sistema, skirta dalintis informacija. Vartotojams, besinaudojantiems sistema, leidžiama įkelti pranešimą (post), jį redaguoti, ištrinti, komentuoti ir pamėgti (like).

## Paleidimas ir naudojimas

Norėdami sistemą paleisti lokaliai per XAMPP, parsisiųskite kodą (Github - Code - Download ZIP), išskleiskite ir Fakebook-main aplanką patalpinkite xampp/htdocs aplanke. Per XAMPP Control Panel įjunkite (start) Apache ir MySQL serverius. Naudodami phpMyAdmin įrankį (XAMPP Control Panel - MySQL - Admin arba http://localhost/phpmyadmin/), sukurkite duomenų bazę (New) pavadinimu **fakebook** ir į ją įkelkite (Import) fakebook.sql failą iš Fakebook-main aplanko. Sistemą pasieksite per naršyklę adresu http://localhost/Fakebook-main

Esami vartotojai:
* Vartotojo vardas BigDaddy, slaptažodis abcd1234
* Vartotojo vardas SomeBeans, slaptažodis aaaa1111
* Vartotojo vardas Munchkin, slaptažodis mmmm1111

Prisijungę matysite visus sistemoje esančius įrašus, galėsite juos pamėgti ir pakomentuoti, kurti naujus įrašus, pasidalindami tekstu ir nuotrauka, taip pat redaguoti ir ištrinti savo įrašus. Sistemoje yra galimybė ieškoti įrašų pagal vartotojo vardą ar įrašo turinį.

### Reikalavimai

Puslapyje naudojamas Bootstrap 5 yra palaikomas visų pagrindinių naršyklių naujausių stabilių versijų. Tikslų sąrašą rasite [čia](https://github.com/twbs/bootstrap/blob/v5.0.0-beta3/.browserslistrc).

### Technologijos

* HTML5
* CSS3
* PHP
* JavaScript
* Bootstrap

### Versijavimas

Kodo versijavimui naudotas [Github](https://github.com/). Visą kodą galite rasti [čia](https://github.com/teramigle/Fakebook).


### Autoriai

Sistemą sukūrė Vilniaus technologijų mokymo centro Žiniatinklio programuotojo mokymo programos ŽP-20/4 grupės mokinė Miglė Jakubkaitė.
