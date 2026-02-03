<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Successful</title>
<link rel="icon" type="image/x-icon" href="logo.png">

<style>
    body {
        margin: 0;
        font-family: "Segoe UI", sans-serif;
        background: linear-gradient(160deg, #08122e, #0a1a40, #001129);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        text-align: center;
        flex-direction: column;
        padding: 20px;
    }

    .success-container {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(8px);
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
        padding: 40px 30px;
        max-width: 420px;
        width: 95%;
        animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .checkmark {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: inline-block;
        border: 3px solid #2ecc71;
        position: relative;
        animation: pop 0.5s ease forwards;
    }

    @keyframes pop {
        0% { transform: scale(0.5); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }

    .checkmark::after {
        content: '';
        position: absolute;
        left: 26px;
        top: 10px;
        width: 20px;
        height: 40px;
        border-right: 3px solid #2ecc71;
        border-bottom: 3px solid #2ecc71;
        transform: rotate(45deg);
        animation: draw 0.5s ease 0.3s forwards;
        opacity: 0;
    }

    @keyframes draw {
        to { opacity: 1; }
    }

    h2 {
        font-size: 22px;
        margin-top: 25px;
        letter-spacing: 1px;
    }

    p {
        font-size: 14px;
        color: #b5c2d6;
        margin: 10px 0 25px;
    }

    .details-box {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 8px;
        padding: 15px;
        font-size: 14px;
        color: #e6eaf3;
        text-align: left;
        margin-bottom: 25px;
    }

    .details-box div {
        display: flex;
        justify-content: space-between;
        padding: 5px 0;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .details-box div:last-child {
        border-bottom: none;
    }

    .home-btn {
        background-color: #0a3d91;
        color: white;
        border: none;
        padding: 12px 20px;
        font-size: 15px;
        border-radius: 6px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: 0.3s ease;
    }

    .home-btn:hover {
        background-color: #092f6d;
    }

    /* 🌐 Responsive */
    @media (max-width: 600px) {
        .success-container {
            padding: 30px 20px;
        }

        .checkmark {
            width: 65px;
            height: 65px;
        }

        h2 {
            font-size: 18px;
        }

        p {
            font-size: 13px;
        }

        .details-box {
            font-size: 13px;
        }

        .home-btn {
            width: 100%;
            padding: 12px;
        }
    }
</style>
</head>

<body>

<div class="success-container">
    <div class="checkmark"></div>
    <h2>Payment Successful!</h2>
    <p>Thank you, {{$invoice->first_name}} {{$invoice->last_name}}. Your payment has been processed successfully.</p>

    <div class="details-box">
        <div><span>Invoice ID:</span> <span>{{$invoice->secrete_id}}</span></div>
        <div><span>Amount Paid:</span> <span>{{$invoice->InvoiceAmount->total_amount}} {{ $invoice->InvoiceAmount->currency ?? 'USD' }}</span></div>
        <div><span>Status:</span> <span>Paid</span></div>
    </div>

    <a href="{{route('invoice.filter')}}" class="home-btn">Return to Home</a>
</div>

</body>
</html>
