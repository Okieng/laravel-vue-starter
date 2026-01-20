<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem, type Feed, type Comment as CommentType } from '@/types';
import { Head, useForm, usePage, router } from '@inertiajs/vue3';
import { MessageSquare, Check, Calendar, Vote, File, Image, Link, Globe, Calendar1, ThumbsUp, MessageSquareText, Pin, Share, EllipsisVertical, FileText, Download, Send, Trash2 } from 'lucide-vue-next';
import { ref, onMounted, onUnmounted } from 'vue';

const props = defineProps<{
    feeds: Feed[];
}>();

const page = usePage();

// Listen for real-time updates
onMounted(() => {
    if (window.Echo) {
        window.Echo.channel('feeds')
            .listen('CommentCreated', (e: { comment: CommentType }) => {
                const feed = props.feeds.find(f => f.id === e.comment.feed_id);
                if (feed) {
                    // Avoid duplicate comments if we were the sender (though toOthers handles this)
                    if (!feed.comments.find(c => c.id === e.comment.id)) {
                        feed.comments.push(e.comment);
                        feed.comments_count++;
                    }
                }
            })
            .listen('LikeToggled', (e: { feedId: number, likesCount: number }) => {
                const feed = props.feeds.find(f => f.id === e.feedId);
                if (feed) {
                    feed.likes_count = e.likesCount;
                }
            });
    }
});

onUnmounted(() => {
    if (window.Echo) {
        window.Echo.leaveChannel('feeds');
    }
});

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

const commentForms = ref<Record<number, string>>({});
const activeCommentSection = ref<number | null>(null);

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

const toggleLike = (feedId: number) => {
    router.post(`/feed/${feedId}/like`, {}, {
        preserveScroll: true,
    });
};

const toggleComments = (feedId: number) => {
    if (activeCommentSection.value === feedId) {
        activeCommentSection.value = null;
    } else {
        activeCommentSection.value = feedId;
        if (!commentForms.value[feedId]) {
            commentForms.value[feedId] = '';
        }
    }
};

const submitComment = (feedId: number) => {
    if (!commentForms.value[feedId]?.trim()) return;

    router.post(`/feed/${feedId}/comment`, {
        content: commentForms.value[feedId]
    }, {
        preserveScroll: true,
        onSuccess: () => {
            commentForms.value[feedId] = '';
        }
    });
};

const deleteComment = (commentId: number) => {
    if (confirm('Are you sure you want to delete this comment?')) {
        router.delete(`/comment/${commentId}`, {
            preserveScroll: true
        });
    }
};
</script>

