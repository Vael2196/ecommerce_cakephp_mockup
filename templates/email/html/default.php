<?php
/**
 * @var Product $product
 */

use App\Model\Entity\Product;
?>

<p style="color: black;">To whom it concerns,</p>
<p style="color: black;">
    The product:<br>
    <strong style="color: black;"><?= h($product->product_name) ?></strong> is low on stock.
</p>
<p style="color: black;">Only <strong><?= h($product->quantity) ?></strong> units remain.</p>
<p style="color: black;">Please restock as soon as possible.</p>
<p style="color: black;">Any queries, please reach out via mobile or directly to crunchy_cravings@u25s1076.iedev.org</p>
<p style="color: black;">Kind Regards,</p>
<p style="color: black;">Merchandise Manager</p>
<p style="color: black;">Mobile: 0400335512</p>
<p style="color: black;">CrunchyCravings</p>
