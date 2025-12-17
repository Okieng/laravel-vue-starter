<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { create, index, store } from '@/routes/employees';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { User, Mail, Briefcase, Building2, ArrowLeft, Plus } from 'lucide-vue-next';

const form = useForm({
    name: '',
    email: '',
    position: '',
    department: '',
});

const submit = () => {
    form.post(store().url);
};
</script>

<template>

    <Head title="Create Employee" />

    <AppLayout :breadcrumbs="[
        { title: 'Employees', href: index().url },
        { title: 'Create', href: create().url },
    ]">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <!-- Header -->
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Create Employee
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Add a new member to your team.
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <Link :href="index().url"
                        class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                        <ArrowLeft class="h-4 w-4" />
                        Back to List
                    </Link>
                </div>
            </div>

            <!-- Form Card -->
            <div
                class="mx-auto w-full max-w-2xl rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                    <h3 class="text-base font-semibold leading-6 text-gray-900 dark:text-white">New Employee Details
                    </h3>
                </div>

                <div class="p-6">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="grid gap-6 md:grid-cols-2">
                            <!-- Name -->
                            <div class="col-span-2">
                                <label for="name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                                <div class="relative mt-1">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <User class="h-5 w-5 text-gray-400" />
                                    </div>
                                    <input id="name" v-model="form.name" type="text"
                                        class="block w-full rounded-lg border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-500 dark:focus:ring-indigo-500 sm:text-sm border py-2"
                                        placeholder="John Doe" required />
                                </div>
                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div class="col-span-2">
                                <label for="email"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email
                                    Address</label>
                                <div class="relative mt-1">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <Mail class="h-5 w-5 text-gray-400" />
                                    </div>
                                    <input id="email" v-model="form.email" type="email"
                                        class="block w-full rounded-lg border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-500 dark:focus:ring-indigo-500 sm:text-sm border py-2"
                                        placeholder="john@example.com" required />
                                </div>
                                <InputError :message="form.errors.email" class="mt-2" />
                            </div>

                            <!-- Position -->
                            <div>
                                <label for="position"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Position</label>
                                <div class="relative mt-1">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <Briefcase class="h-5 w-5 text-gray-400" />
                                    </div>
                                    <input id="position" v-model="form.position" type="text"
                                        class="block w-full rounded-lg border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-500 dark:focus:ring-indigo-500 sm:text-sm border py-2"
                                        placeholder="Software Engineer" required />
                                </div>
                                <InputError :message="form.errors.position" class="mt-2" />
                            </div>

                            <!-- Department -->
                            <div>
                                <label for="department"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Department</label>
                                <div class="relative mt-1">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <Building2 class="h-5 w-5 text-gray-400" />
                                    </div>
                                    <input id="department" v-model="form.department" type="text"
                                        class="block w-full rounded-lg border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-500 dark:focus:ring-indigo-500 sm:text-sm border py-2"
                                        placeholder="Engineering" required />
                                </div>
                                <InputError :message="form.errors.department" class="mt-2" />
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-end gap-3 border-t border-gray-100 pt-6 dark:border-gray-700">
                            <Link :href="index().url"
                                class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                                Cancel
                            </Link>
                            <button type="submit" :disabled="form.processing"
                                class="inline-flex items-center gap-2 rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition-colors hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100">
                                <Plus class="h-4 w-4" />
                                <span v-if="form.processing">Creating...</span>
                                <span v-else>Create Employee</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
