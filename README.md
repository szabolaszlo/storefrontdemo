## Projekt célja
A egy adott business igény megvalósításának bemutatása microservice környezetben.

## Business igény
A rendszerbe lehessen regisztrálni és lehessen hírlevél feliratkozókat nyilvántartani. Ha valaki regisztrál,
egy kapcsolóval tudja megadni hogy egyben a hírlevélre is szeretne feliratkozni vagy sem.
A regisztráció után elérhető felhasználói adatokat listázó oldalon legyen kiírva hogy feliratkozott e az adott felhasználó a hírlevélre vagy sem.


## Beállítás
- docker-compose up -d
- lépj be a phpmyadminba (http://localhost:8080) root jogosultsággal! (usern: root, password: root)
- importáld be a db.sql-t
- docker-compose down
- docker-compose up -d

## Urlek:
http://localhost - Storefront frontend
http://localhost/api/registration - Storefront frontend regisztráció api
http://localhost:5000 - Admin microfrontend shell
http://localhost:8081/api/customers - Customers microservice api
http://localhost:5002/app.js - Customers Admin microfrontend app
http://localhost:8082/api/subscribers - Newsletter microservice Api
http://localhost:5002/app.js - Newsletter Admin microfrontend app

## Storefront api call
curl --header "Content-Type: application/json"   --request POST   --data '{"firstname":"xyz","password":"xyz","lastname":"dddd","email":"ddd","newsletter":"true"}'   http://localhost/api/registration


