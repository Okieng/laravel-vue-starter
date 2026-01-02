<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { index, store } from '@/routes/room-bookings';

const props = defineProps<{
    rooms: Array<{
        id: number;
        name: string;
        capacity: number;
    }>;
}>();

const form = useForm({
    room_id: '',
    event_name: '',
    start_time: '',
    end_time: '',
});

const submit = () => {
    form.post(store().url);
};
</script>

<template>

    <Head title="Book a Room" />

    <AppLayout :breadcrumbs="[
        { title: 'Room Bookings', href: index().url },
        { title: 'Book a Room', href: '' }
    ]">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Book a Room
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Reserve a meeting space for your event.
                    </p>
                </div>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <form @submit.prevent="submit" class="space-y-6 max-w-2xl">
                    <div class="space-y-2">
                        <Label for="event_name">Event Name</Label>
                        <Input id="event_name" v-model="form.event_name" type="text" required autofocus
                            placeholder="e.g. Q4 Planning Meeting" />
                        <InputError :message="form.errors.event_name" />
                    </div>

                    <div class="space-y-2">
                        <Label for="room_id">Room</Label>
                        <select id="room_id" v-model="form.room_id"
                            class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                            required>
                            <option value="" disabled>Select a room</option>
                            <option v-for="room in rooms" :key="room.id" :value="room.id">
                                {{ room.name }} (Capacity: {{ room.capacity }})
                            </option>
                        </select>
                        <InputError :message="form.errors.room_id" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <Label for="start_time">Start Time</Label>
                            <Input id="start_time" v-model="form.start_time" type="datetime-local" required />
                            <InputError :message="form.errors.start_time" />
                        </div>

                        <div class="space-y-2">
                            <Label for="end_time">End Time</Label>
                            <Input id="end_time" v-model="form.end_time" type="datetime-local" required />
                            <InputError :message="form.errors.end_time" />
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <Link :href="index().url">
                            <Button variant="outline" type="button">Cancel</Button>
                        </Link>
                        <Button type="submit" :disabled="form.processing">
                            Confirm Booking
                        </Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
