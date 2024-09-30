<!DOCTYPE html>
<html>
<head>
    <title>Galleria di Immagini</title>
</head>
<body>
<h2>Galleria di Immagini</h2>

@if ($message = Session::get('success'))
    <div>{{ $message }}</div>
@endif

@foreach($images as $image)
    <div>
        <img src="{{ asset($image->image_path) }}" alt="Immagine" width="200">
        <p>{{ $image->prompt }}</p>

        <!-- Form per modificare il prompt -->
        <form action="{{ route('image.update', $image->id) }}" method="POST">
            @csrf
            <label for="prompt">Modifica Prompt:</label>
            <input type="text" name="prompt" value="{{ $image->prompt }}" required>
            <button type="submit">Aggiorna Prompt</button>
        </form>

        <!-- Form per eliminare l'immagine -->
        <form action="{{ route('image.destroy', $image->id) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa immagine?');">
            @csrf
            @method('DELETE')
            <button type="submit">Elimina Immagine</button>
        </form>

        <hr>
    </div>
@endforeach
</body>
</html>