<template>

    <Head title="Feed" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 bg-slate-100 dark:bg-slate-50">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700 bg-white dark:bg-black rounded-xl">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Feed</h3>
                <p class="text-xs text-gray-500">Check the latest updates from your team</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Main Feed Section -->
                <div class="lg:col-span-3 space-y-6">
                    <div
                        class="rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden bg-white dark:bg-black">
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
                                <div v-if="feed.is_pinned" class="absolute top-0 left-0 w-1 h-full bg-yellow-400">
                                </div>
                                <div v-if="feed.is_pinned"
                                    class="absolute top-4 right-4 text-yellow-500 transform rotate-12">
                                    <Pin />
                                </div>
                                <div class="p-5 bg-white">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="bg-center bg-no-repeat bg-cover rounded-full size-10"
                                            :style="{ backgroundImage: `url(${feed.user.avatar || 'https://ui-avatars.com/api/?name=' + feed.user.name})` }">
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <h4 class="text-text-main dark:text-white font-bold text-sm">{{
                                                    feed.user.name
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
                                            <div
                                                class="bg-white dark:bg-surface-dark p-2 rounded-lg shadow-sm text-yellow-300">
                                                <Calendar1 />
                                            </div>
                                            <div>
                                                <div class="font-bold text-sm text-text-main dark:text-white">{{
                                                    feed.title ||
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
                                    class="bg-white dark:bg-background-dark/50 px-5 py-3 border-t border-border-light dark:border-border-dark flex items-center justify-between">
                                    <div class="flex gap-4">
                                        <button @click="toggleLike(feed.id)"
                                            :class="[feed.is_liked ? 'text-primary' : 'text-text-muted hover:text-primary']"
                                            class="flex items-center gap-1.5 text-sm font-medium transition-colors">
                                            <ThumbsUp :class="{ 'fill-current': feed.is_liked }" /> Like <span
                                                class="bg-white dark:bg-surface-dark px-1.5 rounded text-xs border border-border-light dark:border-border-dark ml-1">{{
                                                    feed.likes_count }}</span>
                                        </button>
                                        <button @click="toggleComments(feed.id)"
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

                                <!-- Comment Section (Pinned) -->
                                <div v-if="activeCommentSection === feed.id"
                                    class="px-5 py-4 border-t border-border-light dark:border-border-dark bg-white dark:bg-background-dark/20">
                                    <div class="space-y-4 mb-4">
                                        <div v-for="comment in feed.comments" :key="comment.id" class="flex gap-3">
                                            <div class="bg-center bg-no-repeat bg-cover rounded-full size-8 shrink-0"
                                                :style="{ backgroundImage: `url(${comment.user.avatar || 'https://ui-avatars.com/api/?name=' + comment.user.name})` }">
                                            </div>
                                            <div
                                                class="flex-1 bg-white dark:bg-surface-dark rounded-2xl px-4 py-2 shadow-sm relative group">
                                                <div class="flex justify-between items-start">
                                                    <h5 class="font-bold text-xs text-text-main dark:text-white">{{
                                                        comment.user.name }}</h5>
                                                    <button v-if="comment.user_id === page.props.auth.user.id"
                                                        @click="deleteComment(comment.id)"
                                                        class="opacity-0 group-hover:opacity-100 text-red-500 hover:text-red-600 transition-opacity">
                                                        <Trash2 class="size-3" />
                                                    </button>
                                                </div>
                                                <p class="text-sm text-text-main dark:text-gray-300">{{
                                                    comment.content }}</p>
                                                <span class="text-[10px] text-text-muted mt-1 block">{{ new
                                                    Date(comment.created_at).toLocaleString() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex gap-3 mt-2">
                                        <div class="bg-center bg-no-repeat bg-cover rounded-full size-8 shrink-0"
                                            :style="{ backgroundImage: `url(${page.props.auth.user.avatar || 'https://ui-avatars.com/api/?name=' + page.props.auth.user.name})` }">
                                        </div>
                                        <div class="flex-1 relative">
                                            <input v-model="commentForms[feed.id]" type="text"
                                                placeholder="Write a comment..."
                                                class="w-full bg-white dark:bg-surface-dark border-border-light dark:border-border-dark rounded-full px-4 py-1.5 text-sm focus:ring-primary focus:border-primary pr-10"
                                                @keyup.enter="submitComment(feed.id)" />
                                            <button @click="submitComment(feed.id)"
                                                class="absolute right-2 top-1/2 -translate-y-1/2 text-primary hover:text-blue-600 p-1">
                                                <Send class="size-4" />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <!-- Standard Post -->
                            <article v-else
                                class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                                <div class="p-5 bg-white">
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
                                    class="bg-white dark:bg-black px-5 py-3 border-t border-border-light dark:border-border-dark">
                                    <div class="flex gap-4">
                                        <button @click="toggleLike(feed.id)"
                                            :class="[feed.is_liked ? 'text-primary' : 'text-text-muted hover:text-primary']"
                                            class="flex items-center gap-1.5 text-sm font-medium transition-colors">
                                            <ThumbsUp :class="{ 'fill-current': feed.is_liked }" /> Like <span
                                                class="bg-white dark:bg-surface-dark px-1.5 rounded text-xs border border-border-light dark:border-border-dark ml-1">{{
                                                    feed.likes_count }}</span>
                                        </button>
                                        <button @click="toggleComments(feed.id)"
                                            class="flex items-center gap-1.5 text-sm font-medium text-text-muted hover:text-primary transition-colors">
                                            <MessageSquareText /> Comment <span
                                                class="bg-white dark:bg-surface-dark px-1.5 rounded text-xs border border-border-light dark:border-border-dark ml-1">{{
                                                    feed.comments_count }}</span>
                                        </button>
                                    </div>
                                </div>

                                <!-- Comment Section (Standard) -->
                                <div v-if="activeCommentSection === feed.id"
                                    class="px-5 py-4 border-t border-border-light dark:border-border-dark bg-white dark:bg-background-dark/20">
                                    <div class="space-y-4 mb-4">
                                        <div v-for="comment in feed.comments" :key="comment.id" class="flex gap-3">
                                            <div class="bg-center bg-no-repeat bg-cover rounded-full size-8 shrink-0"
                                                :style="{ backgroundImage: `url(${comment.user.avatar || 'https://ui-avatars.com/api/?name=' + comment.user.name})` }">
                                            </div>
                                            <div
                                                class="flex-1 bg-white dark:bg-surface-dark rounded-2xl px-4 py-2 shadow-sm relative group">
                                                <div class="flex justify-between items-start">
                                                    <h5 class="font-bold text-xs text-text-main dark:text-white">{{
                                                        comment.user.name }}</h5>
                                                    <button v-if="comment.user_id === page.props.auth.user.id"
                                                        @click="deleteComment(comment.id)"
                                                        class="opacity-0 group-hover:opacity-100 text-red-500 hover:text-red-600 transition-opacity">
                                                        <Trash2 class="size-3" />
                                                    </button>
                                                </div>
                                                <p class="text-sm text-text-main dark:text-gray-300">{{
                                                    comment.content }}</p>
                                                <span class="text-[10px] text-text-muted mt-1 block">{{ new
                                                    Date(comment.created_at).toLocaleString() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex gap-3 mt-2">
                                        <div class="bg-center bg-no-repeat bg-cover rounded-full size-8 shrink-0"
                                            :style="{ backgroundImage: `url(${page.props.auth.user.avatar || 'https://ui-avatars.com/api/?name=' + page.props.auth.user.name})` }">
                                        </div>
                                        <div class="flex-1 relative">
                                            <input v-model="commentForms[feed.id]" type="text"
                                                placeholder="Write a comment..."
                                                class="w-full bg-white dark:bg-surface-dark border-border-light dark:border-border-dark rounded-full px-4 py-1.5 text-sm focus:ring-primary focus:border-primary pr-10"
                                                @keyup.enter="submitComment(feed.id)" />
                                            <button @click="submitComment(feed.id)"
                                                class="absolute right-2 top-1/2 -translate-y-1/2 text-primary hover:text-blue-600 p-1">
                                                <Send class="size-4" />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </template>
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Birthdays Widget -->
                    <div
                        class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-5">
                        <div class="flex items-center gap-2 mb-4">
                            <Calendar class="size-5 text-primary" />
                            <h4 class="font-bold text-text-main dark:text-white">Upcoming Birthdays</h4>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="bg-center bg-no-repeat bg-cover rounded-full size-10 shrink-0"
                                    data-alt="User profile picture"
                                    :style="{ backgroundImage: `url(${page.props.auth.user.avatar || 'https://ui-avatars.com/api/?name=' + page.props.auth.user.name})` }">
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-text-main dark:text-white">Sarah Johnson</div>
                                    <div class="text-xs text-text-muted">Turning 28 • Tomorrow</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="bg-center bg-no-repeat bg-cover rounded-full size-10 shrink-0"
                                    data-alt="User profile picture"
                                    :style="{ backgroundImage: `url(${page.props.auth.user.avatar || 'https://ui-avatars.com/api/?name=' + page.props.auth.user.name})` }">
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-text-main dark:text-white">Michael Smith</div>
                                    <div class="text-xs text-text-muted">Oct 24</div>
                                </div>
                            </div>
                            <button
                                class="w-full mt-2 py-2 text-sm text-primary font-medium hover:bg-primary/5 rounded-lg transition-colors">
                                View All
                            </button>
                        </div>
                    </div>

                    <!-- Contracts Widget -->
                    <div
                        class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-5">
                        <!-- <div class="flex items-center gap-2 mb-4">
                            <FileText class="size-5 text-primary" />
                            <h4 class="font-bold text-text-main dark:text-white">Contract Renewals</h4>
                        </div>
                        <div class="space-y-4">
                            <div class="p-3 bg-background-light dark:bg-background-dark rounded-lg">
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium text-text-main dark:text-white">Design Team</span>
                                    <span class="text-xs text-orange-500 font-bold">Expiring Soon</span>
                                </div>
                                <div class="text-xs text-text-muted">3 contracts expiring in 30 days</div>
                            </div>
                            <div class="p-3 bg-background-light dark:bg-background-dark rounded-lg">
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium text-text-main dark:text-white">Engineering</span>
                                </div>
                                <div class="text-xs text-text-muted">All good until Dec 2026</div>
                            </div>
                            <button
                                class="w-full mt-2 py-2 text-sm text-primary font-medium hover:bg-primary/5 rounded-lg transition-colors">
                                Manage Contracts
                            </button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
