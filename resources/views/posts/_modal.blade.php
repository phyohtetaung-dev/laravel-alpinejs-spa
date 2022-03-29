<div id="popup" class="z-50 fixed w-full flex justify-center inset-0" x-show="isOpen">
    <div @click="toggle" class="w-full h-full bg-gray-900 z-0 absolute inset-0"></div>
    <div class="mx-auto container">
        <div class="flex items-center justify-center h-full w-full">
            <div
                class="bg-white dark:bg-gray-800  rounded-md shadow fixed overflow-y-auto sm:h-auto w-10/12 md:w-8/12 lg:w-1/2 2xl:w-2/5">
                <div
                    class="bg-gray-100 dark:bg-gray-600 rounded-tl-md rounded-tr-md px-4 md:px-8 md:py-4 py-7 flex items-center justify-between">
                    <p class="text-base font-semibold dark:text-white" x-text="modalTitle"></p>
                    <button role="button" aria-label="close label"
                        class="focus:ring-2 focus:ring-offset-2 focus:ring-gray-600 focus:outline-none" @click="toggle">
                        <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/add_user-svg1.svg" alt="icon" />
                    </button>
                </div>
                <div class="px-4 md:px-10 pt-6 md:pt-12 md:pb-4 pb-7">
                    <div class="flex items-center justify-center">
                        <div tabindex="0" aria-label="img" role="img" @click="document.querySelector('#cover').click()"
                            class="focus:outline-none w-full h-40 bg-gray-100  rounded-md flex items-center justify-center cursor-pointer">
                            <img :src="previewUrl" alt="icon" class="w-full h-full" />
                        </div>
                    </div>
                    <form class="mt-11">
                        <div>
                            <input placeholder="Title" x-model="post.title"
                                class="focus:ring-2 focus:ring-gray-400 w-full focus:outline-none placeholder-gray-500 py-3 px-3 text-sm leading-none text-gray-800 bg-white dark:bg-gray-900  border rounded border-gray-200 dark:border-gray-700"
                                :class="{ '!border-red-500': error.title }" />
                            <div x-show="error.title">
                                <span class="text-red-500 text-sm" x-text="error.title"></span>
                            </div>
                        </div>
                        <div class="mt-8">
                            <textarea placeholder="Description" x-model="post.description"
                                class="focus:outline-none focus:ring-2 focus:ring-gray-400 dark:bg-gray-900 py-3 pl-3 overflow-y-auto h-24 border placeholder-gray-500 rounded border-gray-200 dark:border-gray-700  w-full resize-none focus:outline-none"
                                :class="{ '!border-red-500': error.description }"></textarea>
                            <div x-show="error.description">
                                <span class="text-red-500 text-sm" x-text="error.description"></span>
                            </div>
                        </div>
                        <input type="file" id="cover" class="hidden" accept="image/*" @click="$el.value = null"
                            @change="previewImg">
                    </form>
                    <div class="flex items-center justify-between mt-9">
                        <button class="btn btn-secondary px-6 py-3 text-sm" @click="toggle">Cancel</button>
                        <button class="btn btn-primary px-6 py-3 text-sm" x-text="modalBtn" @click="submit"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>