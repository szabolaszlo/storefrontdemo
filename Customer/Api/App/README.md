A customer api egy végpontjain access_token vizsgálat van, ami a Storefront alkalmazásból jön.
Előfeltétele a működésnek, hogy a OauthServer be legyen lőve és az API Gateway működjön.
Ha ez adott, kérlek, ebbe a mappába hozz létre egy 'keys' mappát, amibe az OauthServer/App/config/jwt/public.pem fájl lemásolod!

TODO a jwks végpontot meg kell csin az OauthServeren és azzal validálni, mert ez gatyi megoldás

## Az alkalmazás célja
Az alkalmazás tartja nyilván a vásárlókat.
Egy vásárlóról tudnunk kell:
-email
-keresztnév
-vezetéknév
-jelszó


## Notes
Azért nem ide mentjük a newsletter id-t mert akkor zavaros lenne ha kitörlöm az id-t akkor megszűnik a feliratkozás is?  valamint akkor először a feliratkozást kellene elmenteni de ahoz meg kellene a customerid
Ki fogja használni ezt az adatot? a hírlevél ms a dobozhoz valamint a szegmentáláshoz tehát ő a tulajdonosa elsősorban


