<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <h2>Reset Password</h2>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <p>
            Please enter your email address below and we'll send you a link to reset your password.
        </p>
        <input type="email" name="email" placeholder="Your email address">
        <button type="submit">Send Password Reset Link</button>
    </form>
</body>
</html>
