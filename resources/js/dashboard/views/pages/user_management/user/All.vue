<template lang="">
    <div>
        <span class="">Product Inventory Types</span>
        <div class="my-2">
            <div class="flex flex-wrap gap-2">
                <button type="button" class="inline-flex cursor-pointer items-center justify-center rounded-e-xs px-4 py-1 text-sm font-[400] bg-transparent text-gray-700 border border-gray-700 hover:bg-blue-50 transition">
                    <span class="ant-btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--lets-icons" font-size="20" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M12 6v12m6-6H6"></path>
                        </svg>
                    </span>
                    <span>Add New</span>
                </button>
                <button type="button" class="inline-flex cursor-pointer items-center justify-center rounded-e-xs px-4 py-1 text-sm font-[400] bg-transparent text-gray-700 border border-gray-700 hover:bg-blue-50 transition">
                    <span class="ant-btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mynaui" font-size="20" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.5 7h15M7 12h10m-7 5h4"></path>
                        </svg>
                    </span>
                    <span>Filter</span>
                </button>
                <div>
                    <input type="search"
                        @keyup="search_item($event.target.value)"
                        placeholder="searh.."
                        class="bg-white border border-gray-700 text-gray-900 text-sm rounded-e-xs focus:ring-blue-500 focus:border-blue-500 block w-full px-4 py-1"
                    />
                </div>
            </div>
        </div>
        <div class="overflow-x-auto table_wrapper min-h-[450px] max-h-[calc(100vh-220px)] pr-[5px] scrollbar-thin scrollbar-thumb-black scrollbar-track-[#F3F4EE]">
            <table cellpadding="10" class="table-auto w-full whitespace-nowrap border-separate border-spacing-y-2 [&amp;_tbody>tr]:bg-[#FBFBFB] [&amp;_tbody>tr:hover]:bg-white [&amp;_tbody>tr>td]:px-4 [&amp;_tbody>tr>td]:py-2 [&amp;_tbody>tr>td]:relative [&amp;_tbody>tr>td]:before:absolute [&amp;_tbody>tr>td]:before:w-[1px] [&amp;_tbody>tr>td]:before:h-[60%] [&amp;_tbody>tr>td]:before:bg-gray-200 [&amp;_tbody>tr>td]:before:left-0 [&amp;_tbody>tr>td]:before:top-1/2 [&amp;_tbody>tr>td]:before:-translate-y-1/2 first:[&amp;_tbody>tr>td]:before:hidden">
                <thead class="bg-white sticky top-0 left-0 z-[999]">
                    <tr>
                        <th
                            align="left"
                            class="font-medium px-4 py-2 relative before:absolute before:w-[1px] before:h-[60%] before:bg-gray-200 before:left-0 before:top-1/2 before:-translate-y-1/2 first:before:hidden"
                            style="color: rgb(76, 110, 171);"
                        >
                            ID
                        </th>
                        <th
                            align="left"
                            class="font-medium px-4 py-2 relative before:absolute before:w-[1px] before:h-[60%] before:bg-gray-200 before:left-0 before:top-1/2 before:-translate-y-1/2 first:before:hidden"
                            style="color: rgb(76, 110, 171);"
                        >
                            Name
                        </th>
                        <th
                            align="left"
                            class="font-medium px-4 py-2 relative before:absolute before:w-[1px] before:h-[60%] before:bg-gray-200 before:left-0 before:top-1/2 before:-translate-y-1/2 first:before:hidden"
                            style="color: rgb(76, 110, 171);"
                        >
                            Status
                        </th>
                        <th
                            align="center"
                            class="font-medium px-4 py-2 relative before:absolute before:w-[1px] before:h-[60%] before:bg-gray-200 before:left-0 before:top-1/2 before:-translate-y-1/2 first:before:hidden"
                            style="color: rgb(76, 110, 171);"
                        >
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in store.all?.data">
                        <td>{{ item.id }}</td>
                        <td>{{ item.name }}</td>
                        <td>
                            <span v-if="item.status" class="tag tag-success uppercase">
                                active
                            </span>
                        </td>
                        <td>
                            <div class="flex justify-center" style="gap: 4px;">
                                <button type="button" class="cursor-pointer inline-flex items-center justify-center bg-transparent text-gray-700 border border-gray-300 text-sm p-2 w-8 h-8 rounded-e-xs hover:bg-gray-100">
                                    <span class="ant-btn-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--ic" font-size="16" width="1em" height="1em" viewBox="0 0 24 24">
                                            <path
                                                fill="currentColor"
                                                d="m14.06 9.02l.92.92L5.92 19H5v-.92zM17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83l3.75 3.75l1.83-1.83a.996.996 0 0 0 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29m-3.6 3.19L3 17.25V21h3.75L17.81 9.94z"
                                            ></path>
                                        </svg>
                                    </span>
                                </button>
                                <button type="button" class="cursor-pointer inline-flex items-center justify-center bg-transparent text-gray-700 border border-gray-300 text-sm p-2 w-8 h-8 rounded-e-xs hover:bg-gray-100">
                                    <span class="ant-btn-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" font-size="16" width="1em" height="1em" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z"></path>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div>
            <div class="flex items-center justify-between border-t px-4 py-3 sm:px-6">
                <div class="flex flex-1 justify-between sm:hidden">
                    <a :href="store.all?.prev_page_url"
                        @click.prevent="store[`fetch_${this.config.store_prefix}s`]({url: store.all?.prev_page_url})"
                        class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Previous
                    </a>
                    <a :href="store.all?.next_page_url"
                        @click.prevent="store[`fetch_${this.config.store_prefix}s`]({url: store.all?.next_page_url})"
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
                        <nav v-if="store.all?.links" class="isolate inline-flex -space-x-px rounded-md shadow-xs" aria-label="Pagination">
                            <a :href="store.all?.links[0].url"
                                @click.prevent="store[`fetch_${this.config.store_prefix}s`]({url: store.all?.links[0].url})"
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
                                    @click.prevent="store[`fetch_${this.config.store_prefix}s`]({url: link.url})"
                                    :class="{'bg-indigo-300': link.active}"
                                    class="relative z-10 inline-flex items-center hover:bg-gray-300 px-4 py-2 text-sm font-semibold text-gray-900 focus:z-20 focus-visible:outline-2 focus-visible:outline-offset-2">
                                    {{ link.label }}
                                </a>
                            </template>

                            <a :href="store.all?.links[store.all?.links.length-1].url"
                                @click.prevent="store[`fetch_${this.config.store_prefix}s`]({url: store.all?.links[store.all?.links.length-1].url})"
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
                                :value="store[`paginate`]"
                                @change="store[`set_paginate_${config.store_prefix}`]($event.target.value)"
                                class="block w-full rounded-e-xs py-2 border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option :value="10">10</option>
                            <option :value="50">50</option>
                            <option :value="100">100</option>
                            <option :value="200">200</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>
<script>
import user_store from './setup/store';
import config from './setup/config';
import debounce from 'debounce';

export default {
    data: () => ({
        store: user_store(),
        config,
    }),
    watch: {
        'store': function(v){
            console.log(v);
        }
    },
    created: async function () {
        await this.store[`fetch_${this.config.store_prefix}s`]();
    },
    methods: {
        search_item: debounce(async function (value) {
            this.store[`search_${config.store_prefix}`](value)
        },500)
    }
}
</script>
