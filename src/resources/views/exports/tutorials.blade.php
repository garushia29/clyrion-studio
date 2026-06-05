<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tutorials Export</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background: #f5f5f5; }
    </style>
</head>
<body>
    <h1>Tutorials Export</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Series</th>
                <th>Published</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            <tr>
                <td>{{ $item['id'] ?? '' }}</td>
                <td>{{ $item['title'] ?? '' }}</td>
                <td>{{ $item['status'] ?? '' }}</td>
                <td>{{ $item['series']['title'] ?? '' }}</td>
                <td>{{ $item['published_at'] ?? '' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
