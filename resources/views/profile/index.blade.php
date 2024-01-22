@extends('user.dashboard')
@section('main')

<main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            User Profile
        </h2>

        <!-- Display success or error messages -->
        @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if(Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <form action="{{ route('user.update.profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
           

                <!-- File upload for profile picture -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Logo</span>
                    <input
                        type="file"
                        name="profile_pic"
                        accept="image/*"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    />
                </label>
                @if(auth()->user()->profile_pic)
                <img src="{{ Storage::url(auth()->user()->profile_pic) }}" width="150" class="mt-3">
            @endif

            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Company name</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Company name"
                    type="text"
                    name="name"
                    value="{{ auth()->user()->name }}"
                />
            </label>

                <div class="mt-2">
                    <button
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                        name="submit"
                        type="submit"
                    >
                        Update
                    </button>
                    <!-- Display profile picture if exists -->
                   
                </div>
            </div>
        </form>

        <div class="row justify-content-center">
            <h2>Change your password</h2>
    
            <form action="{{route('user.password')}}" method="post">@csrf
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="current_password">Your current password</label>
                        <input type="password" name="current_password" class="form-control" id="current_password">
                    </div>
                    <div class="form-group">
                        <label for="password">Your new password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm password</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                    </div>
                    <div class="form-group mt-4">
                        <button class="btn btn-success" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
   
</main>

@endsection
