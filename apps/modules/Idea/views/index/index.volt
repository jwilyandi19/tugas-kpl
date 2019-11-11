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
    </div>
    {% endfor %}
</body>

</html>