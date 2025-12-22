<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { MessageSquare, Check, Calendar, Vote, File, Image, Link, Globe, Calendar1, ThumbsUp, MessageSquareText, Pin, Share, EllipsisVertical, FileText, Download } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Feed',
        href: dashboard().url,
    },
];
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
                    <button
                        class="flex items-center gap-2 px-4 py-3 border-b-[3px] border-primary text-text-main dark:text-white font-medium text-sm">
                        <MessageSquare /> Message
                    </button>
                    <button
                        class="flex items-center gap-2 px-4 py-3 border-b-[3px] border-transparent text-text-muted hover:text-text-main dark:text-gray-400 dark:hover:text-white transition-colors font-medium text-sm">
                        <Check /> Task
                    </button>
                    <button
                        class="flex items-center gap-2 px-4 py-3 border-b-[3px] border-transparent text-text-muted hover:text-text-main dark:text-gray-400 dark:hover:text-white transition-colors font-medium text-sm">
                        <Calendar /> Event
                    </button>
                    <button
                        class="flex items-center gap-2 px-4 py-3 border-b-[3px] border-transparent text-text-muted hover:text-text-main dark:text-gray-400 dark:hover:text-white transition-colors font-medium text-sm">
                        <Vote /> Poll
                    </button>
                    <button
                        class="flex items-center gap-2 px-4 py-3 border-b-[3px] border-transparent text-text-muted hover:text-text-main dark:text-gray-400 dark:hover:text-white transition-colors font-medium text-sm">
                        <File /> File
                    </button>
                </div>
                <!-- Composer Input -->
                <div class="p-4">
                    <div class="flex gap-3">
                        <div class="bg-center bg-no-repeat bg-cover rounded-full size-10 shrink-0"
                            data-alt="User profile picture of Alex"
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDtR_SFl1km0Ua_dUze5eP_zPy_cuuJZ62uy3tKFrPZ28pkT_Z8AMvHF2OOXHTHgJn8kY8IXdMQOfkQAmtd6B0jvlZWHzvWn2redcEgRrfYAoc0Y9xh2P7-H9npnLgvb0cFYaidzUvMX-YQG_vQLrls1A9INrBzsOcJxqTbwW1-hFH4q3cod4VtXiz8zOLDVpRdNXWRHnGsf4b77Pewd3qMr5mbnJ7Mq08SvBNUBfOYdihu7r0t1jHURG2gDFnM8p3EVp8pH19RdJaa");'>
                        </div>
                        <div class="flex-1">
                            <textarea
                                class="w-full bg-transparent border-none p-0 text-text-main dark:text-white placeholder:text-text-muted/60 focus:ring-0 text-base resize-none min-h-[80px]"
                                placeholder="Apa yang sedang anda pikirkan?"></textarea>
                        </div>
                    </div>
                </div>
                <!-- Composer Footer -->
                <div
                    class="px-4 py-3 bg-background-light/30 dark:bg-background-dark/30 flex items-center justify-between border-t border-border-light dark:border-border-dark">
                    <div class="flex items-center gap-1">
                        <button
                            class="p-2 text-text-muted hover:bg-background-light hover:text-primary rounded-lg transition-colors"
                            title="Upload Image">
                        </button>
                        <button
                            class="p-2 text-text-muted hover:bg-background-light hover:text-primary rounded-lg transition-colors"
                            title="Attach File">
                            <Image />
                        </button>
                        <button
                            class="p-2 text-text-muted hover:bg-background-light hover:text-primary rounded-lg transition-colors"
                            title="Insert Link">
                        </button>
                        <button
                            class="p-2 text-text-muted hover:bg-background-light hover:text-primary rounded-lg transition-colors"
                            title="Add Tag">
                            <Link />
                        </button>
                        <div class="h-5 w-px bg-border-light dark:bg-border-dark mx-1"></div>
                        <button
                            class="p-2 text-text-muted hover:bg-background-light hover:text-primary rounded-lg transition-colors text-xs font-medium flex items-center gap-1">
                            <Globe /> All Employees
                        </button>
                    </div>
                    <button
                        class="bg-primary hover:bg-blue-700 text-white font-medium text-sm px-6 py-2 rounded-lg transition-colors shadow-sm shadow-primary/30">
                        Post
                    </button>
                </div>

                <!-- </div> -->
                <!-- <div class="p-6">
                    <div class="space-y-6">
                        <div v-for="i in 5" :key="i" class="flex items-start gap-4">
                            <div class="rounded-full bg-gray-100 p-2 dark:bg-gray-700">
                                <Activity class="h-4 w-4 text-gray-600 dark:text-gray-300" />
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                    New employee verification pending
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    2 hours ago
                                </p>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="flex flex-col gap-6">
                <!-- Pinned Post -->
                <article
                    class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border border-yellow-200 dark:border-yellow-900/50 overflow-hidden relative">
                    <div class="absolute top-0 left-0 w-1 h-full bg-yellow-400"></div>
                    <div class="absolute top-4 right-4 text-yellow-500 transform rotate-12">
                        <Pin />
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="bg-center bg-no-repeat bg-cover rounded-full size-10"
                                data-alt="Profile picture of Sarah from HR"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC14Vyjov5_bE55DEQBZJCt2zU55gFmDqzQyvYWHzeOQ0WjeERX75i5lBHcYpYRc147rsx97TENmfeCnV0Afp0pk87Y2bcKRZzQ-GUR8OI2uRS3FmGvsZalyvqT8gf25ME-ODADHV3Oq5U_2paTI6i1sZcfQkKZlw3wQ0oZWOZY8LEV5msU-jcEmMFhVS1BS5xzJCzXo500QXGbKU6FdM4x1_NOUQX6_gu2HSDkIyQ6IRWjqshDmhxQ1j21ODWG96gRQrs7J5WsK9DX");'>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h4 class="text-text-main dark:text-white font-bold text-sm">Sarah Jenkins</h4>
                                    <span
                                        class="bg-yellow-100 text-yellow-800 text-[10px] px-2 py-0.5 rounded-full font-bold uppercase tracking-wide dark:bg-yellow-900/50 dark:text-yellow-200">Announcement</span>
                                </div>
                                <div class="text-xs text-text-muted dark:text-gray-500">
                                    Today, 09:30 AM • to <span class="text-primary font-medium">All Employees</span>
                                </div>
                            </div>
                        </div>
                        <div class="prose prose-sm max-w-none text-text-main dark:text-gray-200 mb-4">
                            <p class="font-medium text-lg">🎉 Annual Company Picnic is this Friday!</p>
                            <p>Hi everyone! Just a reminder that our annual summer picnic is happening this Friday
                                at Central Park. We'll have food trucks, games, and music. Please RSVP by Wednesday
                                so we can get the headcount right for catering.</p>
                        </div>
                        <div
                            class="bg-yellow-50 dark:bg-yellow-900/10 border border-yellow-100 dark:border-yellow-900/30 rounded-lg p-3 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="bg-white dark:bg-surface-dark p-2 rounded-lg shadow-sm text-yellow-300">
                                    <Calendar1 />
                                </div>
                                <div>
                                    <div class="font-bold text-sm text-text-main dark:text-white">Summer Picnic 2023
                                    </div>
                                    <div class="text-xs text-text-muted">Friday, Aug 25 • 12:00 PM</div>
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
                                <ThumbsUp/> Like <span
                                    class="bg-white dark:bg-surface-dark px-1.5 rounded text-xs border border-border-light dark:border-border-dark ml-1">24</span>
                            </button>
                            <button
                                class="flex items-center gap-1.5 text-sm font-medium text-text-muted hover:text-primary transition-colors">
                                <MessageSquareText /> Comment <span
                                    class="bg-white dark:bg-surface-dark px-1.5 rounded text-xs border border-border-light dark:border-border-dark ml-1">5</span>
                            </button>
                        </div>
                        <button class="flex items-center gap-1 text-xs font-medium text-text-muted hover:text-primary">
                            <Share /> Share
                        </button>
                    </div>
                </article>
                <!-- Standard Post (Project Update) -->
                <article
                    class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="bg-center bg-no-repeat bg-cover rounded-full size-10"
                                    data-alt="Profile picture of Mike form Product"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDtYOq8T4fb9oBYgKItrhGVTqJvo1uy2IAKeRlISzqWE9l7RiJUEN9IxlHmf4w88m2W5zM3SnR7aZT6pqY7gic5edlj8lumsDFuRZ46OxhsfiOCdw2tTQNL2czMzXT0bVWq2TMol2RfUPBf0leWwnCcqBr41GVy1K3qQHQwTChMxLBdrW6za3bN9mvfyIBlM7JapnSMthazkLgiGADxwn4fwmF3CEpNPC60zh0CIIkyY6QYbOeueYpIfkFCcYvJgdphiK83MDy5ZnZf");'>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="text-text-main dark:text-white font-bold text-sm">Mike Ross</h4>
                                    </div>
                                    <div class="text-xs text-text-muted dark:text-gray-500">
                                        2 hours ago • to <span class="text-primary font-medium">Project Alpha
                                            Team</span>
                                    </div>
                                </div>
                            </div>
                            <button class="text-text-muted hover:text-text-main dark:hover:text-white">
                                <EllipsisVertical />
                            </button>
                        </div>
                        <div class="text-text-main dark:text-gray-200 mb-4 text-sm leading-relaxed">
                            <p class="mb-2">We've just finalized the Q3 roadmap for <span
                                    class="text-primary font-medium cursor-pointer">#ProjectAlpha</span>. The new
                                designs have been approved and we are moving into the development phase next week.
                            </p>
                            <p>Attached is the detailed breakdown of the sprints.</p>
                        </div>
                        <!-- File Attachment -->
                        <div class="flex gap-3 mb-2">
                            <div
                                class="flex items-center gap-3 bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark p-3 rounded-lg max-w-sm w-full hover:border-primary/50 transition-colors cursor-pointer group">
                                <div
                                    class="size-10 bg-red-100 dark:bg-red-900/30 rounded flex items-center justify-center text-red-500">
                                    <FileText />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div
                                        class="font-medium text-sm text-text-main dark:text-white truncate group-hover:text-primary">
                                        Q3_Roadmap_Final.pdf</div>
                                    <div class="text-xs text-text-muted">2.4 MB • PDF Document</div>
                                </div>
                                <button class="text-text-muted hover:text-primary">
                                    <Download />
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Reactions / Footer -->
                    <div
                        class="bg-background-light/50 dark:bg-background-dark/50 px-5 py-3 border-t border-border-light dark:border-border-dark">
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex -space-x-2 overflow-hidden">
                                <img alt="User 1"
                                    class="inline-block h-6 w-6 rounded-full ring-2 ring-white dark:ring-surface-dark"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBVKOY3sR203tcOXvw29nUrlNLgicVdOAkT1AEIhtt6DTXJH_xezVFve8T3wMzblZjwq7VU-fMUu9iAGEC_jjVKa-ZcHjssureP1b6KrWFa-gl2tOavZDcuK_VYwlcqf7XjVb3M4O9n9uZbH3pjDUZhAQoCfBTsGt2LyVdYvijab3LvsX_YXbpgutkOLZDqWj3TkKUuROK9Cd92s8X5btZkwOAYA8Her5odpklPwOWOZtC9ulRS2d6yYreb8sSG1GXENwzGAgKnBeFa" />
                                <img alt="User 2"
                                    class="inline-block h-6 w-6 rounded-full ring-2 ring-white dark:ring-surface-dark"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDzqr09JmkENZJjvfdfXHB0PNeQP-ISipaHpf8INDSfaN9F5TukMsOQQqdkdQvzk2AWUXaGemnkpvpGmw2pLq5qg-VKxye6Yj5eFMI9-aruguYfJVJ1crc4vVe3tS5gfWWUaNV9f9Dzs3G2--5AdpMdK59rlP6JiXIvweGd_iBe7L4RghOU3LEktw9iSIVxVUPeAisEb30-ZL7dwuAlbB1Q6qaQw4sNZMSFWQZy3rv7-dd_NoR01Y4otqWAJKmlx5Q19AEyhrzUdJ__" />
                                <div
                                    class="h-6 w-6 rounded-full ring-2 ring-white dark:ring-surface-dark bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-[10px] font-bold text-gray-600 dark:text-gray-300">
                                    +8</div>
                            </div>
                            <div class="text-xs text-text-muted">12 likes • 3 comments</div>
                        </div>
                        <div class="flex gap-4 border-t border-border-light dark:border-border-dark pt-2">
                            <button
                                class="flex items-center gap-1.5 text-sm font-medium text-primary transition-colors">
                                <ThumbsUp /> Liked
                            </button>
                            <button
                                class="flex items-center gap-1.5 text-sm font-medium text-text-muted hover:text-primary transition-colors">
                                <MessageSquareText /> Comment
                            </button>
                        </div>
                    </div>
                </article>
                <!-- Social Post (New Hire) -->
                <article
                    class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="bg-center bg-no-repeat bg-cover rounded-full size-10"
                                    data-alt="Profile picture of HR"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAsupuyqFM4VVSnH0WfOLMhRdufkNevg_WyIpVQsvlQLO2qqcSRO1dgwZgRfMG-CTYl2KFTi6y7gMoqBnWhTtEvXu3-9mIK2-XDpB9odl8ZJ3lW6myb0rTsGJ_odgVWN0JZ5r-HIiqIjWqCdmc6zGfR8yd9-0otHYV-UJ3cKuKeEfC8q5sNVA9rhsjFOyGG5o2a0cpGzPqpD6WO8zak3oaOeK5UtELua_cI8eafEf0iUja71TPfsoUGkRFMX9f36QV1V0NPgweDCYLa");'>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="text-text-main dark:text-white font-bold text-sm">Jessica Pearson
                                        </h4>
                                        <span class="text-text-muted text-xs">→</span>
                                        <span class="text-text-main dark:text-white font-medium text-sm">General</span>
                                    </div>
                                    <div class="text-xs text-text-muted dark:text-gray-500">
                                        5 hours ago
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-text-main dark:text-gray-200 mb-4 text-sm">
                            <p>Please join me in welcoming <span class="text-primary font-medium">@David Kim</span>
                                to the Design Team! David brings 5 years of experience in UX research and we are
                                thrilled to have him on board. 🚀</p>
                        </div>
                        <!-- Image Grid -->
                        <div class="rounded-lg overflow-hidden grid grid-cols-2 gap-1 h-64 mb-4">
                            <div class="bg-cover bg-center h-full w-full" data-alt="Office welcome party photo"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBPaUlBbDyLeawzl0uwm5152mvrdhRISbr5i7ivp_uBDtq8Wh78pp1SuKSIjI88MPXqvBEFZgHiUlJaBWnyz1JgNHDuXq2dh9YkuzfvZHNcV2mDWf4nIprbyiTe-aVJdKNs_vJzRMp7Ysu8wIVmfGf3AmO_Pi8g0gXDvfsU197GvBdWKpQrMWifuG22Kqyj4cdeDiIvyM7NiPuXmDT75gT5ej5NJqkMSaV3LHMjLc2tn7zmNigYWUqrUQI6Zjpat0324KMwUmwjKJ4s");'>
                            </div>
                            <div class="bg-cover bg-center h-full w-full" data-alt="Portrait of new employee David"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuArKVi6hAwmQzG_qow-77CIt5ffc_yJPWH32Ejsu3eU6SHmMdSqibrlkM-3drYlMDtUFmSspNpndJsOu50gSfMvNDlzM_izaHZi2dg2_kQjiVLv1sIrcK5w0wrvpK78FlXvhXbz2Hz5-RnJWg72bXMaG6sKFTFOApeM9M-xTTThcIQcLB3Pbhd--7moWN21O7wrzL6NZK3C1ZRhbeTFqi3UVBn56lyLoiaMy5qV08gRh5yzhVtTA5uXHoMRiZDfRCLnPcGzMapuWycH");'>
                            </div>
                        </div>
                        <!-- Comments Section (Preview) -->
                        <div class="bg-background-light dark:bg-background-dark rounded-lg p-3 space-y-3">
                            <div class="flex gap-2 items-start">
                                <div class="size-6 rounded-full bg-cover bg-center shrink-0" data-alt="User avatar"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAn3l3lB4TjQprluFYU2ldXlioTjwj2viCq4_18k826VM92MJ_eXjBQiQ-whxKAOnbG_5OUNWRAsRRPL-uol_2EitgDTdJo4_jESaXVRzybKEqGhliAVZLWKwTKmgSpIuplOCZ8DiCa6cz-Lwsn_XxZVUfDAPp_ykYvFaV35PF8yMLW1-Ek1FkkuDaE2Q_e5hVh6L4S-LOlbkNmdd7wsN3ff66Yg0M09yXppNSLopM9OqhmoiB6x_5A9OHePvGWw1QEmRgVZXqUu4y1");'>
                                </div>
                                <div
                                    class="bg-white dark:bg-surface-dark p-2 rounded-lg rounded-tl-none shadow-sm flex-1">
                                    <p class="text-xs font-bold text-text-main dark:text-white">Alex Morgan</p>
                                    <p class="text-xs text-text-main dark:text-gray-300">Welcome to the team, David!
                                        Let's grab coffee soon.</p>
                                </div>
                            </div>
                            <div class="flex gap-2 items-center pl-8">
                                <div class="size-6 rounded-full bg-cover bg-center shrink-0" data-alt="Your avatar"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAQyI_rKPlJ1TQNflV9-EltYs2hMd9P2XBeZ_bjZWndJjC-yohvXTFjabBV8n6FLFhkVK1zqoAhBgAPP3uYLt43DnZ72aWztBjhAP-JiaCaatVZs-OGWL1SmnKI2f8f-Fx7ovv0gTLEe-5KEyosbD8QY7w4BD2v4YAtDLs0uBgz5EqmJLpDcMYeG4kkOtD1A_tp3RA2VsOAUDu6g4-PoAdzOXC3uLbYcp65DpcKLZ2NJPkAXnMzF9WLXC81dJ10kHGRHMERZZn5tQTx");'>
                                </div>
                                <input
                                    class="flex-1 bg-transparent border-b border-border-light dark:border-border-dark text-sm py-1 focus:border-primary focus:ring-0 placeholder:text-text-muted/60"
                                    placeholder="Write a comment..." type="text" />
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </AppLayout>
</template>
