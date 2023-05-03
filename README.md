## Projekt célja
A egy adott business igény megvalósításának bemutatása microservice környezetben.

## Business igény
A rendszerbe lehessen regisztrálni és lehessen hírlevél feliratkozókat nyilvántartani. Ha valaki regisztrál,
egy kapcsolóval tudja megadni hogy egyben a hírlevélre is szeretne feliratkozni vagy sem.
A regisztráció után elérhető felhasználói adatokat listázó oldalon legyen kiírva hogy feliratkozott e az adott felhasználó a hírlevélre vagy sem.


## Beállítás
- docker compose up -d
- lépj be a phpmyadminba (http://localhost:8080) root jogosultsággal! (usern: root, password: root)
- importáld be a db_to_import.sql-t
- docker compose down
- docker compose up -d
- lépj be a Symfonyt használó conténerekbe és telepítsd a composer csomagokat:
- docker compose exec -u root cart_api_ngnix_php sh -c "composer install"
- docker compose exec -u root oauth_server_ngnix_php sh -c "composer install"
- docker compose exec -u root storefront_php sh sh -c "composer install"


## Urlek:
http://localhost - Storefront frontend
http://localhost:5000 - Admin microfrontend shell (acc: sanyi / sanyi)

## API Gateway

Minden microservice elé beékelődik az API Gateway, amely egy reverse proxy szerverként működik. A kéréseket továbbítja a megfelelő microservice felé, illetve ellőrizni tudja a JWT tokeneket validitás szempontjából.

**Egyenlőre token authentikáció ki van kapcsolva!**

Külső elérhetőség: http://localhost:8089

Az egyes, API Gateway által proxyzott microservice-ek a következő képpen érhetőek el:

- http://localhost:8089/customer/api/customers
- http://localhost:8089/customer részt figyeli a gateway, és ha a kérés tartalmazza a /customer részt, akkor a customer microservice felé továbbítja a kérést.
- /api/customers pedig már a customer microservice saját elérési útja.

**Fontos!** Ha a kódban szeretnénk az api gatewayen keresztül használni egy microservice-t, akkor azt a következő képpen tegyük:

- http://api_gateway_nginx:8080/customer/api/customers
- dockeres környezet miatt a service azonosítója a host