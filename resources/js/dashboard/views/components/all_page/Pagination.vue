<template lang="">
    <div class="flex items-center justify-between border-t px-4 py-3 sm:px-6">
        <div class="flex flex-1 justify-between sm:hidden">
            <a :href="store.all?.prev_page_url"
                @click.prevent="store.fetch_all({url: store.all?.prev_page_url})"
                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                Previous
            </a>
            <a :href="store.all?.next_page_url"
                @click.prevent="store.fetch_all({url: store.all?.next_page_url})"
                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                Next
            </a>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-end gap-4">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">
                        {{ store.all?.from }}
                    </span>
                    to
                    <span class="font-medium">
                        {{ store.all?.to }}
                    </span>
                    of
                    <span class="font-medium">
                        {{ store.all?.total }}
                    </span>
                    results
                </p>
            </div>
            <div>
                <nav v-if="store.all?.links" class="isolate flex -space-x-px rounded-md shadow-xs" aria-label="Pagination">
                    <a :href="store.all?.links[0].url"
                        @click.prevent="store.fetch_all({url: store.all?.links[0].url})"
                        class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                        <span class="sr-only">Previous</span>
                        <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <!-- Current: "z-10 bg-indigo-600 text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0" -->
                    <template v-for="(link, link_index) in store.all?.links" :key="link.label">
                        <a v-if="link_index>0 && link_index < store.all?.links.length-1"
                            :href="link.url"
                            @click.prevent="store.fetch_all({url: link.url})"
                            :class="{'bg-indigo-300': link.active}"
                            class="relative z-10 inline-flex items-center hover:bg-gray-300 px-4 py-2 text-sm font-semibold text-gray-900 focus:z-20 focus-visible:outline-2 focus-visible:outline-offset-2">
                            {{ link.label }}
                        </a>
                    </template>

                    <a :href="store.all?.links[store.all?.links.length-1].url"
                        @click.prevent="store.fetch_all({url: store.all?.links[store.all?.links.length-1].url})"
                        class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                        <span class="sr-only">Next</span>
                        <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </nav>
            </div>
            <div>
                <!-- <label for="limit" class="sr-only">Limit</label> -->
                <select id="limit"
                        :value="store.paginate"
                        @change="store.set_paginate($event.target.value)"
                        class="block w-full rounded-e-xs py-2 border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option :value="10">10</option>
                    <option :value="50">50</option>
                    <option :value="100">100</option>
                    <option :value="200">200</option>
                </select>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        store: {
            type: Object,
            required: true
        }
    }
}
</script>
<style lang="">

</style>
