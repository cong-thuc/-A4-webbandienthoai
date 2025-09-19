<x-guest-layout>
    <style>
        body {
            /* background: url("{{ asset('storage/products/background.jpg') }}") no-repeat center center fixed; */
            background-size: cover;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 0;
        }

        .login-container {
            max-width: 360px;
            margin: 20px;
            padding: 30px 25px;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Giữ nguyên tất cả các style cũ bên dưới */
        .login-container h2 {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 4px;
            color: #333;
        }

        .login-container p {
            font-size: 14px;
            color: #888;
            text-align: center;
            margin-bottom: 24px;
        }

        .form-label {
            font-size: 14px;
            margin-bottom: 6px;
            color: #555;
        }

        .form-control {
            width: 100%;
            padding: 10px 40px 10px 12px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 16px;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.8);
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .toggle-password svg {
            width: 20px;
            height: 20px;
            color: #555;
        }

        .btn-submit {
            background-color: #4e73df;
            color: #fff;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #3a5bc7;
        }

        small.text-danger {
            font-size: 12px;
            color: #e74a3b;
        }
    </style>

    <!-- Giữ nguyên toàn bộ HTML cũ -->
    <div class="login-container">
        <h2>Đăng nhập Admin</h2>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div>
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" class="form-control" placeholder="Nhập email" required autofocus>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label for="password" class="form-label">Mật khẩu</label>
                <div class="password-wrapper">
                    <input id="password" type="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
                    <button type="button" class="toggle-password" onclick="togglePassword()" aria-label="Hiện/ẩn mật khẩu">
                        <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.99 9.99 0 012.882-4.442m3.36-2.117A9.978 9.978 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.956 9.956 0 01-1.308 2.572M15 12a3 3 0 01-3 3m0 0a3 3 0 01-3-3m3 3l6 6m-6-6l-6-6"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Đăng nhập</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const eyeOpen = document.getElementById("eye-open");
            const eyeClosed = document.getElementById("eye-closed");

            const isHidden = passwordInput.type === "password";
            passwordInput.type = isHidden ? "text" : "password";
            eyeOpen.style.display = isHidden ? "none" : "inline";
            eyeClosed.style.display = isHidden ? "inline" : "none";
        }
    </script>
</x-guest-layout>