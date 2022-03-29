<div class="w-full flex justify-end items-center" x-show="pageCount > 1">
    <!--First Button-->
    <button @click="view(0)" :disabled="!pageNumber" :class="{ 'disabled text-gray-600' : !pageNumber }">
        <svg class="h-6 w-6 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <polygon points="19 20 9 12 19 4 19 20"></polygon>
            <line x1="5" y1="19" x2="5" y2="5"></line>
        </svg>
    </button>

    <!--Previous Button-->
    <button @click="prev" :disabled="!pageNumber" :class="{ 'disabled cursor-default text-gray-600' : !pageNumber }">
        <svg class="h-6 w-6 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
    </button>

    <!-- Display page numbers -->
    <template x-for="(count,index) in paginationCount" :key="index-1">
        <button class="px-2 py-1 rounded"
            :class="{ 'bg-blue-600 text-white font-bold' : !isNaN(count) && count - 1 === pageNumber }"
            :disabled="isNaN(count)" type="button" @click="view(count-1)">
            <span x-text="count"></span>
        </button>
    </template>

    <!--Next Button-->
    <button @click="next" :disabled="pageNumber >= pageCount - 1"
        :class="{ 'disabled text-gray-600' : pageNumber >= pageCount - 1 }">
        <svg class="h-6 w-6 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
    </button>

    <!--Last Button-->
    <button @click="view(pageCount-1)" :disabled="pageNumber >= pageCount - 1"
        :class="{ 'disabled text-gray-600' : pageNumber >= pageCount - 1 }">
        <svg class="h-6 w-6 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <polygon points="5 4 15 12 5 20 5 4"></polygon>
            <line x1="19" y1="5" x2="19" y2="19"></line>
        </svg>
    </button>
</div>

<div>
    <div class="mt-3 mb-2 flex flex-wrap justify-end items-center text-sm leading-5 text-gray-700">
        <div class="w-full sm:w-auto text-center sm:text-left" x-show="pageCount > 1">
            Total <span class="font-bold" x-text="total"></span> | Showing
            <span x-text="from"></span> to
            <span x-text="to"></span>
        </div>
    </div>
</div>