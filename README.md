# Laravel CRUD App (Beginner Tutorial)

This is a simple CRUD (Create, Read, Update, Delete) application built using Laravel.  
It allows users to create, view, edit, and delete posts.

---

## 🚀 Features

- Create new posts
- List all posts
- Edit existing posts
- Delete posts
- Blade views for UI
- Validation and flash messages

---

## 🛠️ Requirements

- PHP 8.x
- Composer
- Laravel 11.x
- MySQL or SQLite
- Node.js & NPM (optional for frontend)

---

## ⚙️ Installation

```bash
git clone https://github.com/your-username/laravel-crud-app.git
cd laravel-crud-app
composer install
cp .env.example .env
php artisan key:generate
````

Update `.env` file with your database details.

Then run:

```bash
php artisan migrate
php artisan serve
```

Visit: [http://localhost:8000/posts](http://localhost:8000/posts)

---

## 📚 Usage

### 1. Create a Post

* Navigate to `/posts/create`
* Fill in the form and submit

### 2. Edit a Post

* Click “Edit” on any post
* Update the title/content

### 3. Delete a Post

* Click “Delete” on any post

---

## 🧱 Folder Structure

```
app/
  └── Http/
      └── Controllers/
          └── PostController.php

resources/
  └── views/
      └── posts/
          ├── index.blade.php
          ├── create.blade.php
          └── edit.blade.php

routes/
  └── web.php

database/
  └── migrations/
      └── 202x_xx_xx_create_posts_table.php
```

---

## 🧠 Learning Goals

* Master resource controllers
* Learn to work with Blade templates
* Use Laravel's validation and flash session messages
* Get comfortable with migrations and Eloquent models

---

## 🙌 Contributing

Feel free to fork this repository and use it as a base for your own Laravel apps.

---

## 📬 Feedback

If you have any questions or want to collaborate, feel free to open an issue or reach out.

---

## 📎 License

MIT License

````

---

## 🧾 Sample Code Files

---

### ✅ Migration: `create_posts_table.php`

```php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('content');
    $table->timestamps();
});
````

---

### ✅ Model: `Post.php`

```php
class Post extends Model
{
    protected $fillable = ['title', 'content'];
}
```

---

### ✅ Controller: `PostController.php`

```php
public function index()
{
    $posts = Post::latest()->get();
    return view('posts.index', compact('posts'));
}

public function create()
{
    return view('posts.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
    ]);

    Post::create($validated);
    return redirect()->route('posts.index')->with('success', 'Post created!');
}

public function edit(Post $post)
{
    return view('posts.edit', compact('post'));
}

public function update(Request $request, Post $post)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
    ]);

    $post->update($validated);
    return redirect()->route('posts.index')->with('success', 'Post updated!');
}

public function destroy(Post $post)
{
    $post->delete();
    return redirect()->route('posts.index')->with('success', 'Post deleted!');
}
```

---

### ✅ Blade Templates

#### `index.blade.php`

```blade
@extends('layouts.app')

@section('content')
<div>
    <a href="{{ route('posts.create') }}">+ New Post</a>
    @foreach ($posts as $post)
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>
        <a href="{{ route('posts.edit', $post) }}">Edit</a>
        <form action="{{ route('posts.destroy', $post) }}" method="POST">
            @csrf @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @endforeach
</div>
@endsection
```

#### `create.blade.php` and `edit.blade.php`