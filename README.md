# WebShop Demo

Ovaj projekt predstavlja jednostavan PHP/MySQL web shop. Kod je 
organiziran kroz nekoliko mapa i datoteka koje služe za prikaz 
početne stranice, administraciju i korisničke funkcionalnosti poput 
košarice ili liste želja.

## Struktura projekta

### Korijenski PHP fajlovi
- **index.php** – početna stranica s novostima i izdvojenim artiklima.
- **about.php** – statična stranica s informacijama o trgovini.
- **contact.php** – kontakt forma i Google karta.
- **news.php** – prikaz novosti.
- **category.php** – popis proizvoda unutar odabrane kategorije.
- **login.php** – prijava i registracija korisnika.
- **logout.php** – odjava korisnika.
- **profil.php** – uređivanje korisničkog profila.
- **kosarica.php** – pregled i potvrda narudžbe.
- **lista-zelja.php** – pregled korisničke liste želja.
- **dostava.php** – praćenje poslanih narudžbi.
- **recenzije.php** – unos i pregled recenzija.
- **add_to_cart.php** / **remove_from_cart.php** – dodavanje i uklanjanje proizvoda iz košarice.
- **add_to_wishlist.php** – dodavanje artikla na listu želja.

### Elementi (dijeljeni dijelovi stranice)
- **elementi/top-header.php** – gornja traka s login linkovima.
- **elementi/main-header.php** – logo, tražilica i ikona košarice.
- **elementi/nav.php** – navigacija kroz kategorije.
- **elementi/aside.php** – bočna traka s brojačem posjeta i dodatnim informacijama.
- **elementi/footer.php** – podnožje stranice.

### Admin dio
- **admin/login.php** – prijava administratora.
- **admin/logout.php** – odjava administratora.
- **admin/panel.php** – kontrolna ploča za upravljanje narudžbama, kategorijama, proizvodima, korisnicima i recenzijama.
- **admin/save_kat.php** / **admin/delete_kat.php** – dodavanje i brisanje kategorija.
- **admin/save_prod.php** / **admin/delete_prod.php** – dodavanje i brisanje proizvoda te spremanje slika.
- **admin/save_user.php** / **admin/delete_user.php** – upravljanje korisničkim računima.
- **admin/save_review.php** / **admin/delete_review.php** – upravljanje recenzijama.

### Ostalo
- **config/config.php** – spajanje na bazu i pokretanje sesije.
- Mapa **css**, **js** i **slike** sadrže statičke datoteke (stilovi, skripte i slike).

## Pokretanje
1. Kreirati MySQL bazu `webshop` i importirati pripadne tablice
   (u mapi `baza_sql`).
2. U tablicu `admini` dodati administratora:
   ```sql
   INSERT INTO admini (username, pass_hash)
   VALUES ('admin', PASSWORD_HASH('123', PASSWORD_DEFAULT));
   ```
3. Postaviti Apache/Nginx da poslužuje ovu mapu ili koristiti ugrađeni
   PHP server: `php -S localhost:8000`.

Projekt služi kao primjer jednostavne trgovine i ne sadrži napredne
sigurnosne mehanizme te ga treba koristiti samo u edukativne svrhe.