<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <link rel="stylesheet" type="text/css" href="{{ url('/styles/dashboard.css') }}"/>
        <script src="{{ url('/scripts/dashboard.js') }}"></script>
    </x-slot>

    <div class="py-12">
        <div style="max-width: 700px" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div style="display: flex; flex-direction: row">
                        <form action="{{ route('dashboard.store') }}" method="POST">
                            @csrf
                            <div style="display: flex; flex-direction: column">
                            <label for="category">
                                <select name="category" id="category">
                                    <option value="all">All</option>
                                    @foreach($categories as $category)
                                        @if($category->id > 1)
                                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </label>
                            <button type="submit" name="sortById">Sort by category</button>
                            </div>
                        </form>
                        @if(count($admin_status) > 0)
                            @if($admin_status[0]->is_admin_at == 'global' || $admin_status[0]->is_admin_at == 'dashboard')
                                <form action="{{ route('dashboard.store') }}" method="POST">
                                    @csrf
                                    <label for="categoryInput">
                                        <input id="categoryInput" class="categoryInput" type="text" name="category_name"
                                               autocomplete="off">
                                    </label>
                                    <button style="margin: 10px" type="submit" name="addCategory">add</button>
                                    <button style="margin: 10px" type="submit" name="removeCategory">remove</button>
                                </form>
                            @endif
                        @endif
                    </div>

                    @if(count($admin_status) > 0)
                        @if($admin_status[0]->is_admin_at == 'global' || $admin_status[0]->is_admin_at == 'dashboard')
                            <div class="p-6 bg-white border-b border-gray-200"
                                 style="display:flex; justify-content: center">
                                <button class="createPostButton" id="showCreateFieldButton"
                                        onclick="showCreatePostField()">Create a new post
                                </button>
                            </div>
                        @endif
                        <div class="createPost" id="createPost" style="display: none">
                            <form action="{{ route('dashboard.store') }}" method="POST">
                                @csrf
                                <label for="postCreateText">
                                    <textarea name="postCreateText" style="width:100%; height: 100px"
                                              autocomplete="off"></textarea>
                                </label>
                                <div style="display:flex; justify-content: center;">
                                    <button style="font-size: 20px" type="submit" id="createPost" name="createPost">
                                        Create post
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif

                    <div style="display: none">{{ $i=1 }}</div>
                    @foreach($posts as $post)
                        <div id="postNumber{{ $post->id }}">
                            <div class="py-6 m-6 bg-white border-b border-t border-gray-200">
                                <div style="display: flex; flex-direction: row; justify-content: space-between">
                                    <form style="width: 100%" action="{{ route('dashboard.store') }}" method="POST">
                                        @csrf
                                        @if(count($admin_status) > 0)
                                            @if($admin_status[0]->is_admin_at == 'global' || $admin_status[0]->is_admin_at == 'dashboard')
                                                <label for="postId"></label><input name="postId" id="postId"
                                                                                   value="{{ $post->id }}"
                                                                                   style="display: none">
                                                <div style="display: flex;flex-direction: row;">
                                                    <button class="postEditButtons" id="showEditPostButton{{ $i+1 }}"
                                                            type="button"
                                                            onclick="showEditPostField({{ $i+1 }})">Edit post
                                                    </button>
                                                    <button class="postEditButtons" type="submit" name="deletePost"
                                                            id="deletePost">Remove post
                                                    </button>
                                                </div>
                                            @endif
                                        @endif
                                        <div id="postEdit{{ $i+1 }}" style="display: none">
                                            <label for="postEditText{{ $i+1 }}">
                                                    <textarea class="editTextBox" id="postEditText{{ $i+1 }}"
                                                              name="postEditText"></textarea>
                                            </label>
                                            <button type="submit" name="editPost" id="editPost">Edit post
                                            </button>
                                        </div>
                                        <div
                                            style="display: flex;flex-direction: row; justify-content: space-between">
                                            <div style="display: flex;flex-direction: row;">
                                                <p class="postText"
                                                   id="postText{{ $i+1 }}">{{ $post->text }}</p>
                                                @foreach($categories as $category)
                                                    @if($category->id == $post->category_id)
                                                        <p style="font-size: 10px">{{ $category->name }}</p>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div>
                                                <form action="{{ route('dashboard.store') }}" method="POST">
                                                    @csrf
                                                    <div style="display: flex;flex-direction: column">
                                                        <select name="category" id="category"
                                                                style="max-height: 40px">
                                                            <option value="all">All</option>
                                                            @foreach($categories as $category)
                                                                @if($category->id > 1)
                                                                    <option
                                                                        value="{{ $category->name }}">{{ $category->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <label for="postId"></label><input name="postId"
                                                                                           id="postId"
                                                                                           value="{{ $post->id }}"
                                                                                           style="display: none">
                                                        <button type="submit" name="assignCategory">Assign
                                                            category
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <form action="{{ route('dashboard.store') }}" method="POST">
                                    @csrf
                                    <label for="postId"></label><input name="postId" id="postId"
                                                                       value="{{ $post->id }}"
                                                                       style="display: none">
                                    <label for="commentInput">
                                        <input id="commentInput" name="commentInput" class="commentInput"
                                               type="text" placeholder="Add comment" autocomplete="off">
                                    </label>
                                    <div class="commentSubmitContainer">
                                        <button class="commentSubmit" type="submit" name="createComment">Add
                                            comment
                                        </button>
                                    </div>
                                </form>

                                @foreach($comments as $comment)
                                    @if($comment->post_id==$post->id)
                                        <form action="{{ route('dashboard.store') }}" method="POST">
                                            <div style="display: flex;"
                                                 class="flex-row justify-between p-2 bg-white border-t border-gray-200">
                                                <div style="width: 90%;">
                                                    <p class="comment"
                                                       id="comment{{ $comment->id }}">{{ $comment->text }}</p>
                                                    <label for="commentEditTextBox{{ $comment->id }}">
                                                                <textarea id="commentEditTextBox{{ $comment->id }}"
                                                                          name="commentEditText"
                                                                          style="width:100%; display: none;"
                                                                          autocomplete="off"></textarea>
                                                    </label>
                                                </div>
                                                @if(count($admin_status) > 0)
                                                    @if($admin_status[0]->is_admin_at == 'global' || $admin_status[0]->is_admin_at == 'dashboard')
                                                        @csrf
                                                        <label for="commentId{{ $comment->id }}">
                                                            <input name="commentId"
                                                                   id="commentId{{ $comment->id }}"
                                                                   value="{{ $comment->id }}"
                                                                   style="display: none">
                                                        </label>
                                                        <div style="display: flex; flex-direction: column">
                                                            <div class="adjustCommentsButtons">
                                                                <button type="button" name="editComment"
                                                                        onclick="showEditCommentField(document.getElementById('commentId{{ $comment->id }}').value)"
                                                                        id="editComment{{ $comment->id }}">
                                                                    &#9997;
                                                                </button>
                                                                <button type="submit" name="deleteComment"
                                                                        id="deleteComment">&#128465;
                                                                </button>
                                                            </div>

                                                            <button class="p-2" type="submit"
                                                                    name="submitCommentEdit"
                                                                    id="submitComment{{ $comment->id }}"
                                                                    style="visibility: hidden">Commit
                                                            </button>
                                                        </div>

                                                    @endif
                                                @endif
                                            </div>
                                        </form>

                                    @endif
                                @endforeach
                                <div class="border-t border-gray-200"></div>
                            </div>
                        </div>
                        <div style="display: none">{{ $i+=1 }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
