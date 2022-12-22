<div id="staticModal" x-show="open" @click.away="open = false"
    class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full"
    x-data="{
        start: null,
        current: null,
        stop: null,
        interval: null
    }">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    タイマー
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    @click="open = false">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <div>
                    <span x-text="getMinute(current, start)"></span> 分
                    <span x-text="getSecond(current, start)"></span> 秒
                </div>
                <div>
                    <button x-show="!start"
                        @click="
                        start = Date.now()
                        current = start
                        interval = setInterval(() => {current = Date.now()}, 1000)
                    ">Start</button>

                    <div x-show="!stop && start">
                        <button
                            @click="
                            stop = Date.now()
                            clearInterval(interval)
                        ">Stop</button>
                    </div>

                    <div x-show="stop">
                        <button
                            @click="
                            start = null
                            stop = null
                            current = null
                        ">Reset</button>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button @click="setMinuteInput(current, start); open = false">finish</button>
            </div>
        </div>
    </div>
</div>
<script>
    const getMinute = (current, start) => Math.trunc(((current - start) / 1000) / 60);
    const getSecond = (current, start) => Math.trunc(((current - start) / 1000) % 60);

    const setMinuteInput = (current, start) => {
        document.querySelector('#minute').value = Math.trunc(((current - start) / 1000) / 60);
    }
</script>
