<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <script>
        function createPost() {
            var createPost = document.getElementById("createPost");
            if (createPost.style.display === "none") {
                createPost.style.display = "block";
            } else {
                createPost.style.display = "none";
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
                                <button onclick="createPost()">Create post</button>
                            </div>
                        @endif
                        <div class="createPost" id="createPost" style="display: none">
                            <form action="{{ route('dashboard.store') }}" method="POST">
                                @csrf
                                <label for="postText">
                                    <textarea name="postText" style="width:100%; height: 100px"></textarea>
                                </label>
                                <button type="submit" name="createPost" id="createPost">Create post</button>
                            </form>
                        </div>
                    @endif
                    <div style="visibility: hidden">{{ $i=0 }}</div>

                    @foreach($posts as $post)
                        <div class="pt-6 m-6 bg-white border-b border-gray-200">
                            @if(count($admin_status) > 0)
                                @if($admin_status[0]->is_admin_at == 'global' || $admin_status[0]->is_admin_at == 'dashboard')
                                    <form action="{{ route('dashboard.store') }}" method="POST">
                                        @csrf
                                        <label for="postNumber"></label><input name="postNumber" id="postNumber" value="{{ $i+=1 }}">
                                        <div style="display: flex;flex-direction: row; justify-content: space-between">
                                            <button type="submit" name="editPost" id="editPost">Edit post</button>
                                            <button type="submit" name="deletePost" id="deletePost">Remove post</button>
                                        </div>
                                    </form>
                                @endif
                            @endif
                            <p>{{ $post->text }}</p>
                            <button>Add comment</button>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
