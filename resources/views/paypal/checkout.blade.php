<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Checkout Page</title>
    <link rel="stylesheet" href="{{asset('dashboard/css/cart.css')}}">
    <script src="https://www.paypal.com/sdk/js?client-id=YOUR_CLIENT_ID&currency=USD"></script>

    <style>
    
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

       body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    background-image: url('../images/background.jpg'); /* <-- apni image ka path yahan den */
    background-size: cover; /* poori screen fill kare */
    background-position: right; /* center me image rahe */
    background-repeat: no-repeat; /* repeat na ho */
    min-height: 100vh;
    padding: 40px 20px;
}

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header Section */
        .header {
            text-align: center;
            margin-bottom: 60px;
        }

        .logo {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
            color: white;
        }
.logo img {
    width: 200px;
}
       

        .greeting {
            color: #2d3748;
            margin-bottom: 10px;
        }

        .greeting h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .greeting p {
            font-size: 18px;
            color: #313131;
            margin-bottom: 20px;
        }

        .greeting-subtext {
            font-size: 14px;
            color: #525252;
            line-height: 1.6;
            max-width: 700px;
            margin: 0 auto 40px;
        }

        /* Main Content Wrapper */
        .main-content {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
            align-items: start;
        }

        /* Testimonials */
        .testimonial-column {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .testimonial {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .stars {
            color: #f5a623;
            font-size: 16px;
            margin-bottom: 15px;
            letter-spacing: 2px;
        }

        .testimonial-text {
            font-size: 13px;
            color: #4a5568;
            line-height: 1.6;
            margin-bottom: 15px;
            font-style: italic;
        }

        .testimonial-author {
            font-size: 13px;
            color: #2d3748;
            font-weight: 600;
        }

        /* Payment Form Section */
        .payment-section {
            background: #f0f9f7;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .payment-section h2 {
    text-align: center;
    color: #2d3748;
    font-size: 35px;
    margin-bottom: 20px;
    font-weight: 500;
}

        .card-logos {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 30px;
        }

       

        .visa {
            background: #1434CB;
        }

        .mastercard {
            background: #000;
        }

        .amex {
            background: #006FCF;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-row.full {
            grid-template-columns: 1fr;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 14px;
            color: #2d3748;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group input {
            padding: 12px;
            border: 1px solid #cbd5e0;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4a3f8f;
            box-shadow: 0 0 0 3px rgba(74, 63, 143, 0.1);
        }

        .form-row.expiry {
            grid-template-columns: 1fr 1fr 1fr;
            gap: 15px;
        }

        .payment-button {
            width: 100%;
            padding: 14px;
            background: #a0a9b8;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            margin-bottom: 20px;
        }

        .payment-button:hover {
            background: #8b9199;
        }

        .agreement-section {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 10px;
        }

        .agreement-section input[type="checkbox"] {
            margin-top: 5px;
            cursor: pointer;
        }

        .agreement-text {
            font-size: 12px;
            color: #4a5568;
            line-height: 1.5;
        }

        .error-message {
            color: #e53e3e;
            font-size: 12px;
            margin-top: 5px;
        }

        /* Service Agreement Section */
        .service-agreement {
    backdrop-filter: blur(30px);
    background: #ffffff9c;
    border-radius: 12px;
    padding: 40px;
    margin-bottom: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}
.credit-card {
    background: #5b4fa31f;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;}
.card-logo img {
    width: 65px;
}
        .service-agreement h2 {
            color: #2d3748;
            font-size: 18px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .service-agreement .subtitle {
            color: #718096;
            font-size: 12px;
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .services-included {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .services-included h3 {
            color: #2d3748;
            font-size: 14px;
            margin-bottom: 15px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .service-list {
            list-style: none;
        }

        .service-list li {
            color: #4a5568;
            font-size: 13px;
            padding: 10px 0;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            line-height: 1.5;
        }

        .service-list li:before {
            content: "✓";
            color: #9b7ebd;
            font-weight: bold;
            font-size: 14px;
            flex-shrink: 0;
        }

        .more-services {
            color: #2d3748;
            font-size: 13px;
            padding: 10px 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .more-services:before {
            content: "●";
            font-size: 10px;
        }

        .timeline {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .timeline-label {
            color: #718096;
            font-size: 13px;
            font-weight: 500;
        }

        .download-btn {
            background: #5b4fa3;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .download-btn:hover {
            background: #4a3f8f;
        }

        .item-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        .item-table thead {
            background: white;
        }

        .item-table th {
            padding: 15px;
            text-align: left;
            color: #2d3748;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
        }

        .item-table td {
            padding: 20px 15px;
            color: #4a5568;
            font-size: 13px;
            border-bottom: 1px solid #e2e8f0;
            background: white;
        }

        .item-icon {
            color: #9b7ebd;
            font-size: 14px;
            margin-right: 10px;
        }

        .amount-total {
            display: flex;
            justify-content: flex-end;
            gap: 40px;
            padding: 30px 15px;
            border-top: 2px solid #e2e8f0;
            background: white;
            border-radius: 0 0 8px 8px;
        }

        .amount-label {
            color: #2d3748;
            font-weight: 600;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }

        .amount-label .small {
            font-size: 12px;
            font-weight: 500;
            color: #718096;
        }

        .amount-value {
            font-size: 24px;
            font-weight: bold;
            color: #2d3748;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .main-content {
                grid-template-columns: 1fr;
            }

            .payment-section {
                grid-column: 1;
            }

            .testimonial-column {
                order: -1;
            }
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .form-row.expiry {
                grid-template-columns: 1fr;
            }

            .timeline {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .amount-total {
                flex-direction: column;
                gap: 15px;
            }

            body {
                padding: 20px 10px;
            }

            .greeting h1 {
                font-size: 24px;
            }
        }

    </style>
  
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                <img src="{{ asset('logos/' . $invoice->brand->logo) }}"  alt="KDP Logo">

            </div>
            <div class="greeting">
                <h1>Dear {{ $invoice->first_name }} {{ $invoice->last_name }},</h1>
                <p>Thank You for {{$invoice->brand->name}}</p>
            </div>
            <p class="greeting-subtext">
                You're just one payment away from accessing everything you need to move forward. Whether you're just getting started or continuing your journey — we're excited to support what's next.
            </p>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Left Testimonials -->
            <div class="testimonial-column">
                <div class="testimonial">
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">"I used the invoice system to manage my billing, and the process was smooth and efficient.
The system worked well, but I wish it offered more detailed reports and analytics."</p>
                    {{--<div class="testimonial-author">–Duane Cassidy, Author</div>--}}
                </div>

                <div class="testimonial">
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">"The invoice system handled my payments quickly and without any issues.
However, additional analytics and clearer reporting would make it even better."</p>
                    {{--<div class="testimonial-author">–Patric Conlon, Author</div>--}}
                </div>
            </div>

            <!-- Payment Form -->
            <div class="payment-section">
                <div class="credit-card">
                <h2>Credit Card Details</h2>
                <div class="card-logos">
                    <div class="card-logo">
                         <img src="{{ asset('dashboard/img/visa.png') }}" alt="Visa Logo">

                    </div>
                    <div class="card-logo">
                        <img src="{{ asset('dashboard/img/master.png') }}" alt="Master Logo">

                    </div>
                    <div class="card-logo">
                        <img src="{{ asset('dashboard/img/paypal.png') }}" alt="Paypal Logo">

                    </div>
                </div>
                </div>

                <form id="paymentForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="first_name" required value="{{ $invoice->first_name }}">
                        </div>
                            <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                            <input type="hidden" name="currency" value="{{ $invoice->InvoiceAmount->currency ?? 'USD' }}">
                            <input type="hidden" name="total_amount" value="{{ $invoice->InvoiceAmount->total_amount ?? 0 }}">
                            <input type="hidden" name="secrete_id" value="{{ $invoice->secrete_id ?? 0 }}">
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="last_name" required value="{{ $invoice->last_name }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required value="{{ $invoice->email_address }}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" required value="{{ $invoice->phone_number }}">
                        </div>
                    </div>

                    <div class="form-row full">
                        <div class="form-group">
                            <label for="cardNumber">Card Number</label>
                            <input type="text" id="cardNumber" name="cardNumber" placeholder="1234 1234 1234 1234" required>
                        </div>
                    </div>

                    <div class="form-row expiry">
                        <div class="form-group">
                            <label for="expiryMonth">Expiry Month</label>
                            <input type="text" id="expiryMonth" name="expiryMonth" placeholder="MM" maxlength="2" required>
                        </div>
                        <div class="form-group">
                            <label for="expiryYear">Expiry Year</label>
                            <input type="text" id="expiryYear" name="expiryYear" placeholder="YYYY" maxlength="4" required>
                        </div>
                        <div class="form-group">
                            <label for="cvv">CVV Code</label>
                            <input type="text" id="cvv" name="cvv" placeholder="CVC" maxlength="3" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="billingAddress1">Billing Address</label>
                            <input type="text" id="billingAddress1" name="billingAddress1" placeholder="Billing Address" required>
                        </div>
                        <div class="form-group">
                            <label for="billingZipcode">Billing Zipcode</label>
                            <input type="text" id="billingZipcode" name="billingZipcode" placeholder="Billing Zipcode" required>
                        </div>
                    </div>

                    <div class="form-row full">
                        <div class="form-group">
                            <label for="billingAddress2">Billing Address</label>
                            <input type="text" id="billingAddress2" name="billingAddress2" placeholder="Billing Address">
                        </div>
                    </div>

                    <button type="submit" id="paypal-button-container" class="payment-button">Pay Now {{$invoice->InvoiceAmount->total_amount}}</button>

                    <div class="agreement-section">
                        <input type="checkbox" id="agreement" name="agreement" required>
                        <label for="agreement" class="agreement-text">
                            I have read, understood and agree to the terms of the Client Service Agreement.
                        </label>
                    </div>
                    <div id="errorMessage" class="error-message"></div>
                </form>
            </div>

            <!-- Right Testimonials -->
            <div class="testimonial-column">
                <div class="testimonial">
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">"I used the invoice system for all my billing needs, and it made the process simple and organized.
I just wish it provided deeper analytics and more frequent reporting updates."</p>
                   {{-- <div class="testimonial-author">–Brandon McClasky, Author</div> --}}
                </div>

                <div class="testimonial">
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">"The invoice system helped me manage payments effortlessly and kept everything well-structured.
I only wish it offered more detailed tracking and analytical reports during the process."</p>
                  {{--  <div class="testimonial-author">–Emmaline Branch, Author</div> --}}
                </div>
            </div>
        </div>

        <!-- Service Agreement Section -->
      {{--  <div class="service-agreement">
            <h2>📋 SERVICE AGREEMENT DETAILS</h2>
            <p class="subtitle">PROJECT OVERVIEW AND TIMELINE</p>

            <div class="services-included">
                <h3>Services Included</h3>
                <ul class="service-list">
                    <li>Remaining Balance & Extended Distribution Global (1st Installment)</li>
                    <li>Placement of the Authors book on extended global platforms</li>
                    <li>Including Walmart, Target, Kobo, Apple Books, Google Play</li>
                    
                </ul>
            </div>

            <div class="timeline">
                <div class="timeline-label">1-2 months</div>
                <button class="download-btn">📥 Download Agreement</button>
            </div>

            <table class="item-table">
                <thead>
                    <tr>
                        <th>ITEM DESCRIPTION</th>
                        <th>TYPE</th>
                        <th>AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="item-icon">●</span>Remaining Balance & Extended Distribution Global 1st Installment Remaining Balance & Extended Distribution Global 1st Installment Remaining Balance & Extended Distribution Global 1st Installment</td>
                        <td>Package Amount</td>
                        <td>{{ $invoice->InvoiceAmount->total_amount ?? 0 }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="amount-total">
                <div class="amount-label">
                    <span class="small">Amount</span>
                    <span>Due Today</span>
                </div>
                <div class="amount-value">{{ $invoice->InvoiceAmount->total_amount ?? 0 }}</div>
            </div>
        </div> --}}
    </div>



    <script>
        
document.getElementById("paymentForm").addEventListener("submit", function(e) {
    let cardNumber = document.getElementById("cardNumber").value.trim();
    let expiryMonth = document.getElementById("expiryMonth").value.trim();
    let expiryYear = document.getElementById("expiryYear").value.trim();
    let cvv = document.getElementById("cvv").value.trim();
    let error = "";

    // ✅ Card Number: 16 digits only
    if (!/^\d{16}$/.test(cardNumber)) {
        error = "Card Number must be 16 digits.";
    }

    // ✅ Expiry Month: 01 to 12
    else if (!/^(0[1-9]|1[0-2])$/.test(expiryMonth)) {
        error = "Expiry Month must be between 01 and 12.";
    }

    // ✅ Expiry Year: must be >= current year
    else if (!/^\d{4}$/.test(expiryYear)) {
        error = "Expiry Year must be 4 digits (e.g., 2028).";
    } else {
        const currentYear = new Date().getFullYear();
        if (parseInt(expiryYear) < currentYear) {
            error = "Expiry Year cannot be in the past.";
        }
    }

    // ✅ CVV: 3 digits only
    if (!/^\d{3}$/.test(cvv)) {
        error = "CVV Code must be 3 digits.";
    }

    // ✅ Show error and stop submit
    if (error !== "") {
        e.preventDefault();
        document.getElementById("errorMessage").innerText = error;
        return false;
    }

});
const numberOnlyFields = ["cardNumber", "expiryMonth", "expiryYear", "cvv"];

numberOnlyFields.forEach(id => {
    let input = document.getElementById(id);

    // Prevent typing non-numeric characters (including e, +, -, ., etc.)
    input.addEventListener("keydown", function(e) {
        if (
            e.key === "e" || 
            e.key === "E" ||
            e.key === "+" ||
            e.key === "-" ||
            e.key === "." 
        ) {
            e.preventDefault();
        }
    });

    // Remove any non-numeric character if pasted
    input.addEventListener("input", function() {
        this.value = this.value.replace(/\D/g, "");
    });
});
paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: "{{ $invoice->InvoiceAmount->total_amount }}"
                }
            }]
        });
    },

    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {

            // ✅ Send PayPal payment info to your Laravel backend
            fetch("/paypal/payment-success", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    order_id: data.orderID,
                    invoice_id: "{{ $invoice->id }}",
                    amount: "{{ $invoice->InvoiceAmount->total_amount }}"
                })
            })
            .then(res => res.json())
            .then(response => {
                alert("✅ Payment Successful via PayPal!");
                window.location.href = "/thank-you";
            });

        });
    },

    onError: function(err) {
        alert("❌ Something went wrong with PayPal payment");
    }

}).render('#paypal-button-container');


        
        const form = document.getElementById('paymentForm');
        const errorMessage = document.getElementById('errorMessage');
        const agreementCheckbox = document.getElementById('agreement');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Clear previous error
            errorMessage.textContent = '';

            // Validate agreement
            if (!agreementCheckbox.checked) {
                errorMessage.textContent = 'Please accept the agreement terms to proceed with payment.';
                return;
            }

            // Validate form fields
            const formData = new FormData(form);
            let isValid = true;

            for (let [key, value] of formData.entries()) {
                if (key !== 'billingAddress2' && !value.trim()) {
                    isValid = false;
                    break;
                }
            }

            if (!isValid) {
                errorMessage.textContent = 'Please fill in all required fields.';
                return;
            }

            // Simple validation for card number
            const cardNumber = document.getElementById('cardNumber').value.replace(/\s/g, '');
            if (cardNumber.length !== 16) {
                errorMessage.textContent = 'Please enter a valid 16-digit card number.';
                return;
            }

            // If validation passes
            alert('Payment processed successfully! Thank you for your purchase.');
            form.reset();
        });

        // Format card number with spaces
        document.getElementById('cardNumber').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '');
            let formatted = value.match(/.{1,4}/g)?.join(' ') || value;
            e.target.value = formatted;
        });

        // Allow only numbers for phone
        document.getElementById('phone').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9-+]/g, '');
        });

        // Allow only numbers for CVV
        document.getElementById('cvv').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
        });

        // Allow only numbers for month
        document.getElementById('expiryMonth').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9]/g, '');
            if (value.length <= 2) {
                e.target.value = value;
            }
        });

        // Allow only numbers for year
        document.getElementById('expiryYear').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9]/g, '');
            if (value.length <= 4) {
                e.target.value = value;
            }
        });
    </script>
</body>
</html>