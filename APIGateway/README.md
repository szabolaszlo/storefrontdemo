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

## Implementáció
A Storefront alkalmazás customer service adaptere lett felkészítve arra, hogy igényeljen az OauthServertől magának Client Credential Grant alkalmazásával egy JWT access tokent, melyet a API Gateway customer proxy végpontja az oauth serverre ellenőriztet.

A működés:
Egy reverse proxyként működik ez a szerver.
A szerver figyeli, hogy a hívott url-ben, ami hozzá érkezik, a host után mi áll:
- /customer/
- /newsletter/ TODO: a Storefront NewsletterService majd kell hogy használja

Majd a megfelelő upstreamre irányítunk.
Közben a /customer/ végponton átmenő forgalomnál csinálunk egy sub reqestet, amely az OauthServerrel validáltatja a tokent. Ha okés, tovább engedi a customer_api felé a hívást.

Ezt olvas el a jobb megértés érdekében: https://www.nginx.com/blog/validating-oauth-2-0-access-tokens-nginx/


