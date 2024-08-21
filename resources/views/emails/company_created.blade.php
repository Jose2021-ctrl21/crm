<!DOCTYPE html>
<html>
<head>
    <title>Company Created</title>
</head>
<body>
    <h1>Welcome, {{ $company->company_name }}!</h1>
    <p>Your company has been successfully created.</p>
    <p><strong>Email:</strong> {{ $company->email }}</p>
    <p><strong>Website:</strong> {{ $company->website }}</p>
    <p>Thank you for registering with us!</p>
    {{-- HEY!!{{$name}} --}}
</body>
</html>
