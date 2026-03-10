<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';

const articles = [
    {
        id: 1,
        title: 'Company Policy',
        description: 'Standard operating procedures and internal rules for all employees.',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBarIOT6qyH-q04koIE202vMrAe4t-Tm5Q5rjLFgvoISwUvEBeaWs1eC5h5jt8lEztdOtEWLvNxVpJlH8oP5UlSNhYGqRfQEGVJHHHSu-Sqp0GJ5t1FhDh4ryR1mvujDXjH9o_BYsP42pPaySLxKlWT9KsMrc2ClPiJ8ghbz4YQtDgvm4ZfqK649bXwSt9PiYnXi3uXuwvgcounOyHPURXmXOH2BeZ1CKA5tJhrqv90QERrysE5M3isYM_WnpJKAz_owrGpiAq4_han',
        updatedAt: 'Oct 12',
        content: 'Full content for Company Policy...'
    },
    {
        id: 2,
        title: 'Sasaran Mutu',
        description: 'Everything new hires need to know to get started in their first week.',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDSGGcuesXUiBG7efrhE9OoQzBcDx3BWw_xZEN07OPtnOsLsRXSQmThsmiLGJB0ZItZoa1lQ5ZTYXlhyA97Xnn2c6hbeVptCn1dsXp76rMI8VSUHqvGAY888Z7Oi39McgiXSAB5jhRv3lm6uuIXsYyAZyfcUpR8NkRm4Qp8ZHVpWbJ8N8Y_XxfeL7mvgz3Pa9mMXHyJV7d6NFExBNZdIdxkAb2S9S-_c_Lc8bYJnHpWMzPALk20ZmbTz707tjU1UzpLjrv0UWcyy1Yn',
        updatedAt: '2 days ago',
        content: 'Full content for Sasaran Mutu...'
    },
    {
        id: 3,
        title: 'Technical Specs',
        description: 'Architecture diagrams and API documentation for our main services.',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuB3XYcLx8ykONlt3rO_ZbzQe51OL82H0wN-F46guzlpl8kon5Qdoj5VOQjaZxaL0rpKEzdY1Wsik5xvZ64ny_KNgvvw410aki-WApJRqNzrQX749oiXaNFdAQBziYYslyTNd0G0GP1GlYaHgofzCeU2YowBU8_woihO13uSlCnY9a5JYIttqDqJ0fpSJShrOXpvnKgRrtUbFAF60ic0SfncyNUKzeMKswvJm_DYE8BWoolvoMU9XnWwYfSHrRw-3QHzIp9ocM1CYSEO',
        updatedAt: 'Sep 28',
        content: 'Full content for Technical Specs...'
    },
    {
        id: 4,
        title: 'Marketing Assets',
        description: 'Logos, brand colors, and official presentation templates.',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCqtXsHfOJxdLS7ZeCEPviu6Ajq268q4msONzHJOpXg_8o1EiijT2E3DbSHWjGVV1VsHQ6XE36Q8db8Gd1BtGt97AN-TjHr74ezvGfqzECzwmfG9_xh6mlanNJn6NH2cNRz2uWiWw6-gD2A9LzdvWpPrnrijZi39k6X4CKyudSWRBZohiBPKJH1ZfmT7_IGpTAPPhFRD9UI8eNRv2B-FcG4x_qnKBdxfFjlhORPcw3TXarlZUWa0IXIyi8qPVLeV3YreNtfwSlCzo3M',
        updatedAt: '1 hour ago',
        content: 'Full content for Marketing Assets...'
    },
];

const selectedArticle = ref<(typeof articles)[0] | null>(null);
const isOpen = ref(false);

const openArticle = (article: (typeof articles)[0]) => {
    selectedArticle.value = article;
    isOpen.value = true;
};

</script>

