<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, type Feed } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { Calendar1 } from 'lucide-vue-next';

// Define the name for this page
defineOptions({
    name: 'Calendar',
});

const props = defineProps<{
    events: Feed[];
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Calendar',
        href: '/calendar',
    },
];

const toggleFollow = (feedId: number) => {
    router.post(`/feed/${feedId}/follow`, {}, {
        preserveScroll: true,
    });
};
</script>

<template>

    <Head title="Calendar" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Calendar</h3>
                <p class="text-xs text-gray-500">Upcoming events and activities</p>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <div v-for="event in events" :key="event.id"
                    class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border overflow-hidden flex flex-col transition-all hover:shadow-md"
                    :class="[event.is_followed ? 'border-primary' : 'border-border-light dark:border-border-dark']">

                    <div class="p-5 flex-1">
                        <div class="flex justify-between items-start mb-4">
                            <div class="bg-primary/10 text-primary p-2 rounded-lg">
                                <Calendar1 class="h-6 w-6" />
                            </div>
                            <span v-if="event.is_followed"
                                class="bg-primary text-white text-[10px] px-2 py-0.5 rounded-full font-bold uppercase tracking-wide">
                                Following
                            </span>
                        </div>

                        <h4 class="text-lg font-bold text-text-main dark:text-white mb-2">{{ event.title || 'Event' }}
                        </h4>
                        <p class="text-sm text-text-muted mb-4 line-clamp-3">{{ event.content }}</p>

                        <div class="flex items-center gap-2 text-xs text-text-muted mb-1">
                            <span class="font-medium">Date:</span>
                            <span>{{ event.event_date ? new Date(event.event_date).toLocaleString() : 'TBA' }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-text-muted">
                            <span class="font-medium">Organizer:</span>
                            <span>{{ event.user.name }}</span>
                        </div>
                    </div>

                    <div
                        class="p-4 bg-background-light/50 dark:bg-background-dark/50 border-t border-border-light dark:border-border-dark">
                        <button @click="toggleFollow(event.id)"
                            class="w-full py-2 px-4 rounded-lg font-medium text-sm transition-colors flex items-center justify-center gap-2"
                            :class="[
                                event.is_followed
                                    ? 'bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-900/20 dark:text-red-400 dark:hover:bg-red-900/30'
                                    : 'bg-primary text-white hover:bg-blue-700 shadow-sm shadow-primary/30'
                            ]">
                            {{ event.is_followed ? 'Unfollow Event' : 'Follow Event' }}
                        </button>
                    </div>
                </div>

                <div v-if="events.length === 0" class="col-span-full py-12 text-center text-text-muted">
                    No upcoming events found.
                </div>
            </div>
        </div>
    </AppLayout>
</template>
