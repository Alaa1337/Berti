<?php


$variables = [


    'start' => '<div>Melde dich an oder registriere dich jetzt um fortzufahren.</div>',

    'login' => '<form  method="post" >
                                    <div class="form-group text-center" ">
                                        <label for="exampleInputEmail1">E-mail-Addresse</label>
                                        <input type="email" class="form-control" name="loginmail" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-mail-Adresse">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Passwort</label>
                                        <input type="password" name="loginpassword" class="form-control" id="exampleInputPassword1" placeholder="Passwort">
                                       <!-- <button class="btn col"> Passwort vergessen</button>!-->
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Bestätigen</label>
                                    </div>
                                    <button type="submit" id="loginbutton" class="col btn btn-group-lg" name="loginbutton" value="loginbutton">Submit</button>
                                </form>',
    'register' => ' <form method="post" >
                                    <div class="form-group">
                                        <label >Fülle bitte alle Felder aus.</label>
                                        <div class="form-row">

                                            <div class="col">
                                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First name">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">E-mail-Addresse</label>
                                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-mail-Adresse">
                                    </div>
                                    <div class="form-group">
                                        <label >Passwort</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Passwort">
                                    </div>
                                    <div class="form-group">
                                        <label >Passwort Wiederholen</label>
                                        <input type="password" class="form-control" placeholder="Passwort">
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Bestätigen</label>
                                    </div>
                                    <button type="submit" id="registerbutton" class="col btn btn-group-lg" name="registerbutton" value="registerbutton">Submit</button>
                                </form>',


    'impressum' => '<div class="responsivetext"><pre>
Angaben gemäß § 5 TMG:
itspoon GmbH
Flugplatzstr. 111
90768 Fürth


Vertreten durch:
Geschäftsführer Dipl.-Betriebswirt Margus Kohv


Kontakt:
Telefon: +49 911 97 91 31 07
Telefax: +49 911 97 91 31 09
E-Mail: info@itspoon.com


Registereintrag:
Eintragung im Handelsregister.
Registergericht:Fürth
Registernummer: HRB 16085


Umsatzsteuer:
Umsatzsteuer-Identifikationsnummer gemäß §27 a Umsatzsteuergesetz:
DE311062253


</pre> </div>',

    'datenschutz' => '<div class="responsivetext text-justify "><pre>
Die Betreiber dieser Seiten nehmen den Schutz Ihrer persönlichen Daten sehr ernst. 
Wir behandeln Ihre personenbezogenen Daten vertraulich und entsprechend der gesetz-
lichen Datenschutzvorschriften sowie dieser Datenschutzerklärung.

Die Nutzung unserer Webseite ist in der Regel ohne Angabe personenbezogener Daten möglich. 
Soweit auf unseren Seiten personenbezogene Daten 
(beispielsweise Name, Anschrift oder E-Mail-Adressen) 
erhoben werden, erfolgt dies, soweit möglich, stets auf freiwilliger Basis. 
Diese Daten werden ohne Ihre ausdrückliche Zustimmung nicht an Dritte weitergegeben.

Wir weisen darauf hin, dass die Datenübertragung im Internet 
(z.B. bei der Kommunikation per E-Mail) 
Sicherheitslücken aufweisen kann. 
Ein lückenloser Schutz der Daten vor dem Zugriff durch Dritte ist nicht möglich. 

<h1 class="text-center" >Cookies</h1>

Die Internetseiten verwenden teilweise so genannte Cookies.
Cookies richten auf Ihrem Rechner keinen Schaden an und enthalten keine Viren. 
Cookies dienen dazu, unser Angebot nutzerfreundlicher, effektiver und sicherer zu machen. 
Cookies sind kleine Textdateien, die auf Ihrem Rechner 
abgelegt werden und die Ihr Browser speichert.

Die meisten der von uns verwendeten Cookies sind so genannte „Session-Cookies“. 
Sie werden nach Ende Ihres Besuchs automatisch gelöscht. 
Andere Cookies bleiben auf Ihrem Endgerät gespeichert, bis Sie diese löschen. 
Diese Cookies ermöglichen es uns, Ihren Browser beim nächsten Besuch wiederzuerkennen.

Sie können Ihren Browser so einstellen, dass Sie über das Setzen von Cookies
informiert werden und Cookies nur im Einzelfall erlauben, 
die Annahme von Cookies für bestimmte Fälle oder generell ausschließen 
sowie das automatische Löschen 
der Cookies beim Schließen des Browser aktivieren. 
Bei der Deaktivierung von Cookies kann die Funktionalität dieser Website eingeschränkt sein.</pre></div>',


];


