<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem, type Feed, type Comment as CommentType, type Jabatan } from '@/types';
import { Head, useForm, usePage, router } from '@inertiajs/vue3';
import { MessageSquare, Check, Calendar, Vote, File, Image, Link, Globe, Calendar1, ThumbsUp, MessageSquareText, Pin, Share, EllipsisVertical, FileText, Download, Send, Trash2, X } from 'lucide-vue-next';
import { ref, onMounted, onUnmounted } from 'vue';
import MultiSelect from '@/components/ui/MultiSelect.vue';

const props = defineProps<{
    feeds: Feed[];
    jabatans: Jabatan[];
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
    images: [] as File[],
    file_attachment: [] as File[],
    receiver_id: [] as (string | number)[],
});

const fileInput = ref<HTMLInputElement | null>(null);
const previewImages = ref<string[]>([]);

const commentForms = ref<Record<number, string>>({});
const activeCommentSection = ref<number | null>(null);

const triggerFileInput = () => {
    fileInput.value?.click();
};

const handleFileSelect = (event: Event) => {
    const target = event.target as HTMLInputElement;
    if (target.files) {
        Array.from(target.files).forEach(file => {
            form.images.push(file);
            previewImages.value.push(URL.createObjectURL(file));
        });
    }
};

const removeImage = (index: number) => {
    form.images.splice(index, 1);
    URL.revokeObjectURL(previewImages.value[index]);
    previewImages.value.splice(index, 1);
};

const submit = () => {
    form.post('/feed', {
        onSuccess: () => {
            form.reset('content', 'title', 'event_date', 'images', 'file_attachment', 'receiver_id');
            previewImages.value = []; // Clear previews
            selectedAttachments.value = []; // Clear attachments
            if (form.type !== 'post') {
                form.type = 'post';
            }
        },
    });
};

