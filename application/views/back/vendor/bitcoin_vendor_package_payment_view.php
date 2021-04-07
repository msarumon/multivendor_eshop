<form style="display: none" id="bitcoin_form" action="https://www.coinpayments.net/index.php" method="post">
    <input type="hidden" name="cmd" value="_pay_simple">
    <input type="hidden" name="reset" value="1">
    <input type="hidden" name="merchant" value="<?= $bitcoin_coinpayments_merchant?> ">
    <input type="hidden" name="item_name" value="Vendor Package">
    <input type="hidden" name="currency" value="USD">
    <input type="hidden" name="amountf" value="<?= $final_amount?>>">
    <input type="hidden" name="want_shipping" value="0">
    <input type="hidden" name="success_url" value="<?= base_url('vendor/bitcoin_vendor_package_success')?>">
    <input type="hidden" name="cancel_url" value="<?= base_url('vendor/bitcoin_vendor_package_cancel')?>">
    <input type="image" src="https://www.coinpayments.net/images/pub/buynow-grey.png" alt="Buy Now with CoinPayments.net">
</form>

<script>
    document.getElementById("bitcoin_form").submit();
</script>


