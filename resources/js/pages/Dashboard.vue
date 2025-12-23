<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem, type Feed } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { MessageSquare, Check, Calendar, Vote, File, Image, Link, Globe, Calendar1, ThumbsUp, MessageSquareText, Pin, Share, EllipsisVertical, FileText, Download } from 'lucide-vue-next';

const props = defineProps<{
    feeds: Feed[];
}>();

const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Feed',
        href: dashboard().url,
    },
];

const form = useForm({
    type: 'post' as 'post' | 'event' | 'project_update' | 'social',
    content: '',
    title: '',
    event_date: '',
    is_pinned: false,
});

const submit = () => {
    form.post('/feed', {
        onSuccess: () => {
            form.reset('content', 'title', 'event_date');
            if (form.type !== 'post') {
                form.type = 'post';
            }
        },
    });
};
</script>

<template>

    <Head title="Feed" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <!-- <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div
                    class="relative overflow-hidden rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-center gap-4">
                        <div class="rounded-lg bg-blue-50 p-3 dark:bg-blue-900/20">
                            <Users class="h-6 w-6 text-blue-600 dark:text-blue-400" />
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Employees</p>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">1,234</h3>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs text-green-600 dark:text-green-400">
                        <ArrowUpRight class="mr-1 h-3 w-3" />
                        <span class="font-medium">12% from last month</span>
                    </div>
                </div>

                <div
                    class="relative overflow-hidden rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-center gap-4">
                        <div class="rounded-lg bg-purple-50 p-3 dark:bg-purple-900/20">
                            <Building2 class="h-6 w-6 text-purple-600 dark:text-purple-400" />
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Departments</p>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">8</h3>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs text-gray-500 dark:text-gray-400">
                        <span class="font-medium">Across 3 Regions</span>
                    </div>
                </div>

                <div
                    class="relative overflow-hidden rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-center gap-4">
                        <div class="rounded-lg bg-amber-50 p-3 dark:bg-amber-900/20">
                            <FolderKanban class="h-6 w-6 text-amber-600 dark:text-amber-400" />
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Projects</p>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">24</h3>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs text-green-600 dark:text-green-400">
                        <ArrowUpRight class="mr-1 h-3 w-3" />
                        <span class="font-medium">4 new this week</span>
                    </div>
                </div>
            </div> -->

            <!-- <div
                class="flex-1 rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800"> -->
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Feed</h3>
                <p class="text-xs text-gray-500">Check the latest updates from your team</p>
            </div>
            <div
                class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden mb-6">
                <!-- Composer Tabs -->
                <div
                    class="flex border-b border-border-light dark:border-border-dark px-2 bg-background-light/50 dark:bg-surface-dark">
                    <button @click="form.type = 'post'"
                        :class="[form.type === 'post' ? 'border-primary text-text-main dark:text-white' : 'border-transparent text-text-muted hover:text-text-main dark:text-gray-400 dark:hover:text-white']"
                        class="flex items-center gap-2 px-4 py-3 border-b-[3px] transition-colors font-medium text-sm">
                        <MessageSquare /> Message
                    </button>
                    <button @click="form.type = 'project_update'"
                        :class="[form.type === 'project_update' ? 'border-primary text-text-main dark:text-white' : 'border-transparent text-text-muted hover:text-text-main dark:text-gray-400 dark:hover:text-white']"
                        class="flex items-center gap-2 px-4 py-3 border-b-[3px] transition-colors font-medium text-sm">
                        <Check /> Task
                    </button>
                    <button @click="form.type = 'event'"
                        :class="[form.type === 'event' ? 'border-primary text-text-main dark:text-white' : 'border-transparent text-text-muted hover:text-text-main dark:text-gray-400 dark:hover:text-white']"
                        class="flex items-center gap-2 px-4 py-3 border-b-[3px] transition-colors font-medium text-sm">
                        <Calendar /> Event
                    </button>
                    <button @click="form.type = 'social'"
                        :class="[form.type === 'social' ? 'border-primary text-text-main dark:text-white' : 'border-transparent text-text-muted hover:text-text-main dark:text-gray-400 dark:hover:text-white']"
                        class="flex items-center gap-2 px-4 py-3 border-b-[3px] transition-colors font-medium text-sm">
                        <Vote /> Poll
                    </button>
                    <button
                        class="flex items-center gap-2 px-4 py-3 border-b-[3px] border-transparent text-text-muted hover:text-text-main dark:text-gray-400 dark:hover:text-white transition-colors font-medium text-sm">
                        <File /> File
                    </button>
                </div>
                <!-- Composer Input -->
                <form @submit.prevent="submit">
                    <div class="p-4">
                        <div class="flex gap-3">
                            <div class="bg-center bg-no-repeat bg-cover rounded-full size-10 shrink-0"
                                data-alt="User profile picture"
                                :style="{ backgroundImage: `url(${page.props.auth.user.avatar || 'https://ui-avatars.com/api/?name=' + page.props.auth.user.name})` }">
                            </div>
                            <div class="flex-1 space-y-3">
                                <input v-if="form.type !== 'post'" v-model="form.title" type="text"
                                    placeholder="Title (optional)"
                                    class="w-full bg-transparent border-b border-border-light dark:border-border-dark p-2 text-text-main dark:text-white placeholder:text-text-muted/60 focus:ring-0 text-sm mb-2" />

                                <textarea v-model="form.content"
                                    class="w-full bg-transparent border-none p-0 text-text-main dark:text-white placeholder:text-text-muted/60 focus:ring-0 text-base resize-none min-h-[80px]"
                                    placeholder="What's on your mind?"></textarea>

                                <div v-if="form.type === 'event'" class="flex items-center gap-2">
                                    <label class="text-sm text-text-muted">Event Date:</label>
                                    <input type="datetime-local" v-model="form.event_date"
                                        class="bg-transparent border border-gray-300 dark:border-gray-600 rounded p-1 text-sm dark:text-white">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Composer Footer -->
                    <div
                        class="px-4 py-3 bg-background-light/30 dark:bg-background-dark/30 flex items-center justify-between border-t border-border-light dark:border-border-dark">
                        <div class="flex items-center gap-1">
                            <button type="button"
                                class="p-2 text-text-muted hover:bg-background-light hover:text-primary rounded-lg transition-colors"
                                title="Upload Image">
                            </button>
                            <button type="button"
                                class="p-2 text-text-muted hover:bg-background-light hover:text-primary rounded-lg transition-colors"
                                title="Attach File">
                                <Image />
                            </button>
                            <button type="button"
                                class="p-2 text-text-muted hover:bg-background-light hover:text-primary rounded-lg transition-colors"
                                title="Insert Link">
                            </button>
                            <button type="button"
                                class="p-2 text-text-muted hover:bg-background-light hover:text-primary rounded-lg transition-colors"
                                title="Add Tag">
                                <Link />
                            </button>
                            <div class="h-5 w-px bg-border-light dark:bg-border-dark mx-1"></div>
                            <button type="button"
                                class="p-2 text-text-muted hover:bg-background-light hover:text-primary rounded-lg transition-colors text-xs font-medium flex items-center gap-1">
                                <Globe /> All Employees
                            </button>
                        </div>
                        <button type="submit" :disabled="form.processing"
                            class="bg-primary hover:bg-blue-700 text-white font-medium text-sm px-6 py-2 rounded-lg transition-colors shadow-sm shadow-primary/30 disabled:opacity-50">
                            Post
                        </button>
                    </div>
                </form>
            </div>
            <div class="flex flex-col gap-6">
                <template v-for="feed in feeds" :key="feed.id">
                    <!-- Pinned/Event Post -->
                    <article v-if="feed.type === 'event' || feed.is_pinned"
                        class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border border-yellow-200 dark:border-yellow-900/50 overflow-hidden relative">
                        <div v-if="feed.is_pinned" class="absolute top-0 left-0 w-1 h-full bg-yellow-400"></div>
                        <div v-if="feed.is_pinned" class="absolute top-4 right-4 text-yellow-500 transform rotate-12">
                            <Pin />
                        </div>
                        <div class="p-5">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="bg-center bg-no-repeat bg-cover rounded-full size-10"
                                    :style="{ backgroundImage: `url(${feed.user.avatar || 'https://ui-avatars.com/api/?name=' + feed.user.name})` }">
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="text-text-main dark:text-white font-bold text-sm">{{ feed.user.name
                                            }}</h4>
                                        <span v-if="feed.is_pinned"
                                            class="bg-yellow-100 text-yellow-800 text-[10px] px-2 py-0.5 rounded-full font-bold uppercase tracking-wide dark:bg-yellow-900/50 dark:text-yellow-200">Announcement</span>
                                    </div>
                                    <div class="text-xs text-text-muted dark:text-gray-500">
                                        {{ new Date(feed.created_at).toLocaleString() }} • to <span
                                            class="text-primary font-medium">All Employees</span>
                                    </div>
                                </div>
                            </div>
                            <div class="prose prose-sm max-w-none text-text-main dark:text-gray-200 mb-4">
                                <p v-if="feed.title" class="font-medium text-lg">{{ feed.title }}</p>
                                <p class="whitespace-pre-line">{{ feed.content }}</p>
                            </div>
                            <div v-if="feed.event_date"
                                class="bg-yellow-50 dark:bg-yellow-900/10 border border-yellow-100 dark:border-yellow-900/30 rounded-lg p-3 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="bg-white dark:bg-surface-dark p-2 rounded-lg shadow-sm text-yellow-300">
                                        <Calendar1 />
                                    </div>
                                    <div>
                                        <div class="font-bold text-sm text-text-main dark:text-white">{{ feed.title ||
                                            'Event' }}
                                        </div>
                                        <div class="text-xs text-text-muted">{{ new
                                            Date(feed.event_date).toLocaleString() }}</div>
                                    </div>
                                </div>
                                <button class="text-primary text-sm font-bold hover:underline px-3">I'm
                                    Attending</button>
                            </div>
                        </div>
                        <div
                            class="bg-background-light/50 dark:bg-background-dark/50 px-5 py-3 border-t border-border-light dark:border-border-dark flex items-center justify-between">
                            <div class="flex gap-4">
                                <button
                                    class="flex items-center gap-1.5 text-sm font-medium text-text-muted hover:text-primary transition-colors">
                                    <ThumbsUp /> Like <span
                                        class="bg-white dark:bg-surface-dark px-1.5 rounded text-xs border border-border-light dark:border-border-dark ml-1">{{
                                            feed.likes_count }}</span>
                                </button>
                                <button
                                    class="flex items-center gap-1.5 text-sm font-medium text-text-muted hover:text-primary transition-colors">
                                    <MessageSquareText /> Comment <span
                                        class="bg-white dark:bg-surface-dark px-1.5 rounded text-xs border border-border-light dark:border-border-dark ml-1">{{
                                            feed.comments_count }}</span>
                                </button>
                            </div>
                            <button
                                class="flex items-center gap-1 text-xs font-medium text-text-muted hover:text-primary">
                                <Share /> Share
                            </button>
                        </div>
                    </article>

                    <!-- Standard Post -->
                    <article v-else
                        class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                        <div class="p-5">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="bg-center bg-no-repeat bg-cover rounded-full size-10"
                                        :style="{ backgroundImage: `url(${feed.user.avatar || 'https://ui-avatars.com/api/?name=' + feed.user.name})` }">
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <h4 class="text-text-main dark:text-white font-bold text-sm">{{
                                                feed.user.name }}</h4>
                                        </div>
                                        <div class="text-xs text-text-muted dark:text-gray-500">
                                            {{ new Date(feed.created_at).toLocaleString() }}
                                        </div>
                                    </div>
                                </div>
                                <button class="text-text-muted hover:text-text-main dark:hover:text-white">
                                    <EllipsisVertical />
                                </button>
                            </div>
                            <div
                                class="text-text-main dark:text-gray-200 mb-4 text-sm leading-relaxed whitespace-pre-line">
                                <p v-if="feed.title" class="mb-2 font-bold">{{ feed.title }}</p>
                                <p>{{ feed.content }}</p>
                            </div>
                        </div>
                        <!-- Reactions / Footer -->
                        <div
                            class="bg-background-light/50 dark:bg-background-dark/50 px-5 py-3 border-t border-border-light dark:border-border-dark">
                            <div class="flex gap-4">
                                <button
                                    class="flex items-center gap-1.5 text-sm font-medium text-text-muted hover:text-primary transition-colors">
                                    <ThumbsUp /> Like <span
                                        class="bg-white dark:bg-surface-dark px-1.5 rounded text-xs border border-border-light dark:border-border-dark ml-1">{{
                                            feed.likes_count }}</span>
                                </button>
                                <button
                                    class="flex items-center gap-1.5 text-sm font-medium text-text-muted hover:text-primary transition-colors">
                                    <MessageSquareText /> Comment <span
                                        class="bg-white dark:bg-surface-dark px-1.5 rounded text-xs border border-border-light dark:border-border-dark ml-1">{{
                                            feed.comments_count }}</span>
                                </button>
                            </div>
                        </div>
                    </article>
                </template>
            </div>
        </div>
    </AppLayout>
</template>
