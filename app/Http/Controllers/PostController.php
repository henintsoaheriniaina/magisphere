<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $fields = $request->validated();
        // dd($fields);
        $slug = Str::slug(substr($fields['description'], 0, 50));
        $count = Post::where('slug', 'like', "$slug%")->count();
        $count = $count + 1;
        $fields['slug'] = $count ? "{$slug}-{$count}" : $slug;
        if ($request->input('category')) {
            $fields['category'] = $request->input('category');
        } else {
            $fields['category'] = 'post';
        }
        if (Auth::user()->hasRole("admin|moderator")) {
            $fields['status'] = 'approved';
        }
        $post = Auth::user()->posts()->create($fields);
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $uploadedFile = cloudinary()->upload($file->getRealPath(), [
                    'folder' => 'magisphere/posts',
                    'resource_type' => str_contains($file->getMimeType(), 'video') ? 'video' : 'auto'
                ]);

                $post->medias()->create([
                    'url' => $uploadedFile->getSecurePath(),
                    'public_id' => $uploadedFile->getPublicId(),
                    'type' => $file->getClientMimeType(),
                    'name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                ]);
            }
        }

        return redirect()->route('index')->with('success', 'Publié avec succès !');
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if ($post->status !== "approved" && !Auth::user()->hasRole('admin|moderator')) {
            abort(404);
        }
        return view('pages.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('manage_posts', $post);
        return view('pages.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('manage_posts', $post);
        $fields = $request->validate([
            'description' => 'required|string',
            'category' => 'nullable|in:post,announcement',
        ], [
            'description.required' => 'La description est obligatoire.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'description.max' => 'La description ne peut pas dépasser 1000 caractères.',
            'category.in' => 'La catégorie sélectionnée est invalide.',
        ]);
        if ($request->input('category')) {
            $fields['category'] = $request->input('category');
        } else {
            $fields['category'] = 'post';
        }
        $post->update($fields);
        return redirect()->route('posts.show', $post)->with('success', 'Publication Modifiée avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
        if ($post->medias->count() > 0) {
            foreach ($post->medias as $media) {
                cloudinary()->destroy($media->public_id);
            }
        }
        $post->delete();
        return redirect()->route('index')->with('success', 'Publication Supprimée avec succès !');
    }
}
