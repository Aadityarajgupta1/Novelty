<?php
    if(isset($_POST['total_price'])) {
        $total_price = $_POST['total_price'] * 100;
    } else {
        echo "Error: Total price not found";
        exit;
    }

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(array(
            "return_url" => "http://localhost/Work/khalti_payment_success.php",
            "website_url" => "https://example.com/",
            "amount" => $total_price,
            "purchase_order_id" => "Order01",
            "purchase_order_name" => "test",
            "customer_info" => array(
                "name" => "Test Bahadur",
                "email" => "test@khalti.com",
                "phone" => "9800000001"
            )
        )),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Key 7e451173db414ab487eb86d216e79638',
            'Content-Type: application/json',
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    // Decode the JSON response
    $responseData = json_decode($response, true);

    // Check if the response contains the payment URL
    if (isset($responseData['payment_url'])) {
        // Redirect the user to the payment URL
        header("Location: " . $responseData['payment_url']);
        exit(); // Ensure that no other output is sent
    } else {
        // Handle the case when payment URL is not found
        echo "Error: Payment URL not found in the response.";
    }
?>
