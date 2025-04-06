<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = Post::count();
        return view("pages.admin.posts.index", ['count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.admin.posts.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $fields = $request->validated();
        $slug = Str::slug(substr($fields['description'], 0, 50));
        $count = Post::where('slug', 'like', "$slug%")->count();
        $fields['slug'] = $count ? "{$slug}-{$count}" : $slug;
        $fields['status'] = "approved";
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

        return redirect()->route('admin.posts.index')->with('success', 'Publié avec succès !');
    }

    public function setStatus(Request $request, Post $post)
    {
        Gate::authorize('manage_posts', $post);

        $fields = $request->validate([
            'status' => 'required|in:rejected,approved'
        ]);
        $post->status = $fields['status'];
        $post->save();
        return redirect()->back()->with("success", "Status mis à jour avec succès");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('manage_posts', $post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('manage_posts', $post);

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('manage_posts', $post);


        if ($post->medias->count() > 0) {
            foreach ($post->medias as $media) {
                cloudinary()->destroy($media->public_id);
            }
        }
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Publication Supprimée avec succès !');
    }
}
