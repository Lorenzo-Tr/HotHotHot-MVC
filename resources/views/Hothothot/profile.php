<?php extend('template/T_hothothot_subpage')?>

<?php startSection('content');?>
    <main>
        <article class="flex flex-col items-center max-w-md m-auto">
            <header class="flex flex-col items-center">
                <section class="relative">
                    <h3 class="titleHidding absolute">Profile Picture</h3>
                    <button class="rounded-full bg-white p-1 border-4 border-myBg absolute right-0"><img class="w-5 lg:w-5" src="/public/assets/img/edit.svg" alt="Editer la photo de profile"></button>
                    <img class="rounded-full w-28 lg:w-30" src="/public/assets/img/profilePicture.jpg" alt="Your profile picture">
                </section>
                <h2 class="mt-2">Florence Risco</h2>
            </header>
            <section class="flex flex-col items-start w-full bg-gray-800 rounded-3xl p-8 mt-5">
                <h3>Account information</h3>
                <ul class="w-full mt-5 flex flex-col gap-4">
                    <li class="w-full relative">
                        <label class="text-gray-400 block w-full" for="name">Display name</label>
                        <input class="w-min bg-transparent text-xl" name="name" id="name" type="text" value="Florence Risco" disabled>
                        <button class="px-4 p-2 bg-white text-myBg uppercase font-bold absolute right-0 bottom-0 rounded-lg text-sm">Edit</button>
                    </li>
                    <li class="w-full relative">
                        <label class="text-gray-400 block w-full" for="mail">Email</label>
                        <input  class="w-min bg-transparent text-xl" name="mail" id="mail" type="email" value="florisco56@gmail.com" disabled>
                        <button class="px-4 p-2 bg-white text-myBg uppercase font-bold absolute right-0 bottom-0 rounded-lg text-sm">Edit</button>
                    </li>
                    <li class="w-full relative">
                        <label class="text-gray-400 block w-full" for="password">Password</label>
                        <input  class="w-min bg-transparent text-xl" name="password" id="password" type="password" value="Mypasswordestsafe" disabled>
                        <button class="px-4 p-2 bg-white text-myBg uppercase font-bold absolute right-0 bottom-0 rounded-lg text-sm">Change</button>
                    </li>
                </ul>
            </section>
            <footer  class="w-full flex flex-col items-center my-20">
                <a class="text-red text-xl" href="#">Delete your account</a>
                <button class="w-full py-3 Aurora_Bg rounded-xl text-2xl uppercase font-bold mt-8">Sign Out</button>
            </footer>
        </article>
    </main>
<?php endSection()?>