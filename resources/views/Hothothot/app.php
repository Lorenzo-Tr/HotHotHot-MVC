<?php extend('template/hothothot')?>

<?php startSection('content');?>
<main class="mt-9">
    <article class=" temp_section ">
        <header class="flex-fix">
            <h2>Temperature</h2>
            <p id="currentDate" class="text-base text-gray-400 mt-1">Javascript need to be active</p>
        </header>
        <a href="hothothot/exterior" class="Aurora_Bg rounded-3xl p-5 mt-5 lg:max-w-md w-full min-w-min" id="exterior">
            <h3>Exterior</h3>
            <ul class="flex mt-4">
                <li>
                    <data value="30" class="temp border-r-2 pr-3"></data>
                </li>
                <li class="flex flex-col justify-center px-5">
                    <data value="30" class="inline-flex items-center text-2xl max"><img src="/public/assets/img/arrow.svg"
                                                                                        alt="max"></data>
                    <data value="14" class="inline-flex items-center text-2xl min"><img class="min" src="/public/assets/img/arrow.svg"
                                                                                        alt="min"></data>
                </li>
            </ul>
            <p class="inline-flex items-center text-lg mt-5">View more <img class="-rotate-90 ml-1 w-5"
                                                                            src="/public/assets/img/arrow.svg" alt=""></p>
        </a>
        <a href="hothothot/interior" class="Aurora_Bg rounded-3xl p-5 mt-5 lg:max-w-md w-full min-w-min" id="interior">
            <h3>Interior</h3>
            <ul class="flex mt-4">
                <li>
                    <data value="26" class="temp border-r-2 pr-3"></data>
                </li>
                <li class="flex flex-col justify-center px-5">
                    <data value="26" class="inline-flex items-center text-2xl max"><img src="/public/assets/img/arrow.svg"
                                                                                        alt="max"></data>
                    <data value="20" class="inline-flex items-center text-2xl min"><img src="/public/assets/img/arrow.svg"
                                                                                        alt="min"></data>
                </li>
            </ul>
            <p class="inline-flex items-center text-lg mt-5">View more <img class="-rotate-90 ml-1 w-5"
                                                                            src="/public/assets/img/arrow.svg" alt=""></p>
        </a>
        <button id="fetchnewdada" class="inline-flex items-end text-lg text-gray-400 mt-5">Fetch new data <img class="ViewMore_Icon"
                                                                                                               src="/public/assets/img/arrow-nobar.svg" alt=""></button>
    </article>
    <article class="mt-5 mb-8">
        <header class="flex justify-between">
            <h2>Last alert</h2>
        </header>
        <section id="alert" class="bg-gray-800 p-6 mt-5 rounded-3xl ">
            <h3 id="AlertPlaceholder" class="flex flex-col items-center text-gray-400 ">
                <img class="w-24 lg:w-2/12 mb-3" src="/public/assets/img/NoAlert.svg" alt="">
                There is no alert
            </h3>
            <ul class="flex flex-col" id="lastAlert">
            </ul>
            <template id="templateAlert">
                <li>
                    <ul class="p-3 flex lg:flex-wrap">
                        <li class="self-center">
                            <img class="w-14 lg:w-16" src="/public/assets/img/Info.webp" alt="">
                        </li>
                        <li class="ml-5">
                            <h4 class="flex-fix text-gray-400">Alert 08/10/2021 - 10:40</h4>
                            <p class="text-xl"></p>
                        </li>
                    </ul>
                </li>
            </template>
        </section>
    </article>
</main>
<?php endSection()?>
