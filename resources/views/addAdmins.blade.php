<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add or remove admins') }}
        </h2>
        <link rel="stylesheet" type="text/css" href="{{ url('/styles/dashboard.css') }}"/>
        <script src="{{ url('/scripts/dashboard.js') }}"></script>
    </x-slot>

    <div class="py-12">
        <div style="max-width: 700px" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($currentUserAdminCheck[0]->is_admin_at == 'global' || $currentUserAdminCheck[0]->is_admin_at == 'dashboard')
                        @foreach($users as $user)
                            @if($user->id > 1)
                                <form action="{{ route('addAdmins.store') }}" method="POST">
                                    @csrf
                                    <div style="display: flex;justify-content: space-between; margin: 10px">
                                        <p>{{$user->name}}</p>
                                        <label>
                                            <input name="user_id" value="{{$user->id}}" hidden>
                                        </label>
                                        @foreach($AdminRoles as $role)
                                            @if($user->id == $role->user_id)
                                                @if($role->is_admin_at == '')
                                                    <label>
                                                        <input name="isAdmin" value="false" hidden>
                                                    </label>
                                                    <button type="submit" name="makeAdmin">Make admin</button>
                                                @else
                                                    <label>
                                                        <input name="isAdmin" value="true" hidden>
                                                    </label>
                                                    <button type="submit" name="removeAdmin">Revoke admin</button>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </form>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
