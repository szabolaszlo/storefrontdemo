curl --header "Content-Type: application/json"   --request POST   --data '{"firstname":"xyz","password":"xyz","lastname":"dddd","email":"ddd","newsletter":"true"}'   http://localhost/api/registration

meg kell csinálni a customers db-t

1, azért registration az usecase neve mert nem csak felhasználót hozunk létre hannem feliratkozást is. A commandoknak általában aszinkron és szinkron módon is tudnia kell futni ezért általánosságban elmondható hogy oda kell filgyelni hogy milvel térnek vissza hosszu feladatoknál valami queue id-t kellene visszaadniuk, de mivel itt a kliens szinkron ettől eltekinthetünk és ezért a bus használata sem kötelező. Domain objektumot azonban sosem adhatnak vissza mert akkor lehetőség lenne arra hogy egy külső réteg közvetlenül kommunikáljon a domainnel.
A response objektumok tartalma gyakorlatilag a frontend backend szétválasztás ez az interface amit használhat a sablon