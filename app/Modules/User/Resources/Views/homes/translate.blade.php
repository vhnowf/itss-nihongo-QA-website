

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Translation</title>
</head>
<body>
    <h1 id="title">{{ $product->title }}</h1>
    <div id="content">{!! $product->content !!}</div>
    <div id="seo_title">{{ $product->seo_title }}</div>
    <div id="seo_keywords">{{ $product->seo_keywords }}</div>
    <div id="seo_description">{{ $product->seo_description }}</div>

    {{-- <table id="attribute_value">
        @foreach ($product->attributes as $attribute)
            @foreach ($attribute->values as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->value }}</td>
                </tr>
            @endforeach
        @endforeach
    </table> --}}
</body>
</html>
