# hack
hack matf

sajt je online na: http://hack.madjionicarskitrikovi.com/

###Korisne stvari

####GENERAL
 - ne pise se link:
__/skripta.php?a=1&b=2__
nego:
__/skripta/a/1/b/2__

 - nije moguce pisati JS direktno u html, nego se mora uvesti JS fajl:
`<script type="javascript/text" src="{JS_DIR}/huehue.js">`

 - jQuery je automatski ucitan prilikom dohvatanja **base.tmp** templejta

 - neka globalno vidljiva varijabla (ista na celom serveru, za sve klijente),
se moze napraviti tako sto se u __/app/config.json__ ubaci jos jedna linija

####DB
`DB::Query( "..." )`
izvrsava query u bazi i vraca rez

####Session
`Session::Login(email,pass)`
loguje se

`Session::Logout()`
izloguje se

`Session::GetData()`
vraca niz sa podacima (`['email']` i `['pass']` polja dostupna)

####Request
`Request::GotoAddress(adr)`
ide na adresu zadatu

####Template
`Template::load('naziv')`
ucitava view

`->get()`
dohvata parsiran tekst view-a

`->render()`
prikazuje tekst ( `echo template->get();` )