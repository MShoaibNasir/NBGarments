<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Failed</title>
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

    .error-container {
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

    .error-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: inline-block;
        border: 3px solid #e74c3c;
        position: relative;
        animation: pop 0.5s ease forwards;
    }

    @keyframes pop {
        0% { transform: scale(0.5); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }

    .error-icon::before,
    .error-icon::after {
        content: '';
        position: absolute;
        width: 40px;
        height: 3px;
        background-color: #e74c3c;
        top: 38px;
        left: 19px;
        opacity: 0;
        animation: cross 0.5s ease 0.4s forwards;
    }

    .error-icon::before {
        transform: rotate(45deg);
    }

    .error-icon::after {
        transform: rotate(-45deg);
    }

    @keyframes cross {
        to { opacity: 1; }
    }

    h2 {
        font-size: 22px;
        margin-top: 25px;
        letter-spacing: 1px;
        color: #ff6b6b;
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

    .retry-btn {
        background-color: #e74c3c;
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

    .retry-btn:hover {
        background-color: #c0392b;
    }

    /* 🌐 Responsive */
    @media (max-width: 600px) {
        .error-container {
            padding: 30px 20px;
        }

        .error-icon {
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

        .retry-btn {
            width: 100%;
            padding: 12px;
        }
    }
</style>
</head>

<body>

<div class="error-container">
    <div class="error-icon"></div>
    <h2>Payment Failed!</h2>
    <p>Oops! Something went wrong while processing your transaction. Please try again.</p>

    <div class="details-box">
        <div><span>Invoice ID:</span> <span>{{$invoice->secrete_id}}</span></div>
        <div><span>Amount:</span> <span>{{$invoice->InvoiceAmount->total_amount}} {{ $invoice->InvoiceAmount->currency ?? 'USD' }}</span></div>
        <div><span>Status:</span> <span>Failed</span></div>
    </div>

    <a href="{{route('invoice.filter')}}" class="retry-btn">Try Again</a>
</div>

</body>
</html>
