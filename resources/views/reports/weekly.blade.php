<!-- resources/views/reports/weekly.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Weekly Report for {{ $user->name }}</title>
    <style>
        table{
            border: 1px solid red;
        }
        td, th {
            border: 1px solid #000;
        }
    </style>
</head>
<body>
    <h1>Weekly Activity Report</h1>
    <h2>User: {{ $user->name }}</h2>
    <p>Email: {{ $user->email }}</p>

    <h3>Activity Summary</h3>
    <table>
        <tr>
            <th>Date</th>
            <th>Activity</th>
            <th>Description</th>
        </tr>
        @foreach ($activity as $act)
            <?php
                $date = new DateTime($act->created_at);
                $formattedTime = $date->format('d M y h:i A');
            ?>
            <tr><td>{{ $formattedTime }}</td> <td>{{ $act->activity_name }} </td> <td> {{ $act->description }}</td></tr>
        @endforeach
    </table>
</body>
</html>
