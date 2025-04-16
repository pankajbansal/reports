<!-- resources/views/reports/weekly.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Weekly Report for {{ $user->name }}</title>
</head>
<body>
    <h1>Weekly Activity Report</h1>
    <h2>User: {{ $user->name }}</h2>
    <p>Email: {{ $user->email }}</p>

    <h3>Activity Summary</h3>
    <ul>
        @foreach ($activity as $act)
            <li>{{ $act->created_at }} : {{ $act->activity_name }}: {{ $act->description }}</li>
        @endforeach
    </ul>
</body>
</html>
