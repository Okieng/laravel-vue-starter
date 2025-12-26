<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router, usePage } from '@inertiajs/vue3';
import { useIntervalFn } from '@vueuse/core';
import { Send, MessageCircle } from 'lucide-vue-next';
import { nextTick, onMounted, ref, watch } from 'vue';

defineOptions({
    name: 'Chat',
});

const props = defineProps({
    users: {
        type: Array,
        required: true,
    },
});

const page = usePage();
const authUser = page.props.auth.user;

const breadcrumbs = [
    {
        title: 'Chat',
        href: '/chat',
    },
];

const selectedUser = ref(null);
const messages = ref([]);
const newMessage = ref('');
const messagesContainer = ref(null);
const isSending = ref(false);

const scrollToBottom = async () => {
    await nextTick();
    if (messagesContainer.value) {
        messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight;
    }
};

const fetchMessages = async () => {
    if (!selectedUser.value) return;

    try {
        const response = await fetch(`/chat/${selectedUser.value.id}`);
        messages.value = await response.json();
    } catch (error) {
        console.error('Failed to fetch messages', error);
    }
};

const selectUser = async (user) => {
    selectedUser.value = user;
    await fetchMessages();
    scrollToBottom();
};

const sendMessage = async () => {
    if (!selectedUser.value || !newMessage.value.trim() || isSending.value) return;

    isSending.value = true;
    try {
        const response = await fetch(`/chat/${selectedUser.value.id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            },
            body: JSON.stringify({ content: newMessage.value }),
        });

        if (response.ok) {
            const message = await response.json();
            messages.value.push(message);
            newMessage.value = '';
            scrollToBottom();
        } else {
            console.error('Failed to send message', await response.text());
            alert('Failed to send message. Please reload the page.');
        }
    } catch (error) {
        console.error('Failed to send message', error);
        alert('An error occurred. Please try again.');
    } finally {
        isSending.value = false;
    }
};

const fetchUsers = () => {
    router.reload({
        only: ['users', 'auth'],
        preserveState: true,
        preserveScroll: true,
    });
};

// Poll for new messages every 3 seconds
useIntervalFn(() => {
    if (selectedUser.value) {
        fetchMessages();
    }
    // Also update user list to show new unread counts from other users
    fetchUsers();
}, 3000);

watch(() => messages.value.length, () => {
    // Only scroll if we were arguably at the bottom or it's a new load?
    // For now, let's behave like a simple chat app
    // scrollToBottom(); 
    // Actually, constantly scrolling might be annoying if user is reading up history.
    // Let's only scroll on initial load or send.
});

</script>

<template>

    <Head title="Chat" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-[calc(100vh-8rem)] flex-1 overflow-hidden rounded-xl bg-surface-light dark:bg-surface-dark shadow-sm border border-border-light dark:border-border-dark">
            <!-- Sidebar: User List -->
            <div
                class="w-1/3 border-r border-border-light dark:border-border-dark flex flex-col bg-background-light/50 dark:bg-background-dark/50">
                <div class="p-4 border-b border-border-light dark:border-border-dark">
                    <h3 class="font-semibold text-text-main dark:text-white">Contacts</h3>
                </div>
                <div class="flex-1 overflow-y-auto">
                    <button v-for="user in users" :key="user.id" @click="selectUser(user)"
                        class="w-full text-left p-4 hover:bg-surface-active dark:hover:bg-primary/10 transition-colors flex items-center gap-3 border-b border-border-light/50 dark:border-border-dark/50 last:border-0"
                        :class="{ 'bg-primary/10 border-l-4 border-l-primary': selectedUser?.id === user.id }">
                        <div
                            class="h-10 w-10 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold relative">
                            {{ user.name.charAt(0) }}
                            <span v-if="user.unread_count && user.unread_count > 0"
                                class="absolute -top-1 -right-1 h-3 w-3 bg-red-500 rounded-full border-2 border-white dark:border-zinc-900"></span>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <p class="font-medium text-text-main dark:text-white">{{ user.name }}</p>
                                <span v-if="user.unread_count && user.unread_count > 0"
                                    class="text-[10px] bg-red-500 text-white px-1.5 py-0.5 rounded-full font-bold">
                                    {{ user.unread_count }}
                                </span>
                            </div>
                            <p class="text-xs"
                                :class="user.is_active ? 'text-green-600 font-medium' : 'text-text-muted'">
                                {{ user.is_active ? 'Online' : 'Offline' }}
                            </p>
                        </div>
                    </button>
                    <div v-if="users.length === 0" class="p-4 text-center text-text-muted text-sm">
                        No other users found.
                    </div>
                </div>
            </div>

            <!-- Main: Chat Window -->
            <div class="flex-1 flex flex-col bg-white dark:bg-zinc-900">
                <div v-if="selectedUser" class="flex-1 flex flex-col h-full">
                    <!-- Chat Header -->
                    <div
                        class="p-4 border-b border-border-light dark:border-border-dark flex items-center gap-3 bg-surface-light dark:bg-surface-dark shadow-sm z-10">
                        <div
                            class="h-8 w-8 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold text-sm">
                            {{ selectedUser.name.charAt(0) }}
                        </div>
                        <div>
                            <h3 class="font-semibold text-text-main dark:text-white">{{ selectedUser.name }}</h3>
                            <p class="text-xs"
                                :class="selectedUser?.is_active ? 'text-green-600 font-medium' : 'text-text-muted'">
                                <!-- {{ selectedUser?.is_active ? 'Online' : 'Offline' }} -->
                            </p>
                        </div>
                    </div>

                    <!-- Messages Area -->
                    <div ref="messagesContainer"
                        class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50/50 dark:bg-black/20">
                        <div v-if="messages.length === 0" class="text-center py-10 text-text-muted text-sm">
                            No messages yet. Say hi!
                        </div>
                        <div v-for="msg in messages" :key="msg.id" class="flex"
                            :class="msg.sender_id === authUser.id ? 'justify-end' : 'justify-start'">
                            <div class="max-w-[70%] rounded-2xl p-3 px-4 shadow-sm text-sm"
                                :class="msg.sender_id === authUser.id
                                    ? 'bg-primary text-white rounded-br-none'
                                    : 'bg-white dark:bg-zinc-800 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-zinc-700 rounded-bl-none'">
                                <p>{{ msg.content }}</p>
                                <p class="text-[10px] mt-1 opacity-70 text-right">
                                    {{ new Date(msg.created_at).toLocaleTimeString([], {
                                        hour: '2-digit',
                                        minute: '2-digit'
                                    }) }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Input Area -->
                    <div
                        class="p-4 border-t border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark">
                        <form @submit.prevent="sendMessage" class="flex gap-2">
                            <input v-model="newMessage" type="text" placeholder="Type a message..."
                                class="flex-1 rounded-full border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white focus:border-primary focus:ring focus:ring-primary/20 text-sm px-4 py-2"
                                :disabled="isSending" />
                            <button type="submit" :disabled="!newMessage.trim() || isSending"
                                class="bg-primary text-white p-2 rounded-full hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                                <Send class="h-5 w-5" />
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-else
                    class="flex-1 flex flex-col items-center justify-center text-text-muted bg-gray-50/30 dark:bg-black/10">
                    <div
                        class="h-16 w-16 bg-gray-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mb-4">
                        <MessageCircle class="h-8 w-8 text-gray-400" />
                    </div>
                    <p class="font-medium">Select a contact to start chatting</p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
