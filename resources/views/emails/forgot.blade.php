<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
    @php
        // ส่วนที่ใช้สร้างลิงก์สำหรับรีเซ็ตรหัสผ่าน
$resetUrl = url('reset/' . $user->remember_token);
    @endphp
    <h2>Reset Your Password</h2>
    <p>Click the button below to reset your password:</p>
    <a href="{{ $resetUrl }}">
        <button style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer;">
            Reset Password
        </button>
    </a>
</body>
</html>
