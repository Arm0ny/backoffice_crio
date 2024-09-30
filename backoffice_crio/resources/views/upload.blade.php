<!DOCTYPE html>
<html>
<head>
    <title>Carica Immagine</title>
</head>
<body>
<h2>Carica Immagine con Prompt</h2>

@if ($message = Session::get('success'))
    <div>{{ $message }}</div>
@endif

<form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="image">Immagine:</label>
    <input type="file" name="image" id="image" required><br><br>

    <label for="prompt">Prompt (Descrizione):</label>
    <textarea name="prompt" id="prompt" required></textarea><br><br>

    <button type="submit">Carica</button>
</form>
</body>
</html>
