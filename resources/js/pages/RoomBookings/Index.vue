```
<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { create, destroy, index } from '@/routes/room-bookings';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { Plus, ChevronLeft, ChevronRight, Clock, User, MapPin } from 'lucide-vue-next';
import Swal from 'sweetalert2';
import { computed } from 'vue';

const page = usePage();

const props = defineProps<{
    bookings: Array<{
        id: number;
        event_name: string;
        start_time: string;
        end_time: string;
        user_id: number;
        room: {
            name: string;
        };
        user: {
            name: string;
        };
    }>;
    currentDate: {
        year: number;
        month: number;
    };
}>();

const monthNames = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];

const currentMonthName = computed(() => monthNames[props.currentDate.month - 1]);

const calendarDays = computed(() => {
    const year = props.currentDate.year;
    const month = props.currentDate.month - 1; // JS months are 0-indexed

    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const firstDayOfWeek = new Date(year, month, 1).getDay();

    const days = [];

    // Empty slots for days before the first day of the month
    for (let i = 0; i < firstDayOfWeek; i++) {
        days.push({ day: null, date: null });
    }

    // Days of the month
    for (let i = 1; i <= daysInMonth; i++) {
        const date = new Date(year, month, i);
        const dateString = date.toLocaleDateString('en-CA'); // YYYY-MM-DD format for easier comparison

        const dayBookings = props.bookings.filter(booking => {
            const bookingDate = new Date(booking.start_time).toLocaleDateString('en-CA');
            return bookingDate === dateString;
        });

        days.push({
            day: i,
            date: dateString,
            bookings: dayBookings
        });
    }

    return days;
});

const changeMonth = (offset: number) => {
    let newMonth = props.currentDate.month + offset;
    let newYear = props.currentDate.year;

    if (newMonth > 12) {
        newMonth = 1;
        newYear++;
    } else if (newMonth < 1) {
        newMonth = 12;
        newYear--;
    }

    router.visit(index().url, {
        data: { month: newMonth, year: newYear },
        preserveScroll: true,
        preserveState: true,
    });
};

const handleBookingClick = (booking: any) => {
    // Check if current user is the owner
    const isOwner = booking.user_id === page.props.auth.user.id;

    if (isOwner) {
        cancelBooking(booking.id);
    } else {
        showBookingDetails(booking);
    }
};

const showBookingDetails = (booking: any) => {
    Swal.fire({
        title: booking.event_name,
        html: `
            <div class="text-left space-y-2 text-sm">
                <p><strong>Room:</strong> ${booking.room.name}</p>
                <p><strong>Booked By:</strong> ${booking.user.name}</p>
                <p><strong>Date:</strong> ${new Date(booking.start_time).toLocaleDateString()}</p>
                <p><strong>Time:</strong> ${formatTime(booking.start_time)} - ${formatTime(booking.end_time)}</p>
            </div>
        `,
        icon: 'info',
        confirmButtonText: 'Close',
        customClass: {
            popup: 'dark:bg-gray-800 dark:text-white',
        }
    });
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
            popup: 'dark:bg-gray-800 dark:text-white top-layer',
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

const formatTime = (dateString: string) => {
    return new Date(dateString).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
};
</script>

<template>

    <Head title="Room Bookings" />

    <AppLayout :breadcrumbs="[{ title: 'Room Bookings', href: index().url }]">
        <div class="flex h-full flex-1 flex-col gap-6 rounded-xl p-4">
            <!-- Header with Navigation -->
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Room Bookings
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Manage room reservations for {{ currentMonthName }} {{ currentDate.year }}
                    </p>
                </div>
                <div class="flex items-center gap-4">
                    <div
                        class="flex items-center rounded-lg bg-white p-1 shadow-sm ring-1 ring-gray-900/5 dark:bg-gray-800 dark:ring-gray-700">
                        <button @click="changeMonth(-1)"
                            class="rounded-md p-1.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <ChevronLeft class="h-5 w-5" />
                        </button>
                        <span
                            class="min-w-[140px] px-4 text-center text-sm font-semibold text-gray-900 dark:text-white">
                            {{ currentMonthName }} {{ currentDate.year }}
                        </span>
                        <button @click="changeMonth(1)"
                            class="rounded-md p-1.5 text-gray-500 hover:bg-gray-50 hover:text-gray-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <ChevronRight class="h-5 w-5" />
                        </button>
                    </div>
                    <Link :href="create().url"
                        class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <Plus class="h-4 w-4" />
                        Book a Room
                    </Link>
                </div>
            </div>

            <!-- Calendar Grid -->
            <div class="rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div
                    class="grid grid-cols-7 border-b border-gray-200 bg-gray-50 text-center text-xs font-semibold leading-6 text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                    <div class="py-2">Sun</div>
                    <div class="py-2">Mon</div>
                    <div class="py-2">Tue</div>
                    <div class="py-2">Wed</div>
                    <div class="py-2">Thu</div>
                    <div class="py-2">Fri</div>
                    <div class="py-2">Sat</div>
                </div>
                <div class="grid grid-cols-7 text-sm">
                    <div v-for="(day, index) in calendarDays" :key="index"
                        class="min-h-[120px] border-b border-r border-gray-200 p-2 last:border-r-0 dark:border-gray-700"
                        :class="[
                            day.day ? 'bg-white dark:bg-gray-900' : 'bg-gray-50 dark:bg-gray-800/50',
                            (index % 7 === 6) ? 'border-r-0' : ''
                        ]">
                        <div v-if="day.day" class="flex h-full flex-col">
                            <span class="mb-2 font-medium text-gray-900 dark:text-gray-200"
                                :class="{ 'text-indigo-600 dark:text-indigo-400': day.bookings && day.bookings.length > 0 }">
                                {{ day.day }}
                            </span>

                            <div class="flex flex-1 flex-col gap-1.5">
                                <div v-for="booking in day.bookings" :key="booking.id"
                                    class="group relative flex flex-col gap-0.5 rounded-md bg-indigo-50 p-1.5 hover:bg-indigo-100 dark:bg-indigo-900/30 dark:hover:bg-indigo-900/50 transition-all cursor-pointer border-l-2 border-indigo-500"
                                    @click="handleBookingClick(booking)" title="Click to view details">

                                    <span class="font-semibold text-indigo-700 dark:text-indigo-300 text-xs truncate">
                                        {{ booking.event_name }}
                                    </span>

                                    <div class="flex items-center gap-1 text-[10px] text-gray-600 dark:text-gray-400">
                                        <Clock class="h-3 w-3" />
                                        <span>{{ formatTime(booking.start_time) }} - {{ formatTime(booking.end_time)
                                        }}</span>
                                    </div>

                                    <div class="flex items-center gap-1 text-[10px] text-gray-600 dark:text-gray-400">
                                        <MapPin class="h-3 w-3" />
                                        <span class="truncate">{{ booking.room.name }}</span>
                                    </div>

                                    <div class="flex items-center gap-1 text-[10px] text-gray-600 dark:text-gray-400">
                                        <User class="h-3 w-3" />
                                        <span class="truncate">{{ booking.user.name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
/* Ensure grid borders look clean */
.grid-cols-7>div:nth-child(7n) {
    border-right-width: 0;
}
</style>
