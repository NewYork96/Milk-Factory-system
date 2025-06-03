Ez a projekt egy Laravel-alapú tejüzemi nyilvántartó rendszer, amelyet szakdolgozatként készítettem. A cél egy olyan alkalmazás létrehozása volt, amely hatékonyan kezeli a tejüzem működéséhez kapcsolódó adatokat és folyamatokat.

Főbb jellemzők:
-Termékek, beszállítók és készletek kezelése
-Felhasználói jogosultságok és szerepkörök
-Átlátható adminisztrációs felület

Technológiák:
-Laravel 8
-MySQL
-Blade sablonmotor
-Boostrap

Telepítés:
-Készíts egy .env fájlt a .env.example alapján, és állítsd be az adatbázis kapcsolatot.
-Futtasd a composer install parancsot a függőségek telepítéséhez.
-Generálj alkalmazáskulcsot: php artisan key:generate.
-Futtasd a migrációkat: php artisan migrate.
-Indítsd el a szervert: php artisan serve