if (isset($_SESSION['logged_in'])) {

    $variables = [


        'start' => '<div>Willkommen '.$_SESSION['user']['firstname'].'</div>',
        'berichtsheft' => '<div>Willkommen '.$_SESSION['user']['firstname'].' '.$_SESSION['user']['lastname'].'</div>',



        'settings' => '
         <div class="row" >
            <div class="col text-center">
                <a href="?page=delete" name="deletebtn" id="deletebtn" class="col btn btn-group-lg button-8">ACCOUNT LÖSCHEN</a>
            </div>
         </div>',


        'impressum' => '<div class="responsivetext"><pre>
Angaben gemäß § 5 TMG:
itspoon GmbH
Flugplatzstr. 111
90768 Fürth


Vertreten durch:
Geschäftsführer Dipl.-Betriebswirt Margus Kohv


Kontakt:
Telefon: +49 911 97 91 31 07
Telefax: +49 911 97 91 31 09
E-Mail: info@itspoon.com


Registereintrag:
Eintragung im Handelsregister.
Registergericht:Fürth
Registernummer: HRB 16085


Umsatzsteuer:
Umsatzsteuer-Identifikationsnummer gemäß §27 a Umsatzsteuergesetz:
DE311062253


</pre> </div>',
        'datenschutz' => '<div class="responsivetext text-justify "><pre>
Die Betreiber dieser Seiten nehmen den Schutz Ihrer persönlichen Daten sehr ernst. 
Wir behandeln Ihre personenbezogenen Daten vertraulich und entsprechend der gesetz-
lichen Datenschutzvorschriften sowie dieser Datenschutzerklärung.

Die Nutzung unserer Webseite ist in der Regel ohne Angabe personenbezogener Daten möglich. 
Soweit auf unseren Seiten personenbezogene Daten 
(beispielsweise Name, Anschrift oder E-Mail-Adressen) 
erhoben werden, erfolgt dies, soweit möglich, stets auf freiwilliger Basis. 
Diese Daten werden ohne Ihre ausdrückliche Zustimmung nicht an Dritte weitergegeben.

Wir weisen darauf hin, dass die Datenübertragung im Internet 
(z.B. bei der Kommunikation per E-Mail) 
Sicherheitslücken aufweisen kann. 
Ein lückenloser Schutz der Daten vor dem Zugriff durch Dritte ist nicht möglich. 

<h1 class="text-center" >Cookies</h1>

Die Internetseiten verwenden teilweise so genannte Cookies.
Cookies richten auf Ihrem Rechner keinen Schaden an und enthalten keine Viren. 
Cookies dienen dazu, unser Angebot nutzerfreundlicher, effektiver und sicherer zu machen. 
Cookies sind kleine Textdateien, die auf Ihrem Rechner 
abgelegt werden und die Ihr Browser speichert.

Die meisten der von uns verwendeten Cookies sind so genannte „Session-Cookies“. 
Sie werden nach Ende Ihres Besuchs automatisch gelöscht. 
Andere Cookies bleiben auf Ihrem Endgerät gespeichert, bis Sie diese löschen. 
Diese Cookies ermöglichen es uns, Ihren Browser beim nächsten Besuch wiederzuerkennen.

Sie können Ihren Browser so einstellen, dass Sie über das Setzen von Cookies
informiert werden und Cookies nur im Einzelfall erlauben, 
die Annahme von Cookies für bestimmte Fälle oder generell ausschließen 
sowie das automatische Löschen 
der Cookies beim Schließen des Browser aktivieren. 
Bei der Deaktivierung von Cookies kann die Funktionalität dieser Website eingeschränkt sein.</pre></div>',


    ];


}



