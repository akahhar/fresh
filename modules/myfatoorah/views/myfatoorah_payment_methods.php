<div class="row">
<?php echo '<pre>';
print_r($PaymentMethods);
echo '</pre>';
//exit();
foreach($PaymentMethods as $val){
?>

<div class="col-sm-3"> <a href=""><img src="<?php echo $val->ImageUrl;?>" alt="<?php echo $val->PaymentMethodEn;  ?>" >  </a> </div>

<?php
}
?>



</div>