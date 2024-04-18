public function createPost(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'author_id' => 'required|integer|exists:users,id',
        'category_id' => 'required|integer|exists:categories,id',
    ]);

    $title = $request->input('title');
    $authorId = $request->input('author_id');
    $categoryId = $request->input('category_id');

    $existingPost = BlogPost::where('author_id', $authorId)
                            .where('title', $title)
                            ->exists();

    if ($existingPost) {
        return response()->json(['message' => 'Title already exists for this author.'], 409);
    }

    $newPost = new BlogPost();
    $newPost->title = $title;
    $newPost->author_id = $authorId;
    $newPost->status = 'published';
    $newPost->save();

    DB::table('post_categories')->insert([
        'post_id' => $newPost->id,
        'category_id' => $categoryId,
    ]);


    return response()->json(['message' => 'Post created successfully!'], 201);
}
