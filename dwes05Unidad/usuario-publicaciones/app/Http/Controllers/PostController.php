<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function main()
    {
        return view('inicio');
    }

    public function index()
    {
        $posts = Post::all();

        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        if (Auth::check()) {
            return view('posts.create');
        } else {
            return redirect()->route('principal')
                ->with('failure', 'Inicia sesión para poder insertar.');
        }
    }

    public function store(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'title' => 'required|max:255',
                'body' => 'required|max:1000'
            ]);

            $post = new Post;
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->user_id = Auth::id();
            $post->save();

            return redirect()->route('posts.index')
                ->with('success', 'Post creado correctamente.');
        } else {
            return redirect()->route('principal')
                ->with('failure', 'Inicia sesión para poder insertar.');
        }
    }

    public function show(Post $post)
    {
        /*

        En un enfoque típico usando Route::resource, esta función
        mostraría la vista de un 'post' específico con detalles usando
        el modelo Post.

        Ejemplo de implementación típica:

        return view('posts.show', ['post' => $post]);

        */
    }

    public function edit(Post $post)
    {
        if (Auth::check()) {
            return view('posts.edit', ['post' => $post]);
        } else {
            return view('invitado');
        }
    }

    public function update(Request $request, Post $post)
    {
        if (Auth::check()) {
            if (
                Auth::id() == $post->user_id ||
                Auth::user()->role == 'admin'
            ) {
                $request->validate([
                    'title' => 'required|max:255',
                    'body' => 'required|max:1000'
                ]);

                $post->title = $request->input('title');
                $post->body = $request->input('body');
                $post->save();

                return redirect()->route('posts.index')
                    ->with('success', 'Post actualizado correctamente.');
            } else {
                return redirect()->route('principal')
                    ->with('failure', 'No puedes editar este \'post\'.');
            }
        } else {
            return redirect()->route('principal')
                ->with('failure', 'Inicia sesión para poder editar.');
        }
    }

    public function destroy(Post $post)
    {
        /*

        En un enfoque convencional usando Route::resource, esta
        función eliminaría un post específico y redirigiría a la vista
        de índice (post.index). Sin embargo, en este ejemplo didáctico,
        se está usando un enfoque diferente basado en Request y, por
        lo tanto, se deja esta función vacía.

        Ejemplo de implementación típica:

        $post->delete();
        return redirect()->route('posts.index')
        ->with('success', 'Post eliminado correctamente.');

        */
    }

    public function editForm()
    {
        if (Auth::check()) {
            return view('posts.edit_form');
        } else {
            return redirect()->route('principal')
                ->with('failure', 'Inicia sesión para poder editar.');
        }
    }

    public function editById(Request $request)
    {
        if (Auth::check()) {
            $request->validate(['id' => 'required|integer|min:1']);

            $id = $request->input('id');
            $post = Post::findOrFail($id);

            if (
                Auth::id() === $post->user_id ||
                Auth::user()->role === 'admin'
            ) {
                return view('posts.edit', ['post' => $post]);
            } else {
                return redirect()->route('principal')
                    ->with('failure', 'No puedes editar este \'post\'.');
            }
        } else {
            return redirect()->route('principal')
                ->with('failure', 'Inicia sesión para poder editar.');
        }
    }

    public function delForm()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return view('posts.delete_form');
            } else {
                return redirect()->route('principal')
                    ->with('failure', 'Inicia como \'admin\' para borrar.');

            }
        } else {
            return redirect()->route('principal')
                ->with('failure', 'Inicia como \'admin\' para borrar.');
        }
    }

    public function delById(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                $request->validate(['id' => 'required|integer|min:1']);

                $id = $request->input('id');
                $post = Post::findOrFail($id);

                $post->delete();

                return redirect()->route('principal')
                    ->with('success', 'Post eliminado correctamente.');
            } else {
                return redirect()->route('principal')
                    ->with('failure', 'Inicia como \'admin\' para borrar.');
            }
        } else {
            return redirect()->route('principal')
                ->with('failure', 'Inicia como \'admin\' para borrar.');
        }
    }

    public function userPosts()
    {
        if (Auth::check()) {
            $posts = Auth::user()->posts;

            return view('posts.index', ['posts' => $posts]);
        } else {
            return redirect()->route('principal')
                ->with('failure', 'Inicia sesión para ver tus \'posts\'.');
        }
    }
}
