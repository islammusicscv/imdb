<?php 
include_once 'header.php';
include_once 'db.php';

$id = (int) $_GET['id'];



?>

<div class="film">
    <div class="film-slike">
        <img src="https://images-na.ssl-images-amazon.com/images/I/7124A8OOL6L._AC_SL1001_.jpg" alt="slika" />
    </div>
    <div class="film-podatki">
        <div class="naslov">Terminator</div>
        <div class="zanri">Akcija | Triler</div>
        <div class="leto">1984</div>
        <div class="dolzina">1 h 47 min</div>
        <div class="ocena"> * * * * *</div>
        <div class="opis">Schwarzenegger v filmu igra Terminatorja, morilskega kiborga, ki je poslan nazaj v času iz leta 2029 da bi ubil Sarah Connor (Hamilton). Njen še nerojeni sin John Connor naj bi po katastrofalni jedrski vojni v prihodnosti vodil upore proti inteligentnim strojem. Za Terminatorjem pa v preteklost pride tudi Kyle Reese (Biehn), ki mora zaščititi Sarah Connor, da bo lahko nekoč rodila sina.

Nepričakovani komercialni uspeh filma je bil odskočna deska za režisersko kariero takrat še neuveljavljenega Camerona, hkrati pa je utrdil Schwarzeneggerjev sloves zvezde akcijskih filmov.</div>
    </div>
</div>
<div class="igralci">
    <div class="igralec">
        <img src="https://res.cloudinary.com/du1efakdk/image/upload/c_fill,f_auto,h_414,q_auto,w_280/v1617012871/kftv/nig1dtun8ug4gsx1td4n.jpg" alt="igralec" />
        <div class="igralec-podatki">
            <div>Van Diesel (Jože Novak)</div>            
        </div>
    </div>
    <div class="igralec">
        <img src="https://res.cloudinary.com/du1efakdk/image/upload/c_fill,f_auto,h_414,q_auto,w_280/v1617012871/kftv/nig1dtun8ug4gsx1td4n.jpg" alt="igralec" />
        <div class="igralec-podatki">
            <div>Van Diesel (Jože Novak)</div>            
        </div>
    </div>
</div>
<div class="komentarji">
    <form action="comment_insert.php" method="post">
        <textarea name="content" class="form-control" placeholder="Vnesi komentar"></textarea><br />
        <input type="submit" value="Pošlji" class="btn btn-primary" />
    </form>
    <div class="komentarji-prikaz">
        <div class="komentar">
            <div class="komentar-podatki">
                Goraz Žižek (25. 4. 2021 @ 13:24)
            </div>
            <div>To je najjači film ever. Priporočam ogled. </div>
        </div>
        <div class="komentar">
            <div class="komentar-podatki">
                Goraz Žižek (25. 4. 2021 @ 13:24)
            </div>
            <div>To je najjači film ever. Priporočam ogled. </div>
        </div>
        <div class="komentar">
            <div class="komentar-podatki">
                Goraz Žižek (25. 4. 2021 @ 13:24)
            </div>
            <div>To je najjači film ever. Priporočam ogled. </div>
        </div>
        <div class="komentar">
            <div class="komentar-podatki">
                Goraz Žižek (25. 4. 2021 @ 13:24)
            </div>
            <div>To je najjači film ever. Priporočam ogled. </div>
        </div>
        <div class="komentar">
            <div class="komentar-podatki">
                Goraz Žižek (25. 4. 2021 @ 13:24)
            </div>
            <div>To je najjači film ever. Priporočam ogled. </div>
        </div>
    </div>
</div>



<?php 
include_once 'footer.php';
?>