<template>

    <Head title="Knowledge Base" />

    <AppLayout :breadcrumbs="[{ title: 'Knowledge Base', href: '#' }]">
        <div class="flex-1 overflow-y-auto bg-slate-50/50 dark:bg-slate-950/20">
            <div class="max-w-full mx-auto pt-16 pb-12 px-8 text-center">
                <h1 class="text-4xl font-extrabold text-slate-900 dark:text-white mb-4 tracking-tight">
                    Knowledge Base
                </h1>
                <p class="text-slate-500 dark:text-slate-400 mb-8 max-w-2xl mx-auto">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Explicabo, quaerat molestias minima
                    similique sapiente voluptates iure error illum natus quidem, a maxime. Quam repellat officiis hic
                    eveniet voluptas pariatur beatae!
                </p>
                <div class="max-w-2xl mx-auto relative group">
                    <span
                        class="material-icons-round absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-search-icon lucide-search">
                            <path d="m21 21-4.34-4.34" />
                            <circle cx="11" cy="11" r="8" />
                        </svg></span>
                    <input
                        class="w-full pl-12 pr-4 py-4 rounded-2xl bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 shadow-xl shadow-slate-200/50 dark:shadow-none focus:ring-2 focus:ring-primary focus:border-primary transition-all text-lg"
                        placeholder="Search for articles, guides or keywords..." type="text" />
                </div>
            </div>
            <div class="max-w-full mx-auto px-8 pb-16">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">
                            Featured Knowledge Bases
                        </h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400">
                            Explore categorized guides for all teams
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button
                            class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-primary rounded-lg hover:bg-blue-600 shadow-lg shadow-blue-500/20 transition-all">
                            <span class="material-icons-round text-[18px]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M8 12h8" />
                                    <path d="M12 8v8" />
                                </svg>
                            </span>
                            Create Article
                        </button>
                    </div>
                </div>
                <main class="max-w-7xl mx-auto p-8">
                    <div
                        class="bg-white dark:bg-slate-800 rounded-xl shadow-xl overflow-hidden border border-slate-200 dark:border-slate-700">
                        <div class="p-8 border-b border-slate-100 dark:border-slate-700/50">
                            <div class="flex flex-wrap items-center justify-between mb-8">
                                <div class="flex items-center space-x-3">
                                    <h1 class="text-3xl font-light text-slate-800 dark:text-white tracking-tight">
                                        Company Pulse
                                    </h1>
                                    <span class="material-icons text-slate-400 cursor-help text-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-message-circle-question-mark-icon lucide-message-circle-question-mark">
                                            <path
                                                d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719" />
                                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                                            <path d="M12 17h.01" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="flex items-center space-x-1 bg-slate-100 dark:bg-slate-900 p-1 rounded-lg">
                                    <button
                                        class="px-4 py-1.5 rounded-md text-sm font-medium transition-colors hover:bg-white dark:hover:bg-slate-800">
                                        Today
                                    </button>
                                    <button
                                        class="px-4 py-1.5 rounded-md text-sm font-medium transition-colors bg-white dark:bg-slate-700 shadow-sm">
                                        Week
                                    </button>
                                    <button
                                        class="px-4 py-1.5 rounded-md text-sm font-medium transition-colors hover:bg-white dark:hover:bg-slate-800">
                                        Month
                                    </button>
                                    <button
                                        class="px-4 py-1.5 rounded-md text-sm font-medium transition-colors hover:bg-white dark:hover:bg-slate-800">
                                        Year
                                    </button>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                                <div class="flex items-center space-x-4">
                                    <span class="text-sm font-medium text-slate-500">People</span>
                                    <button
                                        class="w-12 h-6 bg-primary/20 dark:bg-primary/10 rounded-full relative p-1 transition-all">
                                        <div class="absolute right-1 top-1 w-4 h-4 bg-primary rounded-full"></div>
                                    </button>
                                    <span class="text-sm font-bold text-primary">Company</span>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="text-[10px] uppercase tracking-wider text-slate-400 font-bold mb-2">General
                                        Rating</span>
                                    <div class="flex -space-x-3 overflow-hidden">
                                        <img alt="User"
                                            class="inline-block h-10 w-10 rounded-full ring-2 ring-white dark:ring-slate-800"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAnhfTcX0KUzCAmuvCPsEnImD476TVdMHGDTVqwh0su1AvzGEMAPKGaXvCkN_FwgHjoybg9pnUuCu_xtNHIK36h7abHlWNUHJka4jmShexCEbztK08jk_IK0YJVM16rIED2XnVthVIlCira7Fa_8BNUfBLyE_EQiDPMBZxHxSqHM5qkuCxMZYfqetBEz1XFLNyfujqNMu6TNlBRNHrF2DcckZcRqhYf-wH69pGTVxvg-rqibUfS59I1g0HgMF7LaVW1c_RzM6_3TBn2" />
                                        <img alt="User"
                                            class="inline-block h-10 w-10 rounded-full ring-2 ring-white dark:ring-slate-800"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDjxL1Bnmzyquj0jhBNGDvwbM2e4_spbYE-Z8AqIbcNnuoSGk2sxma-y4zu_GyBHVPdbgFGLrZKMUaEwazlJvWwzr5nG6w0A-A4S3cXB_Ao9JQn_bwB_t6lA3wqJWCVe59BHipFeo_SD4h2pBbuJMAlGmJbFPQ9Q1aXHjte3DXD8uMAcccv0pAPOmZswHYVmngGG4ONWnFAoeW8jATWm0z_WE6eYLaYQ4ThXOL7Iczn0EOuY_J5bGBYrbPE8IAippuxCxMhS8lmRW6a" />
                                        <img alt="User"
                                            class="inline-block h-10 w-10 rounded-full ring-2 ring-white dark:ring-slate-800"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBxF7gy-feTIsGjOTM-viCoyaxjrQH2ptSUyP5c_IwEZjnHiBcQpwteuyasXYF3c9tF_eUzIIHO4TDZVpg_iW9wIcRvoZOsTsb_rCaTs2rmJiFZsJwHEu7M6kv9Mh31DUFK1OQTnu6NrcBN1yDc48GgMk8iCys_XxUXWx8roZYdq41WVPM-hCgnddIC4c4x9ntKwAYFjl9dVl0Gvy-of0pqhhqHo9ezm0777ncMeyumW0l8imvk4Ax3L2A92QIyxDGYGd9-pQGeT3sp" />
                                        <img alt="User"
                                            class="inline-block h-10 w-10 rounded-full ring-2 ring-white dark:ring-slate-800"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCNMRD9iQ0Ixf48tADojW5EGY-rFSjkmVio-BdYvdn9Lh5uvSlH8GdJDkS9eS_hJSZlNcwymrFiNkcI1sn-vAQpAAZUsTZNdwvkmz1ulGAwQZfZs1HygYvatzWdtxaNrihnvMi9OqDKWYgMdXjm4etYN6qXeTUk7XZbtCTnIYmHAmzbK1RcKXqmc03dpPJq_NtKkjYg1L1pe72HYmYl5Ql2GUYWqnUMaqGbKjAJBNX1p8fAYQM5aLAjBFeStIfiah6o8lui1HJKxeSk" />
                                        <div
                                            class="flex items-center justify-center h-10 w-10 rounded-full ring-2 ring-white dark:ring-slate-800 bg-slate-200 dark:bg-slate-700 text-[10px] font-bold">
                                            +12
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="text-[10px] uppercase tracking-wider text-slate-400 font-bold mb-1">Activity
                                        Rate</span>
                                    <div class="text-5xl font-light text-primary tracking-tighter">
                                        297
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="text-[10px] uppercase tracking-wider text-slate-400 font-bold mb-2">Feature
                                        Usage</span>
                                    <div class="flex items-end space-x-3">
                                        <div class="text-4xl font-bold text-slate-700 dark:text-slate-300">
                                            4%
                                        </div>
                                        <div
                                            class="flex-1 h-8 bg-slate-100 dark:bg-slate-700 rounded-sm relative overflow-hidden mb-1">
                                            <div
                                                class="absolute bottom-0 left-0 w-[4%] h-full bg-red-500 transition-all duration-1000 shadow-[0_0_8px_rgba(239,68,68,0.5)]">
                                            </div>
                                            <div class="absolute inset-0 opacity-10" style="
                      background-image: linear-gradient(
                        90deg,
                        transparent 95%,
                        #000 95%
                      );
                      background-size: 20% 100%;
                    "></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-8 pb-12 relative bg-slate-50/50 dark:bg-slate-800/20">
                            <div class="h-64 w-full relative">
                                <svg class="w-full h-full" viewBox="0 0 1000 200">
                                    <line class="stroke-slate-200 dark:stroke-slate-700" stroke-width="1" x1="0"
                                        x2="1000" y1="180" y2="180"></line>
                                    <line class="stroke-slate-100 dark:stroke-slate-700/50" stroke-width="0.5" x1="0"
                                        x2="1000" y1="140" y2="140"></line>
                                    <line class="stroke-slate-100 dark:stroke-slate-700/50" stroke-width="0.5" x1="0"
                                        x2="1000" y1="100" y2="100"></line>
                                    <line class="stroke-slate-100 dark:stroke-slate-700/50" stroke-width="0.5" x1="0"
                                        x2="1000" y1="60" y2="60"></line>
                                    <path class="stroke-primary chart-line"
                                        d="M 0 170 L 100 172 L 200 175 L 300 174 L 400 171 L 500 160 L 600 50 L 700 80 L 800 110 L 900 115 L 1000 115"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="3">
                                    </path>
                                    <circle class="fill-white dark:fill-slate-800 stroke-primary" cx="0" cy="170" r="4"
                                        stroke-width="2"></circle>
                                    <circle class="fill-white dark:fill-slate-800 stroke-primary" cx="100" cy="172"
                                        r="4" stroke-width="2"></circle>
                                    <circle class="fill-white dark:fill-slate-800 stroke-primary" cx="200" cy="175"
                                        r="4" stroke-width="2"></circle>
                                    <circle class="fill-white dark:fill-slate-800 stroke-primary" cx="300" cy="174"
                                        r="4" stroke-width="2"></circle>
                                    <circle class="fill-white dark:fill-slate-800 stroke-primary" cx="400" cy="171"
                                        r="4" stroke-width="2"></circle>
                                    <circle class="fill-white dark:fill-slate-800 stroke-primary" cx="500" cy="160"
                                        r="4" stroke-width="2"></circle>
                                    <circle class="fill-white dark:fill-slate-800 stroke-primary" cx="600" cy="50" r="4"
                                        stroke-width="2"></circle>
                                    <circle class="fill-white dark:fill-slate-800 stroke-primary" cx="700" cy="80" r="4"
                                        stroke-width="2"></circle>
                                    <circle class="fill-white dark:fill-slate-800 stroke-primary" cx="800" cy="110"
                                        r="4" stroke-width="2"></circle>
                                    <circle class="fill-white dark:fill-slate-800 stroke-primary" cx="900" cy="115"
                                        r="4" stroke-width="2"></circle>
                                </svg>
                            </div>
                            <div class="flex justify-between mt-4 px-2">
                                <span class="text-[10px] text-slate-400 font-medium">00</span>
                                <span class="text-[10px] text-slate-400 font-medium">03</span>
                                <span class="text-[10px] text-slate-400 font-medium">06</span>
                                <span class="text-[10px] text-slate-400 font-medium">09</span>
                                <span class="text-[10px] text-slate-400 font-medium">12</span>
                                <span class="text-[10px] text-slate-400 font-medium">15</span>
                                <span class="text-[10px] text-slate-400 font-medium">18</span>
                                <span class="text-[10px] text-slate-400 font-medium">21</span>
                                <span class="text-[10px] text-slate-400 font-medium">24</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-3 mt-6">
                        <div
                            class="bg-white dark:bg-slate-800 p-4 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 flex flex-col justify-between hover:shadow-md transition-shadow">
                            <div>
                                <h3 class="text-[10px] font-bold text-slate-400 uppercase leading-tight mb-3">
                                    1. Social Network
                                </h3>
                                <div class="h-1 bg-slate-100 dark:bg-slate-700 rounded-full mb-1 overflow-hidden">
                                    <div class="bg-orange-500 h-full" style="width: 18%"></div>
                                </div>
                                <div class="text-[8px] text-slate-400 uppercase font-bold flex justify-between">
                                    <span>Usage 18%</span>
                                </div>
                            </div>
                            <div class="mt-4 flex items-end justify-between">
                                <span class="text-[8px] text-slate-400 uppercase font-bold">Activity</span>
                                <span class="text-3xl font-light text-primary">39</span>
                            </div>
                        </div>
                        <div
                            class="bg-white dark:bg-slate-800 p-4 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 flex flex-col justify-between hover:shadow-md transition-shadow">
                            <div>
                                <h3 class="text-[10px] font-bold text-slate-400 uppercase leading-tight mb-3">
                                    2. Likes
                                </h3>
                                <div class="h-1 bg-slate-100 dark:bg-slate-700 rounded-full mb-1 overflow-hidden">
                                    <div class="bg-red-500 h-full" style="width: 11%"></div>
                                </div>
                                <div class="text-[8px] text-slate-400 uppercase font-bold flex justify-between">
                                    <span>Usage 11%</span>
                                </div>
                            </div>
                            <div class="mt-4 flex items-end justify-between">
                                <span class="text-[8px] text-slate-400 uppercase font-bold">Activity</span>
                                <span class="text-3xl font-light text-primary">19</span>
                            </div>
                        </div>
                        <div
                            class="bg-white dark:bg-slate-800 p-4 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 flex flex-col justify-between hover:shadow-md transition-shadow">
                            <div>
                                <h3 class="text-[10px] font-bold text-slate-400 uppercase leading-tight mb-3">
                                    3. Tasks and Projects
                                </h3>
                                <div class="h-1 bg-slate-100 dark:bg-slate-700 rounded-full mb-1 overflow-hidden">
                                    <div class="bg-amber-500 h-full" style="width: 2%"></div>
                                </div>
                                <div class="text-[8px] text-slate-400 uppercase font-bold flex justify-between">
                                    <span>Usage 2%</span>
                                </div>
                            </div>
                            <div class="mt-4 flex items-end justify-between">
                                <span class="text-[8px] text-slate-400 uppercase font-bold">Activity</span>
                                <span class="text-3xl font-light text-primary">16</span>
                            </div>
                        </div>
                        <div
                            class="bg-white dark:bg-slate-800 p-4 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 flex flex-col justify-between hover:shadow-md transition-shadow">
                            <div>
                                <h3 class="text-[10px] font-bold text-slate-400 uppercase leading-tight mb-3">
                                    4. Chat and Video
                                </h3>
                                <div class="h-1 bg-slate-100 dark:bg-slate-700 rounded-full mb-1 overflow-hidden">
                                    <div class="bg-yellow-400 h-full" style="width: 36%"></div>
                                </div>
                                <div class="text-[8px] text-slate-400 uppercase font-bold flex justify-between">
                                    <span>Usage 36%</span>
                                </div>
                            </div>
                            <div class="mt-4 flex items-end justify-between">
                                <span class="text-[8px] text-slate-400 uppercase font-bold">Activity</span>
                                <span class="text-3xl font-light text-primary">159</span>
                            </div>
                        </div>
                        <div
                            class="bg-white dark:bg-slate-800 p-4 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 flex flex-col justify-between hover:shadow-md transition-shadow">
                            <div>
                                <h3 class="text-[10px] font-bold text-slate-400 uppercase leading-tight mb-3">
                                    5. Drive
                                </h3>
                                <div class="h-1 bg-slate-100 dark:bg-slate-700 rounded-full mb-1 overflow-hidden">
                                    <div class="bg-red-400 h-full" style="width: 4%"></div>
                                </div>
                                <div class="text-[8px] text-slate-400 uppercase font-bold flex justify-between">
                                    <span>Usage 4%</span>
                                </div>
                            </div>
                            <div class="mt-4 flex items-end justify-between">
                                <span class="text-[8px] text-slate-400 uppercase font-bold">Activity</span>
                                <span class="text-3xl font-light text-primary">4</span>
                            </div>
                        </div>
                        <div
                            class="bg-white dark:bg-slate-800 p-4 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 flex flex-col justify-between hover:shadow-md transition-shadow">
                            <div>
                                <h3 class="text-[10px] font-bold text-slate-400 uppercase leading-tight mb-3">
                                    6. Mobile App
                                </h3>
                                <div class="h-1 bg-slate-100 dark:bg-slate-700 rounded-full mb-1 overflow-hidden">
                                    <div class="bg-red-500 h-full" style="width: 14%"></div>
                                </div>
                                <div class="text-[8px] text-slate-400 uppercase font-bold flex justify-between">
                                    <span>Usage 14%</span>
                                </div>
                            </div>
                            <div class="mt-4 flex items-end justify-between">
                                <span class="text-[8px] text-slate-400 uppercase font-bold">Activity</span>
                                <span class="text-3xl font-light text-primary">60</span>
                            </div>
                        </div>
                        <div
                            class="bg-white dark:bg-slate-800 p-4 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 flex flex-col justify-between hover:shadow-md transition-shadow">
                            <div>
                                <h3 class="text-[10px] font-bold text-slate-400 uppercase leading-tight mb-3">
                                    7. CRM
                                </h3>
                                <div class="h-1 bg-slate-100 dark:bg-slate-700 rounded-full mb-1 overflow-hidden">
                                    <div class="bg-slate-200 dark:bg-slate-600 h-full" style="width: 0%"></div>
                                </div>
                                <div class="text-[8px] text-slate-400 uppercase font-bold flex justify-between">
                                    <span>Usage 0%</span>
                                </div>
                            </div>
                            <div class="mt-4 flex items-end justify-between">
                                <span class="text-[8px] text-slate-400 uppercase font-bold">Activity</span>
                                <span class="text-3xl font-light text-primary">0</span>
                            </div>
                        </div>
                    </div>
                </main>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <div v-for="article in articles" :key="article.id" @click="openArticle(article)"
                        class="group cursor-pointer bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all hover:-translate-y-1">
                        <div class="relative h-40 overflow-hidden">
                            <img :alt="article.title"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                :src="article.image" />
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold mb-2 group-hover:text-primary transition-colors">
                                {{ article.title }}
                            </h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4 line-clamp-2">
                                {{ article.description }}
                            </p>
                            <div class="flex items-center justify-between mt-auto">
                                <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Last
                                    updated: {{ article.updatedAt }}</span>
                                <span class="flex items-center gap-1 text-primary text-xs font-bold">
                                    Explore
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <Dialog v-model:open="isOpen">
            <DialogContent
                class="fixed inset-0 z-50 !max-w-none w-screen h-screen flex flex-col p-0 m-0 overflow-hidden bg-white dark:bg-slate-900 border-none rounded-none !translate-x-0 !translate-y-0 top-0 left-0">

                <div v-if="selectedArticle" class="flex flex-col h-full w-full">
                    <!-- <div class="relative h-[40vh] md:h-[50vh] shrink-0">
                        <img :src="selectedArticle.image" :alt="selectedArticle.title"
                            class="w-full h-full object-cover" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent flex items-end p-8 md:p-16">
                            <div class="max-w-5xl mx-auto w-full">
                                <h2 class="text-4xl md:text-6xl font-bold text-white mb-4 tracking-tighter">{{
                                    selectedArticle.title }}</h2>
                                <p class="text-xl text-slate-200 max-w-2xl">{{ selectedArticle.description }}</p>
                            </div>
                        </div>
                    </div> -->

                    <div class="flex-1 overflow-y-auto bg-white dark:bg-slate-950">
                        <div class="max-w-full mx-auto p-8 md:p-16">
                            <div class="prose dark:prose-invert max-w-none">
                                <div class="flex items-center gap-4 mb-12 not-prose">
                                    <span
                                        class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full uppercase tracking-wider">
                                        Knowledge Base
                                    </span>
                                    <span class="text-slate-400 text-sm">
                                        Last updated: {{ selectedArticle.updatedAt }}
                                    </span>
                                </div>

                                <div class="text-lg leading-relaxed text-slate-600 dark:text-slate-300 space-y-8">
                                    <p class="text-2xl font-light italic border-l-4 border-primary pl-6 py-2">
                                        {{ selectedArticle.content }}
                                    </p>

                                    <p>Welcome to the official {{ selectedArticle.title }} guide. This document serves
                                        as a comprehensive resource for all team members, ensuring clarity and
                                        consistency across our operations.</p>

                                    <h3>1. Introduction and Scope</h3>
                                    <p>This section outlines the primary objectives of the {{ selectedArticle.title }}.
                                        It is essential for every employee to familiarize themselves with these concepts
                                        from day one. Our goal is to maintain a professional, secure, and inclusive
                                        environment for everyone.</p>

                                    <h3>2. Standard Procedures</h3>
                                    <p>To maintain high standards, we follow a /@zaenallzae/streamsict set of protocols
                                        developed through
                                        years of industry experience. These procedures are not just guidelines but the
                                        foundation of our work culture.</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 not-prose mb-8">
                                        <div
                                            class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800">
                                            <h4 class="font-bold mb-2">Phase A: Preparation</h4>
                                            <p class="text-sm text-slate-500">Ensuring all tools and resources are ready
                                                before starting any project task.</p>
                                        </div>
                                        <div
                                            class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800">
                                            <h4 class="font-bold mb-2">Phase B: Implementation</h4>
                                            <p class="text-sm text-slate-500">Executing tasks according to the approved
                                                architectural patterns.</p>
                                        </div>
                                    </div>

                                    <h3>3. Key Responsibilities</h3>
                                    <ul>
                                        <li><strong>Continuous Learning:</strong> Regularly check for updates in this
                                            knowledge base.</li>
                                        <li><strong>Collaboration:</strong> Shared knowledge is the key to our
                                            collective success.</li>
                                        <li><strong>Quality Assurance:</strong> Peer-review work to ensure it aligns
                                            with company standards.</li>
                                        <li><strong>Feedback Loop:</strong> If you find any discrepancies, report them
                                            to your department lead immediately.</li>
                                    </ul>

                                    <h3>4. Advanced Configurations</h3>
                                    <p>For senior members and specialized roles, the following configurations apply.
                                        Please note that these require additional access rights and training
                                        certificates.</p>
                                    <pre class="bg-slate-950 text-slate-300 p-6 rounded-xl border border-slate-800"><code>// Configuration override example
{
  "module": "{{ selectedArticle.title.toLowerCase().replace(' ', '-') }}",
  "version": "2.4.0",
  "features": ["auto-scaling", "high-availability"],
  "security": "tier-1"
}</code></pre>

                                    <h3>Conclusion</h3>
                                    <p>We hope this guide provides you with the necessary information to excel in your
                                        role. Remember that being well-informed is twice as effective. We update our
                                        policies quarterly, so keep an eye on the "Last updated" indicator at the top of
                                        this page.</p>

                                    <div
                                        class="mt-16 pt-8 border-t border-slate-200 dark:border-slate-800 text-center not-prose">
                                        <p class="text-slate-400 text-sm mb-4">Was this article helpful?</p>
                                        <div class="flex justify-center gap-4">
                                            <button
                                                class="px-6 py-2 rounded-full border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Yes,
                                                thanks!</button>
                                            <button
                                                class="px-6 py-2 rounded-full border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Not
                                                really</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </DialogContent>
        </Dialog>
    </AppLayout>
</template>