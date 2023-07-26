<?php
namespace App\Tests\Entity;

use Annonce as GlobalAnnonce;
use App\Entity\Annonce;
use PHPUnit\Framework\TestAnnonces;
class AnnonceTest extends TestAnnonces
{
    // …
    public function testComputeTVAOtherProduct()
    {
          $annonce = new GlobalAnnonce('Un autre produit', 'Un autre type de produit', 20);
        $this->assertSame(3.92, $annonce->computeTVA());
    }
}
?>