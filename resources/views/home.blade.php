<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    @auth
        <p>You are logged In</p>
        <form action="/logout" method="POST">
            @csrf
            <button>Logout</button>
        </form>
        <div>
            <h2>Create Post</h2>
            <form action="/create-post" method="POST">
                @csrf
                <input type="text" name="title" placeholder="title"><br>
                <textarea name="description" placeholder="description" cols="30" rows="10"></textarea>
                <button type="submit">Post</button>
            </form>
        </div>

        <div style="border: 2px solid black;">
            <h2>My Posts</h2>
            @foreach ($posts as $post)
                <div style="background-color:rgb(189, 187, 187); padding: 10px; margin: 10px;">
                    <h2>{{$post['title']}}</h2>
                    <h4>by {{$post->user->name}}</h4>
                    <p>{{$post['Description']}}</p>
                    <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
                    <form action="/delete-post/{{$post->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <h1>Welcome</h1>
        <div>
            <h2>Register</h2>
            <form action="/register" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Name">
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <button type="submit">Register</button>
            </form>
        </div>

        <div>
            <h2>Login</h2>
            <form action="/login" method="POST">
                @csrf
                <input type="text" name="loginname" placeholder="Name">
                <input type="password" name="loginpassword" placeholder="Password">
                <button type="submit">Login</button>
            </form>
        </div>

    @endauth
    
</body>
</html>