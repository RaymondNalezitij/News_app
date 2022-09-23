<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <script>
        function showCreatePostField() {

            var createPost = document.getElementById("createPost");
            if (createPost.style.display === "none") {
                createPost.style.display = "block";
                document.getElementById('showCreateFieldButton').innerHTML = 'Cancel';
            } else {
                createPost.style.display = "none";
                document.getElementById('showCreateFieldButton').innerHTML = 'Create post';
            }
        }

        function showEditPostField(postNumber) {
            var createPost = document.getElementById("postEdit" + postNumber);
            if (createPost.style.display === "none") {
                createPost.style.display = "block";
                document.getElementById('showEditPostButton' + postNumber).innerHTML = 'Cancel';
                document.getElementById('postText' + postNumber).style.visibility = 'hidden';
                document.getElementById('postEditText' + postNumber).value = document.getElementById('postText' + postNumber).innerHTML;
            } else {
                createPost.style.display = "none";
                document.getElementById('showEditPostButton' + postNumber).innerHTML = 'Edit post';
                document.getElementById('postText' + postNumber).style.visibility = 'visible';
            }
        }
    </script>

    <div class="py-12">
        <div style="max-width: 700px" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if(count($admin_status) > 0)
                        @if($admin_status[0]->is_admin_at == 'global' || $admin_status[0]->is_admin_at == 'dashboard')
                            <div class="p-6 bg-white border-b border-gray-200">
                                <button id="showCreateFieldButton" onclick="showCreatePostField()">Create post</button>
                            </div>
                        @endif
                        <div class="createPost" id="createPost" style="display: none">
                            <form action="{{ route('dashboard.store') }}" method="POST">
                                @csrf
                                <label for="postCreateText">
                                    <textarea name="postCreateText" style="width:100%; height: 100px"></textarea>
                                </label>
                                <button type="submit" name="createPost" id="createPost">Create post</button>
                            </form>
                        </div>
                    @endif

                    <div style="display: none">{{ $i=1 }}</div>
                    @foreach($posts as $post)
                        <div class="pt-6 m-6 bg-white border-b border-gray-200">
                            @if(count($admin_status) > 0)
                                @if($admin_status[0]->is_admin_at == 'global' || $admin_status[0]->is_admin_at == 'dashboard')
                                    <form action="{{ route('dashboard.store') }}" method="POST">
                                        @csrf
                                        <label for="createdAt"></label><input name="createdAt" id="createdAt" value="{{ $post->created_at }}" style="display: none">
                                        <div style="display: flex;flex-direction: row; justify-content: space-between">
                                            <button id="showEditPostButton{{ $i+1 }}" type="button" onclick="showEditPostField({{ $i+1 }})">Edit post</button>
                                            <button type="submit" name="deletePost" id="deletePost">Remove post</button>
                                        </div>
                                @endif
                            @endif
                            <div id="postEdit{{ $i+1 }}" style="display: none">
                                <label for="postEditText{{ $i+1 }}">
                                    <textarea id="postEditText{{ $i+1 }}" name="postEditText" style="width:100%; height: 100px"></textarea>
                                </label>
                                <button type="submit" name="editPost" id="editPost">Edit post</button>
                            </div>
                            <p class="postText" id="postText{{ $i+1 }}">{{ $post->text }}</p>
                            </form>
                            <button type="button">Add comment</button>
                        </div>
                        <div style="display: none">{{ $i+=1 }}</div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
