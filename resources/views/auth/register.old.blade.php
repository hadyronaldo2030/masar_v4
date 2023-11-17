<link href="{{ asset($globalVariable . 'assetsManeger') }}/fonts/all.min.css" rel="stylesheet">

<style>
    .overflow-hidden{
        overflow: visible !important;
    }
    /* Upload Invoic Image */
    .uploadImg{
        z-index: 1;
        position: relative;
        top: -35px;
        left: 35%;
        width: 120px;
        height: 120px;
        border: 4px solid #acdcff;
        border-radius: 46px;
        object-fit: cover;
        background: #d9d9db;
        text-align: center;
    }

    .uploadImg img {
        width: 100%;
        height: 100%;
        object-fit: contain;;
        position: absolute;
        top: 0;
        left: 0px;
        border-radius: 46px;
    }
    .uploadImg input{
        height: 100%;
        position: relative;
        opacity: 0;
    }
    .uploadImg span{
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: var(--input);
        color: var(--color);
        border-radius: 46px !important;
    }

    /* Small image */
    .boxMinImg {
        display: flex;
        width: 275px;
        overflow-x: auto;
        margin-top: 13px;
        border-radius: 46px;
    }
    .boxMinImg .minImg {
        display: flex;
        min-width: 50px;
        height: 50px;
        margin-right: 6px;
        border-radius: 46px;
        background: var(--input);
        position: relative;
        justify-content: center;
        align-content: center;
        flex-wrap: wrap;
        overflow: hidden;
    }

    .file-upload {
        display: none;
    }

    .minImg img:empty {
        display: none;
    }
    .minImg .delete-button {
        display: none;
    }
    .minImg .delete-button {
        z-index: 1;
        position: absolute;
        top: 0px;
        right: 0px;
        background: #00000082;
        color: #DDD;
        border-radius: 46px;
        width: 100%;
        height: 100%;
        text-align: center;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        opacity: 0;
        transition: all .5s ease;
    }
    .minImg .delete-button:hover {
        opacity: 1;
    }

    .minImg img:visible + .delete-button {
        display: flex;
    }


    .btnPrimary{
        background: rgba(67, 28, 221, 0.874);
        color: #EEE;
    }

</style>

<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <div class="input-group uploadImg">
            <span class="minImg">
                <label style="font-size: 25px; color:#39649f" for="file-upload22" class="custom-upload-button"><i class="fa-solid fa-image fa-2xl"></i></label>
                <input type="file" id="file-upload22"  name="image"  class="file-upload">
                <img src="" alt="">
                <div class="delete-button">X</div>
            </span>
        </div>
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <!-- Job Title -->
        <div>
            <x-input-label for="jobTitle" :value="__('JobTitle')" />
            <x-text-input id="jobTitle" class="block mt-1 w-full" type="text" name="jobTitle" :value="old('jobTitle')" required autofocus autocomplete="jobTitle" />
            <x-input-error :messages="$errors->get('jobTitle')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<script src="{{ asset($globalVariable . 'assetsManeger') }}/fonts/all.min.js"></script>
<script src="{{ asset($globalVariable . 'assetsManeger') }}/js/jquery-3.5.1.min.js"></script>
<script src="{{asset($globalVariable .'assetsManeger')}}/js/createProject.js"></script>
<script>
    // ============================== upload images2 ==============================
   $(document).ready(function() {
       $('.file-upload').change(function() {
           var file = this.files[0];
           var reader = new FileReader();
           var minImg = $(this).closest('.minImg');

           reader.onload = function() {
               var img = minImg.find('img');
               img.attr('src', reader.result);
               img.css('display', 'block');
               minImg.find('.delete-button').css('display', 'flex');
           };

           reader.readAsDataURL(file);
       });

       $('.delete-button').click(function() {
           var minImg = $(this).closest('.minImg');
           var img = minImg.find('img');
           img.attr('src', '');
           img.css('display', 'none');
           var input = minImg.find('.file-upload');
           input.val('');
           $(this).css('display', 'none');
       });
   });
</script>

