<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Projects Export</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background: #f5f5f5; }
    </style>
</head>
<body>
    <h1>Projects Export</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Featured</th>
                <th>Sort Order</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            <tr>
                <td>{{ $item['id'] ?? '' }}</td>
                <td>{{ $item['title'] ?? '' }}</td>
                <td>{{ isset($item['is_featured']) && $item['is_featured'] ? 'Yes' : 'No' }}</td>
                <td>{{ $item['sort_order'] ?? 0 }}</td>
                <td>{{ $item['created_at'] ?? '' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
