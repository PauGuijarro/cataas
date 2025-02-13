<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria de Gats</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: rgb(198, 213, 238);
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #333;
            margin-top: 20px;
            font-size: 2.5rem;
            text-align: center;
            color: red;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 30px;
            justify-items: center;
        }

        .gallery img {
            width: 100%;
            max-height: 250px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .gallery img:hover {
            transform: scale(1.05);
        }

        .tags {
            margin-top: 15px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .tags p {
            margin: 0;
            font-weight: bold;
        }

        .tags a {
            text-decoration: none;
            background-color: red;
            padding: 8px 15px;
            border-radius: 20px;
            margin: 5px;
            color: white;
            font-weight: bold;
            transition: background-color 0.3s, box-shadow 0.3s;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Añadir sombra */
        }

        .tags a:hover {
            background-color: orange;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3); /* Sombra más intensa en hover */
        }

        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pagination a {
            padding: 10px 15px;
            margin: 0 5px;
            border-radius: 5px;
            background-color: #ddd;
            text-decoration: none;
            color: #333;
            display: inline-flex;
            align-items: center;
        }

        .pagination a:hover {
            background-color: red;
            color: white;
        }

        .pagination .active {
            background-color: orange;
            color: white;
        }

        /* Estilo para las flechas */
        .pagination .prev,
        .pagination .next {
            font-size: 18px;
            padding: 8px;
            background-color: #ddd;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }

        .pagination .prev:hover,
        .pagination .next:hover {
            background-color: red;
            color: white;
        }

        /* Botones para la primera y última página */
        .pagination .first,
        .pagination .last {
            font-size: 18px;
            padding: 8px 12px;
            background-color: #ddd;
            border-radius: 5px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }

        .pagination .first:hover,
        .pagination .last:hover {
            background-color: red;
            color: white;
        }
    </style>
</head>

<body>
    <h1>Galeria de Gats</h1>

    <div class="gallery">
        @foreach($cats as $cat)
        <div>
            <img src="https://cataas.com/cat/{{ $cat->_id }}" alt="Cat Image">
            <div class="tags">
                <p>Tags:
                    @foreach(json_decode($cat->tags) as $tag)
                    <a href="{{ route('cats.filter', $tag) }}">{{ $tag }}</a>
                    @endforeach
                </p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="pagination">
        @if($cats->currentPage() > 1)
        <a class="first" href="{{ $cats->url(1) }}">Primera</a>
        @else
        <span class="first" style="visibility: hidden;">Primera</span>
        @endif

        @if($cats->onFirstPage())
        <span class="prev" style="visibility: hidden;">&laquo;</span>
        @else
        <a class="prev" href="{{ $cats->previousPageUrl() }}">&laquo;</a>
        @endif

        @php
        $currentPage = $cats->currentPage();
        $lastPage = $cats->lastPage();
        $range = 2;
        @endphp

        @for ($i = max(1, $currentPage - $range); $i <= min($lastPage, $currentPage + $range); $i++)
            <a class="{{ $cats->currentPage() == $i ? 'active' : '' }}" href="{{ $cats->url($i) }}">{{ $i }}</a>
        @endfor

        @if($cats->hasMorePages())
        <a class="next" href="{{ $cats->nextPageUrl() }}">&raquo;</a>
        @else
        <span class="next" style="visibility: hidden;">&raquo;</span>
        @endif

        @if($cats->currentPage() < $cats->lastPage())
        <a class="last" href="{{ $cats->url($cats->lastPage()) }}">Última</a>
        @else
        <span class="last" style="visibility: hidden;">Última</span>
        @endif
    </div>
</body>

</html>
