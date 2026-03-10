<script setup>
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
const dailyReports = ref([]);
</script>
<template>

    <Head title="Daily Reports" />
    <AppLayout :breadcrumbs="[{ title: 'Daily Reports', href: '#' }]">
        <div class="w-full mx-auto py-8 px-8">
            <div class="flex flex-col gap-8">
                <!-- Date and Basic Info -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-xl p-6 shadow-sm border border-slate-200 dark:border-slate-800">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-slate-500 uppercase tracking-tight">Report
                                Date</label>
                            <div class="relative max-w-[240px]">
                                <input
                                    class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-primary"
                                    type="date" value="2023-10-27" />
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="text-right">
                                <label
                                    class="block text-sm font-medium text-slate-500 uppercase tracking-tight">Status</label>
                                <span class="flex items-center gap-2 text-sm text-amber-500 font-medium">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                    Pending Submission
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Section 1: Tasks Completed -->
                <section class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold flex items-center gap-2">
                            <span class="material-icons text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-circle-check-icon lucide-circle-check">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="m9 12 2 2 4-4" />
                                </svg>
                            </span>
                            Tasks Completed Today
                        </h2>
                        <span class="text-xs font-medium text-slate-400">PULLED FROM YOUR BOARD</span>
                    </div>
                    <div
                        class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-sm border border-slate-200 dark:border-slate-800">
                        <div class="divide-y divide-slate-100 dark:divide-slate-800">
                            <!-- Task Item -->
                            <div
                                class="p-4 flex items-center gap-4 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <input checked=""
                                    class="w-5 h-5 text-primary bg-slate-100 dark:bg-slate-800 border-slate-300 dark:border-slate-700 rounded focus:ring-primary focus:ring-offset-0"
                                    type="checkbox" />
                                <div class="flex-1">
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-medium">
                                            Refactor Authentication Middleware
                                        </h3>
                                        <span
                                            class="px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-[10px] font-bold text-slate-500 uppercase tracking-wide">Development</span>
                                    </div>
                                    <p class="text-xs text-slate-500">
                                        Completed at 11:45 AM • PR #452 merged
                                    </p>
                                </div>
                            </div>
                            <!-- Task Item -->
                            <div
                                class="p-4 flex items-center gap-4 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <input checked=""
                                    class="w-5 h-5 text-primary bg-slate-100 dark:bg-slate-800 border-slate-300 dark:border-slate-700 rounded focus:ring-primary focus:ring-offset-0"
                                    type="checkbox" />
                                <div class="flex-1">
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-medium">Fix Sidebar Collapse Bug</h3>
                                        <span
                                            class="px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-[10px] font-bold text-slate-500 uppercase tracking-wide">Bug
                                            Fix</span>
                                    </div>
                                    <p class="text-xs text-slate-500">
                                        Completed at 3:30 PM • Tested across browsers
                                    </p>
                                </div>
                            </div>
                            <!-- Task Item -->
                            <div
                                class="p-4 flex items-center gap-4 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <input checked=""
                                    class="w-5 h-5 text-primary bg-slate-100 dark:bg-slate-800 border-slate-300 dark:border-slate-700 rounded focus:ring-primary focus:ring-offset-0"
                                    type="checkbox" />
                                <div class="flex-1">
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-medium">Weekly Team Sync Meeting</h3>
                                        <span
                                            class="px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-[10px] font-bold text-slate-500 uppercase tracking-wide">Meeting</span>
                                    </div>
                                    <p class="text-xs text-slate-500">Completed at 4:30 PM</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 bg-slate-50 dark:bg-slate-800/50 flex justify-center">
                            <button class="text-sm text-primary font-semibold flex items-center gap-1 hover:underline">
                                <span class="material-icons text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-circle-plus-icon lucide-circle-plus">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="M8 12h8" />
                                        <path d="M12 8v8" />
                                    </svg>
                                </span> Add Manual
                                Entry
                            </button>
                        </div>
                    </div>
                </section>
                <!-- Section 2: Plans for Tomorrow -->
                <section class="space-y-4">
                    <h2 class="text-lg font-bold flex items-center gap-2">
                        <span class="material-icons text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-calendar1-icon lucide-calendar-1">
                                <path d="M11 14h1v4" />
                                <path d="M16 2v4" />
                                <path d="M3 10h18" />
                                <path d="M8 2v4" />
                                <rect x="3" y="4" width="18" height="18" rx="2" />
                            </svg>
                        </span>
                        What are you planning for tomorrow?
                    </h2>
                    <div
                        class="bg-white dark:bg-slate-900 rounded-xl p-1 shadow-sm border border-slate-200 dark:border-slate-800">
                        <textarea
                            class="w-full bg-transparent border-0 rounded-lg p-4 focus:ring-0 text-slate-700 dark:text-slate-300 placeholder:text-slate-400"
                            placeholder="List your top priorities and goals for the next workday..."
                            rows="4"></textarea>
                    </div>
                </section>
                <!-- Section 3: Roadblocks or Challenges -->
                <section class="space-y-4">
                    <h2 class="text-lg font-bold flex items-center gap-2">
                        <span class="material-icons text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-circle-alert-icon lucide-circle-alert">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" x2="12" y1="8" y2="12" />
                                <line x1="12" x2="12.01" y1="16" y2="16" />
                            </svg>
                        </span>
                        Roadblocks or Challenges
                    </h2>
                    <div
                        class="bg-white dark:bg-slate-900 rounded-xl p-1 shadow-sm border border-slate-200 dark:border-slate-800">
                        <textarea
                            class="w-full bg-transparent border-0 rounded-lg p-4 focus:ring-0 text-slate-700 dark:text-slate-300 placeholder:text-slate-400"
                            placeholder="Any blockers, technical issues, or support needed from the management?"
                            rows="3"></textarea>
                    </div>
                </section>
                <!-- Section 4: Metrics & Time -->
                <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div
                        class="bg-white dark:bg-slate-900 rounded-xl p-6 shadow-sm border border-slate-200 dark:border-slate-800">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-sm font-bold uppercase tracking-wide text-slate-500">
                                Work Hours
                            </h2>
                            <span class="material-icons text-primary">schedule</span>
                        </div>
                        <div class="flex items-end gap-2">
                            <input
                                class="w-24 text-3xl font-bold bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg text-center p-2"
                                step="0.5" type="number" value="8.5" />
                            <span class="text-lg font-medium text-slate-500 pb-2">Hours</span>
                        </div>
                        <p class="text-xs text-slate-400 mt-3 italic">
                            Calculated based on your logged activity.
                        </p>
                    </div>
                    <div
                        class="bg-white dark:bg-slate-900 rounded-xl p-6 shadow-sm border border-slate-200 dark:border-slate-800">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-sm font-bold uppercase tracking-wide text-slate-500">
                                Day Sentiment
                            </h2>
                            <span class="material-icons text-primary">mood</span>
                        </div>
                        <div class="flex gap-4">
                            <button
                                class="flex-1 py-2 rounded-lg bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-primary transition-all text-xl">
                                😞
                            </button>
                            <button
                                class="flex-1 py-2 rounded-lg bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-primary transition-all text-xl">
                                😐
                            </button>
                            <button class="flex-1 py-2 rounded-lg bg-primary/20 border border-primary text-xl">
                                😊
                            </button>
                            <button
                                class="flex-1 py-2 rounded-lg bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-primary transition-all text-xl">
                                🔥
                            </button>
                        </div>
                    </div>
                </section>
                <!-- Action Bar -->
                <div class="flex flex-col md:flex-row items-center justify-between gap-4 pt-6 pb-12">
                    <div class="flex items-center gap-2 text-slate-500 text-sm italic">
                        <span class="material-icons text-sm">cloud_done</span>
                        Draft autosaved at 5:42 PM
                    </div>
                    <div class="flex items-center gap-4 w-full md:w-auto">
                        <button
                            class="flex-1 md:flex-none px-8 py-3 rounded-lg border border-slate-200 dark:border-slate-700 font-semibold hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                            Discard
                        </button>
                        <button
                            class="flex-1 md:flex-none px-8 py-3 rounded-lg bg-primary text-white font-bold shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all flex items-center justify-center gap-2">
                            Submit
                            <!-- <span class="material-icons text-sm">send</span> -->
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>