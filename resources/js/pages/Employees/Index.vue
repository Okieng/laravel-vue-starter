<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { create, destroy, edit, index } from '@/routes/employees';
import { Head, Link, router } from '@inertiajs/vue3';
import { Pencil, Plus, Trash2, Search, Filter, ChevronUp, ChevronDown, ChevronLeft, ChevronRight } from 'lucide-vue-next';
import Swal from 'sweetalert2';
import { ref, watch } from 'vue';

const props = defineProps<{
    employees: {
        data: Array<{
            idkaryawan: string;
            namakaryawan: string;
            email: string;
            nik: string;
            jeniskelamin: string;
            namajabatan: string;
        }>;
        links: Array<{
            url: string | null;
            label: string;
            active: boolean;
        }>;
    };
    filters: {
        search: string;
        sort: string;
        direction: string;
    };
}>();

const search = ref(props.filters.search || '');
const sort = ref(props.filters.sort || '');
const direction = ref(props.filters.direction || '');

let timeout: ReturnType<typeof setTimeout>;

const handleSearch = () => {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        router.get(
            index().url,
            { search: search.value, sort: sort.value, direction: direction.value },
            { preserveState: true, replace: true }
        );
    }, 300);
};

const handleSort = (field: string) => {
    if (sort.value === field) {
        direction.value = direction.value === 'asc' ? 'desc' : 'asc';
    } else {
        sort.value = field;
        direction.value = 'asc';
    }

    router.get(
        index().url,
        { search: search.value, sort: sort.value, direction: direction.value },
        { preserveState: true, replace: true }
    );
};

const deleteEmployee = (id: string) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e11d48',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Yes, delete it!',
        customClass: {
            popup: 'dark:bg-gray-800 dark:text-white',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(destroy(id).url, {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Employee has been deleted.',
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

const getInitials = (name: string) => {
    if (!name) return '??';
    return name
        .split(' ')
        .map((n) => n[0])
        .filter(Boolean)
        .join('')
        .toUpperCase()
        .substring(0, 2);
};
</script>

<template>

    <Head title="Employees" />

    <AppLayout :breadcrumbs="[{ title: 'Employees', href: index().url }]">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <!-- Header Section -->
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Employees
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Manage your team members (Karyawan) and their information.
                    </p>
                </div>
            </div>

            <!-- Search and Filter Bar -->
            <div
                class="flex items-center justify-between gap-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="relative max-w-sm flex-1">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <Search class="h-5 w-5 text-gray-400" />
                    </div>
                    <input v-model="search" @input="handleSearch" type="text"
                        class="block w-full rounded-lg border-gray-300 pl-10 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-500 dark:focus:ring-indigo-500"
                        placeholder="Search by name, nik, or email..." />
                </div>
            </div>

            <!-- Table Section -->
            <div class="rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="overflow-x-auto rounded-xl">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-500 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <!-- <th scope="col" class="px-6 py-4 font-medium">
                                    ID
                                </th> -->
                                <th scope="col"
                                    class="cursor-pointer px-6 py-4 font-medium hover:bg-gray-100 dark:hover:bg-gray-600"
                                    @click="handleSort('namakaryawan')">
                                    <div class="flex items-center gap-2">
                                        Nama
                                        <div v-if="sort === 'namakaryawan'">
                                            <ChevronUp v-if="direction === 'asc'" class="h-4 w-4" />
                                            <ChevronDown v-else class="h-4 w-4" />
                                        </div>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-4 font-medium">
                                    NIK
                                </th>
                                <th scope="col" class="px-6 py-4 font-medium">
                                    Jenis Kelamin
                                </th>
                                <th scope="col" class="px-6 py-4 font-medium">
                                    Jabatan
                                </th>
                                <th scope="col" class="px-6 py-4 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <tr v-for="employee in employees.data" :key="employee.idkaryawan"
                                class="group transition-colors hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <!-- <td class="px-6 py-4 font-mono text-xs text-gray-500 dark:text-gray-400">
                                    {{ employee.idkaryawan }}
                                </td> -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 text-indigo-700 font-bold dark:bg-indigo-900/30 dark:text-indigo-400">
                                            {{ getInitials(employee.namakaryawan) }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900 dark:text-white">
                                                {{ employee.namakaryawan }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ employee.email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 dark:text-gray-300">
                                    {{ employee.nik }}
                                </td>
                                <td class="px-6 py-4">
                                    <span :class="[
                                        'inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset',
                                        employee.jeniskelamin === 'L'
                                            ? 'bg-blue-50 text-blue-700 ring-blue-700/10 dark:bg-blue-900/30 dark:text-blue-400 dark:ring-blue-400/30'
                                            : 'bg-pink-50 text-pink-700 ring-pink-700/10 dark:bg-pink-900/30 dark:text-pink-400 dark:ring-pink-400/30'
                                    ]">
                                        {{ employee.jeniskelamin === 'L' ? 'Laki Laki' : 'Perempuan' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10 dark:bg-gray-700 dark:text-gray-300 dark:ring-gray-600">
                                        {{ employee.namajabatan || '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2 transition-opacity">
                                        <Link :href="edit(employee.idkaryawan).url"
                                            class="rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-blue-600 dark:hover:bg-gray-700 dark:hover:text-blue-400"
                                            title="Edit">
                                            <Pencil class="h-4 w-4" />
                                        </Link>
                                        <button @click="deleteEmployee(employee.idkaryawan)"
                                            class="rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-red-600 dark:hover:bg-gray-700 dark:hover:text-red-400"
                                            title="Delete">
                                            <Trash2 class="h-4 w-4" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="employees.data.length === 0">
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <div class="rounded-full bg-gray-100 p-3 dark:bg-gray-800">
                                            <Search class="h-6 w-6 text-gray-400" />
                                        </div>
                                        <p class="text-base font-medium">No employees found</p>
                                        <p class="text-sm">Try adjusting your search or filters.</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="border-t border-gray-200 px-4 py-3 sm:px-6 dark:border-gray-700"
                    v-if="employees.links.length > 3">
                    <div class="flex items-center justify-between">
                        <div class="flex flex-1 justify-between sm:hidden">
                            <Link v-if="employees.links[0].url" :href="employees.links[0].url ?? '#'"
                                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                Previous
                            </Link>
                            <Link v-if="employees.links[employees.links.length - 1].url"
                                :href="employees.links[employees.links.length - 1].url ?? '#'"
                                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                Next
                            </Link>
                        </div>
                        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-end">
                            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                <template v-for="(link, key) in employees.links" :key="key">
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
