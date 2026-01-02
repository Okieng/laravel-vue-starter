<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { create, destroy, index } from '@/routes/room-bookings';
import { Head, Link, router } from '@inertiajs/vue3';
import { Plus, Trash2, Calendar, Clock, MapPin } from 'lucide-vue-next';
import Swal from 'sweetalert2';

const props = defineProps<{
    bookings: {
        data: Array<{
            id: number;
            event_name: string;
            start_time: string;
            end_time: string;
            room: {
                name: string;
            };
            user: {
                name: string;
            };
        }>;
        links: Array<{
            url: string | null;
            label: string;
            active: boolean;
        }>;
    };
}>();

const formatDateTime = (dateString: string) => {
    return new Date(dateString).toLocaleString();
};

const cancelBooking = (id: number) => {
    Swal.fire({
        title: 'Cancel Booking?',
        text: "Are you sure you want to cancel this booking?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e11d48',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Yes, cancel it!',
        customClass: {
            popup: 'dark:bg-gray-800 dark:text-white',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(destroy(id).url, {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Cancelled!',
                        text: 'Booking has been cancelled.',
                        icon: 'success',
                        confirmButtonColor: '#10b981',
                        customClass: {
                            popup: 'dark:bg-gray-800 dark:text-white',
                        }
                    });
                },
            });
        }
    });
};
</script>

<template>

    <Head title="Room Bookings" />

    <AppLayout :breadcrumbs="[{ title: 'Room Bookings', href: index().url }]">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <!-- Header Section -->
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Room Bookings
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        View upcoming room reservations.
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <Link :href="create().url"
                        class="inline-flex items-center gap-2 rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-900 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100">
                        <Plus class="h-4 w-4" />
                        Book a Room
                    </Link>
                </div>
            </div>

            <!-- Table Section -->
            <div class="rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="overflow-x-auto rounded-xl">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-500 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-medium">Event</th>
                                <th scope="col" class="px-6 py-4 font-medium">Room</th>
                                <th scope="col" class="px-6 py-4 font-medium">Booked By</th>
                                <th scope="col" class="px-6 py-4 font-medium">Time</th>
                                <th scope="col" class="px-6 py-4 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <tr v-for="booking in bookings.data" :key="booking.id"
                                class="group transition-colors hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900 dark:text-white">
                                        {{ booking.event_name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
                                        <MapPin class="h-4 w-4 text-gray-400" />
                                        {{ booking.room.name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                                    {{ booking.user.name }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col text-xs text-gray-500 dark:text-gray-400">
                                        <div class="flex items-center gap-1 mb-1">
                                            <Calendar class="h-3 w-3" />
                                            {{ new Date(booking.start_time).toLocaleDateString() }}
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <Clock class="h-3 w-3" />
                                            {{ new Date(booking.start_time).toLocaleTimeString([], {
                                                hour: '2-digit',
                                            minute: '2-digit' }) }} -
                                            {{ new Date(booking.end_time).toLocaleTimeString([], {
                                                hour: '2-digit',
                                            minute: '2-digit' }) }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button @click="cancelBooking(booking.id)"
                                        class="rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-red-600 dark:hover:bg-gray-700 dark:hover:text-red-400"
                                        title="Cancel Booking">
                                        <Trash2 class="h-4 w-4" />
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="bookings.data.length === 0">
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                    <p class="text-base font-medium">No bookings found</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="border-t border-gray-200 px-4 py-3 sm:px-6 dark:border-gray-700"
                    v-if="bookings.links.length > 3">
                    <div class="flex items-center justify-between">
                        <div class="flex flex-1 justify-between sm:hidden">
                            <Link v-if="bookings.links[0].url" :href="bookings.links[0].url ?? '#'"
                                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                Previous
                            </Link>
                            <Link v-if="bookings.links[bookings.links.length - 1].url"
                                :href="bookings.links[bookings.links.length - 1].url ?? '#'"
                                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                Next
                            </Link>
                        </div>
                        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-end">
                            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                <template v-for="(link, key) in bookings.links" :key="key">
                                    <div v-if="link.url === null"
                                        class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0 dark:text-gray-500 dark:ring-gray-600">
                                        <span v-html="link.label"></span>
                                    </div>
                                    <Link v-else :href="link.url"
                                        class="relative inline-flex items-center px-4 py-2 text-sm font-semibold focus:z-20 focus:outline-offset-0"
                                        :class="[
                                            link.active
                                                ? 'z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'
                                                : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0 dark:text-gray-300 dark:ring-gray-600 dark:hover:bg-gray-700'
                                        ]">
                                        <span v-html="link.label"></span>
                                    </Link>
                                </template>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
