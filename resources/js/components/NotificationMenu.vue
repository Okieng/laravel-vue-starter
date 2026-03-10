<script setup lang="ts">
import { Bell } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';

const notifications = [
    { id: 1, title: 'Task Baru', description: 'Desain landing page selesai', time: '5m ago' },
    { id: 2, title: 'Komentar', description: 'Sarah mengomentari tugasmu', time: '1h ago' },
];
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger :as-child="true">
            <Button variant="ghost" size="icon" class="relative group h-9 w-9 cursor-pointer">
                <Bell class="size-5 opacity-80 group-hover:opacity-100" />
                <span class="absolute top-2 right-2 flex h-2 w-2">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                </span>
            </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent align="end" class="w-80 p-0">
            <div class="flex items-center justify-between border-b px-4 py-3">
                <h4 class="text-sm font-semibold">Notifikasi</h4>
            </div>
            <div class="max-h-[300px] overflow-y-auto">
                <div v-for="n in notifications" :key="n.id"
                    class="px-4 py-3 hover:bg-gray-700 cursor-pointer transition-colors border-b last:border-0">
                    <p class="text-sm font-medium">{{ n.title }}</p>
                    <p class="text-xs text-muted-foreground">{{ n.description }}</p>
                    <p class="text-[10px] text-muted-foreground mt-1">{{ n.time }}</p>
                </div>
            </div>
        </DropdownMenuContent>
    </DropdownMenu>
</template>