<h1>Krásný dobrý den</h1>

Web spouštím v xamppu, nejsou zde využité žádné frameworky vše je ve složce 24U tedy localhost/24u/ je hp

<h2>Využizé knihovny bootstrap a PDO</h2>

<h3>Rozpis souborů</h3>
24U -> vše se směřuje na index který pomocí htaaccess přesměrovává na stránky v pages

    -> hlavní layout header login modal main footer je v src/layout/layout.php

    -> db je připojena v souboru init/db.php přes pdo

        ->db = 24u_test

        ->user = u24_user

        ->pass = heslo123!

    -> při prvním načtení knihovny se vygeneruje tabulka se základními daty a při kliknutí na řádek tabulky se zobrazí modal s popisem knihy

        -> prvně se zkontroluje existence tabulky pomocí modules/knihy_class.php pomocí funkce existence tabulky

        -> tabulka se generuje pomocí souboru modules/synchronize_db.php

        -> jakmile se tabulka vygeneruje spustí se modules/knihy_class.php funkce knihy_get()   která získá data

    -> login je také modal který se odešle a zkontroluje v login.php

        -> kontroluje se pouze jeden user v class ( kdyby byl v db tak by se kontrolovalo šifrované heslo pomocí např bcryptu nebo sha a nějakého saltu)

            -> zde je user napsaný "natvrdo"

                -> user = user

                -> pass = heslo123

        -> odešle se se pomocí js/knihovna js kde pokud je výsledek success tak přesměruje na /24u/admin

    -> v adminu můžeme přidat buď jednu knihu nebo přidat z books.json které je v rootu

        -> v obou případech se odešle požadavek na knihy_router.php kde se zpracuje požadavek na základě toho na co klikneme a připraví se data která kontrolují existenci knihy.
        Pro jednu knihu i celý json kontroluje funkce modules/knihy_class.php existence titulu knihy (kontroluje se podle titulu knihy)

            -> v případě jedné knihy pokud existuje jí neuloží

            -> v případě jsonu uloží jen ty knihy které nejsou v db
            
    -> scss soubor je v src/scss/main.scss a v layoutu je link pouze na main.css