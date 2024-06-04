# DP4-4-MatissSmits-BrivalaikaPavadisanasPortals
## Par projektu

Brīvā laika pavadīšanas portāls ir tīmekļa vietne, kas piedāvā plašu aktivitāšu klāstu, lai palīdzētu lietotājiem atrast un piedalīties dažādās brīvā laika aktivitātēs, piemēram, teikvando un judo treniņos. 
Portāls ir piemērots dažādu vecuma grupu cilvēkiem un piedāvā aktivitātes gan bērniem, gan pieaugušajiem. 

## Funkcijas

Projekts ietver sekojošas galvenās funkcijas:

- **Reģistrācija (register):** Lietotāji var reģistrēties, ievadot savu lietotājvārdu, paroli un e-pasta adresi.
- **Pieteikšanās (login):** Reģistrētie lietotāji var pieteikties, ievadot savu lietotājvārdu vai e-pasta adresi un paroli.
- **Izrakstīšanās (logout):** Lietotāji var izrakstīties no sava konta.
- **Produktu apskate (view products):** Lietotāji var apskatīt pieejamās aktivitātes un produktus ar aprakstiem un cenām.
- **Produktu pievienošana (add products):** Administratori var pievienot jaunus produktus un aktivitātes.
- **Produktu rediģēšana un dzēšana (edit/delete products):** Administratori var rediģēt vai dzēst esošos produktus.
- **Rezervāciju veikšana (make reservation):** Lietotāji var veikt rezervācijas uz pieejamajām aktivitātēm.
- **Rezervāciju apskate (view reservations):** Lietotāji un administratori var apskatīt rezervāciju sarakstu.
- **Rezervāciju pārvaldība (manage reservations):** Administratori var apstiprināt vai noraidīt rezervācijas.

## Projekta mērķi

- Nodrošināt ērtu un efektīvu veidu, kā lietotāji var atrast un rezervēt brīvā laika aktivitātes.
- Piedāvāt plašu aktivitāšu klāstu, kas piemērots dažādu vecuma grupu cilvēkiem.
- Nodrošināt administratoriem rīkus, lai pārvaldītu aktivitātes un lietotāju rezervācijas.

## Tehnoloģijas

Projekts ir izstrādāts, izmantojot sekojošas tehnoloģijas:

- **HTML/CSS/JavaScript:** Lietotāja interfeisa izstrādei.
- **PHP:** Servera puses loģikai un datu apstrādei.
- **Laravel:** PHP ietvars, kas nodrošina strukturētu un efektīvu koda izstrādi.
- **MySQL:** Relāciju datu bāze, kas nodrošina efektīvu datu uzglabāšanu un piekļuvi.
- **React:** JavaScript bibliotēka lietotāja interfeisa komponentiem.

## Datu bāzes struktūra

Projekta datu bāze ietver šādas tabulas:

- **Users:** Satur lietotāju informāciju (ID, vārds, e-pasta adrese, parole, loma).
- **Products:** Satur informāciju par piedāvātajiem produktiem un aktivitātēm (ID, nosaukums, apraksts, cena).
- **Reservations:** Satur informāciju par lietotāju veiktajām rezervācijām (ID, lietotāja ID, produkta ID, rezervācijas datums, statuss).

## Lietošanas piemēri

1. **Reģistrācija:**
   - Lietotājs aizpilda reģistrācijas formu ar lietotājvārdu, paroli un e-pasta adresi.
   - Sistēma validē ievadīto informāciju un nosūta apstiprinājuma e-pastu.

2. **Pieteikšanās:**
   - Lietotājs ievada pieteikšanās informāciju.
   - Sistēma autentificē lietotāju un piešķir piekļuvi kontam.

3. **Produktu pievienošana:**
   - Administrators aizpilda produkta pievienošanas formu.
   - Sistēma validē ievadīto informāciju un saglabā to datu bāzē.

4. **Rezervācijas veikšana:**
   - Lietotājs izvēlas produktu un norāda rezervācijas datumu.
   - Sistēma validē ievadīto informāciju un saglabā rezervāciju datu bāzē.

## Autori

- **Matīss Šmits** - Projekta izstrādātājs
