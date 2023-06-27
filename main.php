<?php
$apiKey = 'YOUR_API_KEY'; // Your Exchange Rates API key
$baseCurrency = 'EUR'; // Base currency for conversion
$targetCurrencies = ['XAU', 'GBP', 'USD', 'JPY', 'CAD', 'CHF', 'AUD']; // Array of target currencies to fetch rates for

$url = "https://api.exchangeratesapi.io/v1/latest?access_key=$apiKey&base=$baseCurrency&symbols=" . implode(',', $targetCurrencies); // If You Are Using Free Api Use Http Instead of Https

$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data && isset($data['rates'])) {
    $rates = $data['rates'];

    echo '<ul>';

    foreach ($rates as $currency => $rate) {
        echo '<li>';
        echo $currency . $baseCurrency . ' <span class="';

        // Check if the rate is greater than 1 to determine the label color
        if ($rate > 1) {
            echo ' success"><i class="fas fa-caret-up"></i>'; // Green label for rate increase
        } else {
            echo ' danger"><i class="fas fa-caret-down"></i>'; // Red label for rate decrease
        }

        echo ' ' . $rate . ' (' . number_format(($rate - 1) * 100, 2) . '%)</span>'; // Display rate and percentage change
        echo '</li>';
    }

    echo '</ul>';
} else {
    echo 'Failed to fetch rates.'; // Display error message if rates couldn't be fetched
}
?>
