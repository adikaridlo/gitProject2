
<html>
<div id="showBarcode">
	
</div>

</html>
<?php

use barcode\barcode\BarcodeGenerator as BarcodeGenerator;
 
$optionsArray = array(
'elementId'=> 'showBarcode',
'value'=> '4797001018719',
'type'=>'ean13',
 
);
echo BarcodeGenerator::widget($optionsArray);
?>