const toggleLike = (feedId: number) => {
    router.post(`/feed/${feedId}/like`, {}, {
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

const selectedImage = ref<string | null>(null);

const openLightbox = (imageUrl: string) => {
    selectedImage.value = imageUrl;
    document.body.style.overflow = 'hidden'; // Prevent scrolling
};

const closeLightbox = () => {
    selectedImage.value = null;
    document.body.style.overflow = ''; // Restore scrolling
};

const attachmentInput = ref<HTMLInputElement | null>(null);
const selectedAttachments = ref<File[]>([]);

const triggerAttachmentInput = () => {
    attachmentInput.value?.click();
};

const handleAttachmentSelect = (event: Event) => {
    const target = event.target as HTMLInputElement;
    if (target.files) {
        Array.from(target.files).forEach(file => {
            form.file_attachment.push(file);
            selectedAttachments.value.push(file);
        });
    }
};

const removeAttachment = (index: number) => {
    form.file_attachment.splice(index, 1);
    selectedAttachments.value.splice(index, 1);
};

</script>

<template>

    <Head title="Feed" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 bg-slate-100 dark:bg-[#0F1115]">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700 bg-white dark:bg-[#242830] rounded-xl">
                <h3 class="text-lg font-medium text-gray-900 dark:text-[#E2E8F0]">Feed</h3>
                <p class="text-xs text-gray-500">Check the latest updates from your team</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <div class="lg:col-span-3 space-y-6">
                    <div
                        class="rounded-xl shadow-sm border border-border-light dark:border-border-dark bg-white dark:bg-[#0F172A]">
                        <div
                            class="flex border-b border-border-light dark:border-border-dark px-2 bg-background-light/50 dark:bg-[#242830] rounded-t-xl">
                            <button @click="form.type = 'post'"
                                :class="[form.type === 'post' ? 'border-primary text-text-main dark:text-[#E2E8F0]' : 'border-transparent text-text-muted hover:text-text-main dark:text-gray-400 dark:hover:text-[#E2E8F0]']"
                                class="flex items-center gap-2 px-4 py-3 border-b-[3px] transition-colors font-medium text-sm">
                                <MessageSquare /> Message
                            </button>
                            <button @click="form.type = 'project_update'"
                                :class="[form.type === 'project_update' ? 'border-primary text-text-main dark:text-[#E2E8F0]' : 'border-transparent text-text-muted hover:text-text-main dark:text-gray-400 dark:hover:text-[#E2E8F0]']"
                                class="flex items-center gap-2 px-4 py-3 border-b-[3px] transition-colors font-medium text-sm">
                                <Check /> Task
                            </button>
                            <button @click="form.type = 'event'"
                                :class="[form.type === 'event' ? 'border-primary text-text-main dark:text-[#E2E8F0]' : 'border-transparent text-text-muted hover:text-text-main dark:text-gray-400 dark:hover:text-[#E2E8F0]']"
                                class="flex items-center gap-2 px-4 py-3 border-b-[3px] transition-colors font-medium text-sm">
                                <Calendar /> Event
                            </button>

                            <!-- <button
                                class="flex items-center gap-2 px-4 py-3 border-b-[3px] border-transparent text-text-muted hover:text-text-main dark:text-gray-400 dark:hover:text-[#E2E8F0] transition-colors font-medium text-sm">
                                <File /> File
                            </button> -->
                        </div>
                        <!-- Composer Input -->
                        <form @submit.prevent="submit">
                            <div class="p-4 dark:bg-[#242830]">
                                <div class="flex gap-3">
                                    <div class="bg-center bg-no-repeat bg-cover rounded-full size-10 shrink-0"
                                        data-alt="User profile picture"
                                        :style="{ backgroundImage: `url(${page.props.auth.user.avatar || 'https://ui-avatars.com/api/?name=' + page.props.auth.user.name})` }">
                                    </div>
                                    <div class="flex-1 space-y-3">
                                        <input v-if="form.type !== 'post'" v-model="form.title" type="text"
                                            placeholder="Title (optional)"
                                            class="w-full bg-transparent border-b border-border-light dark:border-border-dark p-2 text-text-main dark:text-[#E2E8F0] placeholder:text-text-muted/60 focus:ring-0 text-sm mb-2" />



                                        <textarea v-model="form.content"
                                            class="w-full bg-transparent border-none p-0 text-text-main dark:text-[#E2E8F0] placeholder:text-text-muted/60 focus:ring-0 text-base resize-none min-h-[80px]"
                                            placeholder="What's on your mind?"></textarea>

                                        <div v-if="previewImages.length > 0" class="flex gap-2 flex-wrap mt-2">
                                            <div v-for="(src, index) in previewImages" :key="index"
                                                class="relative size-20 rounded-lg overflow-hidden group">
                                                <img :src="src" class="w-full h-full object-cover" />
                                                <button type="button" @click="removeImage(index)"
                                                    class="absolute top-1 right-1 bg-black/50 text-[#E2E8F0] rounded-full p-0.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <Trash2 class="size-3" />
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Attachment List -->
                                        <div v-if="selectedAttachments.length > 0" class="flex flex-col gap-2 mt-2">
                                            <div v-for="(file, index) in selectedAttachments" :key="index"
                                                class="flex items-center justify-between bg-background-light dark:bg-background-dark/50 p-2 rounded-lg border border-border-light dark:border-border-dark">
                                                <div class="flex items-center gap-2 overflow-hidden">
                                                    <div class="bg-primary/10 p-1.5 rounded text-primary">
                                                        <FileText class="size-4" />
                                                    </div>
                                                    <div class="flex flex-col truncate">
                                                        <span
                                                            class="text-xs font-medium text-text-main dark:text-[#E2E8F0] truncate">{{
                                                                file.name }}</span>
                                                        <span class="text-[10px] text-text-muted">{{ (file.size /
                                                            1024).toFixed(1) }} KB</span>
                                                    </div>
                                                </div>
                                                <button type="button" @click="removeAttachment(index)"
                                                    class="text-text-muted hover:text-red-500 transition-colors">
                                                    <X class="size-4" />
                                                </button>
                                            </div>
                                        </div>

                                        <div v-if="form.type === 'event'" class="flex items-center gap-2">
                                            <label class="text-sm text-text-muted">Event Date:</label>
                                            <input type="datetime-local" v-model="form.event_date"
                                                class="bg-transparent border border-gray-300 dark:border-gray-600 rounded p-1 text-sm dark:text-[#E2E8F0]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-4 py-3 bg-background-light/30 dark:bg-[#242830] flex items-center justify-between border-t border-border-light dark:border-border-dark rounded-b-xl">
                                <div class="flex items-center gap-1">
                                    <input type="file" ref="fileInput" class="hidden" accept="image/*" multiple
                                        @change="handleFileSelect" />
                                    <button type="button" @click="triggerFileInput"
                                        class="p-2 text-text-muted hover:bg-background-light hover:text-primary rounded-lg transition-colors"
                                        title="Attach Images">
                                        <Image />
                                    </button>
                                    <input type="file" ref="attachmentInput" class="hidden" multiple
                                        @change="handleAttachmentSelect" />
                                    <button type="button" @click="triggerAttachmentInput"
                                        class="p-2 text-text-muted hover:bg-background-light hover:text-primary rounded-lg transition-colors"
                                        title="Attach File">
                                        <File />
                                    </button>
                                    <div class="h-5 w-px bg-border-light dark:bg-border-dark mx-1"></div>
                                    <div class="flex items-center gap-1.5">
                                        <MultiSelect v-model="form.receiver_id" :options="jabatans"
                                            label-key="namajabatan" value-key="idjabatan" placeholder="All Employees"
                                            class="w-[200px] border-none shadow-none bg-slate-100 dark:bg-slate-800" />
                                    </div>
                                </div>
                                <button type="submit" :disabled="form.processing"
                                    class="bg-primary dark:bg-white dark:text-black hover:bg-secondary text-[#E2E8F0] font-medium text-sm px-6 py-2 rounded-lg transition-colors shadow-sm shadow-primary/30 disabled:opacity-50">
                                    Post
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="flex flex-col gap-6">
                        <template v-for="feed in feeds" :key="feed.id">
                            <article v-if="feed.type === 'event' || feed.is_pinned"
                                class="bg-surface-light dark:bg-[#242830] rounded-xl shadow-sm border border-yellow-200 dark:border-yellow-900/50 overflow-hidden relative">
                                <div v-if="feed.is_pinned" class="absolute top-0 left-0 w-1 h-full bg-yellow-400">
                                </div>
                                <div v-if="feed.is_pinned"
                                    class="absolute top-4 right-4 text-yellow-500 transform rotate-12">
                                    <Pin />
                                </div>
                                <div class="p-5 bg-white dark:bg-[#1A1D23]">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="bg-center bg-no-repeat bg-cover rounded-full size-10"
                                            :style="{ backgroundImage: `url(${feed.user.avatar || 'https://ui-avatars.com/api/?name=' + feed.user.name})` }">
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <h4 class="text-text-main dark:text-[#E2E8F0] font-bold text-sm">{{
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

                                    <!-- Feed Images -->
                                    <div v-if="feed.images && feed.images.length > 0" class="mb-4">
                                        <div :class="[
                                            'grid gap-2',
                                            feed.images.length === 1 ? 'grid-cols-1' :
                                                feed.images.length === 2 ? 'grid-cols-2' :
                                                    feed.images.length === 3 ? 'grid-cols-2' : 'grid-cols-2'
                                        ]">
                                            <div v-for="(image, index) in feed.images" :key="index" :class="[
                                                'rounded-lg overflow-hidden relative cursor-pointer group',
                                                feed.images.length === 3 && index === 0 ? 'row-span-2' : '',
                                                'h-48 w-full'
                                            ]" @click="openLightbox('/storage/' + image)">
                                                <img :src="'/storage/' + image" loading="lazy"
                                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Feed Attachments -->
                                    <div v-if="feed.file_attachment && feed.file_attachment.length > 0"
                                        class="mb-4 flex flex-col gap-2">
                                        <div v-for="(file, index) in feed.file_attachment" :key="index"
                                            class="flex items-center justify-between bg-slate-50 dark:bg-slate-800 p-3 rounded-lg border border-slate-100 dark:border-slate-700">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="bg-blue-100 dark:bg-blue-900/30 p-2 rounded-lg text-blue-600 dark:text-blue-400">
                                                    <FileText class="size-5" />
                                                </div>
                                                <div class="flex flex-col">
                                                    <span
                                                        class="text-sm font-medium text-text-main dark:text-[#E2E8F0] truncate max-w-[200px]">{{
                                                            file.split('/').pop() }}</span>
                                                    <span class="text-xs text-text-muted">Attachment</span>
                                                </div>
                                            </div>
                                            <a :href="'/storage/' + file" target="_blank" download
                                                class="flex items-center gap-1 text-xs font-medium text-primary hover:underline bg-primary/5 hover:bg-primary/10 px-3 py-1.5 rounded-lg transition-colors">
                                                <Download class="size-3.5" /> Download
                                            </a>
                                        </div>
                                    </div>

                                    <div v-if="feed.event_date"
                                        class="bg-yellow-50 dark:bg-yellow-900/10 border border-yellow-100 dark:border-yellow-900/30 rounded-lg p-3 flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="bg-white dark:bg-[#242830] p-2 rounded-lg shadow-sm text-yellow-300">
                                                <Calendar1 />
                                            </div>
                                            <div>
                                                <div class="font-bold text-sm text-text-main dark:text-[#E2E8F0]">{{
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
                                    class="bg-white dark:bg-[#1A1D23] px-5 py-3 border-t border-border-light dark:border-border-dark flex items-center justify-between">
                                    <div class="flex gap-4">
                                        <button @click="toggleLike(feed.id)"
                                            :class="[feed.is_liked ? 'text-primary' : 'text-text-muted hover:text-primary']"
                                            class="flex items-center gap-1.5 text-sm font-medium transition-colors">
                                            <ThumbsUp :class="{ 'fill-current': feed.is_liked }" /> Like <span
                                                class="bg-white dark:bg-[#0F172A] px-1.5 rounded text-xs border border-border-light dark:border-border-dark ml-1">{{
                                                    feed.likes_count }}</span>
                                        </button>
                                        <button @click="toggleComments(feed.id)"
                                            class="flex items-center gap-1.5 text-sm font-medium text-text-muted hover:text-primary transition-colors">
                                            <MessageSquareText /> Comment <span
                                                class="bg-white dark:bg-[#0F172A] px-1.5 rounded text-xs border border-border-light dark:border-border-dark ml-1">{{
                                                    feed.comments_count }}</span>
                                        </button>
                                    </div>
                                    <button
                                        class="flex items-center gap-1 text-xs font-medium text-text-muted hover:text-primary">
                                        <Share /> Share
                                    </button>
                                </div>

                                <div v-if="activeCommentSection === feed.id"
                                    class="px-5 py-4 border-t border-border-light dark:border-border-dark bg-white dark:bg-[#242830]">
                                    <div class="space-y-4 mb-4">
                                        <div v-for="comment in feed.comments" :key="comment.id" class="flex gap-3">
                                            <div class="bg-center bg-no-repeat bg-cover rounded-full size-8 shrink-0"
                                                :style="{ backgroundImage: `url(${comment.user.avatar || 'https://ui-avatars.com/api/?name=' + comment.user.name})` }">
                                            </div>
                                            <div
                                                class="flex-1 bg-white dark:bg-[#242830] rounded-2xl px-4 py-2 shadow-sm relative group">
                                                <div class="flex justify-between items-start">
                                                    <h5 class="font-bold text-xs text-text-main dark:text-[#E2E8F0]">{{
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
                                                class="w-full bg-white dark:bg-[#242830] border-border-light dark:border-border-dark rounded-full px-4 py-1.5 text-sm focus:ring-primary focus:border-primary pr-10"
                                                @keyup.enter="submitComment(feed.id)" />
                                            <button @click="submitComment(feed.id)"
                                                class="absolute right-2 top-1/2 -translate-y-1/2 text-primary hover:text-blue-600 p-1">
                                                <Send class="size-4" />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <article v-else
                                class="bg-surface-light rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                                <div class="p-5 bg-white dark:bg-[#1A1D23]">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-3">
                                            <div class="bg-center bg-no-repeat bg-cover rounded-full size-10"
                                                :style="{ backgroundImage: `url(${feed.user.avatar || 'https://ui-avatars.com/api/?name=' + feed.user.name})` }">
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-2">
                                                    <h4 class="text-text-main dark:text-[#E2E8F0] font-bold text-sm">{{
                                                        feed.user.name }}</h4>
                                                </div>
                                                <div class="text-xs text-text-muted dark:text-gray-500">
                                                    {{ new Date(feed.created_at).toLocaleString() }}
                                                </div>
                                            </div>
                                        </div>
                                        <button class="text-text-muted hover:text-text-main dark:hover:text-[#E2E8F0]">
                                            <EllipsisVertical />
                                        </button>
                                    </div>
                                    <div
                                        class="text-text-main dark:text-gray-200 mb-4 text-sm leading-relaxed whitespace-pre-line">
                                        <p v-if="feed.title" class="mb-2 font-bold">{{ feed.title }}</p>
                                        <p>{{ feed.content }}</p>
                                    </div>

                                    <!-- Feed Images (Unpinned) -->
                                    <div v-if="feed.images && feed.images.length > 0" class="mb-4">
                                        <div :class="[
                                            'grid gap-2',
                                            feed.images.length === 1 ? 'grid-cols-1' :
                                                feed.images.length === 2 ? 'grid-cols-2' :
                                                    feed.images.length === 3 ? 'grid-cols-2' : 'grid-cols-2'
                                        ]">
                                            <div v-for="(image, index) in feed.images" :key="index" :class="[
                                                'rounded-lg overflow-hidden relative cursor-pointer group',
                                                feed.images.length === 3 && index === 0 ? 'row-span-2' : '',
                                                'h-48 w-full'
                                            ]" @click="openLightbox('/storage/' + image)">
                                                <img :src="'/storage/' + image" loading="lazy"
                                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Feed Attachments -->
                                    <div v-if="feed.file_attachment && feed.file_attachment.length > 0"
                                        class="mb-4 flex flex-col gap-2">
                                        <div v-for="(file, index) in feed.file_attachment" :key="index"
                                            class="flex items-center justify-between bg-slate-50 dark:bg-slate-800 p-3 rounded-lg border border-slate-100 dark:border-slate-700">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="bg-blue-100 dark:bg-blue-900/30 p-2 rounded-lg text-blue-600 dark:text-blue-400">
                                                    <FileText class="size-5" />
                                                </div>
                                                <div class="flex flex-col">
                                                    <span
                                                        class="text-sm font-medium text-text-main dark:text-[#E2E8F0] truncate max-w-[200px]">{{
                                                            file.split('/').pop() }}</span>
                                                    <span class="text-xs text-text-muted">Attachment</span>
                                                </div>
                                            </div>
                                            <a :href="'/storage/' + file" target="_blank" download
                                                class="flex items-center gap-1 text-xs font-medium text-primary hover:underline bg-primary/5 hover:bg-primary/10 px-3 py-1.5 rounded-lg transition-colors">
                                                <Download class="size-3.5" /> Download
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="bg-white dark:bg-[#1A1D23] px-5 py-3 border-t border-border-light dark:border-white">
                                    <div class="flex gap-4">
                                        <button @click="toggleLike(feed.id)"
                                            :class="[feed.is_liked ? 'text-primary' : 'text-text-muted hover:text-primary']"
                                            class="flex items-center gap-1.5 text-sm font-medium transition-colors">
                                            <ThumbsUp :class="{ 'fill-current': feed.is_liked }" /> Like <span
                                                class="bg-white dark:bg-[#0F172A] px-1.5 rounded text-xs border border-border-light dark:border-border-dark ml-1">{{
                                                    feed.likes_count }}</span>
                                        </button>
                                        <button @click="toggleComments(feed.id)"
                                            class="flex items-center gap-1.5 text-sm font-medium text-text-muted hover:text-primary transition-colors">
                                            <MessageSquareText /> Comment <span
                                                class="bg-white dark:bg-[#0F172A] px-1.5 rounded text-xs border border-border-light dark:border-border-dark ml-1">{{
                                                    feed.comments_count }}</span>
                                        </button>
                                    </div>
                                </div>

                                <div v-if="activeCommentSection === feed.id"
                                    class="px-5 py-4 border-t border-border-light dark:border-border-dark bg-white dark:bg-[#1A1D23]">
                                    <div class="space-y-4 mb-4">
                                        <div v-for="comment in feed.comments" :key="comment.id" class="flex gap-3">
                                            <div class="bg-center bg-no-repeat bg-cover rounded-full size-8 shrink-0"
                                                :style="{ backgroundImage: `url(${comment.user.avatar || 'https://ui-avatars.com/api/?name=' + comment.user.name})` }">
                                            </div>
                                            <div
                                                class="flex-1 bg-white dark:bg-[#242830] rounded-2xl px-4 py-2 shadow-sm relative group">
                                                <div class="flex justify-between items-start">
                                                    <h5 class="font-bold text-xs text-text-main dark:text-[#E2E8F0]">{{
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
                                                class="w-full bg-white dark:bg-[#242830] border-border-light dark:border-border-dark rounded-full px-4 py-1.5 text-sm focus:ring-primary focus:border-primary pr-10"
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

                <div class="lg:col-span-1 space-y-6">
                    <div
                        class="bg-white dark:bg-[#0F172A] rounded-xl shadow-sm border border-border-light dark:border-border-dark p-5">
                        <div class="flex items-center gap-2 mb-4">
                            <Calendar class="size-5 text-primary" />
                            <h4 class="font-bold text-text-main dark:text-[#E2E8F0]">Upcoming Birthdays</h4>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="bg-center bg-no-repeat bg-cover rounded-full size-10 shrink-0"
                                    data-alt="User profile picture"
                                    :style="{ backgroundImage: `url(${page.props.auth.user.avatar || 'https://ui-avatars.com/api/?name=' + page.props.auth.user.name})` }">
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-text-main dark:text-[#E2E8F0]">Sarah Johnson
                                    </div>
                                    <div class="text-xs text-text-muted">Turning 28 • Tomorrow</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="bg-center bg-no-repeat bg-cover rounded-full size-10 shrink-0"
                                    data-alt="User profile picture"
                                    :style="{ backgroundImage: `url(${page.props.auth.user.avatar || 'https://ui-avatars.com/api/?name=' + page.props.auth.user.name})` }">
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-text-main dark:text-[#E2E8F0]">Michael Smith
                                    </div>
                                    <div class="text-xs text-text-muted">Oct 24</div>
                                </div>
                            </div>
                            <button
                                class="w-full mt-2 py-2 text-sm text-primary font-medium hover:bg-primary/5 rounded-lg transition-colors">
                                View All
                            </button>
                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-[#0F172A] rounded-xl shadow-sm border border-border-light dark:border-border-dark p-5">
                        <div class="flex items-center gap-2 mb-4">
                            <FileText class="size-5 text-primary" />
                            <h4 class="font-bold text-text-main dark:text-[#E2E8F0]">Contract Renewals</h4>
                        </div>
                        <div class="space-y-4">
                            <div class="p-3 bg-background-light dark:bg-background-dark rounded-lg">
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium text-text-main dark:text-[#E2E8F0]">Design
                                        Team</span>
                                    <span class="text-xs text-orange-500 font-bold">Expiring Soon</span>
                                </div>
                                <div class="text-xs text-text-muted">3 contracts expiring in 30 days</div>
                            </div>
                            <div class="p-3 bg-background-light dark:bg-background-dark rounded-lg">
                                <div class="flex justify-between mb-1">
                                    <span
                                        class="text-sm font-medium text-text-main dark:text-[#E2E8F0]">Engineering</span>
                                </div>
                                <div class="text-xs text-text-muted">All good until Dec 2026</div>
                            </div>
                            <button
                                class="w-full mt-2 py-2 text-sm text-primary font-medium hover:bg-primary/5 rounded-lg transition-colors">
                                Manage Contracts
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <Teleport to="body">
            <div v-if="selectedImage"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-sm transition-opacity"
                @click="closeLightbox">
                <button @click="closeLightbox"
                    class="absolute top-4 right-4 text-[#E2E8F0] hover:text-gray-300 bg-white/10 hover:bg-white/20 rounded-full p-2 transition-colors">
                    <X class="size-8" />
                </button>
                <div class="relative max-w-7xl max-h-screen p-4" @click.stop>
                    <img :src="selectedImage" class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl" />
                </div>
            </div>
        </Teleport>
    </AppLayout>
</template>
