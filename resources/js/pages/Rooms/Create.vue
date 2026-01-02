<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { index, store, update } from '@/routes/rooms';

const props = defineProps<{
    room?: {
        id: number;
        name: string;
        description: string;
        capacity: number;
    };
}>();

const form = useForm({
    name: props.room ? props.room.name : '',
    description: props.room ? props.room.description : '',
    capacity: props.room ? props.room.capacity : '',
});

const submit = () => {
    if (props.room) {
        form.put(update(props.room.id).url);
    } else {
        form.post(store().url);
    }
};
</script>

<template>

    <Head :title="room ? 'Edit Room' : 'Create Room'" />

    <AppLayout :breadcrumbs="[
        { title: 'Rooms', href: index().url },
        { title: room ? 'Edit Room' : 'Create Room', href: '' }
    ]">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ room ? 'Edit Room' : 'Create Room' }}
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ room ? 'Update room details' : 'Add a new meeting room' }}
                    </p>
                </div>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <form @submit.prevent="submit" class="space-y-6 max-w-2xl">
                    <div class="space-y-2">
                        <Label for="name">Room Name</Label>
                        <Input id="name" v-model="form.name" type="text" required autofocus
                            placeholder="e.g. Conference Room A" />
                        <InputError :message="form.errors.name" />
                    </div>

                    <div class="space-y-2">
                        <Label for="capacity">Capacity (People)</Label>
                        <Input id="capacity" v-model="form.capacity" type="number" required min="1"
                            placeholder="e.g. 10" />
                        <InputError :message="form.errors.capacity" />
                    </div>

                    <div class="space-y-2">
                        <Label for="description">Description</Label>
                        <textarea id="description" v-model="form.description"
                            class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                            placeholder="Optional room description..."></textarea>
                        <InputError :message="form.errors.description" />
                    </div>

                    <div class="flex items-center gap-4">
                        <Link :href="index().url">
                            <Button variant="outline" type="button">Cancel</Button>
                        </Link>
                        <Button type="submit" :disabled="form.processing">
                            {{ room ? 'Update Room' : 'Create Room' }}
                        </Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
