<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { edit, index, update } from '@/routes/employees';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps<{
    employee: {
        id: number;
        name: string;
        email: string;
        position: string;
        department: string;
    };
}>();

const form = useForm({
    name: props.employee.name,
    email: props.employee.email,
    position: props.employee.position,
    department: props.employee.department,
});

const submit = () => {
    form.put(update(props.employee.id));
};
</script>

<template>

    <Head title="Edit Employee" />

    <AppLayout :breadcrumbs="[
        { title: 'Employees', href: index() },
        { title: 'Edit', href: edit(props.employee.id) },
    ]">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Edit Employee
                </h2>
            </div>

            <div class="max-w-2xl overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <input id="name" v-model="form.name" type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                                required />
                            <InputError :message="form.errors.name" class="mt-2" />
                        </div>

                        <div>
                            <label for="email"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input id="email" v-model="form.email" type="email"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                                required />
                            <InputError :message="form.errors.email" class="mt-2" />
                        </div>

                        <div>
                            <label for="position"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Position</label>
                            <input id="position" v-model="form.position" type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                                required />
                            <InputError :message="form.errors.position" class="mt-2" />
                        </div>

                        <div>
                            <label for="department"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Department</label>
                            <input id="department" v-model="form.department" type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                                required />
                            <InputError :message="form.errors.department" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" :disabled="form.processing"
                                class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">
                                Update Employee
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
