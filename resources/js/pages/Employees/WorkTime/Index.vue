<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Work Time" />
    <AppLayout :breadcrumbs="[{ title: 'Work Time', href: '#' }]">
        <div class="flex-1 overflow-y-auto bg-slate-50/50 dark:bg-slate-950/20 py-10 px-8">
            <div class="max-w-full mx-auto">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-slate-900 dark:text-white">
                        Work Time
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400">
                        Configure your work time details and access rights.
                    </p>
                </div>
            </div>
            <div
                class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div
                    class="p-4 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/50">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <button
                                class="p-1 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-full transition-colors">
                                <span class="material-icons-outlined text-lg align-middle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-chevron-left-icon lucide-chevron-left">
                                        <path d="m15 18-6-6 6-6" />
                                    </svg>
                                </span>
                            </button>
                            <span class="font-semibold text-slate-700 dark:text-slate-200">1 December - 31
                                December</span>
                            <button
                                class="p-1 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-full transition-colors">
                                <span class="material-icons-outlined text-lg align-middle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-chevron-right-icon lucide-chevron-right">
                                        <path d="m9 18 6-6-6-6" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                    <button class="text-primary text-sm font-semibold hover:underline">
                        Today
                    </button>
                </div>
                <div class="relative overflow-hidden">
                    <div class="table-container overflow-x-auto">
                        <table class="w-full border-collapse text-sm text-left">
                            <thead>
                                <tr class="bg-blue-50/50 dark:bg-slate-900/50">
                                    <th
                                        class="sticky-col left-0 bg-blue-50 dark:bg-slate-900 px-6 py-4 font-semibold text-slate-600 dark:text-slate-300 border-r border-slate-200 dark:border-slate-700 min-w-[280px]">
                                        Employee
                                    </th>
                                    <th
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 min-w-[80px]">
                                        Mon 01
                                    </th>
                                    <th
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 min-w-[80px]">
                                        Tue 02
                                    </th>
                                    <th
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 min-w-[80px]">
                                        Wed 03
                                    </th>
                                    <th
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 min-w-[80px]">
                                        Thu 04
                                    </th>
                                    <th
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 min-w-[80px]">
                                        Fri 05
                                    </th>
                                    <th
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 min-w-[80px] bg-slate-100/50 dark:bg-slate-800/80">
                                        Sat 06
                                    </th>
                                    <th
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 min-w-[80px] bg-slate-100/50 dark:bg-slate-800/80">
                                        Sun 07
                                    </th>
                                    <th
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 min-w-[80px]">
                                        Mon 08
                                    </th>
                                    <th
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 min-w-[80px]">
                                        Tue 09
                                    </th>
                                    <th
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 min-w-[80px]">
                                        Wed 10
                                    </th>
                                    <th
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 min-w-[80px]">
                                        Thu 11
                                    </th>
                                    <th
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 min-w-[80px]">
                                        Fri 12
                                    </th>
                                    <th
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 min-w-[80px] bg-slate-100/50 dark:bg-slate-800/80">
                                        Sat 13
                                    </th>
                                    <th
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 min-w-[80px] bg-slate-100/50 dark:bg-slate-800/80">
                                        Sun 14
                                    </th>
                                    <th
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 min-w-[80px]">
                                        Mon 15
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                <tr class="bg-slate-50 dark:bg-slate-900/30">
                                    <td class="px-6 py-2 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400"
                                        colspan="16">
                                        IT Software
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-700/50 transition-colors group">
                                    <td
                                        class="sticky-col left-0 bg-white dark:bg-slate-800 px-6 py-4 border-r border-slate-200 dark:border-slate-700">
                                        <div class="flex items-center space-x-3">
                                            <div class="relative">
                                                <img alt="Prayogi Sukmana avatar"
                                                    class="h-10 w-10 rounded-full object-cover"
                                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDaPWKvx2kJ_Wa3CMqS_kMvPqfJCLK8l2KwhU7XVVHNWPx5rpGpTDJ0KtOb3KqZ6DQuUuCllPi2g6goakBZtXyvrkq8MDmfFMh4m7qf8zo7iK37WbsXGte7frigm3qXWgEfYS2BtnoG3kGRIPLLNsPDnJg3AjZCLUgxLoIFLP-YzHLqyzvB4EoafZjMSEC2gw4ZYGkJqOUq9WBEkY2wUYRTdaWlRGUFu3VJiHRzFCkuHV-u7TzrjmMlm6qdV6zOOdExZG1OGaD5EmPc" />
                                                <span
                                                    class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-white dark:ring-slate-800"></span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-primary">
                                                    Prayogi Sukmana
                                                </div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400">
                                                    Staff IT Programmer
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium">
                                        8h <span class="text-xs text-slate-400">30m</span>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium">
                                        7h <span class="text-xs text-slate-400">15m</span>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium">
                                        8h <span class="text-xs text-slate-400">25m</span>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium">
                                        8h <span class="text-xs text-slate-400">23m</span>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium">
                                        8h <span class="text-xs text-slate-400">37m</span>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium bg-slate-50 dark:bg-slate-800/30">
                                        6h <span class="text-xs text-slate-400">12m</span>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/30">
                                        <span class="material-icons-outlined text-slate-300 dark:text-slate-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-calendar-x-icon lucide-calendar-x">
                                                <path d="M8 2v4" />
                                                <path d="M16 2v4" />
                                                <rect width="18" height="18" x="3" y="4" rx="2" />
                                                <path d="M3 10h18" />
                                                <path d="m14 14-4 4" />
                                                <path d="m10 14 4 4" />
                                            </svg>
                                        </span>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium">
                                        8h <span class="text-xs text-slate-400">29m</span>
                                    </td>
                                    <td class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700">
                                        —
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium">
                                        8h <span class="text-xs text-slate-400">25m</span>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium">
                                        8h <span class="text-xs text-slate-400">13m</span>
                                    </td>
                                    <td class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700">
                                        —
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/30">
                                        —
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/30">
                                        —
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium">
                                        8h <span class="text-xs text-slate-400">00m</span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-700/50 transition-colors group">
                                    <td
                                        class="sticky-col left-0 bg-white dark:bg-slate-800 px-6 py-4 border-r border-slate-200 dark:border-slate-700">
                                        <div class="flex items-center space-x-3">
                                            <div class="relative">
                                                <img alt="Sarah Connor avatar"
                                                    class="h-10 w-10 rounded-full object-cover"
                                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCMUezZFSRcVNDldO_4hGclbSN-OquBoPpk8vv2OQuCotKSw35RTWfBcioppx193buqW-5RuBWttWOdUI4kzMy6_4orop5y2_A13voWMCGKgzX0OvySaC-HWohbacOmdcB9Q8WBNQBzBKxIe9yvmIcmQHGGZX__Ar1R2wDGse5KK2ZPhl5d-0qQ4beUTdDQtOquROj3spOhhPrwah5YEFiupWlLRULK4_pQ3ORXQRKq_VE3FioJ9_-EhaYW-SP_ryiW_hGMz-yXjPhd" />
                                                <span
                                                    class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-slate-300 ring-2 ring-white dark:ring-slate-800"></span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-primary">
                                                    Sarah Connor
                                                </div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400">
                                                    UI/UX Designer
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium">
                                        8h <span class="text-xs text-slate-400">05m</span>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium">
                                        8h <span class="text-xs text-slate-400">10m</span>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium text-red-500">
                                        7h <span class="text-xs opacity-70">45m</span>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium">
                                        8h <span class="text-xs text-slate-400">00m</span>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium">
                                        8h <span class="text-xs text-slate-400">15m</span>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/30">
                                        —
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/30">
                                        —
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium">
                                        8h <span class="text-xs text-slate-400">12m</span>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium">
                                        8h <span class="text-xs text-slate-400">08m</span>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium">
                                        8h <span class="text-xs text-slate-400">30m</span>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium">
                                        9h <span class="text-xs text-slate-400">05m</span>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium">
                                        8h <span class="text-xs text-slate-400">10m</span>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/30">
                                        —
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/30">
                                        —
                                    </td>
                                    <td
                                        class="px-4 py-4 text-center border-r border-slate-200 dark:border-slate-700 font-medium">
                                        8h <span class="text-xs text-slate-400">05m</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="absolute right-0 top-1/2 -translate-y-1/2 p-2 bg-white/80 dark:bg-slate-800/80 shadow-lg rounded-l-full flex items-center justify-center pointer-events-none">
                        <span class="material-icons-outlined text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div
                    class="px-6 py-4 flex flex-col md:flex-row items-center justify-between border-t border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50">
                    <div
                        class="flex items-center space-x-6 text-xs text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wider mb-4 md:mb-0">
                        <div>
                            Total:
                            <span class="text-slate-800 dark:text-slate-100 font-bold ml-1">12</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span>Pages: 1</span>
                            <div class="flex items-center space-x-1 ml-4">
                                <button
                                    class="flex items-center hover:text-primary transition-colors disabled:opacity-30">
                                    <span class="material-icons-outlined text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-chevron-left-icon lucide-chevron-left">
                                            <path d="m15 18-6-6 6-6" />
                                        </svg>
                                    </span>
                                    PREVIOUS
                                </button>
                                <div class="">-</div>
                                <button class="flex items-center hover:text-primary transition-colors">
                                    NEXT
                                    <span class="material-icons-outlined text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-chevron-right-icon lucide-chevron-right">
                                            <path d="m9 18 6-6-6-6" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 text-sm">
                        <span
                            class="text-slate-500 dark:text-slate-400 uppercase text-xs font-bold tracking-widest">Records:</span>
                        <div class="relative inline-block">
                            <select
                                class="appearance-none bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded px-4 py-1.5 pr-8 text-sm focus:ring-primary focus:border-primary">
                                <option>25</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                            <span
                                class="material-icons-outlined absolute right-2 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-base">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="lucide lucide-chevrons-up-down-icon lucide-chevrons-up-down">
                                    <path d="m7 15 5 5 5-5" />
                                    <path d="m7 9 5-5 5 5" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>