
<?php require_once 'vendor/autoload.php';
//use Spipu\Html2Pdf\Html2Pdf;
//if(!empty($_POST["ville"]))
{
	//$ville = htmlspecialchars($_POST["ville"]);

$html2pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4', 'fr');
$html = "
<body>
    <form method=post action=ajoute_annonce.php>
        Titre : 
        <input type=text name=formtitre><br>
        Texte :<textarea cols=40 rows=6 name=formtexte>Texte de l'annonce ici</textarea><br>
        Catégorie : <input type=text name=formcategorie><br>
        Prix : <input type=text name=formprix> €<br>
        Achat ou vente : <select name=formachatvente>...</select><br>
        <input type=submit name=ajoute_annonce value=Ajouter>
        </form>
</body>
</html>
";
$html2pdf->writeHTML($html);
$html2pdf->output('pdf.php');
}
?>