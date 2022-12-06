Storefront réteg célja hogy összekösse a különböző microservicek működését egy adott kliens számára (böngésző server side rendering)

##Notes
-  azért registration az usecase neve (és nem create customer) mert nem csak felhasználót hozunk létre hannem feliratkozást is. 
- A commandoknak általában aszinkron és szinkron módon is tudnia kell futni ezért általánosságban elmondható hogy oda kell filgyelni hogy milvel térnek vissza hosszu feladatoknál valami queue id-t kellene visszaadniuk, de mivel itt a kliens szinkron ettől eltekinthetünk és ezért a bus használata sem kötelező. 
- Domain objektumot azonban sosem adhatnak vissza mert akkor lehetőség lenne arra hogy egy külső réteg közvetlenül kommunikáljon a domainnel.
- A response objektumok tartalma gyakorlatilag a frontend backend szétválasztás ez az interface amit használhat a sablon
- Állapotot (cookie,session stb) csak a controller réteg tartalmazhat a töbi stateless.
- Nincs saját adatbázis semmilyen adatot nem own-ol ez a réteg maximum cacheli az ms-ek adatait.
- A queuet max szinkronra használjuk vagy olyan helyen ahol nem fontos az hogy mikor kapunk választ