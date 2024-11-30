@extends('admin.admin_layout')
@section('admin')
    <!-- Custom CSS for additional styling -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .change-password-form {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            font-size: 24px;
            font-weight: 600;
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-custom {
            background-color: #007bff;
            border: none;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="change-password-form">
            <div class="form-title">Change Password</div>
    
            <!-- Display Validation Errors -->
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            @endif
    
            <form action="{{ route('update.password') }}" method="POST">
                @csrf
                <!-- Old Password -->
                <div class="mb-3">
                    <label for="oldPassword" class="form-label">Old Password</label>
                    <input type="password" class="form-control" id="oldPassword" name="oldpassword" placeholder="Enter old password" required>
                </div>
    
                <!-- New Password -->
                <div class="mb-3">
                    <label for="newPassword" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="newPassword" name="newpassword" placeholder="Enter new password" required>
                </div>
    
                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmpassword" placeholder="Confirm new password" required>
                </div>
    
                <!-- Show/Hide Password Checkbox -->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="showPasswordToggle">
                    <label class="form-check-label" for="showPasswordToggle">Show Passwords</label>
                </div>
    
                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-custom btn-lg text-white">Update Password</button>
                </div>
            </form>
        </div>
    </div>

<script>
    // Show/Hide Password Script
    document.getElementById('showPasswordToggle').addEventListener('click', function () {
        const oldPassword = document.getElementById('oldPassword');
        const newPassword = document.getElementById('newPassword');
        const confirmPassword = document.getElementById('confirmPassword');
        const type = this.checked ? 'text' : 'password';
        oldPassword.type = type;
        newPassword.type = type;
        confirmPassword.type = type;
    });
</script>

@endsection