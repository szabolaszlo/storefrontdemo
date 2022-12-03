Az API gateway egy egységes felületet biztosít a különböző apik számára hogy a klienseknek ne kelljen ismerni az apik végpontjait.
Ebben a rétegben authentikáljuk a hívásokat, valamint a verziózás is itt oldható meg.
A kilönböző klienseknek készíthetünk külön API-kat is.
Külön jogosultságokhoz közhetjük a végpontok használatát (pl admin storefront) A jelen példában nincs értelme de lehet olyan scenárió amiko egy ms külön admin és publikus apit biztosít egy egy műveletre amit mondjuk a storefront nem használ ilyenkor viszont ezt ki lehet itt engedni.

| Kliens átalá használt  | Belső |
| ------------- | ------------- |
| http://localhost/api/admin/newsletter | http://localhost:8082/api/subscribers  |
| http://localhost/api/admin/customer  | http://localhost:8081/api/customers  |
| http://localhost/api/storefront/registration  | http://localhost/api/registration  |


## Verziózás

Készíthetünk új végpontokat a meglévők mellé

| Kliens átalá használt  | Belső |
| ------------- | ------------- |
| http://localhost/api/newsletter | http://localhost:8082/api/subscribers  |
| http://localhost/api/2.0/newsletter | http://localhost:8082/api/new_subscribers  |



## Authentication 
TODO
