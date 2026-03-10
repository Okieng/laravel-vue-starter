<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import {
    Clock,
    User,
    Folder,
    Layout,
    Plus,
    Search,
    MoreHorizontal,
    Globe,
    Lock,
    Settings
} from 'lucide-vue-next';

const props = defineProps({
    projects: Array,
    filters: Object
});

const breadcrumbs = [
    {
        title: 'Projects',
        href: '/projects',
    },
];

const menuItems = [
    { id: 'recently_viewed', label: 'Recently viewed', icon: Clock },
    { id: 'created_by_me', label: 'Created by me', icon: User },
    { id: 'all', label: 'Projects', icon: Folder },
    { id: 'templates', label: 'Templates', icon: Layout },
];

const currentFilter = computed(() => props.filters.current || 'all');

const searchQuery = ref('');

const filteredProjects = computed(() => {
    if (!searchQuery.value) return props.projects;
    return props.projects.filter(p =>
        p.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        (p.description && p.description.toLowerCase().includes(searchQuery.value.toLowerCase()))
    );
});

const isNewProjectModalOpen = ref(false);
const newProject = ref({
    name: '',
    description: '',
    visibility: 'public',
    is_template: false
});

const createProject = () => {
    router.post('/projects', newProject.value, {
        onSuccess: () => {
            isNewProjectModalOpen.value = false;
            newProject.value = { name: '', description: '', visibility: 'public', is_template: false };
        }
    });
};

const trackView = (project) => {
    router.post(`/projects/${project.id}/view`, {}, {
        preserveScroll: true,
        onSuccess: () => {
            // Optionally redirect or handle locally
        }
    });
};

</script>

<template>

    <Head title="Projects" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 gap-6 p-6">
            <div class="w-64 shrink-0 flex flex-col gap-2">
                <div v-for="item in menuItems" :key="item.id">
                    <Link :href="`/projects?filter=${item.id}`"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors"
                        :class="currentFilter === item.id
                            ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400'
                            : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-slate-800'">
                        <component :is="item.icon" class="w-4 h-4" />
                        {{ item.label }}
                    </Link>
                </div>

                <hr class="my-4 border-gray-200 dark:border-slate-800" />

                <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">My workflows</h3>
                <Link href="#"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-slate-800">
                    <Settings class="w-4 h-4" />
                    Manage
                </Link>
            </div>

            <div class="flex-1 flex flex-col min-w-0">
                <div class="flex items-center justify-between mb-6">
                    <div class="relative w-full max-w-md">
                        <Search class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
                        <input v-model="searchQuery" type="text" placeholder="Filter projects..."
                            class="w-full pl-10 pr-4 py-2 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all" />
                    </div>
                    <button @click="isNewProjectModalOpen = true"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg flex items-center gap-2 transition-all active:scale-95 shadow-sm">
                        <Plus class="w-4 h-4" />
                        New project
                    </button>
                </div>

                <div
                    class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-xl overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-800/50">
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Name
                                </th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Visibility</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Created By</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-slate-800">
                            <tr v-if="filteredProjects.length === 0">
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                    <Folder class="w-12 h-12 mx-auto mb-3 opacity-20" />
                                    <p class="text-lg font-medium">No projects found</p>
                                    <p class="text-sm">Try adjusting your filters or search query.</p>
                                </td>
                            </tr>
                            <tr v-for="project in filteredProjects" :key="project.id"
                                class="hover:bg-gray-50 dark:hover:bg-slate-800/50 transition-colors group cursor-pointer"
                                @click="trackView(project)">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="p-2 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg text-indigo-600 dark:text-indigo-400">
                                            <Layout v-if="project.is_template" class="w-4 h-4" />
                                            <Folder v-else class="w-4 h-4" />
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-gray-900 dark:text-white">{{
                                                project.name }}</div>
                                            <div v-if="project.description" class="text-xs text-gray-500 line-clamp-1">
                                                {{ project.description }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium"
                                        :class="project.visibility === 'public'
                                            ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400'
                                            : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400'">
                                        <Globe v-if="project.visibility === 'public'" class="w-3 h-3" />
                                        <Lock v-else class="w-3 h-3" />
                                        {{ project.visibility }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-6 h-6 rounded-full bg-gray-200 dark:bg-slate-700 flex items-center justify-center text-[10px] font-bold">
                                            {{ project.user.name.charAt(0) }}
                                        </div>
                                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ project.user.name
                                            }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="p-1 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                                        <MoreHorizontal class="w-5 h-5" />
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div v-if="isNewProjectModalOpen"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
            <div
                class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden animate-in fade-in zoom-in duration-200">
                <div class="p-6 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Create new project</h3>
                    <button @click="isNewProjectModalOpen = false" class="text-gray-400 hover:text-gray-600">
                        <Plus class="w-6 h-6 rotate-45" />
                    </button>
                </div>
                <form @submit.prevent="createProject" class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Project
                            name</label>
                        <input v-model="newProject.name" type="text" required placeholder="e.g. Website Redesign"
                            class="w-full px-4 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-sm outline-none focus:ring-2 focus:ring-indigo-500 transition-all" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description
                            (optional)</label>
                        <textarea v-model="newProject.description" rows="3"
                            class="w-full px-4 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-sm outline-none focus:ring-2 focus:ring-indigo-500 transition-all resize-none"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Visibility</label>
                            <select v-model="newProject.visibility"
                                class="w-full px-4 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-sm outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
                                <option value="public">Public</option>
                                <option value="private">Private</option>
                            </select>
                        </div>
                        <div class="flex items-end pb-2">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input v-model="newProject.is_template" type="checkbox"
                                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" />
                                <span class="text-sm text-gray-700 dark:text-gray-300">Set as template</span>
                            </label>
                        </div>
                    </div>
                </form>
                <div class="p-6 bg-gray-50 dark:bg-slate-800/50 flex justify-end gap-3">
                    <button @click="isNewProjectModalOpen = false"
                        class="px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-slate-800 rounded-lg">
                        Cancel
                    </button>
                    <button @click="createProject"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm active:scale-95 transition-all">
                        Create
                    </button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
