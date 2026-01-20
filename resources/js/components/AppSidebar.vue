<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import { index as employeesIndex } from '@/routes/employees';
import { type NavItem } from '@/types';
import { computed } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';
import { BookOpen, Calendar, Folder, LayoutGrid, MessageCircle, Users, Presentation, DoorOpen } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const page = usePage();

const mainNavItems = computed(() => [
    {
        title: 'Feed',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Messenger',
        href: '/chat',
        icon: MessageCircle,
        badge: page.props.auth.unreadMessageCount as number,
    },
    {
        title: 'Employees',
        href: employeesIndex(),
        icon: Users,
    },
    {
        title: 'Rooms',
        href: '/rooms',
        icon: DoorOpen,
    },
    {
        title: 'Room Booking',
        href: '/room-bookings',
        icon: Presentation,
    },
    {
        title: 'Calendar',
        href: '/calendar',
        icon: Calendar,
    },
]);

const footerNavItems: NavItem[] = [
    {
        title: 'Github Repo',
        href: 'https://github.com/laravel/vue-starter-kit',
        icon: Folder,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: BookOpen,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
