# Oauth Server

Egy önálló authorizációs szerver OAuth 2.0 alapokon.
Két package-re támaszkodik a projekt:

Az egyik https://oauth2.thephpleague.com/, ami a szerver üzemeltetéséért, alap logikáiért felelős.

Itt érdemes megismerkedni a grant type-okkal, amivel kikérhető egy access token.

A másik maga a symfony-s integráció.
https://github.com/thephpleague/oauth2-server-bundle

Érdemes átnézni ezeket.

## Telepítés
Felhívom itt a figyelmed, hogy ez egy Alpine linuxszal fut, tehát picit másabb mint az ubuntu
A jogosultság kezelés nem a legjobb: TODO helyre rakni

A bundle tartalmazza a szükséges táblákat, amiket létre kell hoznod

Futtatnod kell ezt a parancsot a containeren belül:

```docker exec -it oauth_server_nginx_php /bin/sh```



majd ```bin/console doctrine:schema:update --force``` a projekt mappában

Nem mélyedtem bele az alpine-ba, de az a workaorund, hogy:

- a Dockerfile-ba kikomizod a ```USER nobody``` sort
- újra buildeled a projektet
- belépsz és lefuttatod a táblák kreálássát
- Visszarakod ```USER nobody``` sort
- Újrabuildelsz.

Azért csináljuk h a root jogsi megmaradjon, de ezt akinek van affinitása, megcsinálhatná

Ha ez megvan, mind1, hogy hol, de futtasd le a ```bash keygen.sh``` parancsot, hogy legyen private és public key-ed a jwt token generálásához.

Két alap route van ami elérhető:
- /token
- /authorize

illetve van egy saját amit az API Gateway használ a tokenek validálására:

- /token/validate TODO: erre rakni kell vmi védelmet


