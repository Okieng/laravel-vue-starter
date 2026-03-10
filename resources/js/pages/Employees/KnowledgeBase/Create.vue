<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>

    <Head title="Knowledge Base" />

    <AppLayout :breadcrumbs="[{ title: 'Knowledge Base', href: '#' }]">
        <div class="flex-1 overflow-y-auto bg-slate-50/50 dark:bg-slate-950/20 py-10 px-8">
            <div class="max-w-full mx-auto">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-slate-900 dark:text-white">
                        Knowledge Base Settings
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400">
                        Configure your knowledge base category details and access rights.
                    </p>
                </div>
                <form class="space-y-8">
                    <section
                        class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
                        <h2 class="text-lg font-semibold mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-info-icon lucide-info">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M12 16v-4" />
                                    <path d="M12 8h.01" />
                                </svg>
                            </span>
                            General Information
                        </h2>
                        <div class="space-y-6">
                            <div>
                                <label
                                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Knowledge
                                    Base Name</label>
                                <input
                                    class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-primary focus:border-primary px-4 py-2.5"
                                    placeholder="e.g. Employee Handbook" type="text" />
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Description</label>
                                <textarea
                                    class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-primary focus:border-primary px-4 py-2.5"
                                    placeholder="Describe what this knowledge base contains..." rows="4"></textarea>
                            </div>
                        </div>
                    </section>
                    <section
                        class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
                        <h2 class="text-lg font-semibold mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">image</span>
                            Cover Image
                        </h2>
                        <div class="flex items-start gap-6">
                            <div
                                class="w-48 h-32 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 bg-slate-100 dark:bg-slate-800">
                                <img alt="Current Cover" class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBarIOT6qyH-q04koIE202vMrAe4t-Tm5Q5rjLFgvoISwUvEBeaWs1eC5h5jt8lEztdOtEWLvNxVpJlH8oP5UlSNhYGqRfQEGVJHHHSu-Sqp0GJ5t1FhDh4ryR1mvujDXjH9o_BYsP42pPaySLxKlWT9KsMrc2ClPiJ8ghbz4YQtDgvm4ZfqK649bXwSt9PiYnXi3uXuwvgcounOyHPURXmXOH2BeZ1CKA5tJhrqv90QERrysE5M3isYM_WnpJKAz_owrGpiAq4_han" />
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-center w-full">
                                    <label
                                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-slate-300 dark:border-slate-700 rounded-xl cursor-pointer bg-slate-50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <span class="material-symbols-outlined text-slate-400 mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-cloud-upload-icon lucide-cloud-upload">
                                                    <path d="M12 13v8" />
                                                    <path
                                                        d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242" />
                                                    <path d="m8 17 4-4 4 4" />
                                                </svg></span>
                                            <p class="mb-1 text-sm text-slate-500 dark:text-slate-400 font-medium">
                                                Click to upload or drag and drop
                                            </p>
                                            <p class="text-xs text-slate-400">
                                                PNG, JPG or GIF (max. 800x400px)
                                            </p>
                                        </div>
                                        <input class="hidden" type="file" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section
                        class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
                        <h2 class="text-lg font-semibold mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-lock-keyhole-icon lucide-lock-keyhole">
                                    <circle cx="12" cy="16" r="1" />
                                    <rect x="3" y="10" width="18" height="12" rx="2" />
                                    <path d="M7 10V7a5 5 0 0 1 10 0v3" />
                                </svg>
                            </span>
                            Privacy &amp; Permissions
                        </h2>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-3">Who can
                                    see this?</label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                    <label
                                        class="relative flex cursor-pointer rounded-lg border border-slate-200 dark:border-slate-700 p-4 shadow-sm focus:outline-none bg-slate-50 dark:bg-slate-800/40">
                                        <input checked="false" class="h-4 w-4 text-primary border-slate-300 mt-0.5"
                                            name="privacy" type="radio" value="all" />
                                        <div class="ml-3">
                                            <span class="block text-sm font-bold text-slate-900 dark:text-white">All
                                                Employees</span>
                                            <span class="block text-xs text-slate-500">Public within company</span>
                                        </div>
                                    </label>
                                    <label
                                        class="relative flex cursor-pointer rounded-lg border border-slate-200 dark:border-slate-700 p-4 shadow-sm focus:outline-none">
                                        <input class="h-4 w-4 text-primary border-slate-300 mt-0.5" name="privacy"
                                            type="radio" value="private" />
                                        <div class="ml-3">
                                            <span
                                                class="block text-sm font-bold text-slate-900 dark:text-white">Private</span>
                                            <span class="block text-xs text-slate-500">Only invited members</span>
                                        </div>
                                    </label>
                                    <label
                                        class="relative flex cursor-pointer rounded-lg border border-slate-200 dark:border-slate-700 p-4 shadow-sm focus:outline-none">
                                        <input class="h-4 w-4 text-primary border-slate-300 mt-0.5" name="privacy"
                                            type="radio" value="dept" />
                                        <div class="ml-3">
                                            <span
                                                class="block text-sm font-bold text-slate-900 dark:text-white">Departments</span>
                                            <span class="block text-xs text-slate-500">Specific team access</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-3">Manage
                                    Editors</label>
                                <div class="space-y-3">
                                    <div
                                        class="flex items-center justify-between p-3 bg-slate-50 dark:bg-slate-800/40 rounded-lg">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-xs font-bold">
                                                JD
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-slate-900 dark:text-white">
                                                    John Doe
                                                </p>
                                                <p class="text-xs text-slate-500">Owner</p>
                                            </div>
                                        </div>
                                        <span class="text-xs font-medium text-slate-400 uppercase">Creator</span>
                                    </div>
                                    <div
                                        class="flex items-center justify-between p-3 border border-slate-200 dark:border-slate-700 rounded-lg">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white text-xs font-bold">
                                                AS
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-slate-900 dark:text-white">
                                                    Alice Smith
                                                </p>
                                                <p class="text-xs text-slate-500">HR Manager</p>
                                            </div>
                                        </div>
                                        <button class="text-slate-400 hover:text-red-500 transition-colors"
                                            type="button">
                                            <span class="material-symbols-outlined text-[18px]">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-trash-icon lucide-trash">
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                                    <path d="M3 6h18" />
                                                    <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                    <button
                                        class="flex items-center gap-2 px-3 py-2 text-sm font-semibold text-primary hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-all"
                                        type="button">
                                        <span class="material-symbols-outlined text-[18px]">
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
                                        Add Editor
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="flex items-center justify-end gap-4 pb-12">
                        <button
                            class="px-6 py-2.5 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-all"
                            type="button">
                            Cancel
                        </button>
                        <button
                            class="px-8 py-2.5 text-sm font-semibold text-white bg-primary rounded-lg hover:bg-blue-600 shadow-lg shadow-blue-500/20 transition-all"
                            type="submit">
                            Save Knowledge Base
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>