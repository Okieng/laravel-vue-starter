<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Activity, ArrowUpRight, Building2, FolderKanban, Users } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div
                    class="relative overflow-hidden rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-center gap-4">
                        <div class="rounded-lg bg-blue-50 p-3 dark:bg-blue-900/20">
                            <Users class="h-6 w-6 text-blue-600 dark:text-blue-400" />
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Employees</p>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">1,234</h3>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs text-green-600 dark:text-green-400">
                        <ArrowUpRight class="mr-1 h-3 w-3" />
                        <span class="font-medium">12% from last month</span>
                    </div>
                </div>

                <div
                    class="relative overflow-hidden rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-center gap-4">
                        <div class="rounded-lg bg-purple-50 p-3 dark:bg-purple-900/20">
                            <Building2 class="h-6 w-6 text-purple-600 dark:text-purple-400" />
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Departments</p>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">8</h3>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs text-gray-500 dark:text-gray-400">
                        <span class="font-medium">Across 3 Regions</span>
                    </div>
                </div>

                <div
                    class="relative overflow-hidden rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-center gap-4">
                        <div class="rounded-lg bg-amber-50 p-3 dark:bg-amber-900/20">
                            <FolderKanban class="h-6 w-6 text-amber-600 dark:text-amber-400" />
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Projects</p>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">24</h3>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs text-green-600 dark:text-green-400">
                        <ArrowUpRight class="mr-1 h-3 w-3" />
                        <span class="font-medium">4 new this week</span>
                    </div>
                </div>
            </div>

            <div
                class="flex-1 rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Recent Activity</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        <div v-for="i in 5" :key="i" class="flex items-start gap-4">
                            <div class="rounded-full bg-gray-100 p-2 dark:bg-gray-700">
                                <Activity class="h-4 w-4 text-gray-600 dark:text-gray-300" />
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                    New employee verification pending
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    2 hours ago
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
