<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        /* Import Google Font */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
            .login-container {
                background: #1c1c1c;
                width: 380px;
                padding: 40px 35px;
                border-radius: 16px;
                box-shadow: 0 0 25px rgba(82, 214, 224, 0.3);
                text-align: center;
                transition: 0.4s ease;
                border: 1px solid #52d6e05c;
            }

        body {
            height: 100vh;
            background: linear-gradient(135deg, #000, #111);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: #1c1c1c;
            width: 380px;
            padding: 40px 35px;
            border-radius: 16px;
            box-shadow: 0 0 25px rgba(82, 214, 224, 0.3);
            text-align: center;
            transition: 0.4s ease;
        }

        .login-container h3 {
            margin-bottom: 25px;
            color: #52D6E0;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .input-group {
            position: relative;
            margin-bottom: 25px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #333;
            border-radius: 8px;
            outline: none;
            background: #0e0e0e;
            color: #fff;
            font-size: 15px;
            transition: 0.3s ease;
        }

        .input-group input:focus {
            border-color: #52D6E0;
            box-shadow: 0 0 10px rgba(82, 214, 224, 0.5);
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            color: #52D6E0;
            user-select: none;
        }

        .login-btn {
            width: 100%;
            background: #52D6E0;
            color: #000;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background: transparent;
            color: #52D6E0;
            border: 2px solid #52D6E0;
        }

        .links {
            margin-top: 20px;
            font-size: 14px;
        }

        .links a {
            color: #52D6E0;
            text-decoration: none;
            font-weight: 500;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .login-container:hover {
            transform: scale(1.02);
        }

        @media (max-width: 420px) {
            .login-container {
                width: 90%;
                padding: 30px 25px;
            }
        }

        /* SweetAlert custom button */
        .swal2-confirm {
            background-color: #52D6E0 !important;
            color: #000 !important;
        }
    </style>
</head>
<body>
    <div class="login-container">
        
        <h2 class="my-4">Admin Login</h2>
        <form method="POST" action="{{ route('login.user') }}">
            @csrf
            <div class="input-group">
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" placeholder="Email or Username" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="input-group">
                <input id="password" type="password" placeholder="Enter Password"
                       class="form-control @error('password') is-invalid @enderror" name="password" required>
                <span class="toggle-password" onclick="togglePassword()">👁️</span>

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button type="submit" class="login-btn">Login</button>
        </form>

        <div class="links">
            {{-- <p><a href="#">Forgot Password?</a></p> --}}
            {{-- <p>Don’t have an account? <a href="#">Sign Up</a></p> --}}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#52D6E0'
        });
    </script>
    @endif

    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
            confirmButtonColor: '#52D6E0'
        });
    </script>
    @endif

    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const toggleIcon = document.querySelector(".toggle-password");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.textContent = "🙈";
            } else {
                passwordField.type = "password";
                toggleIcon.textContent = "👁️";
            }
        }
    </script>
</body>
</html>
