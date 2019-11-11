<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Idea List</title>
</head>

<body>
    {% if isAuth is not true %}
    <a href="/tugas-kpl/user/signup">Daftar disini</a>
    <a href="/tugas-kpl/user/login">Login disini</a>
    {% else %}
    <a href="/tugas-kpl/user/logout">Logout</a>
    <a href="/tugas-kpl/idea/create">Buat Ide</a>
    {% endif %}
    <h1>Kumpulan Ide2</h1>
    {% for idea in ideas %}
    <div style="border: 1px solid #000;padding: 10px;">
        <h2 style="margin: 0px">{{ idea.content() }}</h2>
        <p>
            {{ idea.description() }}
        </p>
        <p>
        Score : {{ idea.ratingScore() }}, Jumlah Pemberi Nilai: {{ idea.ratingCount() }}
        </p>
        <form action="rating" method="post">
            <input type="hidden" name="ideaId" value="{{ idea.id() }}">
            Score 1 - 5
            <input type="number" name="ratingScore" placeholder="Score" min="1" max="5">
            <input type="submit">
        </form>
    </div>
    {% endfor %}
</body>

</html>