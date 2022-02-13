<?php extend('template/T_hothothot_subpage')?>

<?php startSection('content');?>
    <main class="max-w-md m-auto">
        <header id="interiorMiniCard" class="Aurora_Bg rounded-3xl p-5 lg:max-w-md w-full min-w-min">
            <ul class="flex p-3">
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
        </header>
        <section class="mt-5 ">
            <h2>Chart</h2>
            <canvas class=" mt-5 bg-gray-800 p-5 rounded-3xl" id="interiorChart"></canvas>
        </section>
        <section id="history" class="my-5">
            <h2>History</h2>
            <template id="InteriorHistory">
                <ul class="flex gap-2 rounded-3xl p-6 lg:max-w-md w-full min-w-min bg-gray-800 mt-5">
                    <li>
                        <data value="10:00" class="text-5xl pr-5 font-bold border-r-2 setDataValue hours"></data>
                    </li>
                    <li class="flex justify-center px-5">
                        <data value="20" class="inline-flex items-center text-3xl setValue historyTemp"></data>
                    </li>
                </ul>
            </template>
        </section>
    </main>
<?php endSection()?>