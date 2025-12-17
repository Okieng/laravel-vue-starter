<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { create, destroy, edit, index } from '@/routes/employees';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps<{
    employees: Array<{
        id: number;
        name: string;
        email: string;
        position: string;
        department: string;
    }>;
}>();

const deleteEmployee = (id: number) => {
    if (confirm('Are you sure you want to delete this employee?')) {
        router.delete(destroy(id));
    }
};
</script>

<template>

    <Head title="Employees" />

    <AppLayout :breadcrumbs="[{ title: 'Employees', href: index() }]">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Employees
                </h2>
                <Link :href="create()"
                    class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">
                    Add Employee
                </Link>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Position</th>
                            <th scope="col" class="px-6 py-3">Department</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="employee in employees" :key="employee.id"
                            class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ employee.name }}
                            </td>
                            <td class="px-6 py-4">{{ employee.email }}</td>
                            <td class="px-6 py-4">{{ employee.position }}</td>
                            <td class="px-6 py-4">{{ employee.department }}</td>
                            <td class="px-6 py-4">
                                <Link :href="edit(employee.id)"
                                    class="mr-3 font-medium text-blue-600 hover:underline dark:text-blue-500">
                                    Edit
                                </Link>
                                <button @click="deleteEmployee(employee.id)"
                                    class="font-medium text-red-600 hover:underline dark:text-red-500">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <tr v-if="employees.length === 0">
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No employees found.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
