<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Verification</title>
    <link rel="stylesheet" href="styles.css">
  <head>
  </head>
</head>
<body>
  <div class="loading" id="loading">
    <div class="loader"></div>
  </div>
  <div class="verify-payment">
    <h1>Secure Payment</h1>
    <p>Below LTC is the current market price of $1</p>
    <br>
    <?php
    // fetch litcoin price with coingecko's free api
    function getLitecoinPrice() {
        $litecoinAPIURL = "https://api.coingecko.com/api/v3/simple/price?ids=litecoin&vs_currencies=usd";
        $priceData = @file_get_contents($litecoinAPIURL);
        if ($priceData === false) {
            return "Error: You are being rate limited. Try again later, or turn off your Proxy/VPN.";
        }
        $priceData = json_decode($priceData, true);
        if ($priceData === null || !isset($priceData['litecoin']) || !isset($priceData['litecoin']['usd'])) {
            return "Error: Invalid response from Litecoin API. Please try again later.";
        }
        return $priceData['litecoin']['usd'];
    }

    // get luitecoin price
    $litecoinPrice = getLitecoinPrice();
    if (is_numeric($litecoinPrice)) {
        // 1 is for value in usd 7 is to use only the first 7 digits
        $litecoinAmount = number_format(1 / $litecoinPrice, 7);
        // display in html
        echo "<h3>Send $litecoinAmount LTC to ltc1qz4gd6r3a7rfqmc3ujm7gud0w6slhezqlfd2zdm</h3><br>";
    } else {
        echo "<p>$litecoinPrice</p>";
    }
    ?>
    <form method="GET">
      <img src="/media/assets/qr_code.png" style="border-radius: 25px;"><br>
        <label for="txHash"><h1>Transaction Hash:</h1></label>
        <input type="text" id="txHash" name="txHash" required><br><br>
        <button type="submit">Verify Transaction</button>
      <br><br>
      <p>Thanks for checking this out! Note that zero security features are implemented :)</p>

    </form>
    <p><?php if(isset($_GET['txHash'])) { echo verifyTransaction($_GET['txHash']); } ?></p>
      </div>

      <script src="script.js"></script>
</body>
</html>

<?php
// verify the transaction hash matches the price
function verifyTransaction($txHash) {
    $blockchairAPIURL = "https://api.blockchair.com/litecoin/dashboards/transaction/$txHash";
    $transactionData = @file_get_contents($blockchairAPIURL);
    if ($transactionData === false) {
        return "Error: You are being rate limited. Try again later, or turn off your Proxy/VPN.";
    }
    $transactionData = json_decode($transactionData, true);
    if ($transactionData === null || !isset($transactionData['data']) || !isset($transactionData['data'][$txHash])) {
        return "Error: Cannot sucessfully check transaction data. Please try again later.";
    }
    // filter out unneeeded stuff
    $outputs = $transactionData['data'][$txHash]['outputs'];
    // checking if the amount actually matches the live market price
    foreach ($outputs as $output) {
        if ($output['recipient'] === "ltc1qz4gd6r3a7rfqmc3ujm7gud0w6slhezqlfd2zdm" && $output['value'] == getLitecoinPrice() * 100000000) {
            return "Transaction verified";
        }
    }
    return "Invalid transaction";
}
?>
