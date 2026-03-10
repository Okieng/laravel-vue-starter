<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Teleport } from 'vue';

// Define the name for this page
defineOptions({
    name: 'Task',
});

const breadcrumbs = [
    {
        title: 'Task',
        href: '/task',
    },
];

const isModalOpen = ref(false);

const viewMode = ref('kanban');

const closeModal = () => {
    isModalOpen.value = false;
};

const openModal = () => {
    isModalOpen.value = true;
};
</script>

<template>

    <Head title="Task" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex items-center gap-4">
                <div
                    class="flex flex-col md:flex-row items-start md:items-center justify-between w-full bg-slate-100 dark:bg-[#242830] rounded-lg p-2 gap-4">

                    <div class="px-4 py-2">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white leading-tight">Task</h3>
                        <p class="text-xs text-gray-500">Manage your tasks and to-dos</p>
                    </div>

                    <div class="flex flex-wrap items-center gap-2 px-4 pb-2 md:pb-0 md:pr-4">
                        <button @click="viewMode = 'kanban'"
                            :class="viewMode === 'kanban' ? 'bg-white dark:bg-slate-700 shadow-sm text-gray-900 dark:text-white' : 'text-slate-500 hover:text-slate-700 dark:hover:text-slate-300'"
                            class="px-3 py-1.5 text-sm font-medium rounded-md flex items-center gap-2 border border-transparent hover:border-gray-300 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect width="7" height="7" x="3" y="3" rx="1" />
                                <rect width="7" height="7" x="14" y="3" rx="1" />
                                <rect width="7" height="7" x="14" y="14" rx="1" />
                                <rect width="7" height="7" x="3" y="14" rx="1" />
                            </svg>
                            Kanban
                        </button>

                        <button @click="viewMode = 'list'"
                            :class="viewMode === 'list' ? 'bg-white dark:bg-slate-700 shadow-sm text-gray-900 dark:text-white' : 'text-slate-500 hover:text-slate-700 dark:hover:text-slate-300'"
                            class="px-3 py-1.5 text-sm font-medium rounded-md flex items-center gap-2 border border-transparent hover:border-gray-300 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M3 5h.01" />
                                <path d="M3 12h.01" />
                                <path d="M3 19h.01" />
                                <path d="M8 5h13" />
                                <path d="M8 12h13" />
                                <path d="M8 19h13" />
                            </svg>
                            List
                        </button>

                        <button
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md flex items-center gap-2 shadow-sm transition-all active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            New Board
                        </button>
                    </div>
                </div>
            </div>
            <!-- tab disini, isinya kanban (active), list, deadline -->
            <!-- <div class="border-b border-gray-200 dark:border-slate-700 mt-4">
                <nav class="flex gap-6 px-4" aria-label="Tabs">
                    <button
                        class="shrink-0 border-b-2 border-indigo-600 px-1 pb-4 text-sm font-semibold text-indigo-600 dark:text-indigo-400"
                        aria-current="page">
                        Kanban
                    </button>

                    <button
                        class="shrink-0 border-b-2 border-transparent px-1 pb-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-slate-400 dark:hover:text-slate-200 transition-all">
                        List
                    </button>

                    <button
                        class="shrink-0 border-b-2 border-transparent px-1 pb-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-slate-400 dark:hover:text-slate-200 transition-all">
                        Deadline
                    </button>
                </nav>
            </div> -->
            <!--kanban-->
            <div v-show="viewMode === 'kanban'" class="flex-1 overflow-x-auto p-8 custom-scrollbar">
                <div class="flex gap-6 h-full min-w-max">
                    <!-- <div class="w-80 flex flex-col h-full">
                        <div class="flex items-center justify-between mb-4 px-2">
                            <div class="flex items-center gap-2">
                                <h2 class="font-bold text-slate-700 dark:text-slate-200">
                                    To Do
                                </h2>
                                <span
                                    class="px-2 py-0.5 text-xs font-bold bg-slate-200 dark:bg-slate-800 rounded-full text-slate-600 dark:text-slate-400">3</span>
                            </div>
                            <button class="p-1 hover:bg-slate-200 dark:hover:bg-slate-800 rounded-md">
                                <span class="material-icons-round text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                                        <path d="M5 12h14" />
                                        <path d="M12 5v14" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                        <div class="space-y-4 overflow-y-auto custom-scrollbar flex-1 pb-4">
                            <div
                                class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow group">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-semibold text-sm">Mock Up Company Profile</h3>
                                    <button class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                                        <span class="material-icons-round text-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-ellipsis-icon lucide-ellipsis">
                                                <circle cx="12" cy="12" r="1" />
                                                <circle cx="19" cy="12" r="1" />
                                                <circle cx="5" cy="12" r="1" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-4 line-clamp-2 leading-relaxed">
                                    Redesign website company profile PT Anyar Retail Indonesia
                                </p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span
                                        class="px-2 py-0.5 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400 text-[10px] font-bold rounded">Design</span>
                                    <span
                                        class="px-2 py-0.5 bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-400 text-[10px] font-bold rounded">Frontend</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4 text-slate-400">
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-calendar-icon lucide-calendar">
                                                    <path d="M8 2v4" />
                                                    <path d="M16 2v4" />
                                                    <rect width="18" height="18" x="3" y="4" rx="2" />
                                                    <path d="M3 10h18" />
                                                </svg></span>
                                            Jan 25
                                        </div>
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-user-icon lucide-user">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                    <circle cx="12" cy="7" r="4" />
                                                </svg></span>
                                            Sugih Nurdiansyah
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-0.5 bg-orange-200 dark:bg-orange-900/20 text-orange-600 dark:text-orange-400 text-[10px] font-bold rounded-full border border-orange-100 dark:border-orange-900/30">High</span>
                                </div>
                                <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                                    <button
                                        class="w-full text-[11px] font-semibold text-primary hover:bg-blue-50 dark:hover:bg-blue-900/20 py-1.5 rounded-md transition-colors flex items-center justify-center gap-1">
                                        <span class="material-icons-round text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-user-round-plus-icon lucide-user-round-plus">
                                                <path d="M2 21a8 8 0 0 1 13.292-6" />
                                                <circle cx="10" cy="8" r="5" />
                                                <path d="M19 16v6" />
                                                <path d="M22 19h-6" />
                                            </svg>
                                        </span>
                                        Assign
                                    </button>
                                </div>
                            </div>
                            <div
                                class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-semibold text-sm">
                                        Client presentation prep
                                    </h3>
                                    <button class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                                        <span class="material-icons-round text-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-ellipsis-icon lucide-ellipsis">
                                                <circle cx="12" cy="12" r="1" />
                                                <circle cx="19" cy="12" r="1" />
                                                <circle cx="5" cy="12" r="1" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-4 line-clamp-2 leading-relaxed">
                                    Prepare slides for Q1 review meeting with the main
                                    stakeholders.
                                </p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span
                                        class="px-2 py-0.5 bg-green-100 dark:bg-green-500 text-green-600 dark:text-green-400 text-[10px] font-bold rounded">Sales</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4 text-slate-400">
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-calendar-icon lucide-calendar">
                                                    <path d="M8 2v4" />
                                                    <path d="M16 2v4" />
                                                    <rect width="18" height="18" x="3" y="4" rx="2" />
                                                    <path d="M3 10h18" />
                                                </svg></span>
                                            Jan 24
                                        </div>
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-user-icon lucide-user">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                    <circle cx="12" cy="7" r="4" />
                                                </svg></span>
                                            Febry Arizqa Firmansyah
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-0.5 bg-red-200 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-[10px] font-bold rounded-full border border-red-100 dark:border-red-900/30">Urgent</span>
                                </div>
                            </div>

                        </div>
                    </div> -->
                    <!--kanban-->
                    <div class="w-80 flex flex-col h-[80vh] bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-2">

                        <div class="flex items-center justify-between mb-4 px-2 pt-2 flex-shrink-0">
                            <div class="flex items-center gap-2">
                                <h2 class="font-bold text-slate-700 dark:text-slate-200">To Do</h2>
                                <span
                                    class="px-2 py-0.5 text-xs font-bold bg-slate-200 dark:bg-slate-800 rounded-full text-slate-600 dark:text-slate-400">3</span>
                            </div>
                            <button class="p-1 hover:bg-slate-200 dark:hover:bg-slate-800 rounded-md transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="text-slate-400">
                                    <path d="M5 12h14" />
                                    <path d="M12 5v14" />
                                </svg>
                            </button>
                        </div>

                        <div class="flex-1 overflow-y-auto overflow-x-hidden space-y-4 px-2 pb-4 custom-scrollbar">

                            <div
                                class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition-all group cursor-grab active:cursor-grabbing">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-semibold text-sm">Mock Up Company Profile</h3>
                                    <button class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            class="lucide-ellipsis">
                                            <circle cx="12" cy="12" r="1" />
                                            <circle cx="19" cy="12" r="1" />
                                            <circle cx="5" cy="12" r="1" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div
                                class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition-all group">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-semibold text-sm">Client presentation prep</h3>
                                </div>
                            </div>

                            <div
                                class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                                <h3 class="font-semibold text-sm">Additional Task for Testing</h3>
                            </div>

                            <div
                                class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-semibold text-sm">
                                        Client presentation prep
                                    </h3>
                                    <button class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                                        <span class="material-icons-round text-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-ellipsis-icon lucide-ellipsis">
                                                <circle cx="12" cy="12" r="1" />
                                                <circle cx="19" cy="12" r="1" />
                                                <circle cx="5" cy="12" r="1" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-4 line-clamp-2 leading-relaxed">
                                    Prepare slides for Q1 review meeting with the main
                                    stakeholders.
                                </p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span
                                        class="px-2 py-0.5 bg-green-100 dark:bg-green-500 text-green-600 dark:text-green-400 text-[10px] font-bold rounded">Sales</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4 text-slate-400">
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-calendar-icon lucide-calendar">
                                                    <path d="M8 2v4" />
                                                    <path d="M16 2v4" />
                                                    <rect width="18" height="18" x="3" y="4" rx="2" />
                                                    <path d="M3 10h18" />
                                                </svg></span>
                                            Jan 24
                                        </div>
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-user-icon lucide-user">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                    <circle cx="12" cy="7" r="4" />
                                                </svg></span>
                                            Febry Arizqa Firmansyah
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-0.5 bg-red-200 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-[10px] font-bold rounded-full border border-red-100 dark:border-red-900/30">Urgent</span>
                                </div>
                            </div>

                            <div
                                class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-semibold text-sm">
                                        Client presentation prep
                                    </h3>
                                    <button class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                                        <span class="material-icons-round text-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-ellipsis-icon lucide-ellipsis">
                                                <circle cx="12" cy="12" r="1" />
                                                <circle cx="19" cy="12" r="1" />
                                                <circle cx="5" cy="12" r="1" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-4 line-clamp-2 leading-relaxed">
                                    Prepare slides for Q1 review meeting with the main
                                    stakeholders.
                                </p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span
                                        class="px-2 py-0.5 bg-green-100 dark:bg-green-500 text-green-600 dark:text-green-400 text-[10px] font-bold rounded">Sales</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4 text-slate-400">
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-calendar-icon lucide-calendar">
                                                    <path d="M8 2v4" />
                                                    <path d="M16 2v4" />
                                                    <rect width="18" height="18" x="3" y="4" rx="2" />
                                                    <path d="M3 10h18" />
                                                </svg></span>
                                            Jan 24
                                        </div>
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-user-icon lucide-user">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                    <circle cx="12" cy="7" r="4" />
                                                </svg></span>
                                            Febry Arizqa Firmansyah
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-0.5 bg-red-200 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-[10px] font-bold rounded-full border border-red-100 dark:border-red-900/30">Urgent</span>
                                </div>
                            </div>

                            <div
                                class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-semibold text-sm">
                                        Client presentation prep
                                    </h3>
                                    <button class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                                        <span class="material-icons-round text-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-ellipsis-icon lucide-ellipsis">
                                                <circle cx="12" cy="12" r="1" />
                                                <circle cx="19" cy="12" r="1" />
                                                <circle cx="5" cy="12" r="1" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-4 line-clamp-2 leading-relaxed">
                                    Prepare slides for Q1 review meeting with the main
                                    stakeholders.
                                </p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span
                                        class="px-2 py-0.5 bg-green-100 dark:bg-green-500 text-green-600 dark:text-green-400 text-[10px] font-bold rounded">Sales</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4 text-slate-400">
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-calendar-icon lucide-calendar">
                                                    <path d="M8 2v4" />
                                                    <path d="M16 2v4" />
                                                    <rect width="18" height="18" x="3" y="4" rx="2" />
                                                    <path d="M3 10h18" />
                                                </svg></span>
                                            Jan 24
                                        </div>
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-user-icon lucide-user">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                    <circle cx="12" cy="7" r="4" />
                                                </svg></span>
                                            Febry Arizqa Firmansyah
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-0.5 bg-red-200 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-[10px] font-bold rounded-full border border-red-100 dark:border-red-900/30">Urgent</span>
                                </div>
                            </div>

                            <div
                                class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-semibold text-sm">
                                        Client presentation prep
                                    </h3>
                                    <button class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                                        <span class="material-icons-round text-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-ellipsis-icon lucide-ellipsis">
                                                <circle cx="12" cy="12" r="1" />
                                                <circle cx="19" cy="12" r="1" />
                                                <circle cx="5" cy="12" r="1" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-4 line-clamp-2 leading-relaxed">
                                    Prepare slides for Q1 review meeting with the main
                                    stakeholders.
                                </p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span
                                        class="px-2 py-0.5 bg-green-100 dark:bg-green-500 text-green-600 dark:text-green-400 text-[10px] font-bold rounded">Sales</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4 text-slate-400">
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-calendar-icon lucide-calendar">
                                                    <path d="M8 2v4" />
                                                    <path d="M16 2v4" />
                                                    <rect width="18" height="18" x="3" y="4" rx="2" />
                                                    <path d="M3 10h18" />
                                                </svg></span>
                                            Jan 24
                                        </div>
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-user-icon lucide-user">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                    <circle cx="12" cy="7" r="4" />
                                                </svg></span>
                                            Febry Arizqa Firmansyah
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-0.5 bg-red-200 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-[10px] font-bold rounded-full border border-red-100 dark:border-red-900/30">Urgent</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="w-80 flex flex-col h-[80vh] bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-2">

                        <div class="flex items-center justify-between mb-4 px-2 pt-2 flex-shrink-0">
                            <div class="flex items-center gap-2">
                                <h2 class="font-bold text-slate-700 dark:text-slate-200">In Progress</h2>
                                <span
                                    class="px-2 py-0.5 text-xs font-bold bg-slate-200 dark:bg-slate-800 rounded-full text-slate-600 dark:text-slate-400">3</span>
                            </div>
                            <button @click="openModal"
                                class="p-1 hover:bg-slate-200 dark:hover:bg-slate-800 rounded-md transition-colors">
                                <span class="material-icons-round text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" class="lucide-plus">
                                        <path d="M5 12h14" />
                                        <path d="M12 5v14" />
                                    </svg>
                                </span>
                            </button>

                            <Teleport to="body">
                                <div v-if="isModalOpen"
                                    class="fixed inset-0 z-[99] flex items-center justify-center overflow-hidden">

                                    <div @click="closeModal"
                                        class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity">
                                    </div>

                                    <div
                                        class="relative w-full max-w-3xl bg-white dark:bg-slate-900 rounded-2xl shadow-2xl p-6 mx-4 transform transition-all">

                                        <div class="flex items-center justify-between mb-6">
                                            <h3 class="text-xl font-bold text-slate-800 dark:text-white">Tambah Task
                                                Baru</h3>
                                            <button @click="closeModal"
                                                class="text-slate-400 hover:text-slate-600 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path d="M18 6 6 18" />
                                                    <path d="m6 6 12 12" />
                                                </svg>
                                            </button>
                                        </div>

                                        <div class="flex-1 overflow-y-auto p-8 custom-scrollbar space-y-6">
                                            <div>
                                                <label
                                                    class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-2">Task
                                                    Name</label>
                                                <input
                                                    class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none"
                                                    placeholder="Enter task title..." type="text" />
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-2">Task
                                                    Description</label>
                                                <div
                                                    class="border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-primary">
                                                    <textarea
                                                        class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-b-xl text-sm p-4 min-h-[120px] "
                                                        placeholder="Enter task description..."></textarea>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div>
                                                    <label
                                                        class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-2">Assign
                                                        To</label>
                                                    <div class="relative group">
                                                        <div
                                                            class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                                            <span class="material-icons-round text-lg">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="lucide lucide-search-icon lucide-search">
                                                                    <path d="m21 21-4.34-4.34" />
                                                                    <circle cx="11" cy="11" r="8" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                        <input
                                                            class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-primary transition-all"
                                                            placeholder="Search team members..." type="text" />
                                                    </div>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-2">Project
                                                        / Category</label>
                                                    <div class="relative">
                                                        <select
                                                            class="w-full appearance-none bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                                                            <option>Product Development</option>
                                                            <option>Marketing Campaign</option>
                                                            <option>Sales Operations</option>
                                                            <option>Internal Infrastructure</option>
                                                        </select>
                                                        <span
                                                            class="material-icons-round absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-chevron-down-icon lucide-chevron-down">
                                                                <path d="m6 9 6 6 6-6" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div class="col-span-2">
                                                    <label
                                                        class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-2">Duration</label>
                                                    <div class="flex items-center gap-2">
                                                        <div class="relative flex-1">
                                                            <input
                                                                class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-xl pl-10 pr-4 py-2.5 text-xs focus:ring-2 focus:ring-primary transition-all"
                                                                type="date" />
                                                        </div>
                                                        <span class="text-slate-400 text-md">sampai</span>
                                                        <div class="relative flex-1">
                                                            <input
                                                                class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-xl pl-10 pr-4 py-2.5 text-xs focus:ring-2 focus:ring-primary transition-all"
                                                                type="date" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-2">
                                                    <label
                                                        class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-2">Priority</label>
                                                    <div class="flex gap-2">
                                                        <button
                                                            class="flex-1 py-2.5 px-2 rounded-xl border border-slate-200 dark:border-slate-700 text-[10px] font-bold uppercase tracking-wider text-slate-500 bg-white dark:bg-slate-800 hover:border-blue-200 hover:text-blue-600 transition-all flex items-center justify-center gap-1.5">
                                                            <span class="w-2 h-2 rounded-full bg-slate-300"></span> Low
                                                        </button>
                                                        <button
                                                            class="flex-1 py-2.5 px-2 rounded-xl border-2 border-primary text-[10px] font-bold uppercase tracking-wider text-primary bg-blue-50 dark:bg-blue-900/20 transition-all flex items-center justify-center gap-1.5">
                                                            <span
                                                                class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                                            Medium
                                                        </button>
                                                        <button
                                                            class="flex-1 py-2.5 px-2 rounded-xl border border-slate-200 dark:border-slate-700 text-[10px] font-bold uppercase tracking-wider text-slate-500 bg-white dark:bg-slate-800 hover:border-red-200 hover:text-red-600 transition-all flex items-center justify-center gap-1.5">
                                                            <span class="w-2 h-2 rounded-full bg-red-500"></span> High
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex justify-end gap-3 mt-8">
                                            <button @click="closeModal" type="button"
                                                class="px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg">
                                                Batal
                                            </button>
                                            <button
                                                class="px-4 py-2 text-sm font-medium bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                                Simpan Task
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </Teleport>
                        </div>

                        <div class="flex-1 overflow-y-auto overflow-x-hidden space-y-4 px-2 pb-4 custom-scrollbar">

                            <div
                                class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition-all group cursor-grab active:cursor-grabbing">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-semibold text-sm">Mock Up Company Profile</h3>
                                    <button class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            class="lucide-ellipsis">
                                            <circle cx="12" cy="12" r="1" />
                                            <circle cx="19" cy="12" r="1" />
                                            <circle cx="5" cy="12" r="1" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div
                                class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition-all group cursor-grab active:cursor-grabbing">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-semibold text-sm">Client presentation prep</h3>
                                </div>
                            </div>

                            <div
                                class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                                <h3 class="font-semibold text-sm">Additional Task for Testing</h3>
                            </div>

                            <div
                                class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-semibold text-sm">
                                        Client presentation prep
                                    </h3>
                                    <button class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                                        <span class="material-icons-round text-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-ellipsis-icon lucide-ellipsis">
                                                <circle cx="12" cy="12" r="1" />
                                                <circle cx="19" cy="12" r="1" />
                                                <circle cx="5" cy="12" r="1" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-4 line-clamp-2 leading-relaxed">
                                    Prepare slides for Q1 review meeting with the main
                                    stakeholders.
                                </p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span
                                        class="px-2 py-0.5 bg-green-100 dark:bg-green-500 text-green-600 dark:text-green-400 text-[10px] font-bold rounded">Sales</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4 text-slate-400">
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-calendar-icon lucide-calendar">
                                                    <path d="M8 2v4" />
                                                    <path d="M16 2v4" />
                                                    <rect width="18" height="18" x="3" y="4" rx="2" />
                                                    <path d="M3 10h18" />
                                                </svg></span>
                                            Jan 24
                                        </div>
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-user-icon lucide-user">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                    <circle cx="12" cy="7" r="4" />
                                                </svg></span>
                                            Febry Arizqa Firmansyah
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-0.5 bg-red-200 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-[10px] font-bold rounded-full border border-red-100 dark:border-red-900/30">Urgent</span>
                                </div>
                            </div>

                            <div
                                class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-semibold text-sm">
                                        Client presentation prep
                                    </h3>
                                    <button class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                                        <span class="material-icons-round text-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-ellipsis-icon lucide-ellipsis">
                                                <circle cx="12" cy="12" r="1" />
                                                <circle cx="19" cy="12" r="1" />
                                                <circle cx="5" cy="12" r="1" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-4 line-clamp-2 leading-relaxed">
                                    Prepare slides for Q1 review meeting with the main
                                    stakeholders.
                                </p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span
                                        class="px-2 py-0.5 bg-green-100 dark:bg-green-500 text-green-600 dark:text-green-400 text-[10px] font-bold rounded">Sales</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4 text-slate-400">
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-calendar-icon lucide-calendar">
                                                    <path d="M8 2v4" />
                                                    <path d="M16 2v4" />
                                                    <rect width="18" height="18" x="3" y="4" rx="2" />
                                                    <path d="M3 10h18" />
                                                </svg></span>
                                            Jan 24
                                        </div>
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-user-icon lucide-user">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                    <circle cx="12" cy="7" r="4" />
                                                </svg></span>
                                            Febry Arizqa Firmansyah
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-0.5 bg-red-200 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-[10px] font-bold rounded-full border border-red-100 dark:border-red-900/30">Urgent</span>
                                </div>
                            </div>

                            <div
                                class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-semibold text-sm">
                                        Client presentation prep
                                    </h3>
                                    <button class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                                        <span class="material-icons-round text-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-ellipsis-icon lucide-ellipsis">
                                                <circle cx="12" cy="12" r="1" />
                                                <circle cx="19" cy="12" r="1" />
                                                <circle cx="5" cy="12" r="1" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-4 line-clamp-2 leading-relaxed">
                                    Prepare slides for Q1 review meeting with the main
                                    stakeholders.
                                </p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span
                                        class="px-2 py-0.5 bg-green-100 dark:bg-green-500 text-green-600 dark:text-green-400 text-[10px] font-bold rounded">Sales</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4 text-slate-400">
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-calendar-icon lucide-calendar">
                                                    <path d="M8 2v4" />
                                                    <path d="M16 2v4" />
                                                    <rect width="18" height="18" x="3" y="4" rx="2" />
                                                    <path d="M3 10h18" />
                                                </svg></span>
                                            Jan 24
                                        </div>
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-user-icon lucide-user">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                    <circle cx="12" cy="7" r="4" />
                                                </svg></span>
                                            Febry Arizqa Firmansyah
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-0.5 bg-red-200 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-[10px] font-bold rounded-full border border-red-100 dark:border-red-900/30">Urgent</span>
                                </div>
                            </div>

                            <div
                                class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-semibold text-sm">
                                        Client presentation prep
                                    </h3>
                                    <button class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                                        <span class="material-icons-round text-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-ellipsis-icon lucide-ellipsis">
                                                <circle cx="12" cy="12" r="1" />
                                                <circle cx="19" cy="12" r="1" />
                                                <circle cx="5" cy="12" r="1" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-4 line-clamp-2 leading-relaxed">
                                    Prepare slides for Q1 review meeting with the main
                                    stakeholders.
                                </p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span
                                        class="px-2 py-0.5 bg-green-100 dark:bg-green-500 text-green-600 dark:text-green-400 text-[10px] font-bold rounded">Sales</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4 text-slate-400">
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-calendar-icon lucide-calendar">
                                                    <path d="M8 2v4" />
                                                    <path d="M16 2v4" />
                                                    <rect width="18" height="18" x="3" y="4" rx="2" />
                                                    <path d="M3 10h18" />
                                                </svg></span>
                                            Jan 24
                                        </div>
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-user-icon lucide-user">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                    <circle cx="12" cy="7" r="4" />
                                                </svg></span>
                                            Febry Arizqa Firmansyah
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-0.5 bg-red-200 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-[10px] font-bold rounded-full border border-red-100 dark:border-red-900/30">Urgent</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="w-80 flex flex-col h-full">
                        <div class="flex items-center justify-between mb-4 px-2">
                            <div class="flex items-center gap-2">
                                <h2 class="font-bold text-slate-700 dark:text-slate-200">
                                    In Review
                                </h2>
                                <span
                                    class="px-2 py-0.5 text-xs font-bold bg-slate-200 dark:bg-slate-800 rounded-full text-slate-600 dark:text-slate-400">2</span>
                            </div>
                            <button class="p-1 hover:bg-slate-200 dark:hover:bg-slate-800 rounded-md">
                                <span class="material-icons-round text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                                        <path d="M5 12h14" />
                                        <path d="M12 5v14" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                        <div class="space-y-4 overflow-y-auto custom-scrollbar flex-1 pb-4">
                            <div
                                class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-semibold text-sm">Security audit report</h3>
                                    <button class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                                        <span class="material-icons-round text-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-ellipsis-icon lucide-ellipsis">
                                                <circle cx="12" cy="12" r="1" />
                                                <circle cx="19" cy="12" r="1" />
                                                <circle cx="5" cy="12" r="1" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-4 line-clamp-2 leading-relaxed">
                                    Review findings from the internal quarterly security
                                    assessment.
                                </p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span
                                        class="px-2 py-0.5 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-[10px] font-bold rounded">Security</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4 text-slate-400">
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-calendar-icon lucide-calendar">
                                                    <path d="M8 2v4" />
                                                    <path d="M16 2v4" />
                                                    <rect width="18" height="18" x="3" y="4" rx="2" />
                                                    <path d="M3 10h18" />
                                                </svg></span>
                                            Jan 26
                                        </div>
                                        <div class="flex items-center gap-1 text-[11px]">
                                            <span class="material-icons-round text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-user-icon lucide-user">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                    <circle cx="12" cy="7" r="4" />
                                                </svg></span>
                                            Asep Suherman
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-0.5 bg-orange-200 dark:bg-orange-900/20 text-orange-600 dark:text-orange-400 text-[10px] font-bold rounded-full border border-orange-100 dark:border-orange-900/30">High</span>
                                </div>
                            </div>
                            <div
                                class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm opacity-60">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-semibold text-sm text-slate-400">
                                        Marketing campaign
                                    </h3>
                                    <button class="text-slate-400">
                                        <span class="material-icons-round text-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-ellipsis-icon lucide-ellipsis">
                                                <circle cx="12" cy="12" r="1" />
                                                <circle cx="19" cy="12" r="1" />
                                                <circle cx="5" cy="12" r="1" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <div class="flex items-center gap-2 mb-4">
                                    <span class="material-icons-round text-slate-400 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-check-icon lucide-check">
                                            <path d="M20 6 9 17l-5-5" />
                                        </svg>
                                    </span>
                                    <span class="text-xs text-slate-400 line-through">Drafting social media posts</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-80 flex flex-col h-full opacity-75">
                        <div class="flex items-center justify-between mb-4 px-2">
                            <div class="flex items-center gap-2">
                                <h2 class="font-bold text-slate-700 dark:text-slate-200">
                                    Done
                                </h2>
                                <span
                                    class="px-2 py-0.5 text-xs font-bold bg-slate-200 dark:bg-slate-800 rounded-full text-slate-600 dark:text-slate-400">1</span>
                            </div>
                            <button class="p-1 hover:bg-slate-200 dark:hover:bg-slate-800 rounded-md">
                                <span class="material-icons-round text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                                        <path d="M5 12h14" />
                                        <path d="M12 5v14" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                        <div class="space-y-4 overflow-y-auto custom-scrollbar flex-1 pb-4">
                            <div
                                class="bg-white/50 dark:bg-slate-900/50 p-4 rounded-xl border border-dashed border-slate-200 dark:border-slate-800">
                                <div class="flex flex-col items-center justify-center py-8 text-slate-400">
                                    <span class="material-icons-round text-3xl mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-clipboard-list-icon lucide-clipboard-list">
                                            <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                                            <path
                                                d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                                            <path d="M12 11h4" />
                                            <path d="M12 16h4" />
                                            <path d="M8 11h.01" />
                                            <path d="M8 16h.01" />
                                        </svg>
                                    </span>
                                    <p class="text-sm">Drag completed tasks here</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end kanban-->

            <!--list-->
            <div v-show="viewMode === 'list'"
                class="overflow-x-auto rounded-lg border dark:border-slate-700 bg-slate-900/50 mt-4">
                <table class="w-full bg-slate-50 text-slate-900 text-sm text-left text-slate-300">
                    <thead class="text-xs uppercase dark:bg-gray-800 dark:text-gray-400 border-b border-slate-700">
                        <tr>
                            <th class="px-4 py-3 font-medium">Title</th>
                            <th class="px-4 py-3 font-medium">Assignees</th>
                            <th class="px-4 py-3 font-medium">Status</th>
                            <th class="px-4 py-3 font-medium">Priority</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y dark:bg-gray-800 divide-gray-800">
                        <tr class="hover:bg-gray-800/30 transition-colors">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox"
                                        class="rounded border-slate-600 bg-slate-700 dark:text-white">
                                    <span class="dark:text-white">(Dashboard) - Filter Data Ads Transaction Per
                                        Periode</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex -space-x-2">
                                    <div
                                        class="w-6 h-6 rounded-full bg-indigo-500 dark:border-slate-900 border-slate-900 flex items-center justify-center text-[10px] text-white">
                                        JD</div>
                                    <div
                                        class="w-6 h-6 rounded-full bg-emerald-500 dark:border-slate-900 border-slate-900 flex items-center justify-center text-[10px] text-white">
                                        AK</div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    class="px-2 py-1 rounded-full text-[10px] font-semibold bg-blue-500/10 dark:bg-blue-600 dark:text-blue-300 text-blue-400 border border-blue-500/20 uppercase">Ready
                                    To Test</span>
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    class="px-2 py-1 rounded text-[10px] font-bold bg-red-500/10 dark:bg-red-600 dark:text-red-300 text-red-500 uppercase">High</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!--end list-->
        </div>

    </AppLayout>
</template>
