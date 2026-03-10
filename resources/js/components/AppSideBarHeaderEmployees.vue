<script setup lang="ts">
import AppearanceTabs from '@/components/AppearanceTabs.vue';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import UserMenuContent from '@/components/UserMenuContent.vue';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import NotificationMenu from '@/components/NotificationMenu.vue';
import { SidebarTrigger } from '@/components/ui/sidebar';
import { useInitials } from '@/composables/useInitials';
import type { BreadcrumbItemType } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed, VueElement } from 'vue';
import { index as knowledgeBaseIndex } from '@/routes/employees/knowledge-base';
import { index as employeesIndex } from '@/routes/employees';
import { ref } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth.user);
const { getInitials } = useInitials();
const isMobileMenuOpen = ref(false);

withDefaults(
    defineProps<{
        breadcrumbs?: BreadcrumbItemType[];
    }>(),
    {
        breadcrumbs: () => [],
    },
);
</script>

<template>
    <header
        class="flex h-16 shrink-0 items-center gap-2 border-b border-sidebar-border/70 px-6 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12 md:px-4">
        <div class="flex items-center gap-2">
            <SidebarTrigger class="-ml-1 text-gray-400 hover:text-white" />
            <template v-if="breadcrumbs && breadcrumbs.length > 0">
                <Breadcrumbs :breadcrumbs="breadcrumbs" />
            </template>
        </div>
        <div class="hidden md:flex items-center gap-2 px-4 py-2 text-sm text-gray-400">
            <!-- <Link :href="employeesIndex().url"
                class="block px-4 py-2 rounded-md hover:text-white hover:bg-gray-700 transition-colors">
                Company Structure
            </Link> -->
            <div
                class="group relative cursor-pointer block px-4 py-2 rounded-md hover:text-white hover:bg-gray-700 transition-colors">
                <div class="flex items-center">
                    <span class="mr-1">Time and reports</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="opacity-60">
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </div>

                <div class="absolute left-0 top-full z-20 hidden w-48 pt-2 group-hover:block">
                    <div class="rounded-md border border-gray-800 bg-gray-700 p-1 shadow-xl">
                        <a href="#" class="block rounded px-3 py-2 text-xs hover:bg-[#333333] hover:text-white">Daily
                            Reports</a>
                        <a href="#"
                            class="block rounded px-3 py-2 text-xs hover:bg-[#333333] hover:text-white">Attendance</a>
                        <a href="#" class="block rounded px-3 py-2 text-xs hover:bg-[#333333] hover:text-white">Work
                            Times</a>
                    </div>
                </div>
            </div>

            <Link :href="knowledgeBaseIndex().url"
                class="block px-4 py-2 rounded-md hover:text-white hover:bg-gray-700 transition-colors">
                Knowledge Base
            </Link>
        </div>

        <div class="ml-auto flex items-center gap-2">
            <NotificationMenu />
            <AppearanceTabs />

            <DropdownMenu>
                <DropdownMenuTrigger as-child>
                    <Button variant="ghost" size="icon" class="relative h-8 w-8 rounded-full">
                        <Avatar class="h-8 w-8">
                            <AvatarImage v-if="user.avatar" :src="user.avatar" :alt="user.name" />
                            <AvatarFallback>{{ getInitials(user.name) }}</AvatarFallback>
                        </Avatar>
                    </Button>
                </DropdownMenuTrigger>
                <DropdownMenuContent class="w-56" align="end">
                    <UserMenuContent :user="user" />
                </DropdownMenuContent>
            </DropdownMenu>
        </div>

    </header>
    <div
        class="flex md:hidden overflow-x-auto no-scrollbar px-4 gap-6 text-sm font-medium border-t border-slate-100 dark:border-border-dark/50">
        <a class="py-3 text-slate-500 dark:text-slate-400 whitespace-nowrap" href="#">Employees</a>
        <a class="py-3 text-slate-500 dark:text-slate-400 whitespace-nowrap" href="#">Time &amp; Reports</a>
        <Link :href="knowledgeBaseIndex().url" class="py-3 text-slate-500 dark:text-slate-400 whitespace-nowrap">
            Knowledge Base
        </Link>
    </div>
</template>
