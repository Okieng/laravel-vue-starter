<script setup lang="ts">
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { useInitials } from '@/composables/useInitials';
import { ref } from 'vue';
import type { User } from '@/types';
import ThemeSelector from '@/components/ThemeSelector.vue';

interface Props {
    user: User;
}

defineProps<Props>();

const { getInitials } = useInitials();

const fileInput = ref<HTMLInputElement | null>(null);

const triggerFileInput = () => {
    fileInput.value?.click();
};

const handleFileChange = (event: Event) => {
    const target = event.target as HTMLInputElement;
    if (target.files && target.files.length > 0) {
        const file = target.files[0];
        // TODO: Handle file upload or preview here
        console.log('Selected file:', file);
    }
};
</script>

<template>
    <div class="bg-white dark:bg-slate-900 flex flex-col lg:flex-row w-full h-full min-h-0">
        <aside
            class="w-full lg:w-80 bg-slate-50 dark:bg-slate-800/50 border-r border-slate-200 dark:border-slate-800 p-8 flex flex-col gap-8 shrink-0">
            <div class="flex flex-col items-center text-center">
                <div class="relative group">
                    <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-white dark:border-slate-700 shadow-md relative group cursor-pointer"
                        @click="triggerFileInput">
                        <img alt="Prayogi Sukmana Profile" class="w-full h-full object-cover"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDz3sGjGjC1KTj1p4c_YkpJsdXbVq4WhaKdHWCSkTGTGVZr_7wIJy4uO6yrLns51asw9_PD62wAJQxB0Hv-y6N5KslLY3okphF2nDVlZWiwquw7SUfE9HPMlMjBtIvW2SOH-nHHBBcAxAXSj4kqjA6TAEaXmT_K-Ex4-o6aSS_Lc1yPCayMsyktvLeXzGEw1glqHKtxBzgcyCybVtCBs4J9--Z57Nv0kv5_qmd9vM3E86ZBfjwBceGKHtg5zdIkJIx7BF0xluoP4Fd9" />

                        <!-- Hover Overlay -->
                        <div
                            class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <span class="material-icons-outlined text-white text-3xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-camera-icon">
                                    <path
                                        d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                    <circle cx="12" cy="13" r="3" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <ThemeSelector :user="user">
                        <button
                            class="absolute top-2 right-2 p-2 bg-white/20 hover:bg-white/40 rounded-full text-white transition-colors"
                            title="Customize Background">
                            <span class="material-icons-outlined text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-palette h-4 w-4">
                                    <circle cx="13.5" cy="6.5" r=".5" />
                                    <circle cx="17.5" cy="10.5" r=".5" />
                                    <circle cx="8.5" cy="7.5" r=".5" />
                                    <circle cx="6.5" cy="12.5" r=".5" />
                                    <path
                                        d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z" />
                                </svg>
                            </span>
                        </button>
                    </ThemeSelector>
                    <input type="file" ref="fileInput" class="hidden" accept="image/*" @change="handleFileChange" />
                    <span
                        class="absolute bottom-2 right-2 w-5 h-5 bg-green-500 border-2 border-white dark:border-slate-800 rounded-full shadow-sm"
                        title="Online Status"></span>
                </div>
                <div class="mt-4">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">
                        Prayogi Sukmana
                    </h2>
                    <p class="text-sm font-medium text-primary uppercase tracking-wider">
                        Staff IT Programmer
                    </p>
                </div>
                <div
                    class="mt-4 flex items-center justify-center gap-2 px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    ONLINE
                </div>
            </div>
            <div
                class="bg-white dark:bg-slate-800 rounded-xl p-5 shadow-sm border border-slate-200 dark:border-slate-700">
                <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 mb-4 flex items-center gap-2">
                    <span class="material-icons-outlined text-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-heart-pulse-icon lucide-heart-pulse">
                            <path
                                d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5" />
                            <path d="M3.22 13H9.5l.5-1 2 4.5 2-7 1.5 3.5h5.27" />
                        </svg></span>
                    STRESS LEVEL
                </p>
                <div class="flex flex-col items-center">
                    <div class="gauge-container mb-2">
                        <div class="gauge-bg"></div>
                        <div class="gauge-fill"></div>
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 text-center mb-3">
                        Measure your stress level to improve productivity
                    </p>
                    <button
                        class="w-full py-2 px-4 border border-slate-200 dark:border-slate-600 rounded-lg text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                        HOW TO MEASURE?
                    </button>
                </div>
            </div>
        </aside>
        <main class="flex-1 p-8 lg:p-10 overflow-y-auto">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-bold text-slate-800 dark:text-white">
                    Contact Information
                </h3>
                <button
                    class="flex items-center gap-2 px-4 py-2 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-sm font-semibold rounded-lg transition-all">
                    <span class="material-icons-outlined text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-pencil-icon lucide-pencil">
                            <path
                                d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z" />
                            <path d="m15 5 4 4" />
                        </svg>
                    </span>
                    Edit Profile
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8 mb-12">
                <div>
                    <label
                        class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">First
                        Name</label>
                    <p class="text-slate-900 dark:text-slate-200 font-medium">
                        Prayogi
                    </p>
                </div>
                <div>
                    <label
                        class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Last
                        Name</label>
                    <p class="text-slate-900 dark:text-slate-200 font-medium">
                        Sukmana
                    </p>
                </div>
                <div>
                    <label
                        class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Position</label>
                    <p class="text-slate-900 dark:text-slate-200 font-medium">
                        Staff IT Programmer
                    </p>
                </div>
                <div>
                    <label
                        class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Email</label>
                    <p class="text-primary hover:underline cursor-pointer font-medium">
                        prayogisukmana5@gmail.com
                    </p>
                </div>
                <div>
                    <label
                        class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Department</label>
                    <p class="text-slate-900 dark:text-slate-200 font-medium">
                        IT Software
                    </p>
                </div>
                <div>
                    <label
                        class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Second
                        Name</label>
                    <p class="text-slate-400 dark:text-slate-600 italic font-normal">
                        Not specified
                    </p>
                </div>
                <div>
                    <label
                        class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Notification
                        Language</label>
                    <p class="text-slate-900 dark:text-slate-200 font-medium flex items-center gap-2">
                        <span class="material-icons-outlined text-base text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-languages-icon lucide-languages">
                                <path d="m5 8 6 6" />
                                <path d="m4 14 6-6 2-3" />
                                <path d="M2 5h12" />
                                <path d="M7 2h1" />
                                <path d="m22 22-5-10-5 10" />
                                <path d="M14 18h6" />
                            </svg>
                        </span>
                        English (US)
                    </p>
                </div>
            </div>
            <div class="mb-12">
                <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-6">
                    Appreciations
                </h3>
                <div class="flex gap-4 overflow-x-auto px-4 py-2 scroll-smooth">
                    <div class="flex-shrink-0 w-16 h-16 rounded-2xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center border border-blue-100 dark:border-blue-800 group hover:scale-110 transition-transform cursor-pointer"
                        title="Thumbs Up">
                        <span class="material-icons-outlined text-blue-500 text-3xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-thumbs-up-icon lucide-thumbs-up">
                                <path
                                    d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2a3.13 3.13 0 0 1 3 3.88Z" />
                                <path d="M7 10v12" />
                            </svg>
                        </span>
                    </div>
                    <div class="flex-shrink-0 w-16 h-16 rounded-2xl bg-purple-50 dark:bg-purple-900/20 flex items-center justify-center border border-purple-100 dark:border-purple-800 group hover:scale-110 transition-transform cursor-pointer"
                        title="Gift">
                        <span class="material-icons-outlined text-purple-500 text-3xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-trophy-icon lucide-trophy">
                                <path d="M10 14.66v1.626a2 2 0 0 1-.976 1.696A5 5 0 0 0 7 21.978" />
                                <path d="M14 14.66v1.626a2 2 0 0 0 .976 1.696A5 5 0 0 1 17 21.978" />
                                <path d="M18 9h1.5a1 1 0 0 0 0-5H18" />
                                <path d="M4 22h16" />
                                <path d="M6 9a6 6 0 0 0 12 0V3a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1z" />
                                <path d="M6 9H4.5a1 1 0 0 1 0-5H6" />
                            </svg>
                        </span>
                    </div>
                    <div class="flex-shrink-0 w-16 h-16 rounded-2xl bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center border border-amber-100 dark:border-amber-800 group hover:scale-110 transition-transform cursor-pointer"
                        title="Trophy">
                        <span class="material-icons-outlined text-amber-500 text-3xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-trophy-icon lucide-trophy">
                                <path d="M10 14.66v1.626a2 2 0 0 1-.976 1.696A5 5 0 0 0 7 21.978" />
                                <path d="M14 14.66v1.626a2 2 0 0 0 .976 1.696A5 5 0 0 1 17 21.978" />
                                <path d="M18 9h1.5a1 1 0 0 0 0-5H18" />
                                <path d="M4 22h16" />
                                <path d="M6 9a6 6 0 0 0 12 0V3a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1z" />
                                <path d="M6 9H4.5a1 1 0 0 1 0-5H6" />
                            </svg>
                        </span>
                    </div>
                    <div class="flex-shrink-0 w-16 h-16 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20 flex items-center justify-center border border-emerald-100 dark:border-emerald-800 group hover:scale-110 transition-transform cursor-pointer"
                        title="Money Bag">
                        <span class="material-icons-outlined text-emerald-500 text-3xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-trophy-icon lucide-trophy">
                                <path d="M10 14.66v1.626a2 2 0 0 1-.976 1.696A5 5 0 0 0 7 21.978" />
                                <path d="M14 14.66v1.626a2 2 0 0 0 .976 1.696A5 5 0 0 1 17 21.978" />
                                <path d="M18 9h1.5a1 1 0 0 0 0-5H18" />
                                <path d="M4 22h16" />
                                <path d="M6 9a6 6 0 0 0 12 0V3a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1z" />
                                <path d="M6 9H4.5a1 1 0 0 1 0-5H6" />
                            </svg>
                        </span>
                    </div>
                    <div class="flex-shrink-0 w-16 h-16 rounded-2xl bg-indigo-50 dark:bg-indigo-900/20 flex items-center justify-center border border-indigo-100 dark:border-indigo-800 group hover:scale-110 transition-transform cursor-pointer"
                        title="Crown">
                        <span class="material-icons-outlined text-indigo-500 text-3xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-trophy-icon lucide-trophy">
                                <path d="M10 14.66v1.626a2 2 0 0 1-.976 1.696A5 5 0 0 0 7 21.978" />
                                <path d="M14 14.66v1.626a2 2 0 0 0 .976 1.696A5 5 0 0 1 17 21.978" />
                                <path d="M18 9h1.5a1 1 0 0 0 0-5H18" />
                                <path d="M4 22h16" />
                                <path d="M6 9a6 6 0 0 0 12 0V3a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1z" />
                                <path d="M6 9H4.5a1 1 0 0 1 0-5H6" />
                            </svg>
                        </span>
                    </div>
                    <div class="flex-shrink-0 w-16 h-16 rounded-2xl bg-pink-50 dark:bg-pink-900/20 flex items-center justify-center border border-pink-100 dark:border-pink-800 group hover:scale-110 transition-transform cursor-pointer"
                        title="Celebrate">
                        <span class="material-icons-outlined text-pink-500 text-3xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-trophy-icon lucide-trophy">
                                <path d="M10 14.66v1.626a2 2 0 0 1-.976 1.696A5 5 0 0 0 7 21.978" />
                                <path d="M14 14.66v1.626a2 2 0 0 0 .976 1.696A5 5 0 0 1 17 21.978" />
                                <path d="M18 9h1.5a1 1 0 0 0 0-5H18" />
                                <path d="M4 22h16" />
                                <path d="M6 9a6 6 0 0 0 12 0V3a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1z" />
                                <path d="M6 9H4.5a1 1 0 0 1 0-5H6" />
                            </svg>
                        </span>
                    </div>
                    <div class="flex-shrink-0 w-16 h-16 rounded-2xl bg-rose-50 dark:bg-rose-900/20 flex items-center justify-center border border-rose-100 dark:border-rose-800 group hover:scale-110 transition-transform cursor-pointer"
                        title="Heart">
                        <span class="material-icons-outlined text-rose-500 text-3xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-trophy-icon lucide-trophy">
                                <path d="M10 14.66v1.626a2 2 0 0 1-.976 1.696A5 5 0 0 0 7 21.978" />
                                <path d="M14 14.66v1.626a2 2 0 0 0 .976 1.696A5 5 0 0 1 17 21.978" />
                                <path d="M18 9h1.5a1 1 0 0 0 0-5H18" />
                                <path d="M4 22h16" />
                                <path d="M6 9a6 6 0 0 0 12 0V3a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1z" />
                                <path d="M6 9H4.5a1 1 0 0 1 0-5H6" />
                            </svg>
                        </span>
                    </div>
                    <div class="flex-shrink-0 w-16 h-16 rounded-2xl bg-cyan-50 dark:bg-cyan-900/20 flex items-center justify-center border border-cyan-100 dark:border-cyan-800 group hover:scale-110 transition-transform cursor-pointer"
                        title="Star">
                        <span class="material-icons-outlined text-cyan-500 text-3xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-trophy-icon lucide-trophy">
                                <path d="M10 14.66v1.626a2 2 0 0 1-.976 1.696A5 5 0 0 0 7 21.978" />
                                <path d="M14 14.66v1.626a2 2 0 0 0 .976 1.696A5 5 0 0 1 17 21.978" />
                                <path d="M18 9h1.5a1 1 0 0 0 0-5H18" />
                                <path d="M4 22h16" />
                                <path d="M6 9a6 6 0 0 0 12 0V3a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1z" />
                                <path d="M6 9H4.5a1 1 0 0 1 0-5H6" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
            <div class="mb-12">
                <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-6">
                    Additional Information
                </h3>
                <div
                    class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-5 flex items-center gap-4 border border-slate-100 dark:border-slate-800">
                    <img alt="Supervisor Avatar" class="w-12 h-12 rounded-full object-cover shadow-sm"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBN8WjfQ4sWSsCujHl7RRI3etQ4BHiK0sQMOEe1N0AU6Xj7Jtj3mKQLR8CwoRvReVelcG9rzVOkqT65LuqNomQKP42WpJ7US8DVFxJAsGyZrkUGexkIhR-z9SPA70Z9twWewxKcDl4Q7f-48bqIMI_RQjEjMS7zRprftPfbEZ0CZIwU216CBSdTiTiurU8xKAJfHpySvt0z-at5Ee8cri0fMKho0B_bNchlk9vDWyVZDpRfrSV0W4YChCiGNWFm-XrUFPUSNyyaebp2" />
                    <div>
                        <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                            Supervisor
                        </p>
                        <p class="text-slate-900 dark:text-slate-200 font-semibold">
                            Alexandru Voica
                        </p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">
                            Head of IT Software
                        </p>
                    </div>
                </div>
            </div>
            <div class="mb-6">
                <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-4">
                    About Me
                </h3>
                <div class="relative group">
                    <div
                        class="absolute -left-4 top-4 w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center border-4 border-white dark:border-slate-900">
                        <span class="material-icons-outlined text-slate-400 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-library-icon lucide-library">
                                <path d="m16 6 4 14" />
                                <path d="M12 6v14" />
                                <path d="M8 8v12" />
                                <path d="M4 4v16" />
                            </svg>
                        </span>
                    </div>
                    <div class="pl-10">
                        <div
                            class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 min-h-[120px] shadow-sm group-hover:shadow-md transition-shadow">
                            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">
                                Passionate about building robust software solutions and
                                exploring the latest trends in full-stack development. I enjoy
                                collaborative environments where I can share stories, learn
                                from my peers, and document our team's milestones. Feel free
                                to reach out for collaboration!
                            </p>
                            <div class="mt-4 flex gap-2">
                                <span
                                    class="px-3 py-1 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 text-[10px] font-bold rounded-full uppercase">#Innovation</span>
                                <span
                                    class="px-3 py-1 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 text-[10px] font-bold rounded-full uppercase">#BackendExpert</span>
                                <!-- <span
                                    class="px-3 py-1 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 text-[10px] font-bold rounded-full uppercase">#TechEnthusiast</span> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
