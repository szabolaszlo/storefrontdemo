## Projekt célja
A egy adott business igény megvalósításának bemutatása microservice környezetben.

## Business igény
A rendszerbe lehessen regisztrálni és lehessen hírlevél feliratkozókat nyilvántartani. Ha valaki regisztrál,
egy kapcsolóval tudja megadni hogy egyben a hírlevélre is szeretne feliratkozni vagy sem.
A regisztráció után elérhető felhasználói adatokat listázó oldalon legyen kiírva hogy feliratkozott e az adott felhasználó a hírlevélre vagy sem.


## Beállítás
- docker-compose up -d
- lépj be a phpmyadminba (http://localhost:8080) root jogosultsággal! (usern: root, password: root)
- importáld be a db_to_import.sql-t
- docker-compose down
- docker-compose up -d
- lépj be a Symfonyt használó conténerekbe és telepítsd a composer csomagokat:
- docker compose exec -u root cart_api_ngnix_php sh majd composer install majd exit
- docker compose exec -u root oauth_server_ngnix_php sh majd composer install majd exit
- docker compose exec -u root storefront_php sh majd composer install majd exit


## Urlek:
http://localhost - Storefront frontend
http://localhost:5000 - Admin microfrontend shell (acc: sanyi / sanyi)

